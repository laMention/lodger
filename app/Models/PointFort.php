<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointFort extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','libelle_point_fort','etat','deleted',
    ];

    public function appartements()
    {
        return $this->belongsToMany(Appartement::class);
    }

    public function pointsfortsbiens()
    {
        return $this->hasMany(AppartementPointFort::class);
    }
}
