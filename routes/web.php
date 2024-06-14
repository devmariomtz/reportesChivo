<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/weekly_report', function () {
        return view('weekly_report');
    })->name('weekly_report');
});


Route::post('/upload-csv', [CsvController::class, 'uploadCsv'])->name('upload.csv');
