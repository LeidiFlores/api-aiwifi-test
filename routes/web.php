<?php

use App\Http\Controllers\ApiRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
