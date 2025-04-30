<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IbanController;

// Homepage and IBAN generation routes
Route::get('/', [IbanController::class, 'index']);
Route::post('/generate', [IbanController::class, 'generate'])->name('generate.iban');

// API endpoint for AJAX or external usage
Route::get('/api/generate', [IbanController::class, 'apiGenerate']);

// ✅ Health check route for Render
Route::get('/health', function () {
    return response()->json(['status' => 'ok'], 200);
});