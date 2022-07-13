<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'date',
        'bureau_initial_id',
        'bureau_final_id',
        'type',
        'date_saisie',
        'observation',
        'agent_mouvement',
        'statut',
        'agent_id',
    ];

    public function bureau_initial(){
        return $this->belongsTo(Bureau::class);
    }

    public function bureau_final(){
        return $this->belongsTo(Bureau::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class)->withPivot('quantite')->withTimestamps();
    }
}
