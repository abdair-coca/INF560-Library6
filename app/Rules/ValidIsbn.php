<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidIsbn implements ValidationRule
{
    /**
     * Valida que el valor sea un ISBN-13 con dígito verificador correcto.
     * Si el campo es nullable y viene vacío, esta regla no se invoca.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Elimina guiones y espacios (ya debería venir limpio por prepareForValidation,
        // pero lo hacemos aquí también como defensa en profundidad)
        $isbn = preg_replace('/[\s\-]/', '', $value);

        // Solo validamos ISBN-13 (13 dígitos). ISBN-10 queda nullable.
        if (strlen($isbn) !== 13) {
            $fail('El ISBN debe tener exactamente 13 dígitos.');
            return;
        }

        if (! ctype_digit($isbn)) {
            $fail('El ISBN solo puede contener dígitos numéricos.');
            return;
        }

        // Calcular dígito verificador
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += (int) $isbn[$i] * ($i % 2 === 0 ? 1 : 3);
        }
        $checkDigit = (10 - ($sum % 10)) % 10;

        if ($checkDigit !== (int) $isbn[12]) {
            $fail('El ISBN-13 ingresado no es válido: el dígito verificador no coincide.');
        }
    }
}
 
