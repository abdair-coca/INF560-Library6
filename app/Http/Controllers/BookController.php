<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Eager loading de 'category' y 'authors' para optimizar la consulta
        $books = Book::with(['category', 'authors'])->paginate(12);
        
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // El parámetro $book se inyecta automáticamente gracias al Route Model Binding
    public function show(Book $book)
    {
        $book->load(['category', 'authors', 'activeLoans']);
        
        return view('books.show', compact('book'));
    }
    
    // ... (resto de métodos se implementarán en futuras guías)
}