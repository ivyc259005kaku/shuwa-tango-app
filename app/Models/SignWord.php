<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignWord extends Model
{
    use HasFactory;

    protected $fillable = [
        'sign_id',
        'word',
    ];

    /**
     * この単語が属するイラスト
     */
    public function sign()
    {
        return $this->belongsTo(Sign::class);
    }
}