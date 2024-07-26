<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Tool;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Font\NotoSans;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('renter.create', [
            'tools' => Tool::where('status', 'Available')->latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'renter_name' => 'required',
            'renter_email' => 'required',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $validatedData['rental_date'] = now();
        $validatedData['rental_status'] = 'Rented';

        $tool = Tool::find($validatedData['tool_id']);

        if (!$tool) {
            return redirect()->back()->withErrors('Tool not found.');
        }

        $tool->status = 'Rented';
        $tool->save();

        Rent::create($validatedData);

        return redirect()->route('home')->with('success', 'Tool rented successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rent $rent)
    {
        return view('renter.show', [
            'rent' => $rent,
            'tool' => $rent->tool,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rent $rent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rent $rent)
    {
        $validatedData = $request->validate([
            'return_date' => 'required|date|after_or_equal:rental_date',
        ]);

        $rent = Rent::findOrfail($rent->id);
        $tool = Tool::find($rent->tool_id);

        if (!$tool) {
            return redirect()->back()->withErrors('Tool not found.');
        }

        $rent->return_date = $validatedData['return_date'];
        $rent->rental_status = 'Returned';

        // Hitung total biaya sewa
        $rentalDays = Carbon::parse($rent->rental_date)->diffInDays(Carbon::parse($validatedData['return_date'])) + 1;
        $totalCost = $tool->price_per_day * $rentalDays;

        // Hitung denda jika terlambat
        $lateDays = Carbon::parse($validatedData['return_date'])->diffInDays(Carbon::parse($rent->due_date), false);
        $lateDays = round($lateDays);
        $lateFee = $lateDays <= 0 ? $tool->price_per_day * $lateDays : 0;
        // jadikan denda positif
        $lateFee = abs($lateFee);

        // Bulatkan total biaya dan denda ke dua desimal
        $rent->total_cost = round($totalCost, 2);
        $rent->late_fee = round($lateFee, 2);
        $rent->save();

        $tool->status = 'Available';
        $tool->save();

        return redirect()->route('home')->with('success', 'Tool returned successfully.');
    }

    /**
     * Download invoice.
     */
    public function downloadInvoice($id)
    {
        $rent = Rent::findOrfail($id);

        // Generate QR code for the WhatsApp message link
        $whatsappNumber = '6281325693477'; // Nomor WhatsApp Admin Only
        $invoiceNumber = '[RNT-' . $rent->id . '-' . now()->format('dmy') . ']';
        
        // buat pesan WhatsApp dengan format: Halo, saya ingin klaim invoice [RNT-1-010121] Nama Peminjam - Total Biaya + Fee lalu buat format monospace
        $whatsappMessage = '```Halo, saya ingin klaim invoice ' . $invoiceNumber . ' ' . $rent->renter_name . ' - Rp. ' . number_format($rent->total_cost + $rent->late_fee, 0, ',', '.') . ' mohon untuk segera diproses. Terima kasih.```';
        

        $whatsappLink = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode($whatsappMessage) . '%0A%0A' . route('rents.show', $rent->id);

        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($whatsappLink)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->labelText('Scan To contact Admin')
            ->labelFont(new NotoSans(20))
            ->size(560)
            ->margin(0)
            ->build();

        $qrCodeImage = $result->getDataUri();

        // Ambil data dari database
        $rentdate = \Carbon\Carbon::parse($rent->rental_date);
        $duedate = \Carbon\Carbon::parse($rent->due_date);
        $returndate = \Carbon\Carbon::parse($rent->return_date);

        $diffDay = $rentdate->diffInDays($duedate, true) + 1;
        $estimatePrice = $rent->total_cost; // total_cost sudah mencakup biaya sewa
        $lateFee = $rent->late_fee;

        // hitung hari keterlambatan
        $lateDays = $returndate->diffInDays($duedate, false) + (-1);
        // $lateDays = round($lateDays);
        if ($lateDays <= 0) {
            $lateDays = abs($lateDays);
        } else {
            $lateDays = 0;
        }

        // Data yang akan dikirim ke view
        $data = [
            'rent' => $rent,
            'rent_unique_id' => 'RNT-' . $rent->id . '-' . now()->format('dmy'),
            'rentdate' => $rentdate,
            'duedate' => $duedate,
            'returndate' => $returndate,
            'lateDays' => $lateDays,
            'diffDay' => $diffDay,
            'estimatePrice' => $estimatePrice,
            'lateFee' => $lateFee,
            'totalCost' => $estimatePrice + $lateFee,
            'qrCodeImage' => $qrCodeImage,
            'whatsappLink' => $whatsappLink,
        ];

        $pdf = Pdf::loadView('renter.invoice', $data);
        // download and stream pdf
        $invoiceName = 'Invoice-' .'_'. $rent->id .'_'. $rent->renter_name .'_'. now()->format('d m Y') . '.pdf';
        // return $pdf->download($invoiceName);
        return $pdf->stream($invoiceName);
    }

    /**
     * Weekly report.
     */
    public function weeklyReport(Rent $rent)
    {
        $totalRents = $rent->count();
        $totalIncome = $rent->sum('total_cost');
        $totalLateFee = $rent->sum('late_fee');

        return view('renter.report', [
            'rents' => \App\Models\Rent::with('tool')->latest()->get(),
            'totalRents' => $totalRents,
            'totalIncome' => $totalIncome,
            'totalLateFee' => $totalLateFee,
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent $rent)
    {
        //
    }
}
