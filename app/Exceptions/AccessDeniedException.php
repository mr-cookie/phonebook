<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AccessDeniedException extends Exception
{
    public function render(Request $request): JsonResponse{
        return response()->json(["message" => $this->getMessage()]);
    }
}
