<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneradorCategoria;
use Carbon\Carbon; // Importar la clase Carbon para manejar las fechas

class GeneradorCategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener la fecha y hora actual
        $now = Carbon::now();

        // Lista de categorías a insertar
        $categorias = [
            ['nombre' => 'Carro', 'tiempo_meta' => 12, 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Viaje', 'tiempo_meta' => 6, 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Celular', 'tiempo_meta' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Computadora', 'tiempo_meta' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Curso', 'tiempo_meta' => 4, 'created_at' => $now, 'updated_at' => $now],
        ];

        // Insertar cada categoría en la tabla generador_categorias
        foreach ($categorias as $categoria) {
            GeneradorCategoria::create($categoria);
        }
    }
}
