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
        Schema::create('escalados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escala_id');
            $table->unsignedBigInteger('efetivo_id');
            $table->date('data');
            $table->timestamps();
            //relations
            $table->foreign('escala_id')->references('id')->on('escalas');
            $table->foreign('efetivo_id')->references('id')->on('efetivos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalados');
    }
};
