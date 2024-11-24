<?php

namespace App\Http\Requests;

use App\Rules\ValidEmail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContribuyenteRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtener las reglas de validación para la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        $contribuyenteId = $this->route('id');

        return [
            'tipo_documento' => 'required|string|max:255',
            'documento' => [
                'required',
                'string',
                'max:255',
                Rule::unique('contribuyentes')->ignore($contribuyenteId),
            ],
            'nombres' => $this->tipo_documento === 'Cédula' ? 'required|string' : 'nullable|string',
            'apellidos' => $this->tipo_documento === 'Cédula' ? 'required|string' : 'nullable|string',
            'razon_social' => $this->tipo_documento === 'NIT' ? 'required|string' : 'nullable|string',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'celular' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                new ValidEmail(),
                Rule::unique('contribuyentes')->ignore($contribuyenteId),
            ],
        ];
    }

    /**
     * Obtener los nombres personalizados para los atributos.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'tipo_documento' => 'tipo de documento',
            'documento' => 'documento',
            'nombres' => 'nombres',
            'apellidos' => 'apellidos',
            'direccion' => 'dirección',
            'telefono' => 'teléfono',
            'celular' => 'celular',
            'email' => 'correo electrónico',
        ];
    }

    /**
     * Obtener los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'documento.required' => 'El documento es obligatorio.',
            'nombres.required' => 'Los nombres son obligatorios.',
            'documento.unique' => 'El documento ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'celular.required' => 'El celular es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
        ];
    }
}
