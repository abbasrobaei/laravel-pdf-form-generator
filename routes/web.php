<?php

use Illuminate\Support\Facades\Route;


// Personalstammdaten:
Route::get('/', function () {
    return view('personalform');
})->middleware('guest');
Route::post('/save-as-pdf', [App\Http\Controllers\PersonalDataController::class, 'saveAsPdf'])->name('saveAsPdf');

