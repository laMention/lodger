<?php 
 	namespace App\Repository;


	use App\Http\Controllers\Controller;
	use App\Models\User;
	use App\Models\Abonnement;
	use App\Models\CommandeAbonnement;
	use Illuminate\Http\Request;
	use App\Http\Traits\FileTrait;
	use App\Http\Traits\Generator;
	use App\Http\Traits\CheckConnectionTrait;
	use Carbon\Carbon;
	use Auth;

	/**
	 * 
	 */
	class AbonnementRepository
	{
		use FileTrait,CheckConnectionTrait,Generator;

		private $abonnement;
		private $order;
		
		
		function __construct(Abonnement $abonnement,CommandeAbonnement $order)
		{
			$this->abonnement = $abonnement;			
			$this->order = $order;			
		}

		public function createAbonnement($agence_id,$offre_abonnement_id,$date_abonnement,$date_expiration)
		{
			
			return $this->abonnement->newQuery()->create([
              'reference' => 'AB_'.$this->reference(),
              'agence_id' => $agence_id,
              'offre_abonnement_id' => $offre_abonnement_id,
              'date_abonnement' =>$date_abonnement,
              'date_expiration' =>$date_expiration,
              'user_id' => auth()->user()->id
            ]);
		}


		public function getAbonnement()
    	{
	        return Abonnement::with('offre')->where(['agence_id' => auth()->user()->agence->id,'etat'=>1,'status'=>1])->first();
	    }

	    public function oldSubscriptions()
	    {
	    	return Abonnement::with('offre')->where(['etat' => 0, 'status' => 0])->get();
	    }

	    public function getOrders()
    	{
	        return CommandeAbonnement::with('offre')->where(['agence_id' => auth()->user()->agence->id,'deleted'=>0])->get();
	        // return Abonnement::with('offre')->where(['agence_id' => auth()->user()->agence->id,'deleted'=>0])->get();

	    }


	    public function invoiceIssue($abonnement_id,$agence_id,$remember_token,$status)
	    {
	    	return $this->order->newQuery()->create([
	    		'reference' => 'FR_'.$this->reference(),
	    		'abonnement_id' => $abonnement_id,
	    		'agence_id' => $agence_id,
	    		'remember_token' => $remember_token,
	    		'status' => $status
	    	]);
	    }

	    public function updateStatusOrder($abonnement_id,$status)
	    {
	    	return $this->order->whereAbonnement_id($abonnement_id)->update([
	    		'status' => $status
	    	]);
	    }
	}
?>