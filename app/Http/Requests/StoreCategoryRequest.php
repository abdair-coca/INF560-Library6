<?php

namespace App\Http\Requests;

use App\Rules\ValidSlug;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    protected function prepareForValidation(): void
    {
        // Normaliza el color a mayúsculas: #dc2626 → #DC2626
        if ($this->color) {
            $this->merge([
                'color' => strtoupper(trim($this->color)),
            ]);
        }

        // Genera el slug a partir del nombre si no se proporcionó
        if ($this->name && ! $this->slug) {
            $this->merge([
                'slug' => \Illuminate\Support\Str::slug($this->name),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:100',
                              Rule::unique('categories', 'name')],
            'color'       => ['nullable', 'regex:/^#[0-9A-F]{6}$/'],
            'slug'        => ['nullable', new ValidSlug],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.max'      => 'El nombre no puede superar los 100 caracteres.',
            'name.unique'   => 'Ya existe una categoría con ese nombre.',
            'color.regex'   => 'El color debe ser un código hexadecimal válido (ej. #DC2626).',
        ];
    }
}
