<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public const ADMIN = 1;
    public const RESPONSABLE = 2;
    public const AGENT = 3;

}
