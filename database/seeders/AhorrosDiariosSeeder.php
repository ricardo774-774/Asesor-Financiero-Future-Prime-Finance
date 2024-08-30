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
            ['ejemplo' => 'Café o bebidas compradas fuera', 'ahorro' => 50, 'foto' => ''],
            ['ejemplo' => 'Comida fuera de casa', 'ahorro' => 150, 'foto' => ''],
            ['ejemplo' => 'Transporte', 'ahorro' => 100, 'foto' => ''],
            ['ejemplo' => 'Uso de energía en el hogar', 'ahorro' => 30, 'foto' => ''],
            ['ejemplo' => 'Snacks y golosinas', 'ahorro' => 20, 'foto' => ''],
            ['ejemplo' => 'Suscripciones y servicios', 'ahorro' => 200, 'foto' => ''],
            ['ejemplo' => 'Agua embotellada', 'ahorro' => 15, 'foto' => ''],
            ['ejemplo' => 'Marcas genéricas', 'ahorro' => 60, 'foto' => ''],
            ['ejemplo' => 'Promociones y cupones', 'ahorro' => 80, 'foto' => ''],
            ['ejemplo' => 'Entretenimiento', 'ahorro' => 250, 'foto' => ''],
        ]);
    }
}
