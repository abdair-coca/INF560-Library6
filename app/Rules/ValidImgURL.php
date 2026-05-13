<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidImgURL implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'max_redirects' => 3,
                'timeout' => 10,
                'ignore_errors' => true,
            ],
        ]);

        try {
            $content = @file_get_contents($value, false, $context);

            if ($content === false || !isset($http_response_header)) {
                $fail('No se pudo verificar la URL de portada. Comprueba que sea accesible públicamente.');
                return;
            }

            $contentType = null;

            foreach ($http_response_header as $header) {
                if (stripos($header, 'Content-Type:') === 0) {
                    $contentType = trim(substr($header, strlen('Content-Type:')));
                    break;
                }
            }

            if (!$contentType || !str_starts_with(strtolower($contentType), 'image/')) {
                $fail('La URL no apunta a un archivo de imagen válido.');
            }
        } catch (\Exception $e) {
            $fail('No se pudo verificar la URL de portada. Comprueba que sea accesible públicamente.');
        }
    }
}
