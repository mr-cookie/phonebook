<?php

namespace App\DTO;
//use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class ContactUpdateDTO extends DataTransferObject{
    public string $nickname;
    public string $phone_number;
    public bool $favorite = false;
}