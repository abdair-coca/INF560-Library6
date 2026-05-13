<?php

namespace App\Http\Requests;

use App\Rules\ValidSlug;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    protected function prepareForValidation(): void
    {
        if ($this->color) {
            $this->merge(['color' => strtoupper(trim($this->color))]);
        }
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')->id;

        return [
            'name'        => ['required', 'string', 'max:100',
                              Rule::unique('categories', 'name')->ignore($categoryId)],
            'color'       => ['nullable', 'regex:/^#[0-9A-F]{6}$/'],
            'slug'        => ['nullable',
                              new ValidSlug($categoryId)],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.unique'   => 'Ya existe una categoría con ese nombre.',
            'color.regex'   => 'El color debe ser un código hexadecimal válido (ej. #DC2626).',
        ];
    }
}
