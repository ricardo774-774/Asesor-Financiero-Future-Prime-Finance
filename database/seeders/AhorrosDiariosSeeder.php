<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AhorrosDiariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ahorro_visual')->insert([
            ['ejemplo' => 'Esta cantidad representa aproximadamente un cafe diario', 'ahorro' => 50, 'foto' => 'cafe.jpg'],
            ['ejemplo' => 'Comer fuera de casa puede representar un gasto cotidiano que representa esta cantidad aproximadamente', 'ahorro' => 150, 'foto' => 'comida.jpg'],
            ['ejemplo' => 'Usar transporte publico o caminar puede representar este ahorro', 'ahorro' => 100, 'foto' => 'transporte.jpg'],
            ['ejemplo' => 'Unas papas al dia representan este ahorro', 'ahorro' => 30, 'foto' => 'papas.jpg'],
            ['ejemplo' => 'Equivale aproximadamente a un dulce diario al dia', 'ahorro' => 20, 'foto' => 'dulces.jpg'],
            ['ejemplo' => 'Podrias ahorrar esta cantidad diaria si tienes muchas aplicaciones de streaming o suscripciones que en realidad muchas veces no usas.', 'ahorro' => 200, 'foto' => 'suscripcion.jpg'],
            ['ejemplo' => 'Usar un termo en lugar de comprar agua embotellada representa este ahorro', 'ahorro' => 15, 'foto' => 'botella.jpg'],
            ['ejemplo' => 'Podrías ahorrar esta cantidad comprando alguna marca alternativa de diversos productos', 'ahorro' => 60, 'foto' => 'marca.jpg'],
            ['ejemplo' => 'Podrías ahorrar esto usando un cupón o aprovechando alguna promoción', 'ahorro' => 80, 'foto' => 'cupon.jpg'],
            ['ejemplo' => 'El entretenimiento puede sonar divertido pero piensa en otras actividades que quizás puedas hacer de forma gratuita', 'ahorro' => 250, 'foto' => 'entretenimiento.jpg'],
            ['ejemplo' => 'Piensa en lugares a donde salir que te gusten que no representen un gasto recurrente', 'ahorro' => 250, 'foto' => 'salidas.jpg'],
        ]);
    }
}
