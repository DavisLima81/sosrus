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
        Schema::create('escala_agendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mes_id');
            $table->unsignedBigInteger('escala_id');
            $table->timestamps();
            //foreign keys
            $table->foreign('mes_id')->references('id')->on('meses');
            $table->foreign('escala_id')->references('id')->on('escalas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escala_agendas');
    }
};
