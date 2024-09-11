<?php

namespace Tests\Feature;

use App\Services\GetReservations\HotelLegs;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HotelLegsTest extends TestCase
{
    private $getHotelLegs;

    #[Test]
    public function TestHotelLegsConection(): void
    {
        
        $this->getHotelLegs = new HotelLegs();

        $array = [
            'hotelId' => 10,
            'checkIn' => '2022-04-20',
            'checkOut' => '2022-04-21',
            'numberOfGuests' => 2,
            'numberOfRooms' => 2,
            'currency' => 'USD'
        ];

        $testData = (object) $array;

        $response = $this->getHotelLegs->getReservations($testData);

        

        $this->assertIsArray($response);
        $this->assertIsArray($response[0]);
        $this->assertArrayHasKey('roomId', $response[0]);
        $this->assertIsInt($response[0]['roomId']);
        $this->assertArrayHasKey('rates', $response[0]);
        $rates = $response[0]['rates'];
        $this->assertIsArray($rates);
        $this->assertArrayHasKey('mealPlanId', $rates[0]);
        $this->assertIsInt($rates[0]['mealPlanId']);
        $this->assertArrayHasKey('isCancellable', $rates[0]);
        $this->assertIsBool($rates[0]['isCancellable']);
        $this->assertArrayHasKey('price', $rates[0]);
        $this->assertIsFloat($rates[0]['price']);
    }
}
