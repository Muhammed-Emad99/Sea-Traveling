<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('clients.index'));
});

Route::resource('clients', ClientController::class)->names('clients')->except('show');
Route::resource('contracts', ContractController::class)->names('contracts')->except('show');
Route::resource('trips', TripController::class)->names('trips')->except('show');
