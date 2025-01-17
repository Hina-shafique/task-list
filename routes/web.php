<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/books');
});

Route::get('/books', [BooksController::class, 'index']);
Route::get('/books/{book}/create', [BooksController::class, 'create']);
Route::get('/books/{book}', [BooksController::class, 'show']);
Route::post('/books/{book}', [BooksController::class, 'store']);

// Route::get('/search', SearchController::class);