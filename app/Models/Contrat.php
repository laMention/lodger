<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','description', 'etat', 'libelle','agence_id','deleted','archived','user_id'
    ];

    public function locations()
    {
        return $this->hasMany(Location::class,'contrat_id');
    }

    public function scopeContrats($query)
    {
        return $query->where(['agence_id' => auth()->user()->agence->id,'deleted' => 0,'archived' => 0]);
    }
}
