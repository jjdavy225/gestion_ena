<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_jour extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'nature',
        'jour',
        'quantite_initiale',
        'montant_initial',
        'quantite_entree',
        'montant_entree',
        'quantite_stock',
        'montant_stock',
        'quantite_sortie',
        'montant_sortie',
        'quantite_finale',
        'montant_final',
        'montant_diff',
        'exercice_code',
        'agent_id',
        'date',
        'reference',
    ];

    public function articles(){
        return $this->belongsToMany(Article::class)->withPivot('quantite_article')->withTimestamps();
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
