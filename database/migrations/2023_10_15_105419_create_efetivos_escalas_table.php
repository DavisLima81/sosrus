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
        Schema::create('efetivos_escalas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('efetivo_id');
            $table->unsignedBigInteger('escala_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('efetivos_escalas');
    }
};
