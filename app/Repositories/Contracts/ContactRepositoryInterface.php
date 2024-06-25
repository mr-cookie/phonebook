<?php
namespace App\Repositories\Contracts;
use App\DTO\ContactStoreDTO;
use App\DTO\ContactUpdateDTO;
use App\DTO\ContactListDTO;
use App\DTO\ContactFavoriteDTO;

interface ContactRepositoryInterface {
  function show(int $id, int $userId);
  function index(ContactListDTO $dto);
  function store(ContactStoreDTO $dto);
  function update(int $id, ContactUpdateDTO $dto);
  function updateFavorite(int $id, int $userId);
  function destroy(int $id, int $userId);
}