<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_conducteur_id',
        'numero_permis',
        'type_permis',
        'validite_permis',
        'agent_id',
    ];

    public function agent_conducteur(){
        return $this->belongsTo(Agent::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function affectation_principale(){
        return $this->hasOne(Affectation::class,'conducteur_principal_id');
    }

    public function affectation_secondaire(){
        return $this->hasOne(Affectation::class,'conducteur_secondaire_id');
    }

    public function demande_vehicules(){
        return $this->hasMany(DemandeVehicule::class);
    }
}
