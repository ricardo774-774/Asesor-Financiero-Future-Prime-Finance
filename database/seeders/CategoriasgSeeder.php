<?php

namespace Database\Seeders;

use App\Models\categoriasg;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        categoriasg::create([
            'Nombre'=>'vivienda',
            'fv'=>'0'
        ]);

        categoriasg::create([
            'Nombre'=>'salud',
            'fv'=>'0'
        ]);


        categoriasg::create([
            'Nombre'=>'educacion',
            'fv'=>'0'
        ]);


        categoriasg::create([
            'Nombre'=>'transporte',
            'fv'=>'0'
        ]);


        categoriasg::create([
            'Nombre'=>'alimento',
            'fv'=>'0'
        ]);


        categoriasg::create([
            'Nombre'=>'autocuidado',
            'fv'=>'0'
        ]);


        categoriasg::create([
            'Nombre'=>'necesario',
            'fv'=>'1'
        ]);


        categoriasg::create([
            'Nombre'=>'innecesario',
            'fv'=>'1'
        ]);



        //
    }
}
