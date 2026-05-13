<?php

namespace App\Http\Requests;

use App\Rules\ValidIsbn;
use App\Rules\ValidYear;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidImgURL;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Control de roles se implementa en Guía 9
    }

    /**
     * Normaliza datos antes de validar.
     */
    protected function prepareForValidation(): void
    {
        // Elimina guiones y espacios del ISBN para normalizar formato
        if ($this->isbn) {
            $this->merge([
                'isbn' => preg_replace('/[\s\-]/', '', $this->isbn),
            ]);
        }

        // Convierte el campo language a minúsculas y lo capitaliza
        if ($this->language) {
            $this->merge([
                'language' => ucfirst(strtolower(trim($this->language))),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'title'            => ['required', 'string', 'max:255'],
            'isbn'             => [
                'nullable',
                'string',
                'max:13',
                Rule::unique('books', 'isbn'),
                new ValidIsbn,
            ],
            'publisher'        => ['nullable', 'string', 'max:150'],
            'publish_year' => [
                'nullable',
                'integer',
                new ValidYear,
            ],
            'pages'            => ['nullable', 'integer', 'min:1'],
            'language'         => ['nullable', 'string', 'max:50'],
            'description'      => ['nullable', 'string'],
            'cover_url' => [
                'nullable',
                'url',
                'max:500',
                new ValidImgURL,
            ],
            'total_copies'     => ['required', 'integer', 'min:1'],
            'category_id'      => ['required', Rule::exists('categories', 'id')],
            'authors'          => ['required', 'array', 'min:1'],
            'authors.*'        => [Rule::exists('authors', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'         => 'El título del libro es obligatorio.',
            'isbn.unique'            => 'Este ISBN ya está registrado en el catálogo.',
            'isbn.max'               => 'El ISBN no puede superar los 13 caracteres.',
            'publication_year.min'   => 'El año de publicación no puede ser anterior al año 1000.',
            'publication_year.max'   => 'El año de publicación no puede ser futuro.',
            'total_copies.required'  => 'Debes indicar cuántas copias tiene el libro.',
            'total_copies.min'       => 'El número de copias debe ser al menos 1.',
            'category_id.required'   => 'Debes seleccionar una categoría.',
            'category_id.exists'     => 'La categoría seleccionada no existe.',
            'authors.required'       => 'Debes asignar al menos un autor al libro.',
            'authors.min'            => 'Debes asignar al menos un autor al libro.',
            'authors.*.exists'       => 'Uno de los autores seleccionados no existe.',
        ];
    }
}
