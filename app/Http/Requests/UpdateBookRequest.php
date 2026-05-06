<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        // Al actualizar, ignoramos el ISBN del propio libro en la regla unique
        return [
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20|unique:books,isbn,' . $this->book->id,
            'publisher' => 'nullable|string|max:150',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'pages' => 'nullable|integer|min:1',
            'language' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'cover_url' => 'nullable|url|max:500',
            'total_copies' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'authors' => 'required|array|min:1',
            'authors.*' => 'exists:authors,id',
        ];
    }
}
