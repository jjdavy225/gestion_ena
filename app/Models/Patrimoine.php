<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrimoine extends Model
{
    use HasFactory;

    protected $fillable = [
        'bureau_id',
        'article_id',
        'quantite', 
    ];

    public function bureau(){
        return $this->belongsTo(Bureau::class);
    }

    public function article(){
        return $this->belongsTo(Article::class);
    }
}
