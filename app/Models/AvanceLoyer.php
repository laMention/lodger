<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvanceLoyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','appartement_id','montant','devise','periode','etat','description','paid'
    ];
    protected $attributes = ['paid' => 0];

    public function getPaid($attribute)
    {
        return $this->paid()[$attribute];
    }
    public function paid(){
        return [
            0 => 'En attente',
            1 => 'Payé',
        ];
    }

    public function appartement()
    {
        return $this->belongsTo(Appartement::class);
    }
}
