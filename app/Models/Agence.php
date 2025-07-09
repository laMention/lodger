<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','name','email','contact','contact_fixe','agrement','email_verified_at','registre_commerce','code_verification','adresse','photo','localisation','remember_token','ville_id','pays_id','etat','gerant'
    ];

    public function facturesLocataire()
    {
        return $this->hasMany(Facture::class);
    }
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
    public function employes()
    {
        return $this->hasMany(User::class,'agence_id')->where(['type_user'=>2]);
    }
    public function locataires()
    {
        return $this->hasMany(User::class)->where(['type_user'=>1]);
    }
    public function proprietaires()
    {
        return $this->hasMany(User::class)->where(['type_user'=>0]);
    }
    public function pays()
    {
        return $this->belongsTo(Country::class,'pays_id');
    }
    public function abonnement()
    {
        return $this->hasOne(Abonnement::class);
    }

    public function forfait()
    {
        return $this->morphToMany(OffreAbonnement::class, 'abonnements');
    }

    public function compte()
    {
        return $this->hasOne(Compte::class);
    }

}
