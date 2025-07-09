<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppartementComodite extends Model
{
    use HasFactory;
    protected $table = 'appartement_comodite';

    protected $fillable = [
        'appartement_id','comodite_id','etat',
    ];

    public function appartement()
   {
       return $this->belongsTo(Appartement::class);
   }
    
   public function comodite()
   {
       return $this->belongsTo(Comodite::class);
   }
}
