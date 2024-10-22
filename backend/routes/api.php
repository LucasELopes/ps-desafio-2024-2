<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('/books', [BookController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', function (Request $request) {
        return response()->json(Auth::user(), Response::HTTP_OK);
    });
});

Route::middleware(['auth:sanctum', 'can:admin'])->group(function () {
    
    Route::apiResource('/books', BookController::class)->except('index');
    
    Route::get('/books/{id}/{quantity}', [BookController::class, 'buyBook'])
    ->where('quantity', '[0-9]+');

    Route::apiResource('/categories', CategoryController::class);

    Route::apiResource('/users', UserController::class);
});

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
