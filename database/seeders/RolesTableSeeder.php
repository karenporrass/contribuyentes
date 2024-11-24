<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        Roles::create(['nombre' => 'super usuario', 'permiso' => 'super']);
        Roles::create(['nombre' => 'administrador', 'permiso' => 'lectura']);
    }
}
