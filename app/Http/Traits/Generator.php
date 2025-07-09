<?php
    namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;


/**
 * 
 */
trait Generator
{
	
    public function reference()
    {
        return random_int(1111111111, 9999999999); 
    }

    public function generateCodeEmailVerification()
    {
        return 'LO-'.random_int(11111,99999);
    }

    public function createToken()
    {
        return Str::random(40);
    }

    public function soldeAccount()
    {
        return date('Y').''.random_int(111111111111,999999999999).'000';
    }

}