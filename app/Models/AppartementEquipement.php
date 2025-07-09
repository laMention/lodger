<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppartementEquipement extends Model
{
    use HasFactory;

    protected $table = 'appartement_equipement';

    protected $fillable = [
        'appartement_id','equipement_id','etat',
    ];

    public function appartement()
   {
       return $this->belongsTo(Appartement::class);
   }
    
   public function equipement()
   {
       return $this->belongsTo(Equipement::class);
   }
}
