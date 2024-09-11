<?php 

namespace App\Dto;

readonly class UserSearchDto {
  private function __construct(        
    public int $hotelId,
    public string $checkIn,
    public string $checkOut,
    public int $numberOfGuests,
    public int $numberOfRooms,
    public string $currency
  ) {}

  public static function fromArray(array $data): array
  {
    if(!is_int((int) $data['hotelId'])) return [null, 'Error: Hotel id must be an integer'];
    if(!is_string($data['checkIn'])) return [null, 'Error: Check in must be a string'];
    if(!is_string($data['checkOut'])) return [null, 'Error: Check out must be a string'];
    if($data['checkOut'] < $data['checkIn']) return [null, 'Error: Check out must be after check in'];
    if(!is_int((int) $data['numberOfGuests'])) return [null, 'Error: Number of guests must be an integer'];
    if(!is_int((int) $data['numberOfRooms'])) return [null, 'Error: Number of rooms must be an integer'];
    if(!is_string($data['currency'])) return [null, 'Error: Currency must be a string'];

    return [new self(
      $data['hotelId'],
      $data['checkIn'],
      $data['checkOut'],
      $data['numberOfGuests'],
      $data['numberOfRooms'],
      $data['currency']
    ), null];
  }

}