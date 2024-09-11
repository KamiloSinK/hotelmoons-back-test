<?php 

namespace app\Dto;

readonly class HotelLegsSearchDto {
  private function __construct(       
      public int $hotel,
      public string $checkInDate,
      public int $numberOfNights,
      public int $guests,
      public int $rooms,
      public string $currency
  ) {}

  public static function fromArray(array $data): array
  {
    if(!is_int($data['hotel'])) return [null, 'error: Hotel must be an integer'];
    if(!is_string($data['checkInDate'])) return [null, 'error: Check in date must be a string'];
    if(!is_int($data['numberOfNights'])) return [null, 'error: Number of nights must be an integer'];
    if(!is_int($data['guests'])) return [null, 'error: Guests must be an integer'];
    if(!is_int($data['rooms'])) return [null, 'error: Rooms must be an integer'];
    if(!is_string($data['currency'])) return [null, 'error: Currency must be a string'];
   

    return [new self(
      $data['hotel'],
      $data['checkInDate'],
      $data['numberOfNights'],
      $data['guests'],
      $data['rooms'],
      $data['currency']
    ), null];
  }

}