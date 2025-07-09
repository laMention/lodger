<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference','locataire_id','appartement_id','contrat_id','agence_id','etat','date_location','date_resiliation','user_id','caution_id','avance_loyer_id','commission_agence_id','location_id',
    ];

    public function locataire()
    {
        return $this->belongsTo(User::class,'locataire_id');
    }

    public function appartement()
    {
        return $this->belongsTo(Appartement::class);
    }
}
