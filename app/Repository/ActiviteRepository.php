<?php 
 	namespace App\Repository;


	use App\Http\Controllers\Controller;
	use App\Models\User;
	use App\Models\Activite;
	use Illuminate\Http\Request;
	use App\Http\Traits\FileTrait;
	use App\Http\Traits\Generator;
	use App\Http\Traits\CheckConnectionTrait;
	use Carbon\Carbon;
	use Auth;

	/**
	 * 
	 */
	class ActiviteRepository
	{
		use FileTrait,CheckConnectionTrait,Generator;

		private $activite;
		
		
		function __construct(Activite $activite)
		{
			$this->activite = $activite;			
		}

		public function createActivity($titre,$description,$etat)
		{
			
			return $this->activite->newQuery()->create([
              'reference' => 'AC_'.$this->reference(),
              'titre' => $titre,
              'description' => $description,
              'etat' =>$etat,
            ]);
		}
	}
?>