<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resiliation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','location_id', 'user_id','motif','agence_id','etat',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
