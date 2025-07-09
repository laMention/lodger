<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;
    protected $fillable = [
        'agence_id','solde','deleted','etat','num_compte',
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
