<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RoleSeeder::class, CategoriasgSeeder::class]); 
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'adminL',
            'email' => 'lalofrancia1@gmail.com',
            'password' => Hash::make('Modular2')
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'adminR',
            'email' => 'roberloplo23@gmail.com',
            'password' => Hash::make('Modular2')
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'userG',
            'email' => 'usuarioG@gmail.com',
            'password' => Hash::make('Modular2')
        ])->assignRole('user');
    }
}
