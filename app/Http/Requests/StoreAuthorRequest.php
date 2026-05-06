<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'nationality' => 'nullable|string|max:80',
            'birth_date' => 'nullable|date|before:today',
            'biography' => 'nullable|string',
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'birth_date.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
        ];
    }
}
