<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'num',
        'date',
        'objet',
        'num_fact',
        'date_fact',
        'remise',
        'tva',
        'montant',
        'delai_paie',
        'delai_liv',
        'date_liv',
        'statut_liv',
        'fournisseur_id',
        'agent_id',
        'date_saisie',
        'date_annul',
        'frais',
        'garantie',
    ];

    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class)->withPivot('quantite','prix_unitaire','quantite_livree','reste')->withTimestamps();
    }

    public function livraisons(){
        return $this->hasMany(Livraison::class);
    }
}
