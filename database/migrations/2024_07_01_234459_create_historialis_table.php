<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historialis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->float('ingreso_fijo')->nullable();
            $table->float('ingreso_variable')->nullable();
            $table->boolean('tipo_ingreso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historialis');
    }
};
