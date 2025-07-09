<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comodite extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference','libelle_comodite','etat','deleted',
    ];

    

    public function appartements()
    {
        return $this->belongsToMany(Appartement::class);
    }

    public function comoditebiens()
    {
        return $this->hasMany(AppartementComodite::class);
    }

   
}
