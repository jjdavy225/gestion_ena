<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'initial',
        'physique',
        'final',
        'maj',
        'exercice_code',
        'jour',
        'nature',
    ];

    public function articles(){
        return $this->belongsToMany(Article::class);
    }
}
