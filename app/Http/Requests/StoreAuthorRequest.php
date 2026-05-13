<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateAuthorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => $this->first_name
                ? ucwords(strtolower(trim($this->first_name)))
                : $this->first_name,
            'last_name'  => $this->last_name
                ? ucwords(strtolower(trim($this->last_name)))
                : $this->last_name,
        ]);
    }

    public function rules(): array
    {
        return [
            'first_name'  => ['required', 'string', 'max:100'],
            'last_name'   => ['required', 'string', 'max:100'],
            'nationality' => ['nullable', 'string', 'max:80'],
            'birth_date'  => [
                'nullable', 'date',
                Rule::when(
                    $this->filled('birth_date'),
                    ['before:today']
                ),
            ],
            'biography'   => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'El nombre del autor es obligatorio.',
            'last_name.required'  => 'El apellido del autor es obligatorio.',
            'birth_date.before'   => 'La fecha de nacimiento debe ser anterior a hoy.',
        ];
    }
}
 
