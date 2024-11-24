<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Obtener todos los roles.
     */
    public function getAll()
    {
        $roles = Roles::all();

        return response()->json($roles, 200);
    }
}
