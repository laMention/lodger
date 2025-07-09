<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementLoyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','facture_id','locataire_id','location_id','appartement_id','montant','etat','status','description', 'passerelle', 'date_paiement','status_transaction','agence_id','devise','mode_paiement','ref_paiement','deleted','user_id',
    ];


    public function facture(){
        return $this->belongsTo(Facture::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
    public function locataire()
    {
        return $this->belongsTo(Locataire::class);

    }

}
