<?php
namespace App\Services;

use App\DTO\ContactFavoriteDTO;
use App\DTO\ContactListDTO;
use App\DTO\ContactStoreDTO;
use App\DTO\ContactUpdateDTO;
use App\Exceptions\AccessDeniedException;
use App\Exceptions\Contact\NotFoundContactException;
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
        $contact = $this->repoContact->show($id);
        if ($contact){
            if ($contact->user_id != $userId)
                return throw new AccessDeniedException('Access denied.'); 
            $dto = new ContactFavoriteDTO([
                'favorite' => !$contact->favorite
            ]);
            return $this->repoContact->updateFavorite($id, $dto);
        }
        return throw new NotFoundContactException('Contact not found!');
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