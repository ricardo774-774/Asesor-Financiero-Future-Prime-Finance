<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistoricosSeeder extends Seeder
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

        // Para el userID 11: 30 días de septiembre
        $userID = 11;
        $startDate = Carbon::create(2024, 9, 1); // 1 de septiembre de 2024

        for ($i = 0; $i < 30; $i++) {
            DB::table('historicos')->insert([
                'userID' => $userID,
                'saldo' => rand(200, 4000),
                'fecha_click' => $startDate->copy()->addDays($i)->toDateString(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Para el userID 22: 90 días de julio, agosto, septiembre
        $userID = 22;
        $startDate = Carbon::create(2024, 7, 1); // 1 de julio de 2024

        for ($i = 0; $i < 90; $i++) {
            DB::table('historicos')->insert([
                'userID' => $userID,
                'saldo' => rand(200, 4000),
                'fecha_click' => $startDate->copy()->addDays($i)->toDateString(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Para el userID 33: 180 días de abril a septiembre
        $userID = 33;
        $startDate = Carbon::create(2024, 4, 1); // 1 de abril de 2024

        for ($i = 0; $i < 180; $i++) {
            DB::table('historicos')->insert([
                'userID' => $userID,
                'saldo' => rand(200, 4000),
                'fecha_click' => $startDate->copy()->addDays($i)->toDateString(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
