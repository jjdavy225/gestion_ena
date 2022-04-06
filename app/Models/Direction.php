<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'designation',
        'abrege',
    ];

    public function departements(){
        return $this->hasMany(Departement::class);
    }
}
