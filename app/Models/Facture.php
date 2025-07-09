<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','periode','user_id','location_id','fichier','etat','status','agence_id','locataire_id','date_echeance','next_date_echeance','reste'
    ];
    protected $attributes = ['status' => 0];

    public function getStatus($attribute)
    {
        return $this->status()[$attribute];
    }

    public function status(){
        return [
            0 => 'En attente',
            1 => 'Non soldé',
            2 => 'Soldé',
            3 => 'Annulé',
            // 4 => 'Arriéré',
        ];
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
    public function paiement_loyers(){
        return $this->hasMany(PaiementLoyer::class)->where(['deleted'=>0,"etat"=>1,'agence_id'=>auth()->user()->agence->id]);
    }
    public function locataire(){
        return $this->belongsTo(User::class,'locataire_id');
    }
     public function agence(){
        return $this->belongsTo(Agence::class);
    }
}
