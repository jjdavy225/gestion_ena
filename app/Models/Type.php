<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'designation',
        'supprime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
