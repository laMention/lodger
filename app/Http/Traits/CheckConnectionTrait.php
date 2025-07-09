<?php
  namespace App\Http\Traits;

    

  use App\Models\User;
  use Illuminate\Support\Facades\Request;
  use Illuminate\Support\Facades\Validator;
  use DB;


  /**
   * 
   */
  trait CheckConnectionTrait
  {
    
      public function checkconnection()
      {
          $connected = @fsockopen(env('APP_URL'), 80); 
          if ($connected){
              $is_conn = true;
          }else{
              $is_conn = false; //action in connection failure
          }
          return $is_conn;
      }

  }