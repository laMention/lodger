<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppartementPointFort extends Model
{
    use HasFactory;

    protected $table = 'appartement_point_fort';

     protected $fillable = [
        'appartement_id','point_fort_id','etat'
    ];

   public function appartement()
   {
       return $this->belongsTo(Appartement::class);
   }
    
   public function pointsforts()
   {
       return $this->belongsTo(PointFort::class);
   }
    
   
}
