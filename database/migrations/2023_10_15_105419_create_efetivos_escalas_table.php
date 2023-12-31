<?php

use App\Models\Efetivo;
use App\Models\Escala;
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
            $table->foreignIdFor(Efetivo::class);
            $table->foreignIdFor(Escala::class);
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
