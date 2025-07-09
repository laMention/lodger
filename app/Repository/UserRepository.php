<?php 
 	namespace App\Repository;


	use App\Http\Controllers\Controller;
	use App\Models\User;
	use Illuminate\Http\Request;
	use App\Http\Traits\FileTrait;
	use App\Http\Traits\Generator;
	use App\Http\Traits\CheckConnectionTrait;
	use Carbon\Carbon;
	use Auth;

	/**
	 * 
	 */
	class UserRepository
	{
		use FileTrait,CheckConnectionTrait,Generator;

		private $user;
		
		
		function __construct(User $user)
		{
			$this->user = $user;			
		}

		public function create($name,$lastname,$email,$contact,$contact_fixe,$pays_id,$ville,$adresse,$type_user,$role,$agence)
		{
			
			return $this->user->newQuery()->create([
              'reference' => $this->reference(),
              'name' => $name,
              'lastname' => $lastname,
              'email' =>$email,
              'contact' =>$contact,
              'contact_fixe' =>$contact_fixe,
              'country_id' =>$pays_id,
              'ville' =>$ville,
              'adresse' =>$adresse,
              'type_user' => $type_user,
              'role' => $role,
              'agence_id' => $agence
            ]);
		}
	}
?>