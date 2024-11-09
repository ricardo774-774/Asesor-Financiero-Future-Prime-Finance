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

        // Para el userID 11: 30 días, terminando el 20 de noviembre
        $userID = 11;
        $endDate = Carbon::create(2024, 11, 20); // 20 de noviembre de 2024
        $startDate = $endDate->copy()->subDays(30 - 1); // Restar 29 días para comenzar el 23 de octubre de 2024

        for ($i = 0; $i < 30; $i++) {
            DB::table('historicos')->insert([
                'userID' => $userID,
                'saldo' => rand(200, 4000),
                'fecha_click' => $startDate->copy()->addDays($i)->toDateString(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Para el userID 22: 90 días, terminando el 20 de noviembre
        $userID = 22;
        $startDate = $endDate->copy()->subDays(90 - 1); // Restar 89 días para comenzar el 23 de agosto de 2024

        for ($i = 0; $i < 90; $i++) {
            DB::table('historicos')->insert([
                'userID' => $userID,
                'saldo' => rand(200, 4000),
                'fecha_click' => $startDate->copy()->addDays($i)->toDateString(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Para el userID 33: 180 días, terminando el 20 de noviembre
        $userID = 33;
        $startDate = $endDate->copy()->subDays(180 - 1); // Restar 179 días para comenzar el 24 de mayo de 2024

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