<?php
namespace App\Services;

use App\DTO\ContactFavoriteDTO;
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

    public function toggleFavorite(int $id){
        $contact = $this->repoContact->show($id);
        if ($contact){
            $dto = new ContactFavoriteDTO([
                'favorite' => !$contact->favorite
            ]);
            return $this->repoContact->updateFavorite($id, $dto);
        }
        return false;
    }

    public function show(int $id){
        return $this->repoContact->show($id); 
    }

    public function index(ContactListDTO $dto){
        return $this->repoContact->index($dto); 
    }

    public function destroy(int $id){
        return $this->repoContact->destroy($id); 
    }
}