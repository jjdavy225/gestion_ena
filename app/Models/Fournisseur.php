<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'sigle',
        'siege',
        'adresse',
        'tel',
        'fax',
        'email',
        'site_web',
        'r_com',
        'ccont',
        'banque',
        'compte',
        'contact',
        'activite',
        'capital',
        'regime_impot',
        'centre_impot',
    ];

    public function commandes(){
        return $this->hasMany(Commande::class);
    }

    public function vehicules(){
        return $this->hasMany(Voiture::class);
    }
}
