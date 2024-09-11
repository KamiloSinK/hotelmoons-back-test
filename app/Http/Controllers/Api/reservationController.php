<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class reservationController extends Controller
{
    public function getReservations(Request $request) {
        $reservation = new Reservation();

        return $reservation->getAllReservations($request->all());
    }
}
