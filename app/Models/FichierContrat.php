<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichierContrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'locataire_id','agence_id','location_id','contrat','deleted','archived'
    ];

    public function locataire()
    {
        return $this->belongsTo(User::class);
    }
}
