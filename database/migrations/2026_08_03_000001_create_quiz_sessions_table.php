<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->json('queue');       // 出題順（sign_idの配列）
            $table->unsignedInteger('current_index')->default(0); // 現在の問題位置
            $table->unsignedInteger('correct_count')->default(0); // 正解数
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_sessions');
    }
};