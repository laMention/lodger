<?php
     namespace App\Http\Traits;

     // use Intervention\Image\ImageManagerStatic as Image;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use DB;


/**
 * 
 */
trait FileTrait
{
	
    public function uploadImage($model,$field_request,$directory,$index,$champ)
    {
        
       $file = $field_request;
       $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();

       if (!is_dir(public_path('storage') . $directory)) {
           mkdir(public_path('storage') . $directory, 0777, true);
           
           $file->move(public_path('storage') . $directory, $imageName);
       }else{

        $file->move(public_path('storage') . $directory, $imageName);
       }


       DB::table($model)->where(['id' => $index])->update([
           $champ => $imageName
       ]);
       
           
    }

}