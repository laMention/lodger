<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreAbonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','libelle','montant','periode','etat','duree','devise',
    ];

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }

    public function historiqueAbonnement()
    {
        return $this->hasMany(CommandeAbonnement::class);
    }
}
