<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable =[
        'code',
        'date',
        'remise',
        'tva',
        'montant',
        'delai',
        'date_saisie',
        'commande_id',
        'agent_id',
        'stock_id',
        'statut',
        'num_bon',
        'date_bon',
        'fact_num',
        'fact_date',
    ];

    public function commande(){
        return $this->belongsTo(Commande::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class)->withPivot('quantite_livree','prix_unitaire','reste','pu_origine')->withTimestamps();
    }

    public function stock(){
        return $this->belongsTo(Stock::class);
    }
}
