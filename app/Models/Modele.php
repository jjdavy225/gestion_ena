<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie',
        'type_energie',
        'designation',
    ];

    public function vehicules(){
        return $this->hasMany(Vehicule::class);
    }
}
