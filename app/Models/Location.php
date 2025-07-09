<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','user_id','appartement_id','locataire_id','contrat_id','agence_id','etat','date_location','deleted','archived'

    ];
    protected $dates = ['created_at', 'updated_at','date_location'];

    public function appartement()
    {
        return $this->belongsTo(Appartement::class);
    }
    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function locataire()
    {
        return $this->belongsTo(User::class,'locataire_id');
    }
    public function factures(){
        return $this->hasMany(Facture::class)->where(['deleted'=>0,"etat"=>1,'agence_id'=>auth()->user()->agence->id]);
    }
    public function paiement_loyers(){
        return $this->hasMany(PaiementLoyer::class)->where(['deleted'=>0,"etat"=>1,'agence_id'=>auth()->user()->agence->id]);
    }

    public function resiliation()
    {
        return $this->hasOne(Resiliation::class);
    }
}
