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
        'bureau_id',
        'stock_id',
        'agent_id',
    ];

    public function articles(){
        return $this->belongsToMany(Article::class)->withPivot('quantite','prix_unitaire')->withTimestamps();
    } 

    public function bureau(){
        return $this->belongsTo(Bureau::class);
    }

    public function stock(){
        return $this->belongsTo(Stock::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
