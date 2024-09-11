<?php
namespace App\Services\getReservations;

use App\Dto\HotelLegsSearchDto;
use DateTime;
use Illuminate\Support\Facades\Http;

class HotelLegs {

  public function getReservations($data) {
      
    $checkOut = new DateTime($data->checkOut);
    $checkIn = new DateTime($data->checkIn);


    $difference = $checkOut->diff($checkIn);
    $days = $difference->days;

    $arrangeData = array(
      'hotel' => $data->hotelId,
      'checkInDate' => $data->checkIn,
      'numberOfNights' => $days,
      'guests' => $data->numberOfGuests,
      'rooms' => $data->numberOfRooms,
      'currency' => $data->currency
    );

    list($hotelLegsSearchDto, $error) = HotelLegsSearchDto::fromArray($arrangeData);

    if($error != null) return $error;
    
    return $this->getReservationData($hotelLegsSearchDto);

  }

  private function getReservationData($data) {
    $json = json_encode($data);
    $dataArray = json_decode($json, true);

    $response = Http::get($_ENV['HOTEL_LEGS_API_URL'], $dataArray);
    
    return $this->arrangeResponseData($response);

  }

  private function arrangeResponseData($data) {
    $transform = collect($data['results'])->map(function ($item) {
        return [
            'roomId' => $item['room'],
            'rates' => [
                [
                    'mealPlanId' => $item['room'],
                    'isCancellable' => $item['canCancel'],
                    'price' => $item['price']
                ]
            ]
        ];
    })->toArray();

    return $transform;
  }

}