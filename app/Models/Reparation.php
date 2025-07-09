<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','description', 'etat', 'incident_id','user_id','agence_id','read_at','deleted','locataire_id',
    ];

    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }

    public function locataire()
    {
        return $this->belongsTo(User::class);
    }
}
