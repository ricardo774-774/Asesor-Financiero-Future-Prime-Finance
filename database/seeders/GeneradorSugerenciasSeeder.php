<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneradorSugerencia;
use Carbon\Carbon; // Importar la clase Carbon para manejar las fechas

class GeneradorSugerenciasSeeder extends Seeder
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

        // Lista de sugerencias a insertar con IDs específicos de categorías
        $sugerencias = [
            // Sugerencias para la categoría con ID 1
            ['sugerencia_cid' => 1, 'titulo' => 'Compra un carro económico', 'monto' => 100000, 'foto' => 'carro_bajo.jpg', 'created_at' => $now, 'updated_at' => $now],  // Bajo
            ['sugerencia_cid' => 1, 'titulo' => 'Compra un carro de gama media', 'monto' => 300000, 'foto' => 'carro_medio.jpg', 'created_at' => $now, 'updated_at' => $now],  // Medio
            ['sugerencia_cid' => 1, 'titulo' => 'Compra un carro de lujo', 'monto' => 600000, 'foto' => 'carro_alto.jpg', 'created_at' => $now, 'updated_at' => $now],  // Alto

            // Sugerencias para la categoría con ID 2
            ['sugerencia_cid' => 2, 'titulo' => 'Planifica un viaje local', 'monto' => 5000, 'foto' => 'viaje_bajo.jpg', 'created_at' => $now, 'updated_at' => $now],  // Bajo
            ['sugerencia_cid' => 2, 'titulo' => 'Planifica un viaje a Europa', 'monto' => 30000, 'foto' => 'viaje_medio.jpg', 'created_at' => $now, 'updated_at' => $now],  // Medio
            ['sugerencia_cid' => 2, 'titulo' => 'Planifica un viaje alrededor del mundo', 'monto' => 150000, 'foto' => 'viaje_alto.jpg', 'created_at' => $now, 'updated_at' => $now],  // Alto

            // Sugerencias para la categoría con ID 3
            ['sugerencia_cid' => 3, 'titulo' => 'Compra un celular básico', 'monto' => 3000, 'foto' => 'cel_bajo.jpg', 'created_at' => $now, 'updated_at' => $now],  // Bajo
            ['sugerencia_cid' => 3, 'titulo' => 'Compra un celular de gama media', 'monto' => 6000, 'foto' => 'cel_medio.jpg', 'created_at' => $now, 'updated_at' => $now],  // Medio
            ['sugerencia_cid' => 3, 'titulo' => 'Compra un celular de alta gama', 'monto' => 15000, 'foto' => 'cel_alto.jpg', 'created_at' => $now, 'updated_at' => $now],  // Alto

            // Sugerencias para la categoría con ID 4
            ['sugerencia_cid' => 4, 'titulo' => 'Compra una computadora básica', 'monto' => 5000, 'foto' => 'compu_bajo.jpg', 'created_at' => $now, 'updated_at' => $now],  // Bajo
            ['sugerencia_cid' => 4, 'titulo' => 'Compra una computadora de gama media', 'monto' => 15000, 'foto' => 'compu_medio.jpg', 'created_at' => $now, 'updated_at' => $now],  // Medio
            ['sugerencia_cid' => 4, 'titulo' => 'Compra una computadora de alta gama', 'monto' => 25000, 'foto' => 'compu_alto.jpg', 'created_at' => $now, 'updated_at' => $now],  // Alto

            // Sugerencias para la categoría con ID 5
            ['sugerencia_cid' => 5, 'titulo' => 'Inscríbete en un curso básico', 'monto' => 2000, 'foto' => 'curso_bajo.jpg', 'created_at' => $now, 'updated_at' => $now],  // Bajo
            ['sugerencia_cid' => 5, 'titulo' => 'Inscríbete en un curso avanzado', 'monto' => 5000, 'foto' => 'curso_medio.jpg', 'created_at' => $now, 'updated_at' => $now],  // Medio
            ['sugerencia_cid' => 5, 'titulo' => 'Inscríbete en un curso intensivo', 'monto' => 10000, 'foto' => 'curso_alto.jpg', 'created_at' => $now, 'updated_at' => $now],  // Alto
        ];

        // Inserta cada sugerencia en la tabla generador_sugerencias
        foreach ($sugerencias as $sugerencia) {
            GeneradorSugerencia::create($sugerencia);
        }
    }
}
