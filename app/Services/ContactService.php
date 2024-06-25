<?php
namespace App\Services;

use App\DTO\ContactListDTO;
use App\DTO\ContactStoreDTO;
use App\DTO\ContactUpdateDTO;
use App\Repositories\Contracts\ContactRepositoryInterface;

class ContactService {
    private $repoContact;
    public function __construct(
        ContactRepositoryInterface $repoContact){
        $this->repoContact = $repoContact;
    }

    public function store(ContactStoreDTO $dto){
        return $this->repoContact->store($dto); 
    }

    public function update(int $id, ContactUpdateDTO $dto){
        return $this->repoContact->update($id, $dto); 
    }

    public function toggleFavorite(int $id, int $userId){
        return $this->repoContact->updateFavorite($id, $userId);
    }

    public function show(int $id, int $userId){
        $contact = $this->repoContact->show($id, $userId);
        return $contact;  
    }

    public function index(ContactListDTO $dto){
        return $this->repoContact->index($dto); 
    }

    public function destroy(int $id, int $userId){
        return $this->repoContact->destroy($id, $userId); 
    }
}