<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    // created_at / updated_at カラムを持たないため無効化（answered_atのみ使用）
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'sign_id',
        'is_correct',
        'answered_at',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'answered_at' => 'datetime',
    ];

    /**
     * 回答したユーザー
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 出題されたイラスト
     */
    public function sign()
    {
        return $this->belongsTo(Sign::class);
    }
}
