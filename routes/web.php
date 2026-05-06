<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('books/trashed', [BookController::class, 'trashed'])->name('books.trashed');
Route::resource('books', BookController::class);


Route::resource('books', BookController::class);
Route::resource('authors', AuthorController::class);
Route::resource('categories', CategoryController::class);
Route::get('/miembros', fn() => view('miembros.index', ['members' =>
App\Models\Member::with('user')->take(10)->get()]));

// Ruta extra para restaurar libros eliminados (softdeleted)
Route::patch('books/{book}/restore', [BookController::class, 'restore'])
 ->name('books.restore')
 ->withTrashed(); // permite recibir modelos con deleted_at no nulo
 