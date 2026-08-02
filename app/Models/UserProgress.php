<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    protected $table = 'user_progress';

    protected $fillable = [
        'user_id',
        'sign_id',
        'status',
    ];

    /**
     * ステータス定数（未学習/学習中/習得済み）
     */
    const STATUS_UNLEARNED = '未学習';

    const STATUS_LEARNING = '学習中';

    const STATUS_MASTERED = '習得済み';

    /**
     * 対象ユーザー
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 対象イラスト
     */
    public function sign()
    {
        return $this->belongsTo(Sign::class);
    }
}
