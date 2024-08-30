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
        Schema::create('metahistorico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->float('saldo');
            $table->date('fecha_click');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metahistorico');
    }
};
