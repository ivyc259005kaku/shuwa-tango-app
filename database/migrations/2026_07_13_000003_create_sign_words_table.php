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
        Schema::create('sign_words', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sign_id')->constrained('signs')->cascadeOnDelete(); // イラストID
            $table->string('word', 255); // 単語・意味
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sign_words');
    }
};
