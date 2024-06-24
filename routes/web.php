<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;

use Illuminate\Http\Request;
Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
});

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';



Route::controller(ContactController::class)->prefix('contacts')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
    Route::patch('/{id}/toggle-favorite', 'toggleFavorite');
})->middleware('auth');

