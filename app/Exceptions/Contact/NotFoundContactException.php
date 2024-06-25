<?php

namespace App\Exceptions\Contact;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NotFoundContactException extends Exception
{
    public function render(Request $request): JsonResponse{
        return response()->json(["message" => $this->getMessage()]);
    }
}
