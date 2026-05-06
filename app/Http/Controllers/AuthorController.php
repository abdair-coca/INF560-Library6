<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
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
