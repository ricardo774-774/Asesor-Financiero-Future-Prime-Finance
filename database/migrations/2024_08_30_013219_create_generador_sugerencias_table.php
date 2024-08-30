<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneradorSugerenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generador_sugerencias', function (Blueprint $table) {
            $table->id();  // Identificador único
            $table->foreignId('sugerencia_cid')->constrained('generador_categorias');  // Clave foránea a generador_categorias
            $table->string('titulo');  // Título de la sugerencia
            $table->integer('monto');  // Nueva columna de tipo entero para monto
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
        Schema::dropIfExists('generador_sugerencias');
    }
}
