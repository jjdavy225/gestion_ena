<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retour extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'date',
        'observation',
        'date_saisie',
        'sortie_id',
        'agent_id',
    ];

    public function article(){
        return $this->belongsToMany(Article::class)->withPivot('quantite','prix_unitaire')->withTimestamps();
    } 

    public function sortie(){
        return $this->belongsTo(Sortie::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
