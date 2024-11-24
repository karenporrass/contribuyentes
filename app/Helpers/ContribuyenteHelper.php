<?php

// app/Helpers/ContribuyenteHelper.php

namespace App\Helpers;

class ContribuyenteHelper
{
    public static function procesarRazonSocial($razonSocial)
    {
        $partes = explode(' ', $razonSocial);

        if (count($partes) < 2) {
            return [
                'nombres' => $razonSocial,
                'apellidos' => '',
            ];
        }

        $nombres = array_shift($partes);
        $apellidos = implode(' ', $partes);

        return [
            'nombres' => $nombres,
            'apellidos' => $apellidos,
        ];
    }
}
