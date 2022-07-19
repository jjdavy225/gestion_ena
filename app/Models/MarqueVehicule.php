<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarqueVehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
    ];

    public function vehicules(){
        return $this->hasMany(Vehicule::class);
    }
}
