<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','agence_id','offre_abonnement_id','etat','status','user_id','date_expiration','deleted','date_abonnement','date_changement_abonnement',
    ];

    protected $dates = [ 'date_abonnement','date_changement_abonnement', 'date_expiration'];
    
    public static function paiementMode()
    {
        return [
            'orange'=>[
                'name'=>'ORANGE',
                'image'=>'storage/OrangeMoney.jpg'
            ],
            'mtn'=>[
                'name'=>'MTN',
                'image'=>'storage/mtn.png'
            ],
            'moov'=>[
                'name'=>'MOOV',
                'image'=>'storage/moov-money.png'
            ],

        ];
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
    public function offre()
    {
        return $this->belongsTo(OffreAbonnement::class,'offre_abonnement_id');
    }
}
