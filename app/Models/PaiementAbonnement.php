<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementAbonnement extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','agence_id','abonnement_id','reference','montant_paiement','statut','etat','mode_paiement','source','channel','currency','date_payment','country_code','account','entTransaction_id','extTransaction_id','annee_expiration_carte','mois_expiration_carte','cvc',
    ];
}
