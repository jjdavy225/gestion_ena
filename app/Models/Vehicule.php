<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'immatriculation',
        'carte_grise',
        'num_chassis',
        'date_mise_en_circulation',
        'type_acquisition',
        'date_acquisition',
        'kilometrage',
        'fournisseur_id',
        'dispo',
        'modele_id',
        'marque_vehicule_id',
    ];

    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class);
    }

    public function modele(){
        return $this->belongsTo(Modele::class);
    }

    public function marque_vehicule(){
        return $this->belongsTo(MarqueVehicule::class);
    }

    public function pannes(){
        return $this->hasMany(Panne::class);
    }

    public function entretiens(){
        return $this->hasMany(Entretien::class);
    }
}
