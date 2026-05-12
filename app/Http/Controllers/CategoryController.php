<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('books')->orderBy('name')->paginate(20);
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        return redirect()->route('categories.show', $category)->with('success', "Categoria \"{$category->name}\" creado correctamente.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $books = $category->books;
        return view('category.show', compact('category', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return redirect()
            ->route('categories.show', $category)
            ->with('success', "Categoria \"{$category->name}\" actualizada correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->books()->exists())
            {
              return back()->with(
                'error',
                "No se puede eliminar \"{$category->name}\": tiene libros asociados."
            );  
            }
        $category->delete();
        return redirect()
            ->route('categories.index')
            ->with('success', "Categoria \"{$category->name}\" eliminada correctamente.");
    }
}
