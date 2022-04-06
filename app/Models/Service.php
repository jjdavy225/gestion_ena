<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'designation',
    ];

    public function agents(){
        return $this->hasMany(Agent::class);
    }

    public function departement(){
        return $this->belongsTo(Departement::class);
    }
}
