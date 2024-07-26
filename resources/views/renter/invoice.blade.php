<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $rent_unique_id . '-' . strtoupper($rent->renter_name) }}</title>
    <style>
        body {
            margin: 0 auto;
            font-family: 'Consolas', monospace;
            color: #4B5563;
        }
        .header table {
            width: 100%;
            background-color: #F3F4F6;
            padding: 20px 40px 20px 40px;
        }
        .header img {
            width: 112px;
            height: auto;
        }
        .header .text-right {
            text-align: right;
        }
        .header h2 {
            margin: 0 0 8px 0;
            font-size: 32px;
            font-weight: bolder;
            color: #1F2937;
        }
        .header p {
            margin: 4px 0;
            font-size: 14px;
            color: #6B7280;
        }


        .section table {
            width: 100%;
            font-size: 14px;
            color: #4B5563;
            padding-top: 60px;
            padding-left: 40px;
            padding-right: 40px;
        }
        .section thead {
            border-bottom: 1px solid #E5E7EB;
        }
        .section tbody {
            border-bottom: 1px solid #E5E7EB;
        }
        .section th {
            text-decoration: underline;
            text-transform: uppercase;
            background-color: #F3F4F6;
            padding: 8px 24px;
        }
        .section td {
            padding: 6px 24px;
        }

        .content {
            padding: 40px;
        }
        .content table {
            width: 100%;
            text-align: left;
            font-size: 14px;
            color: #4B5563;
            border-collapse: collapse;
        }
        .content th {
            padding: 8px 24px;
        }
        .content td {
            padding: 16px 24px;
        }
        .content thead {
            text-transform: uppercase;
            color: #374151;
        }
        .content thead th {
            background-color: #F3F4F6;
        }
        .content tbody tr {
            border-bottom: 1px solid #E5E7EB;
        }
        .content tbody tr:nth-child(odd) {
            background-color: #FFFFFF;
            
        }
        .content tbody tr:nth-child(even) {
            background-color: #FFFFFF;
        }
        .content tfoot {
            background-color: #ECFDF5;
            font-weight: bold;
            color: #047857;
        }
        .content tfoot td {
            padding: 16px 24px;
        }
        .content tfoot th, tfoot td {
            text-transform: uppercase;
        }

        .qrcode {
            text-align: center;
            padding: 40px;
        }
        .qrcode img {
            padding: 8px;
            width: 180px;
            height: auto;
            border: 2px dashed #1F2937;
        }
        .qrcode p {
            margin: 12px 0;
            font-size: 14px;
            color: #6B7280;
        }
        .qrcode a {
            padding: 8px 16px;
            margin: 8px 0;
            color: #E5E7EB;
            background-color: #3B82F6;
            text-decoration: none;
        }

        .footer {
            text-align: right;
            color: #6B7280;
            /* make in the bottom */
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .footer p {
            margin: 4px 0;
            font-size: 14px;
        }


        .text-left {
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .whitespace-nowrap {
            white-space: nowrap;
        }
        .py-1 {
            padding-top: 46px;
            padding-bottom: 46px;
        }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <thead >
                <tr style="margin: 40px 40px 0px 0px">
                    <td class="text-left">
                        <img src="{{ asset('electric-logo.png') }}" alt="Electric Logo">
                    </td>
                    <td class="text-right
                    ">
                        <h2>Invoice</h2>
                        <p># {{ $rent_unique_id }}</p>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
    <div class="section">
        <table>
            <thead>
                <tr>
                    <th class="text-left">Rent Date</th>
                    <th class="text-right
                    ">Due Date</th>
                </tr>
                <tr>
                    <td class="text-left">{{ $rentdate->format('d F Y') }}</td>
                    <td class="text-right
                    ">{{ $duedate->format('d F Y') }}</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="text-left">Return Date</th>
                    <td class="text-right">{{ $returndate->format('d F Y') . ' ' . $lateDays . ' days late' }}</td>
                </tr>

            </tbody>
        </table>
    </div>
    
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th class="text-left">Renter Name</th>
                    <th class="text-right">Tool Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="whitespace-nowrap">{{ $rent->renter_name }}</td>
                    <td class="text-right">{{ $rent->tool->name }} [{{ $rent->tool->serial_number }}]</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th class="text-left">Item</th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr class="py-1">
                    <td class="whitespace-nowrap">Rental Duration ({{ round($diffDay) }} days)</td>
                    <td class="text-right">Rp. {{ number_format($estimatePrice, 0, '.', '.') }}</td>
                </tr>
                <tr class="py-1">
                    <td class="whitespace-nowrap">Late Fee</td>
                    <td class="text-right">Rp. {{ number_format($lateFee, 0, '.', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-left">Total</th>
                    <td class="text-right">Rp. {{ number_format($totalCost, 0, '.', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="qrcode">
        <img src="{{ $qrCodeImage }}" alt="QR">
        <p>Or</p>
        <a href="{{ $whatsappLink }}">
            Chat by WhatsApp
        </a>
    </div>


    

    <div class="footer">
        <p>{{ $rent_unique_id . ' ' . now()->format('H:i:s') }}</p>
    </div>
</body>
</html>
