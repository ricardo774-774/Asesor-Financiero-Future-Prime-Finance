<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosMuestraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([
            ['id' => 11, 'name' => 'Alex Casillas', 'email' => 'alexcasillas@gmail.com', 'password' => Hash::make('Modular2')],
            ['id' => 22, 'name' => 'Max Cruz', 'email' => 'maxcruz@gmail.com', 'password' => Hash::make('Modular2')],
            ['id' => 33, 'name' => 'Abraham Ramirez', 'email' => 'abrahamramirez@gmail.com', 'password' => Hash::make('Modular2')],
        ]);
    }
}

