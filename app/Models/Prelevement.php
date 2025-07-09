<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prelevement extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference','sujet', 'user_id','message','agence_id','etat',
    ];
}

  $table->string('reference');
            $table->integer('agence_id')->default(0);
            $table->integer('montant')->nullable();
            $table->string('devise')->nullable();
            $table->integer('moyen_paiement_id')->nullable();
            $table->integer('abonnement_id')->nullable();
            $table->string('passerelle')->nullable();
            $table->string('status')->nullable();
            $table->string('status_transaction')->nullable();
            $table->date('date_prelevement')->nullable();
            $table->text('description')->nullable();
            $table->tinyinteger('etat')->default(true);
