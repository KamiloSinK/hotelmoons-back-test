<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\reservationController;

Route::get('/reservations', [reservationController::class, 'getReservations']);
