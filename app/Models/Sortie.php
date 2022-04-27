<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'date',
        'heure',
        'obs',
        'date_saisie',
        'demande_id',
        'code_sorn',
        'code_structure',
        'code_bureau',
        'code_secteur',
        'agent_id',
        'agent_matr_est_saisie',
        'supprime',
    ];

    public function demande(){
        return $this->belongsTo(Demande::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class)->withPivot('quantite_sortie','reste')->withTimestamps();
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
