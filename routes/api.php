<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [RegisterController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/contacts/stadistics', [ContactController::class, 'stadistics']);
    Route::apiResource('/contacts', ContactController::class);
});


