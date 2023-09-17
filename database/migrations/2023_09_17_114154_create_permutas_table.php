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
        Schema::create('permutas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escala_id');
            $table->date('data');
            $table->unsignedBigInteger('entra_efetivo_id');
            $table->unsignedBigInteger('sai_efetivo_id');
            $table->boolean('no_prazo');
            $table->unsignedBigInteger('autorizador_id');
            $table->timestamps();
            //relationships
            $table->foreign('escala_id')->references('id')->on('escalas');
            $table->foreign('entra_efetivo_id')->references('id')->on('efetivos');
            $table->foreign('sai_efetivo_id')->references('id')->on('efetivos');
            $table->foreign('autorizador_id')->references('id')->on('efetivos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permutas');
    }
};
