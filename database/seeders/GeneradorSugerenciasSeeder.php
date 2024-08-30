<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneradorSugerencia;

class GeneradorSugerenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lista de sugerencias a insertar con IDs específicos de categorías
        $sugerencias = [
            // Sugerencias para la categoría con ID 1
            ['sugerencia_cid' => 1, 'titulo' => 'Compra un carro económico', 'monto' => 10000],  // Bajo
            ['sugerencia_cid' => 1, 'titulo' => 'Compra un carro de gama media', 'monto' => 20000],  // Medio
            ['sugerencia_cid' => 1, 'titulo' => 'Compra un carro de lujo', 'monto' => 50000],  // Alto

            // Sugerencias para la categoría con ID 2
            ['sugerencia_cid' => 2, 'titulo' => 'Planifica un viaje local', 'monto' => 500],  // Bajo
            ['sugerencia_cid' => 2, 'titulo' => 'Planifica un viaje a Europa', 'monto' => 3000],  // Medio
            ['sugerencia_cid' => 2, 'titulo' => 'Planifica un viaje alrededor del mundo', 'monto' => 15000],  // Alto

            // Sugerencias para la categoría con ID 3
            ['sugerencia_cid' => 3, 'titulo' => 'Compra un celular básico', 'monto' => 100],  // Bajo
            ['sugerencia_cid' => 3, 'titulo' => 'Compra un celular de gama media', 'monto' => 500],  // Medio
            ['sugerencia_cid' => 3, 'titulo' => 'Compra un celular de alta gama', 'monto' => 1000],  // Alto

            // Sugerencias para la categoría con ID 4
            ['sugerencia_cid' => 4, 'titulo' => 'Compra una computadora básica', 'monto' => 300],  // Bajo
            ['sugerencia_cid' => 4, 'titulo' => 'Compra una computadora de gama media', 'monto' => 1000],  // Medio
            ['sugerencia_cid' => 4, 'titulo' => 'Compra una computadora de alta gama', 'monto' => 2500],  // Alto

            // Sugerencias para la categoría con ID 5
            ['sugerencia_cid' => 5, 'titulo' => 'Inscríbete en un curso básico', 'monto' => 50],  // Bajo
            ['sugerencia_cid' => 5, 'titulo' => 'Inscríbete en un curso avanzado', 'monto' => 300],  // Medio
            ['sugerencia_cid' => 5, 'titulo' => 'Inscríbete en un curso intensivo', 'monto' => 1000],  // Alto
        ];

        // Inserta cada sugerencia en la tabla generador_sugerencias
        foreach ($sugerencias as $sugerencia) {
            GeneradorSugerencia::create($sugerencia);
        }
    }
}
