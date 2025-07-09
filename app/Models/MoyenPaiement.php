<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoyenPaiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference', 'user_id','type_user','description', 'compte', 'type_paiement', 'date_expiration', 'defaut', 'cvc', 'etat', 'status','paiement_auto','agence_id','mois_expiration_carte',
    ];

    protected $attributes = ['type_paiement' => 0];
    // protected $dates = ['date_expiration'];

    public function getType_paiement($attribute)
    {
        return $this->type_paiement()[$attribute];
    }
    public function type_paiement(){
        return [
            0 => 'Espèce',
            1 => 'Chèque',
            2 => 'Carte bancaire',
            3 => 'Orange',
            4 => 'Moov',
            5 => 'MTN',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
