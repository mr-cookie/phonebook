<?php
namespace App\DTO;
//use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class ContactListDTO extends DataTransferObject{
    public int $page = 1;
    public int $perPage = 5;
    public int $user_id;
}