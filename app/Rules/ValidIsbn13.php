<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidIsbn13 implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            return;
        }
        // Solo números
        if (!ctype_digit($value)) {
            $fail('El ISBN debe contener solo números.');
            return;
        }

        // Exactamente 13 dígitos
        if (strlen($value) !== 13) {
            $fail('El ISBN debe tener exactamente 13 dígitos.');
            return;
        }

        $sum = 0;

        // Recorre los primeros 12 dígitos
        for ($i = 0; $i < 12; $i++) {

            $digit = (int) $value[$i];

            if ($i % 2 === 0) {
                $sum += $digit;
            } else {
                $sum += $digit * 3;
            }
        }

        // Calcula dígito verificador
        $checkDigit = (10 - ($sum % 10)) % 10;

        // Último dígito real
        $lastDigit = (int) $value[12];

        // Comparación final
        if ($checkDigit !== $lastDigit) {
            $fail('El ISBN-13 no es válido.');
        }
    }
}
