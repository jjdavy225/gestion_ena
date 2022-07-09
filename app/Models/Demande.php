<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'date',
        'objet',
        'fiche',
        'delai',
        'date_saisie',
        'date_annul',
        'date_val',
        'agent_id',
        'agt_matr_est_faite',
        'bureau_id',
        'code_secteur',
        'statut',
        'date_auto',
        'num_auto',
        'siga_code',
    ];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class)->withPivot('quantite','quantite_sortie','reste')->withTimestamps();
    }

    public function sorties(){
        return $this->hasMany(Sortie::class);
    }

    public function bureau(){
        return $this->belongsTo(Bureau::class);
    }
}
