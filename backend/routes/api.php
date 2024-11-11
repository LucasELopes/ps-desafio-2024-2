<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', function (Request $request) {
        return response()->json(Auth::user(), Response::HTTP_OK);
    });
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('books/category/{id}', [CategoryController::class, 'categoryBooks']);


Route::middleware(['auth:sanctum', 'can:admin'])->group(function () {
    Route::apiResource('/categories', CategoryController::class)->except(['index']);
    Route::apiResource('/books', BookController::class)->except(['index', 'show']);
    Route::apiResource('/users', UserController::class);
});


Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
