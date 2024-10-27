<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriptografiController;


Route::get('/', [KriptografiController::class, 'showEncryptionForm']);
Route::post('/encryption', [KriptografiController::class, 'encrypt']);
Route::get('/decryption', [KriptografiController::class, 'showDecryptionForm']);
Route::post('/decryption', [KriptografiController::class, 'decrypt']);
