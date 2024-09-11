<?php

namespace App\Models;

use App\Dto\UserSearchDto;
use App\Services\GetReservations\GetAll;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function getAllReservations($data) {
        list($userSearchDto, $error) = UserSearchDto::fromArray($data);

        if($error != null) return $error;
        
        $getAllReservationsFromServices = new GetAll();
        $HotelLegsReservations = $getAllReservationsFromServices->getAllReservations($userSearchDto);

        return $this->arrangeAllSearching($HotelLegsReservations);
    }

    private function arrangeAllSearching($data){

        $allRooms = array_merge($data);

        return collect([
            'rooms' => $allRooms
        ]);
    }
}
