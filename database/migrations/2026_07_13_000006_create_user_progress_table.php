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
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // ユーザーID
            $table->foreignId('sign_id')->constrained('signs')->cascadeOnDelete(); // イラストID
            $table->string('status', 20); // 未学習/学習中/習得済み
            $table->timestamps();

            // ユーザーとイラストの組み合わせは重複しない（複合ユニークキー）
            $table->unique(['user_id', 'sign_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};
