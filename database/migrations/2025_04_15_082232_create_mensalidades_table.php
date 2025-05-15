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
        Schema::create('mensalidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matricula_id')->constrained()->onDelete('cascade');
            $table->string('mes'); // Ex: "Janeiro"
            $table->year('ano');
            $table->decimal('valor', 10, 2);
            $table->enum('estado', ['pendente', 'pago', 'vencido'])->default('pendente');
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensalidades');
    }
};
