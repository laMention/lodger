<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','user_id','agence_id','type_operation','designation','description','date_operation','montant','remarque','etat',
    ];

    protected $attributes = ['type_operation' => 0];

    public function getOperation($attribute)
    {
        return $this->type_operation()[$attribute];
    }

    public function type_operation(){
        return [
            1 => 'Entrée',
            2 => 'Sortie',
        ];
    }
}
