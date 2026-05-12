<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidIsbn13;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Control de roles se implementa en Guía 8
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'isbn' => [
                'nullable',
                'unique:books,isbn',
                new ValidIsbn13,
            ],
            'publisher' => 'nullable|string|max:150',
            'publish_year' => 'nullable|integer|min:1000|max:' . date('Y'),
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
    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'category_id.required' => 'Debes seleccionar una categoría.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'authors.required' => 'Debes asignar al menos un autor.',
            'authors.min' => 'Debes asignar al menos un autor.',
            'authors.*.exists' => 'Uno de los autores seleccionados no existe.',
            'total_copies.min' => 'El número de copias debe ser al menos 1.',
        ];
    }
}
