<?php

namespace App\DTO;
use Spatie\DataTransferObject\DataTransferObject;

class ContactFavoriteDTO extends DataTransferObject{
    public bool $favorite;
    public int $user_id;
}