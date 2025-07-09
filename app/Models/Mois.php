<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mois extends Model
{
    use HasFactory;



    public function Mois($mois)
    {
        
        switch ($mois) {
            case 'January':
                return 'Janvier';
                break;

            case 'February':
                return 'Février';
                break;
            
            case 'March':
                return 'Mars';
                break;

            case 'April':
                return 'Avril';
                break;

            case 'May':
                return 'Mai';
                break;

            case 'June':
                return 'Juin';
                break;

            case 'July':
                return 'Juillet';
                break;

            case 'August':
                return 'Aout';
                break;

            case 'September':
                return 'Septembre';
                break;

            case 'October':
                return 'Octobre';
                break;

            case 'November':
                return 'Novembre';
                break;

            case 'December':
                return 'Décembre';
                break;

            default:
                // code...
                break;
        }
    }
}
