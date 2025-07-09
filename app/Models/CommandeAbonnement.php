<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeAbonnement extends Model
{
    use HasFactory;

    protected $fillable = ['reference','offre_abonnement_id','agence_id','remember_token','status','deleted','date_abonnement'];

    public function offre()
    {
        return $this->belongsTo(OffreAbonnement::class,'offre_abonnement_id');
    }
}
 