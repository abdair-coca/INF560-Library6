<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
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
}
