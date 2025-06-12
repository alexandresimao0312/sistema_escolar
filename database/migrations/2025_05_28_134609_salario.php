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
        //
    Schema::create('salarios', function (Blueprint $table) {
    $table->id();
    $table->foreignId('funcionario_id')->constrained('funcionarios')->onDelete('cascade');
    $table->string('cargo');
    $table->decimal('salario_base', 10, 2);
    $table->decimal('bonus', 10, 2)->default(0);
    $table->decimal('descontos', 10, 2)->default(0);
    $table->decimal('total_recebido', 10, 2);
    $table->date('referente_mes'); // Ex: 2025-05-01
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
         Schema::dropIfExists('salarios');
    }
};
