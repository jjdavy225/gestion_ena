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
}
