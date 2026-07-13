<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'source',
    ];

    /**
     * このイラストに紐づく単語（意味）一覧
     */
    public function words()
    {
        return $this->hasMany(SignWord::class);
    }
}