<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_entretien',
        'date',
        'montant',
        'observation',
        'vehicule_id',
        'agent_id',
    ];

    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
