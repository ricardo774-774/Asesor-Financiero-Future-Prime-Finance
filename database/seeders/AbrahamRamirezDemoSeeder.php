<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbrahamRamirezDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Este seeder crea datos completos para Abraham Ramirez (userID 33) - Perfil clase media
     */
    public function run(): void
    {
        $userID = 33; // Abraham Ramirez
        $now = Carbon::now();

        // 1. GASTOS DE CLASE MEDIA
        $gastos = [
            1 => 5500,   // Alimentación - $5,500 al mes (supermercado, restaurantes ocasionales)
            2 => 2000,   // Transporte - $2,000 al mes (auto familiar, gasolina, mantenimiento)
            3 => 2500,   // Entretenimiento - $2,500 al mes (cine, salidas familiares, hobbies)
            4 => 8500,   // Vivienda - $8,500 al mes (hipoteca o renta en zona media)
            5 => 1500,   // Salud - $1,500 al mes (seguro médico, medicinas)
            6 => 2000,   // Educación - $2,000 al mes (escuela hijos, cursos)
            7 => 1500,   // Ropa - $1,500 al mes (vestimenta familiar)
            8 => 1500,   // Otros - $1,500 al mes (servicios, imprevistos)
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

        // 2. INGRESOS CLASE MEDIA
        DB::table('ingresos')->updateOrInsert(
            ['userID' => $userID],
            [
                'ingreso_fijo' => 40000,    // Salario mensual de $40,000
                'ingreso_variable' => 5000, // Bonos y comisiones $5,000
                'ingreso_saldo' => 35000,   // Saldo actual de $35,000
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // 3. METAS FINANCIERAS REALISTAS
        DB::table('metas')->updateOrInsert(
            ['userID' => $userID],
            [
                'meta_dinero' => 100000, // Meta: $100,000 para enganche de casa
                'meta_fecha' => 547,     // En 18 meses (547 días)
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // 4. OBJETIVO PREVIO CLASE MEDIA
        DB::table('previos')->updateOrInsert(
            ['userID' => $userID],
            [
                'dinero_previo' => 50000, // Objetivo anterior: $50,000
                'fecha_previo' => 365,    // En 1 año
                'created_at' => $now->copy()->subMonths(4), // Creado hace 4 meses
                'updated_at' => $now,
            ]
        );

        // 5. HISTORIAL FINANCIERO CLASE MEDIA
        $this->createMiddleClassFinancialHistory($userID, $now);

        // 6. HISTORIAL DE GASTOS EQUILIBRADOS
        $this->createBalancedExpenseHistory($userID, $now);

        // 7. HISTORIAL DE INGRESOS ESTABLES
        $this->createStableIncomeHistory($userID, $now);
    }

    /**
     * Crear historial financiero con crecimiento constante de clase media
     */
    private function createMiddleClassFinancialHistory($userID, $now)
    {
        // Limpiar historial anterior
        DB::table('historicos')->where('userID', $userID)->delete();

        $startDate = $now->copy()->subMonths(7); // 7 meses de historial
        $currentDate = $startDate->copy();
        $baseAmount = 22000; // Saldo inicial moderado
        
        while ($currentDate->lte($now)) {
            // Simular variación de saldos de clase media
            $dayOfMonth = $currentDate->day;
            
            if ($dayOfMonth <= 5) {
                // Principio de mes: día de pago, saldo alto
                $saldo = $baseAmount + rand(15000, 25000);
            } elseif ($dayOfMonth <= 15) {
                // Mediados de mes: gastos normales
                $saldo = $baseAmount + rand(8000, 18000);
            } else {
                // Final de mes: saldo moderado
                $saldo = $baseAmount + rand(3000, 12000);
            }

            // Tendencia de crecimiento constante
            $monthsFromStart = $startDate->diffInMonths($currentDate);
            $baseAmount = 22000 + ($monthsFromStart * 1000); // Crecimiento de $1,000/mes

            // Agregar volatilidad ocasional (ahorro extra o gasto imprevisto)
            if (rand(1, 100) <= 15) { // 15% probabilidad
                $variation = rand(-3000, 8000);
                $saldo += $variation;
            }

            DB::table('historicos')->insert([
                'userID' => $userID,
                'saldo' => max($saldo, 1000), // Mínimo $1,000
                'fecha_click' => $currentDate->toDateString(),
                'created_at' => $currentDate->copy(),
                'updated_at' => $currentDate->copy(),
            ]);

            $currentDate->addDays(3); // Registro cada 3 días
        }
    }

    /**
     * Crear historial detallado de gastos equilibrados
     */
    private function createBalancedExpenseHistory($userID, $now)
    {
        // Limpiar historial anterior
        DB::table('historialgs')->where('userID', $userID)->delete();

        $startDate = $now->copy()->subMonths(4);
        $currentDate = $startDate->copy();

        $gastosClaseMedia = [
            1 => ['min' => 100, 'max' => 350, 'frecuencia' => 0.8],   // Alimentación - frecuente
            2 => ['min' => 50, 'max' => 200, 'frecuencia' => 0.6],    // Transporte
            3 => ['min' => 200, 'max' => 800, 'frecuencia' => 0.4],   // Entretenimiento
            4 => ['min' => 8500, 'max' => 8500, 'frecuencia' => 0.1], // Vivienda - mensual
            5 => ['min' => 300, 'max' => 1000, 'frecuencia' => 0.2],  // Salud
            6 => ['min' => 400, 'max' => 1200, 'frecuencia' => 0.3],  // Educación
            7 => ['min' => 300, 'max' => 1000, 'frecuencia' => 0.2],  // Ropa
            8 => ['min' => 100, 'max' => 500, 'frecuencia' => 0.4],   // Otros
        ];

        while ($currentDate->lte($now)) {
            foreach ($gastosClaseMedia as $categoriaID => $config) {
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
     * Crear historial de ingresos estables con ocasionales extras
     */
    private function createStableIncomeHistory($userID, $now)
    {
        // Limpiar historial anterior
        DB::table('historialis')->where('userID', $userID)->delete();

        $startDate = $now->copy()->subMonths(7);
        $currentMonth = $startDate->copy()->startOfMonth();

        while ($currentMonth->lte($now)) {
            // Salario mensual estable
            DB::table('historialis')->insert([
                'userID' => $userID,
                'ingreso_fijo' => 40000,
                'ingreso_variable' => 0,
                'tipo_ingreso' => 1, // Tipo fijo
                'created_at' => $currentMonth->copy()->addDays(4),
                'updated_at' => $currentMonth->copy()->addDays(4),
            ]);

            // Bonos ocasionales (cada 4 meses)
            if ($currentMonth->month % 4 == 0) {
                DB::table('historialis')->insert([
                    'userID' => $userID,
                    'ingreso_fijo' => 0,
                    'ingreso_variable' => rand(8000, 15000),
                    'tipo_ingreso' => 2, // Tipo variable - bonus
                    'created_at' => $currentMonth->copy()->addDays(15),
                    'updated_at' => $currentMonth->copy()->addDays(15),
                ]);
            }

            // Ingresos extras ocasionales (freelance, ventas)
            if (rand(1, 100) <= 35) { // 35% probabilidad
                DB::table('historialis')->insert([
                    'userID' => $userID,
                    'ingreso_fijo' => 0,
                    'ingreso_variable' => rand(2000, 8000),
                    'tipo_ingreso' => 2, // Tipo variable
                    'created_at' => $currentMonth->copy()->addDays(rand(10, 25)),
                    'updated_at' => $currentMonth->copy()->addDays(rand(10, 25)),
                ]);
            }

            // Ingresos por aguinaldo/utilidades (diciembre)
            if ($currentMonth->month == 12) {
                DB::table('historialis')->insert([
                    'userID' => $userID,
                    'ingreso_fijo' => 0,
                    'ingreso_variable' => rand(25000, 35000),
                    'tipo_ingreso' => 2, // Tipo variable - aguinaldo
                    'created_at' => $currentMonth->copy()->addDays(20),
                    'updated_at' => $currentMonth->copy()->addDays(20),
                ]);
            }

            $currentMonth->addMonth();
        }
    }
} 