<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaxCruzDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Este seeder crea datos completos para Max Cruz (userID 22) para demostrar el sistema
     */
    public function run(): void
    {
        $userID = 22; // Max Cruz
        $now = Carbon::now();

        // 1. GASTOS REALISTAS POR CATEGORÍA
        $gastos = [
            1 => 2500,  // Alimentación - $2,500 al mes
            2 => 800,   // Transporte - $800 al mes  
            3 => 1200,  // Entretenimiento - $1,200 al mes
            4 => 3500,  // Vivienda - $3,500 al mes (renta)
            5 => 600,   // Salud - $600 al mes
            6 => 400,   // Educación - $400 al mes
            7 => 300,   // Ropa - $300 al mes
            8 => 200,   // Otros - $200 al mes
        ];

        // Actualizar gastos existentes
        foreach ($gastos as $categoriaID => $monto) {
            DB::table('gastos')
                ->where('userID', $userID)
                ->where('categoriasID', $categoriaID)
                ->update([
                    'monto' => $monto,
                    'updated_at' => $now,
                ]);
        }

        // 2. INGRESOS MENSUALES
        DB::table('ingresos')->updateOrInsert(
            ['userID' => $userID],
            [
                'ingreso_fijo' => 12000, // Salario mensual de $12,000
                'ingreso_variable' => 0,
                'ingreso_saldo' => 8500, // Saldo actual de $8,500
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // 4. META FINANCIERA REALISTA
        DB::table('metas')->updateOrInsert(
            ['userID' => $userID],
            [
                'meta_dinero' => 25000, // Meta: $25,000 para un carro
                'meta_fecha' => 365, // En 1 año (365 días)
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // 5. OBJETIVO PREVIO (para comparación)
        DB::table('previos')->updateOrInsert(
            ['userID' => $userID],
            [
                'dinero_previo' => 15000, // Objetivo anterior: $15,000
                'fecha_previo' => 180, // En 6 meses
                'created_at' => $now->copy()->subMonths(2), // Creado hace 2 meses
                'updated_at' => $now,
            ]
        );

        // 6. HISTORIAL FINANCIERO REALISTA (últimos 6 meses)
        $this->createRealisticFinancialHistory($userID, $now);

        // 7. HISTORIAL DE GASTOS DETALLADO
        $this->createDetailedExpenseHistory($userID, $now);

        // 8. HISTORIAL DE INGRESOS
        $this->createIncomeHistory($userID, $now);
    }

    /**
     * Crear historial financiero realista con tendencia de crecimiento
     */
    private function createRealisticFinancialHistory($userID, $now)
    {
        // Limpiar historial anterior
        DB::table('historicos')->where('userID', $userID)->delete();

        $startDate = $now->copy()->subMonths(6);
        $currentDate = $startDate->copy();
        $baseAmount = 3000; // Saldo inicial
        
        while ($currentDate->lte($now)) {
            // Simular variación realista del saldo
            $dayOfMonth = $currentDate->day;
            
            if ($dayOfMonth <= 5) {
                // Principio de mes: día de pago, saldo alto
                $saldo = $baseAmount + rand(4000, 6000);
            } elseif ($dayOfMonth <= 15) {
                // Mediados de mes: gastos normales
                $saldo = $baseAmount + rand(2000, 4000);
            } else {
                // Final de mes: saldo más bajo
                $saldo = $baseAmount + rand(500, 2500);
            }

            // Tendencia de crecimiento gradual
            $monthsFromStart = $startDate->diffInMonths($currentDate);
            $baseAmount = 3000 + ($monthsFromStart * 200); // Crecimiento de $200/mes

            DB::table('historicos')->insert([
                'userID' => $userID,
                'saldo' => $saldo,
                'fecha_click' => $currentDate->toDateString(),
                'created_at' => $currentDate->copy(),
                'updated_at' => $currentDate->copy(),
            ]);

            $currentDate->addDays(3); // Registro cada 3 días
        }
    }

    /**
     * Crear historial detallado de gastos
     */
    private function createDetailedExpenseHistory($userID, $now)
    {
        // Limpiar historial anterior
        DB::table('historialgs')->where('userID', $userID)->delete();

        $startDate = $now->copy()->subMonths(3);
        $currentDate = $startDate->copy();

        $gastosPorCategoria = [
            1 => ['min' => 50, 'max' => 150, 'frecuencia' => 0.8],   // Alimentación - frecuente
            2 => ['min' => 20, 'max' => 100, 'frecuencia' => 0.6],   // Transporte
            3 => ['min' => 100, 'max' => 500, 'frecuencia' => 0.3],  // Entretenimiento
            4 => ['min' => 3500, 'max' => 3500, 'frecuencia' => 0.1], // Vivienda - mensual
            5 => ['min' => 200, 'max' => 800, 'frecuencia' => 0.2],  // Salud
            6 => ['min' => 100, 'max' => 400, 'frecuencia' => 0.2],  // Educación
            7 => ['min' => 150, 'max' => 600, 'frecuencia' => 0.1],  // Ropa
            8 => ['min' => 50, 'max' => 200, 'frecuencia' => 0.3],   // Otros
        ];

        while ($currentDate->lte($now)) {
            foreach ($gastosPorCategoria as $categoriaID => $config) {
                if (rand(1, 100) <= ($config['frecuencia'] * 100)) {
                    $monto = rand($config['min'], $config['max']);
                    
                    DB::table('historialgs')->insert([
                        'userID' => $userID,
                        'categoriasID' => $categoriaID,
                        'monto' => $monto,
                        'fv' => 1, // Campo requerido según la estructura
                        'created_at' => $currentDate->copy(),
                        'updated_at' => $currentDate->copy(),
                    ]);
                }
            }
            $currentDate->addDay();
        }
    }

    /**
     * Crear historial de ingresos
     */
    private function createIncomeHistory($userID, $now)
    {
        // Limpiar historial anterior
        DB::table('historialis')->where('userID', $userID)->delete();

        $startDate = $now->copy()->subMonths(6);
        $currentMonth = $startDate->copy()->startOfMonth();

        while ($currentMonth->lte($now)) {
            // Salario mensual
            DB::table('historialis')->insert([
                'userID' => $userID,
                'ingreso_fijo' => 12000,
                'ingreso_variable' => 0,
                'tipo_ingreso' => 1, // Tipo fijo
                'created_at' => $currentMonth->copy()->addDays(4),
                'updated_at' => $currentMonth->copy()->addDays(4),
            ]);

            // Ingresos extras ocasionales
            if (rand(1, 100) <= 30) { // 30% de probabilidad
                DB::table('historialis')->insert([
                    'userID' => $userID,
                    'ingreso_fijo' => 0,
                    'ingreso_variable' => rand(500, 2000),
                    'tipo_ingreso' => 2, // Tipo variable
                    'created_at' => $currentMonth->copy()->addDays(rand(10, 25)),
                    'updated_at' => $currentMonth->copy()->addDays(rand(10, 25)),
                ]);
            }

            $currentMonth->addMonth();
        }
    }
} 