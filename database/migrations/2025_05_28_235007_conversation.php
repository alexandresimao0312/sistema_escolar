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
         Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->morphs('user_one'); // Ex: user_one_id, user_one_type
            $table->morphs('user_two'); // Ex: user_two_id, user_two_type
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
         Schema::dropIfExists('conversations');
    }
};
