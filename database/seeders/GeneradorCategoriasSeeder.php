<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneradorCategoria;

class GeneradorCategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lista de categorías a insertar
        $categorias = [
            ['nombre' => 'Carro', 'tiempo_meta' => 12],
            ['nombre' => 'Viaje', 'tiempo_meta' => 6],
            ['nombre' => 'Celular', 'tiempo_meta' => 3],
            ['nombre' => 'Computadora', 'tiempo_meta' => 4],
            ['nombre' => 'Curso', 'tiempo_meta' => 4],
        ];

        // Insertar cada categoría en la tabla generador_categorias
        foreach ($categorias as $categoria) {
            GeneradorCategoria::create($categoria);
        }
    }
}
