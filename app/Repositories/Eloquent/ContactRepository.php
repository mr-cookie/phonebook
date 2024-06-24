<?php
namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Models\Contact;
use App\DTO\ContactStoreDTO;
use App\DTO\ContactUpdateDTO;
use App\DTO\ContactListDTO;
use App\DTO\ContactFavoriteDTO;

class ContactRepository implements ContactRepositoryInterface{

    private static function getExceptionNotFound(){
        return throw new \Exception('Contact not found!');;
    }

    function show(int $id){
        $contact = Contact::find($id);
        if ($contact)
            return $contact;
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
        if($contact){
            foreach($dto->all() as $key => $value)
                $contact->{$key} = $value;
            return $contact->save();
        }
       return self::getExceptionNotFound(); 
    }
    
    function destroy(int $id){
        $contact = Contact::find($id);
        if($contact){
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