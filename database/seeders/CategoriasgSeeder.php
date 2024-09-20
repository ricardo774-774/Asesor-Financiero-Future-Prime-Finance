<?php

namespace Database\Seeders;

use App\Models\categoriasg;
use Illuminate\Database\Seeder;
use Carbon\Carbon; // Importar la clase Carbon para manejar las fechas

class CategoriasgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener la fecha y hora actual
        $now = Carbon::now();

        categoriasg::create([
            'Nombre' => 'vivienda',
            'fv' => '0',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        categoriasg::create([
            'Nombre' => 'salud',
            'fv' => '0',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        categoriasg::create([
            'Nombre' => 'educacion',
            'fv' => '0',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        categoriasg::create([
            'Nombre' => 'transporte',
            'fv' => '0',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        categoriasg::create([
            'Nombre' => 'alimento',
            'fv' => '0',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        categoriasg::create([
            'Nombre' => 'autocuidado',
            'fv' => '0',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        categoriasg::create([
            'Nombre' => 'necesario',
            'fv' => '1',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        categoriasg::create([
            'Nombre' => 'innecesario',
            'fv' => '1',
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
