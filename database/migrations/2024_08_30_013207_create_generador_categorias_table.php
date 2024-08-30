<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneradorCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generador_categorias', function (Blueprint $table) {
            $table->id();  // Identificador único
            $table->string('nombre');  // Nombre de la categoría
            $table->integer('tiempo_meta');  // Nueva columna de tipo entero para tiempo_meta
            $table->timestamps();  // Columnas de created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generador_categorias');
    }
}
