<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panne extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'vehicule_id',
        'vehicule_utilisable',
        'causes',
        'observation',
        'degats',
        'date_panne',
        'repare',
        'agent_id',
        'statut',
    ];

    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function reparations(){
        return $this->hasMany(Reparation::class);
    }
}
