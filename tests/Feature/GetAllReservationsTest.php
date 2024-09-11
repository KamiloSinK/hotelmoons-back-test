<?php

namespace Tests\Feature;

use App\Models\Reservation;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetAllReservationsTest extends TestCase
{
    private $reservation;

    #[Test]
    public function TestGetAllReservations(): void
    {
        
        $this->reservation = new Reservation();

        $array = [
            'hotelId' => 1,
            'checkIn' => "2018-10-20",
            'checkOut' => "2018-10-25",
            'numberOfGuests' => 3,
            'numberOfRooms' => 2,
            'currency' => "EUR"
        ];

        $response = $this->reservation->getAllReservations($array);

        
        $this->assertIsObject($response);
        $this->assertIsArray($response['rooms']);
        $this->assertIsArray($response['rooms'][0]);
        $this->assertArrayHasKey('roomId', $response['rooms'][0]);
        $this->assertArrayHasKey('rates', $response['rooms'][0]);
        $this->assertIsArray($response['rooms'][0]['rates']);	
        $this->assertArrayHasKey('mealPlanId', $response['rooms'][0]['rates'][0]);	
        $this->assertIsInt($response['rooms'][0]['rates'][0]['mealPlanId']);	
        $this->assertArrayHasKey('isCancellable', $response['rooms'][0]['rates'][0]);	
        $this->assertIsBool($response['rooms'][0]['rates'][0]['isCancellable']);	
        $this->assertArrayHasKey('price', $response['rooms'][0]['rates'][0]);	
        $this->assertIsFloat($response['rooms'][0]['rates'][0]['price']);	
    }
}
