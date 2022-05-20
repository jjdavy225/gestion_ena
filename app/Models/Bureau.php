<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bureau extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'designation',
        'site_id',
    ];

    public function site(){
        return $this->belongsTo(Site::class);
    }

    public function sorties(){
        return $this->hasMany(Sortie::class);
    }

    public function demandes(){
        return $this->hasMany(Demande::class);
    }

    public function patrimoines(){
        return $this->hasMany(Patrimoine::class);
    }
}
