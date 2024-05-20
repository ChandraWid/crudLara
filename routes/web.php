<?php

use App\Http\Controllers\barangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('barang', barangController::class);