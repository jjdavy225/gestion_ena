<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'fonction',
        'adresse',
        'tel',
        'poste',
        'login',
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function roles(){
        return $this->hasMany(Role::class);
    }

    public function commandes(){
        return $this->hasMany(Commande::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function livraisons(){
        return $this->hasMany(Livraison::class);
    }

    public function stock_jours(){
        return $this->hasMany(Stock_jour::class);
    }

    public function demandes(){
        return $this->hasMany(Demande::class);
    }

    public function sorties(){
        return $this->hasMany(Sortie::class);
    }

    public function retours(){
        return $this->hasMany(Retour::class);
    }

    public function mouvements(){
        return $this->hasMany(Mouvement::class);
    }

    public function pannes(){
        return $this->hasMany(Panne::class);
    }

    public function reparations(){
        return $this->hasMany(Reparation::class);
    }

    public function entretiens(){
        return $this->hasMany(Entretien::class);
    }

    public function conducteur_info(){
        return $this->hasOne(Conducteur::class,'agent_conducteur_id');
    }

    public function conducteurs(){
        return $this->hasMany(Conducteur::class);
    }

    public function affectations(){
        return $this->hasMany(Affectation::class);
    }

    public function demande_vehicules(){
        return $this->hasMany(DemandeVehicule::class);
    }
}
