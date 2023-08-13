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
        Schema::create('efetivos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nome_guerra');
            $table->string('trigrama', 3);
            $table->unsignedBigInteger('precedencia_id');
            $table->unsignedBigInteger('quadro_id');
            $table->unsignedBigInteger('especialidade_id')->nullable();
            $table->unsignedBigInteger('subunidade_id')->nullable();
            $table->unsignedBigInteger('secao_id')->nullable();
            $table->unsignedBigInteger('funcao_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            //relacionamentos
            $table->foreign('precedencia_id')->references('id')->on('precedencias');
            $table->foreign('quadro_id')->references('id')->on('quadros');
            $table->foreign('especialidade_id')->references('id')->on('especialidades');
            $table->foreign('subunidade_id')->references('id')->on('subunidades');
            $table->foreign('secao_id')->references('id')->on('secoes');
            $table->foreign('funcao_id')->references('id')->on('funcoes');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('efetivos');
    }
};
