<?php
namespace App\Services\GetReservations;

class GetAll {

  public function getAllReservations($data) {

    $hotelLegs = new HotelLegs();
    return $hotelLegs->getReservations($data);
    
  }

}