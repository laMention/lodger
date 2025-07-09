<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','libelle_equipement','etat','deleted',
    ];

    public function appartements()
    {
        return $this->belongsToMany(Appartement::class);
    }

    public function equipementsbiens()
    {
        return $this->hasMany(AppartementEquipement::class);
    }
}
