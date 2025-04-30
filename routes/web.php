<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IbanController;

Route::get('/', [IbanController::class, 'index']);
Route::post('/generate', [IbanController::class, 'generate'])->name('generate.iban');

// ✅ new AJAX endpoint
Route::get('/api/generate', [IbanController::class, 'apiGenerate']);