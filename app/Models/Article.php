<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'designation',
        'divisible',
        'unite',
        'alerte',
        'type_id',
        'marque_id',
        'supprime',
        'prix_jour',
        'prix_dal',
    ];

    public function commandes(){
        return $this->belongsToMany(Commande::class)->withPivot('quantite', 'prix_unitaire','quantite_livree','reste')->withTimestamps();
    }

    public function livraisons(){
        return $this->belongsToMany(Livraison::class)->withPivot('quantite_livree','prix_unitaire','reste','pu_origine')->withTimestamps();
    }

    public function marque(){
        return $this->belongsTo(Marque::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function stocks(){
        return $this->belongsToMany(Stock::class)->withPivot('quantite_article','mouvement')->withTimestamps();
    }

    public function stock_jours(){
        return $this->belongsToMany(Stock_jour::class)->withPivot('quantite_article')->withTimestamps();
    }

    public function demandes(){
        return $this->belongsToMany(Demande::class)->withPivot('quantite','quantite_sortie','reste')->withTimestamps();
    }

    public function inventaires(){
        return $this->belongsToMany(Inventaire::class)->withPivot('quantite','nature_stock')->withTimestamps();
    }

    public function sorties(){
        return $this->belongsToMany(Sortie::class)->withPivot('quantite_sortie','reste')->withTimestamps();
    }

    public function retours(){
        return $this->belongsToMany(Retour::class)->withPivot('quantite','prix_unitaire')->withTimestamps();
    }

    public function patrimoines(){
        return $this->hasMany(Patrimoine::class);
    }
}
