<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable =[
        'code',
        'designation',
    ];

    public function bureaus(){
        return $this->hasMany(Bureau::class);
    }
}
