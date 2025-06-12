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
        Schema::create('ajudas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('conteudo'); // tutorial escrito
            $table->string('video_url')->nullable(); // link para vídeo tutorial
            $table->string('categoria')->nullable(); // ex: 'mensalidade', 'aluno'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajudas');
    }
};
