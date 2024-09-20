<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // IDs de usuarios para insertar gastos
        $userIDs = [11, 22, 33];

        // Ciclo para cada userID
        foreach ($userIDs as $userID) {
            // Inserta registros para las categorías 1 al 8 con monto 0
            for ($categoriasID = 1; $categoriasID <= 8; $categoriasID++) {
                DB::table('gastos')->insert([
                    'userID' => $userID,
                    'categoriasID' => $categoriasID,
                    'monto' => 0,
                ]);
            }
        }
    }
}
