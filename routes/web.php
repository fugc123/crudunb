<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

