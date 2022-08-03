<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'panne_id',
        'date',
        'montant',
        'observation',
        'statut',
        'agent_reparation',
        'agent_id',
    ];

    public function panne(){
        return $this->belongsTo(Panne::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
