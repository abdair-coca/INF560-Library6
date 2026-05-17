<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::redirect('/', '/books');

// ── Autenticación ──────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('register',  [RegisterController::class, 'showForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.store');
    Route::get('login',     [LoginController::class,   'showForm'])->name('login');
    Route::post('login',    [LoginController::class,   'login'])->name('login.store');
});
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ── Libros ─────────────────────────────────────────────────────────────────────
// Las rutas especiales ANTES del resource para que no las capture {book}
Route::get('books/trashed',          [BookController::class, 'trashed'])->name('books.trashed');
Route::patch('books/{book}/restore', [BookController::class, 'restore'])->name('books.restore')->withTrashed();

// UNA SOLA declaración — el middleware vive en el controlador, no aquí
Route::resource('books', BookController::class);

// ── Autores y Categorías (mismo patrón) ────────────────────────────────────────
Route::resource('authors',    AuthorController::class);
Route::resource('categories', CategoryController::class);