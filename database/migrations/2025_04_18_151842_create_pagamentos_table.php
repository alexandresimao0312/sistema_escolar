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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mensalidade_id')->constrained()->onDelete('cascade');
            $table->date('data_pagamento');
            $table->decimal('valor_pago', 10, 2);
            $table->string('forma_pagamento'); // exemplo: dinheiro, multicaixa, transferência
            $table->string('referencia')->nullable(); // recibo, comprovativo, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
