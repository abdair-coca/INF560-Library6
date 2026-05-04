<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('books', BookController::class);
Route::resource('authors', AuthorController::class);
Route::resource('categories', CategoryController::class);
Route::get('/miembros', fn() => view('miembros.index', ['members' =>
App\Models\Member::with('user')->take(10)->get()]));