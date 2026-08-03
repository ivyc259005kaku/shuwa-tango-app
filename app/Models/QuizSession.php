<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
    protected $fillable = [
        'user_id',
        'queue',
        'current_index',
        'correct_count',
    ];

    protected $casts = [
        'queue' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}