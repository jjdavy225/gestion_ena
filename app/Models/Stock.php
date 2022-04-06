<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'initial',
        'entree',
        'sortie',
        'retour',
        'stock',
        'exercice_code',
        'jour',
        'nature',
        'montant_initial',
        'entree_montant',
        'assemble_montant',
        'sortie_montant',
        'retour_montant',
        'stock_montant',
    ];

    public function articles(){
        return $this->belongsToMany(Article::class)->withPivot('quantite_article','mouvement')->withTimestamps();
    }

    public function livraisons(){
        return $this->hasMany(Livraison::class);
    }
}
