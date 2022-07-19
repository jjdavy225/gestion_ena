<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'date_debut',
        'date_fin_prevue',
        'date_fin_reelle',
        'conducteur_principal_id',
        'conducteur_secondaire_id',
        'direction',
        'service',
        'agent_id',
    ];

    public function conducteur_principal(){
        return $this->belongsTo(Conducteur::class);
    }

    public function conducteur_secondaire(){
        return $this->belongsTo(Conducteur::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
