<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IbanController;

// ✅ Main UI route
Route::get('/', [IbanController::class, 'index']);

// ✅ IBAN generation form submission
Route::post('/generate', [IbanController::class, 'generate'])->name('generate.iban');

// ✅ AJAX endpoint for IBAN generation
Route::get('/api/generate', [IbanController::class, 'apiGenerate']);

// ✅ Health check route for Render
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});