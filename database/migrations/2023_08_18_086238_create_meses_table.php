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
        Schema::create('meses', function (Blueprint $table) {
            $table->id();
            $table->integer('ano', false, true);
            $table->unsignedBigInteger('do_ano_mes_id');
            $table->timestamps();
            //relationships
            $table->foreign('mes_id')->references('id')->on('do_ano_meses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meses');
    }
};
