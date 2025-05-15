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
        Schema::create('ajuste_mensalidades', function (Blueprint $table) {
     $table->id();
    $table->foreignId('curso_id')->constrained()->onDelete('cascade');
    $table->foreignId('classe_id')->constrained()->onDelete('cascade');
    $table->decimal('ajuste', 10, 2)->nullable(); // valor final da mensalidade para a classe
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajuste_mensalidades');
    }
};
