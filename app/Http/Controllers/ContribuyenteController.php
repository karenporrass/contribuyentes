<?php

namespace App\Http\Controllers;

use App\Helpers\ContribuyenteHelper;
use App\Models\Contribuyente;
use App\Http\Requests\StoreContribuyenteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContribuyenteController extends Controller
{
    /**
     * Obtener todos los contribuyentes.
     */
    public function getAll()
    {
        $contribuyentes = Contribuyente::all();

        return response()->json($contribuyentes, 200);
    }

    public function store(StoreContribuyenteRequest $request)
    {
        try {
            $validatedData = $request->validated();

            if ($validatedData['tipo_documento'] === 'NIT') {
                $razonSocial = $validatedData['razon_social'];
                $procesado = ContribuyenteHelper::procesarRazonSocial($razonSocial);

                $validatedData['nombres'] = $procesado['nombres'];
                $validatedData['apellidos'] = $procesado['apellidos'];

                unset($validatedData['razon_social']);
            }

            $contribuyente = Contribuyente::create($validatedData);

            return response()->json($contribuyente, 201);
        } catch (\Exception $exception) {
            Log::error('Error al crear contribuyente:', ['error' => $exception->getMessage()]);

            return response()->json(['error' => 'No se pudo crear el contribuyente'], 500);
        }
    }

    /**
     * @param StoreContribuyenteRequest $request
     */
    public function update(StoreContribuyenteRequest $request, $id)
    {
        try {
            $contribuyente = Contribuyente::findOrFail($id);

            Log::debug(['request' => $request->all()]);
            Log::debug(['contribuyente' => $contribuyente->toArray()]);

            $validatedData = $request->validated();

            if ($validatedData['tipo_documento'] === 'NIT') {
                $razonSocial = $validatedData['razon_social'];
                $procesado = ContribuyenteHelper::procesarRazonSocial($razonSocial);

                $validatedData['nombres'] = $procesado['nombres'];
                $validatedData['apellidos'] = $procesado['apellidos'];

                unset($validatedData['razon_social']);
            }

            $contribuyente->update($validatedData);

            return response()->json($contribuyente, 200);
        } catch (\Exception $exception) {
            Log::error('Error al actualizar contribuyente:', ['error' => $exception->getMessage()]);

            return response()->json(['error' => 'No se pudo actualizar el contribuyente'], 500);
        }
    }

    public function delete($id)
    {
        try {
            $contribuyente = Contribuyente::findOrFail($id);
            $contribuyente->delete();

            return response()->json(null, 204);
        } catch (\Exception $exception) {
            Log::error('Error al eliminar contribuyente:', ['error' => $exception->getMessage()]);

            return response()->json(['error' => 'No se pudo eliminar el contribuyente'], 500);
        }
    }

    /**
     * Verificar si un documento ya existe.
     */
    public function checkDocumentoExistence(Request $request)
    {
        $documento = $request->input('documento');

        $exists = Contribuyente::where('documento', $documento)->exists();

        return response()->json(['exists' => $exists]);
    }
}
