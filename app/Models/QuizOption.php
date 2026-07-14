<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'sign_id',
        'word',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    /**
     * この選択肢が属するイラスト
     */
    public function sign()
    {
        return $this->belongsTo(Sign::class);
    }
}