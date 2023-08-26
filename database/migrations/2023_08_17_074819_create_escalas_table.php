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
        Schema::create('escalas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escala_tipo_id');
            $table->unsignedBigInteger('guarnicao_id');
            $table->string('nome');
            $table->string('descricao');
            $table->string('inicio');
            $table->unsignedInteger('duracao');
            $table->unsignedBigInteger('regime_id');
            $table->timestamps();
            //relacionamentos
            $table->foreign('escala_tipo_id')->references('id')->on('escala_tipos');
            $table->foreign('guarnicao_id')->references('id')->on('guarnicoes');
            $table->foreign('regime_id')->references('id')->on('regimes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalas');
    }
};
