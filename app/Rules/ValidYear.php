<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidYear implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $currentYear = (int) date('Y');

        if ($value < 1450) {
            $fail('El año de publicación no puede ser anterior a 1450 (invención de la imprenta).');
        }

        if ($value > $currentYear + 1) {
            $fail('El año de publicación no puede ser tan futuro.');
        }
    }
}