<?php
namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Models\Contact;
use App\DTO\ContactStoreDTO;
use App\DTO\ContactUpdateDTO;
use App\DTO\ContactListDTO;
use App\DTO\ContactFavoriteDTO;
use App\Exceptions\Contact\NotFoundContactException;
use App\Exceptions\AccessDeniedException;
class ContactRepository implements ContactRepositoryInterface{

    private static function accessDeniedException(){
        return throw new AccessDeniedException('Access denied.');
    }

    private static function getExceptionNotFound(){
        return throw new NotFoundContactException('Contact not found!');
    }

    function show(int $id, int $userId){
        $contact = Contact::find($id);
        if ($contact){
            if ($contact->user_id != $userId)
                return self::accessDeniedException();
            return $contact;
        }
        return self::getExceptionNotFound(); 
    }

    function index(ContactListDTO $dto){
        return Contact::where('user_id', $dto->user_id)
            ->orderBy('created_at', 'desc')
            ->paginate($dto->perPage);
    }

    function store(ContactStoreDTO $dto){
        return Contact::create($dto->all());
    }

    function update(int $id, ContactUpdateDTO $dto){
        $contact = Contact::find($id);
        if($contact->user_id != $dto->user_id)
            return self::accessDeniedException(); 
        if($contact){
            foreach($dto->all() as $key => $value)
                $contact->{$key} = $value;
            return $contact->save();
        }
       return self::getExceptionNotFound(); 
    }
    
    function destroy(int $id, $userId){
        $contact = Contact::find($id);
        if($contact){
            if($contact->user_id != $userId)
                return self::accessDeniedException();
            return $contact->delete();
        }
        return self::getExceptionNotFound();
    }

    function updateFavorite(int $id, ContactFavoriteDTO $dto){
        $contact = Contact::find($id);
        if($contact){
            $contact->favorite = $dto->favorite;
            return $contact->save();
        }
    }
    
} 