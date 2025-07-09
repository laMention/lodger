<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppartementCaution extends Model
{
    use HasFactory;

     protected $fillable = [
        'caution_id','appartement_id',
    ];
}
