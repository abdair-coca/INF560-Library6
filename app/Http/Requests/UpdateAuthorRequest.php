<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    protected function prepareForValidation(): void
    {
        // Capitaliza nombre y apellido para normalizar el formato
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
            'birth_date'  => ['nullable', 'date', 'before:today'],
            'biography'   => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'El nombre del autor es obligatorio.',
            'last_name.required'  => 'El apellido del autor es obligatorio.',
            'first_name.max'      => 'El nombre no puede superar los 100 caracteres.',
            'last_name.max'       => 'El apellido no puede superar los 100 caracteres.',
            'birth_date.before'   => 'La fecha de nacimiento debe ser anterior a hoy.',
            'biography.max'       => 'La biografía no puede superar los 5000 caracteres.',
        ];
    }
}
 
