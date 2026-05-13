<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidIsbn;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->isbn) {
            $this->merge([
                'isbn' => preg_replace('/[\s\-]/', '', $this->isbn),
            ]);
        }
        if ($this->language) {
            $this->merge([
                'language' => ucfirst(strtolower(trim($this->language))),
            ]);
        }
    }

    public function rules(): array
    {
        $bookId = $this->route('book')->id;

        return [
            'title'            => ['required', 'string', 'max:255'],
            // unique ignora el propio registro al actualizar
            'isbn'             => ['nullable', 'string', 'max:13',
                                   Rule::unique('books', 'isbn')->ignore($bookId),
                                   new ValidIsbn],
            'publisher'        => ['nullable', 'string', 'max:150'],
            'publication_year' => ['nullable', 'integer', 'min:1000',
                                   'max:' . date('Y')],
            'pages'            => ['nullable', 'integer', 'min:1'],
            'language'         => ['nullable', 'string', 'max:50'],
            'description'      => ['nullable', 'string'],
            'cover_url'        => ['nullable', 'url', 'max:500'],
            // total_copies: solo obligatorio si se envía explícitamente
            'total_copies'     => [
                Rule::when(
                    $this->has('total_copies'),
                    ['required', 'integer', 'min:1']
                ),
            ],
            'category_id'      => ['required', Rule::exists('categories', 'id')],
            'authors'          => ['required', 'array', 'min:1'],
            'authors.*'        => [Rule::exists('authors', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'El título del libro es obligatorio.',
            'isbn.unique'          => 'Este ISBN ya está registrado para otro libro.',
            'total_copies.min'     => 'El número de copias debe ser al menos 1.',
            'category_id.required' => 'Debes seleccionar una categoría.',
            'category_id.exists'   => 'La categoría seleccionada no existe.',
            'authors.required'     => 'Debes asignar al menos un autor al libro.',
            'authors.*.exists'     => 'Uno de los autores seleccionados no existe.',
        ];
    }
}
