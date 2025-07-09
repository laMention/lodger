<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','sujet','description', 'etat', 'status', 'appartement_id','user_id','agence_id','read_at','deleted','locataire_id',
    ];
    
    protected $dates = ['read_at'];

    public function appartement()
    {
        return $this->belongsTo(Appartement::class);
    }

    public function reparation()
    {
        return $this->hasOne(Reparation::class);
    }
    public function locataire()
    {
        return $this->belongsTo(User::class);
    }
}
