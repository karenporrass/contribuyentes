<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ValidEmail implements Rule
{
    public function passes($attribute, $value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/@com\.com$/', $value);
    }
    public function message()
    {
        return 'El correo electrónico proporcionado no es válido o tiene un dominio no permitido.';
    }
}
