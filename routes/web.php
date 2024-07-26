<?php

use App\Http\Controllers\RentController;
use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        // 'tools' => \App\Models\Tool::get(),
        // 'rents' => \App\Models\Rent::with('tool')->get(),
        // 'calibrates' => \App\Models\Calibrate::with('tool')->get(),

        // load data from database with N+1 problem
        'tools' => \App\Models\Tool::latest()->get(),
        'rents' => \App\Models\Rent::with('tool')->latest()->get(),
        'calibrates' => \App\Models\Calibrate::with('tool')->latest()->get(),
    ]);
})->name('home');

Route::get('/terms-condition', function () {
    return view('auth.terms');
})->name('terms');

Route::get('/contoh', function () {
    return view('contoh');
})->name('contoh');
Route::get('/contohlagi', function () {
    return view('renter.contoh');
});

Route::resource('tools', ToolController::class)->name('*', 'tools');
Route::resource('rents', RentController::class)->name('*', 'rents');
Route::get('/rents/{id}/invoice', [RentController::class, 'downloadInvoice'])->name('rents.invoice');
Route::get('/report', [RentController::class, 'weeklyReport'])->name('rents.report');
