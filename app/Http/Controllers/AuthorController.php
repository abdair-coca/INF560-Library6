<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // index y show son públicos; todo lo demás requiere auth
            new Middleware('auth', except: ['index', 'show']),

            // Solo las operaciones de escritura requieren rol librarian
            new Middleware('role:librarian', only: ['create', 'store', 'edit', 'update', 'destroy']),
        ];
    }
    public function index()
    {
        $authors = Author::withCount('books')
            ->orderBy('last_name')
            ->paginate(15);
        return view('authors.index', compact('authors'));
    }
    public function create()
    {
        return view('authors.create');
    }
    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());
        return redirect()->route('authors.show', $author)->with('success', "Autor \"{$author->full_name}\" registrado correctamente.");
    }
    public function show(Author $author)
    {
        $author->load('books.category');
        return view('authors.show', compact('author'));
    }
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());
        return redirect()
            ->route('authors.show', $author)
            ->with('success', "Autor \"{$author->full_name}\" actualizado correctamente.");
    }

    public function destroy(Author $author)
    {
        if ($author->books()->exists()) {
            return back()->with(
                'error',
                "No se puede eliminar a \"{$author->full_name}\": tiene libros asociados. "
                    . "Reasigna los libros antes de eliminar el autor."
            );
        }
        $author->delete();
        return redirect()
            ->route('authors.index')
            ->with('success', "Autor \"{$author->full_name}\" eliminado correctamente.");
    }
}
