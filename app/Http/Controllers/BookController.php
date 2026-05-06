<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['category', 'authors'])
            ->latest()
            ->paginate(12);
        return view('books.index', compact('books'));
    }
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('last_name')->get();
        return view('books.create', compact('categories', 'authors'));
    }
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $data['available_copies'] = $data['total_copies'];
        $book = Book::create($data);
        $book->authors()->sync($request->input('authors', []));
        return redirect()->route('books.show', $book)->with('success', "Libro \"{$book->title}\" registrado correctamente.");
    }
    public function show(Book $book)
    {
        $book->load(['authors', 'category', 'activeLoans.member.user']);
        return view('books.show', compact('book'));
    }
    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('last_name')->get();
        $selectedAuthors = $book->authors->pluck('id')->toArray();
        return view('books.edit', compact(
            'book',
            'categories',
            'authors',
            'selectedAuthors'
        ));
    }
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();
        // Ajustar available_copies proporcionalmente si cambió total_copies
        $diff = $data['total_copies'] - $book->total_copies;
        $data['available_copies'] = max(0, $book->available_copies + $diff);
        $book->update($data);
        $book->authors()->sync($request->input('authors', []));
        return redirect()
            ->route('books.show', $book)
            ->with('success', "Libro \"{$book->title}\" actualizado correctamente.");
    }
    public function destroy(Book $book)
    {
        if ($book->activeLoans()->exists()) {
            return back()->with(
                'error',
                "No se puede eliminar \"{$book->title}\": tiene préstamos activos."
            );
        }
        $book->delete(); // SoftDelete: marca deleted_at
        return redirect()
            ->route('books.index')
            ->with('success', "Libro \"{$book->title}\" eliminado correctamente.");
    }
    /**
     * Restaura un libro eliminado lógicamente.
     */
    public function restore(Book $book)
    {
        $book->restore(); // Limpia deleted_at
        return redirect()
            ->route('books.show', $book)
            ->with('success', "Libro \"{$book->title}\" restaurado correctamente.");
    }
    public function trashed()
    {
        $books = Book::onlyTrashed()
            ->with('category')
            ->latest('deleted_at')
            ->paginate(15);
        return view('books.trashed', compact('books'));
    }
}
