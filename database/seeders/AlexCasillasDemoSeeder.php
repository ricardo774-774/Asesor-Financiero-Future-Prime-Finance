<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AlexCasillasDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Este seeder crea datos completos para Alex Casillas (userID 11) - Perfil de ingresos altos
     */
    public function run(): void
    {
        $userID = 11; // Alex Casillas
        $now = Carbon::now();

        // 1. GASTOS DE ALTO NIVEL ECONÓMICO
        $gastos = [
            1 => 8500,   // Alimentación - $8,500 al mes (restaurantes premium, comida gourmet)
            2 => 2800,   // Transporte - $2,800 al mes (auto de lujo, gasolina premium)
            3 => 4500,   // Entretenimiento - $4,500 al mes (viajes, eventos VIP)
            4 => 15000,  // Vivienda - $15,000 al mes (casa premium o departamento de lujo)
            5 => 2200,   // Salud - $2,200 al mes (seguro médico privado, tratamientos)
            6 => 3000,   // Educación - $3,000 al mes (cursos especializados, MBA)
            7 => 2500,   // Ropa - $2,500 al mes (marcas de diseñador)
            8 => 1500,   // Otros - $1,500 al mes (servicios premium)
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

        // 2. INGRESOS ALTOS MÚLTIPLES
        DB::table('ingresos')->updateOrInsert(
            ['userID' => $userID],
            [
                'ingreso_fijo' => 85000,    // Salario ejecutivo de $85,000
                'ingreso_variable' => 25000, // Bonos y comisiones $25,000
                'ingreso_saldo' => 125000,   // Saldo actual de $125,000
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // 3. METAS FINANCIERAS AMBICIOSAS
        DB::table('metas')->updateOrInsert(
            ['userID' => $userID],
            [
                'meta_dinero' => 500000, // Meta: $500,000 para inversión inmobiliaria
                'meta_fecha' => 730,     // En 2 años (730 días)
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // 4. OBJETIVO PREVIO AMBICIOSO
        DB::table('previos')->updateOrInsert(
            ['userID' => $userID],
            [
                'dinero_previo' => 200000, // Objetivo anterior: $200,000
                'fecha_previo' => 365,     // En 1 año
                'created_at' => $now->copy()->subMonths(3), // Creado hace 3 meses
                'updated_at' => $now,
            ]
        );

        // 5. HISTORIAL FINANCIERO DE ALTO PATRIMONIO
        $this->createHighIncomeFinancialHistory($userID, $now);

        // 6. HISTORIAL DE GASTOS PREMIUM
        $this->createPremiumExpenseHistory($userID, $now);

        // 7. HISTORIAL DE INGRESOS MÚLTIPLES
        $this->createMultipleIncomeHistory($userID, $now);
    }

    /**
     * Crear historial financiero con saldos altos y crecimiento acelerado
     */
    private function createHighIncomeFinancialHistory($userID, $now)
    {
        // Limpiar historial anterior
        DB::table('historicos')->where('userID', $userID)->delete();

        $startDate = $now->copy()->subMonths(8); // 8 meses de historial
        $currentDate = $startDate->copy();
        $baseAmount = 75000; // Saldo inicial alto
        
        while ($currentDate->lte($now)) {
            // Simular variación de saldos altos
            $dayOfMonth = $currentDate->day;
            
            if ($dayOfMonth <= 5) {
                // Principio de mes: día de pago, saldo muy alto
                $saldo = $baseAmount + rand(30000, 50000);
            } elseif ($dayOfMonth <= 15) {
                // Mediados de mes: gastos de lujo pero saldo alto
                $saldo = $baseAmount + rand(15000, 35000);
            } else {
                // Final de mes: saldo sigue siendo considerable
                $saldo = $baseAmount + rand(8000, 25000);
            }

            // Tendencia de crecimiento acelerado
            $monthsFromStart = $startDate->diffInMonths($currentDate);
            $baseAmount = 75000 + ($monthsFromStart * 3000); // Crecimiento de $3,000/mes

            // Agregar volatilidad por inversiones
            if (rand(1, 100) <= 20) { // 20% probabilidad de ganancia por inversión
                $saldo += rand(5000, 20000);
            }

            DB::table('historicos')->insert([
                'userID' => $userID,
                'saldo' => $saldo,
                'fecha_click' => $currentDate->toDateString(),
                'created_at' => $currentDate->copy(),
                'updated_at' => $currentDate->copy(),
            ]);

            $currentDate->addDays(2); // Registro cada 2 días (más frecuente)
        }
    }

    /**
     * Crear historial detallado de gastos premium
     */
    private function createPremiumExpenseHistory($userID, $now)
    {
        // Limpiar historial anterior
        DB::table('historialgs')->where('userID', $userID)->delete();

        $startDate = $now->copy()->subMonths(4);
        $currentDate = $startDate->copy();

        $gastosPremium = [
            1 => ['min' => 200, 'max' => 800, 'frecuencia' => 0.9],   // Alimentación premium - muy frecuente
            2 => ['min' => 100, 'max' => 400, 'frecuencia' => 0.7],   // Transporte de lujo
            3 => ['min' => 500, 'max' => 2500, 'frecuencia' => 0.4],  // Entretenimiento VIP
            4 => ['min' => 15000, 'max' => 15000, 'frecuencia' => 0.1], // Vivienda premium - mensual
            5 => ['min' => 500, 'max' => 1500, 'frecuencia' => 0.3],  // Salud premium
            6 => ['min' => 800, 'max' => 2000, 'frecuencia' => 0.2],  // Educación especializada
            7 => ['min' => 800, 'max' => 3000, 'frecuencia' => 0.2],  // Ropa de diseñador
            8 => ['min' => 200, 'max' => 1000, 'frecuencia' => 0.4],  // Servicios premium
        ];

        while ($currentDate->lte($now)) {
            foreach ($gastosPremium as $categoriaID => $config) {
                if (rand(1, 100) <= ($config['frecuencia'] * 100)) {
                    $monto = rand($config['min'], $config['max']);
                    
                    DB::table('historialgs')->insert([
                        'userID' => $userID,
                        'categoriasID' => $categoriaID,
                        'monto' => $monto,
                        'fv' => 1,
                        'created_at' => $currentDate->copy(),
                        'updated_at' => $currentDate->copy(),
                    ]);
                }
            }
            $currentDate->addDay();
        }
    }

    /**
     * Crear historial de múltiples fuentes de ingresos altos
     */
    private function createMultipleIncomeHistory($userID, $now)
    {
        // Limpiar historial anterior
        DB::table('historialis')->where('userID', $userID)->delete();

        $startDate = $now->copy()->subMonths(8);
        $currentMonth = $startDate->copy()->startOfMonth();

        while ($currentMonth->lte($now)) {
            // Salario ejecutivo mensual
            DB::table('historialis')->insert([
                'userID' => $userID,
                'ingreso_fijo' => 85000,
                'ingreso_variable' => 0,
                'tipo_ingreso' => 1, // Tipo fijo
                'created_at' => $currentMonth->copy()->addDays(4),
                'updated_at' => $currentMonth->copy()->addDays(4),
            ]);

            // Bonos trimestrales
            if ($currentMonth->month % 3 == 0) { // Cada 3 meses
                DB::table('historialis')->insert([
                    'userID' => $userID,
                    'ingreso_fijo' => 0,
                    'ingreso_variable' => rand(40000, 80000),
                    'tipo_ingreso' => 2, // Tipo variable - bonus
                    'created_at' => $currentMonth->copy()->addDays(15),
                    'updated_at' => $currentMonth->copy()->addDays(15),
                ]);
            }

            // Ingresos por inversiones (frecuentes)
            if (rand(1, 100) <= 60) { // 60% probabilidad
                DB::table('historialis')->insert([
                    'userID' => $userID,
                    'ingreso_fijo' => 0,
                    'ingreso_variable' => rand(5000, 25000),
                    'tipo_ingreso' => 2, // Tipo variable - inversiones
                    'created_at' => $currentMonth->copy()->addDays(rand(10, 25)),
                    'updated_at' => $currentMonth->copy()->addDays(rand(10, 25)),
                ]);
            }

            // Ingresos por consultoría/freelance de alto nivel
            if (rand(1, 100) <= 40) { // 40% probabilidad
                DB::table('historialis')->insert([
                    'userID' => $userID,
                    'ingreso_fijo' => 0,
                    'ingreso_variable' => rand(15000, 45000),
                    'tipo_ingreso' => 2, // Tipo variable - consultoría
                    'created_at' => $currentMonth->copy()->addDays(rand(5, 20)),
                    'updated_at' => $currentMonth->copy()->addDays(rand(5, 20)),
                ]);
            }

            $currentMonth->addMonth();
        }
    }
} 