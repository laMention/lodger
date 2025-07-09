<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre','date_transaction','montant','devise','moyen_paiement','etat','deleted','agence_id'
    ];

    protected $dates = ['date_transaction'];
}
