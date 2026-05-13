<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ValidSlug implements ValidationRule
{
    /**
     * @param int|null $ignoreId  ID del registro a ignorar en la comprobación de unicidad.
     *                            Null en creación; el ID del modelo en actualización.
     */
    public function __construct(private readonly ?int $ignoreId = null) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 1. Formato: solo minúsculas, números y guiones; sin guión al inicio o fin
        if (! preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $value)) {
            $fail('El slug solo puede contener letras minúsculas, números y guiones, ' .
                  'sin empezar ni terminar con guión.');
            return;
        }

        // 2. Longitud máxima
        if (strlen($value) > 100) {
            $fail('El slug no puede superar los 100 caracteres.');
            return;
        }

        // 3. Unicidad en la tabla categories
        $query = DB::table('categories')->where('slug', $value);

        if ($this->ignoreId !== null) {
            $query->where('id', '!=', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail('Este slug ya está en uso por otra categoría.');
        }
    }
}
