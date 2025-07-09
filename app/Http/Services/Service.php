<?php 
	namespace App\Http\Services;

	use App\Models\Session;
	use Carbon\Carbon;



/**
 * 
 */
class Service 
{
	
	public static function getIpAdress(){
		//whether ip is from the share internet  
	    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
	        $ip = $_SERVER['HTTP_CLIENT_IP'];  
	    }  
	    //whether ip is from the proxy  
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
	    }  
		//whether ip is from the remote address  
	    else{  
	        $ip = $_SERVER['REMOTE_ADDR'];  
	    }  
     	return $ip; 
	}

	public static function getUserAgent()
	{
		return $_SERVER['HTTP_USER_AGENT'];
	}

	public static function createSession($user_token,$user_id)
    {
        return Session::create([
            'id' => $user_token,
            'user_id' => $user_id,
            'ip_address' => request()->ip(),
            'user_agent' => Service::getUserAgent(),
            'payload' => NULL,
            'last_activity' => Carbon::now(), 
        ]);
    }

    public static function nextDate($nb_jours)
    {
    	return date('Y-m-d H:i:s',strtotime(Carbon::now().'+'.$nb_jours.' days'));
    }

    public static function getUserSession($session_id)
    {
    	return Session::where(['id' => $session_id])->first();
    }

    


}

