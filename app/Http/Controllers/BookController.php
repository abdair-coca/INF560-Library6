<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
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
        $authors = Author::all();

        return view('books.create', compact('categories', 'authors'));
    }

    // El parámetro $book se inyecta automáticamente gracias al Route Model Binding
    public function show(Book $book)
    {
        $book->load(['category', 'authors', 'activeLoans']);

        return view('books.show', compact('book'));
    }

    public function store(Request $request)
    {
        // Validación básica
        $validated = $request->validate([
            'title' => 'required',
            'isbn' => 'required|string|max:50',
            'publisher' => 'nullable',
            'publish_year' => 'nullable|integer',
            'pages' => 'nullable|integer',
            'language' => 'nullable',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ]);

        // Crear libro
        $book = Book::create($validated);

        $book->authors()->sync($request->authors);

        // Redirección
        return redirect()->route('books.index')
            ->with('success', 'Libro creado correctamente');
    }
    public function destroy(string $id) {
        Book::destroy($id);
        return redirect()->route('books.index')-> with('success', 'Libro eliminado correctamente');
    }
}
