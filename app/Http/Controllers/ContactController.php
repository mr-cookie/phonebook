<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactListRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\DTO\ContactStoreDTO;
use App\DTO\ContactUpdateDTO;
use App\DTO\ContactListDTO;
use App\Services\ContactService;
use Illuminate\Support\Facades\Auth;
class ContactController extends Controller
{
    protected $contactService = NULL;

    public function __construct(ContactService $contactService){
        $this->contactService = $contactService;
    }

    public function store(ContactRequest $request){
        $data = $request->validated(); 
        $data['user_id'] = Auth::id();
        $dto = new ContactStoreDTO($data);
        $result = $this->contactService->store($dto);
        return response()->json($result, 200);
    }

    public function update(ContactUpdateRequest $request, int $id){
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $dto = new ContactUpdateDTO($data);
        $result = $this->contactService->update($id, $dto);
        return response()->json($result, 200);
    }

    public function toggleFavorite(int $id){
        $result = $this->contactService->toggleFavorite($id, Auth::id()); 
        return response()->json($result, 200);
    }

    public function show(int $id){
        $result = $this->contactService->show($id, Auth::id());
        return response()->json($result, 200);
    }

    public function index(ContactListRequest $request){
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $dto = new ContactListDTO($data);
        $result = $this->contactService->index($dto);
        return response()->json($result, 200); 
    }

    public function destroy(int $id){
        $result = $this->contactService->destroy($id, Auth::id());
        return response()->json($result, 200);
    }
}
