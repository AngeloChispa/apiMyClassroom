<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Maestro',
            'description' => 'El profe',
        ]);

        Role::create([
            'name' => 'Alumno',
            'description' => 'Muerto de hambre que busca un futuro mejor, hay un 20% de probabilidades de que se equivocara de carrera',
        ]);

    }
}
