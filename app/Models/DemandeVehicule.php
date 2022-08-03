<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeVehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'objet',
        'conducteur_id',
        'date_sortie',
        'date_retour',
        'vehicule_id',
        'kilometrage_depart',
        'kilometrage_retour',
        'date_retour_reelle',
        'statut',
        'agent_id',
    ];

    public function conducteur(){
        return $this->belongsTo(Conducteur::class);
    }

    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
