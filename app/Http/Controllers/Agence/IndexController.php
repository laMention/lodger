<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Compte;
use App\Models\User;
use App\Models\Abonnement;
use App\Models\Appartement;
use App\Models\PaiementLoyer;
use App\Models\Location;
use App\Repository\AbonnementRepository;
use Carbon\Carbon;
use Session;
use DB;


class IndexController extends Controller
{
    protected $suscribe;

    public function __construct(AbonnementRepository $forfait)
    {
        $this->forfait = $forfait;
    }
    
    public function index()
    {
        $ctr = $this->contratThisYear()->whereYear('locations.created_at', Carbon::now()->year)->sum('montant_loyer');
        $tp = $this->totalPaiement()->sum('montant');
        $em = $this->entreeDuMois();
        $nbc=$this->locations()->count();
        $nba=$this->appartements()->count();
        $listep = $this->totalPaiement()->orderby('id','desc')->limit(6)->get();
        $listel = $this->locations()->orderby('id','desc')->limit(6)->get();
        $p=$this->proprietaires()->count();
        $listp=$this->proprietaires()->limit(6)->get();

        $type_abonnement = "";
        $error_ab = "";
        
        $compte = Compte::where(['agence_id' => auth()->user()->agence->id])->first();
        // echo $abonnement = Abonnement::where(['agence_id' => auth()->user()->agence->id])->first();die;
       $abonnement = $this->forfait->getAbonnement();

       $lgts = $this->appartements()->limit(6)->get();


       if (!empty($abonnement) && isset($abonnement)) {
           if ($abonnement->offre->duree == "JOURS") {
            $type_abonnement = "Periode d'essai";
            }
            if ($abonnement->offre->duree == "MOIS") {
                $type_abonnement = "Abonnement mensuel";
            }
            if ($abonnement->offre->duree == "ANNEE") {
                $type_abonnement = "Abonnement annuel";
            }
       }else{
            $error_ab = "<span class='alert alert-danger' data-dismiss='alert'> Abonnement introuvable</span>";
       }
        

        $cat = new Appartement;

        return view('backend.dashboard',compact('compte','abonnement','type_abonnement','error_ab','ctr','tp','em','nbc','nba','listep','listel','cat','p','listp'));
    }

    protected function entreeDuMois()
    {
        return PaiementLoyer::where(['etat'=>1,'deleted'=>0,'agence_id'=>auth()->user()->agence->id])->whereMonth('created_at', Carbon::now()->month)->sum('montant');
    }


    protected function nbLgtOccupe()
    {
        return Appartement::where(['statut'=>1,'etat'=>1,'deleted'=>0,'agence_id'=>auth()->user()->agence->id])->count();
    }


    protected function contratThisYear()
    {
       
        return DB::table('locations')
            ->join('appartements','locations.appartement_id','=','appartements.id')            
            ->where(['locations.agence_id'=>auth()->user()->agence->id,'appartements.deleted'=>0,'appartements.etat'=>1,'locations.etat'=>1,'locations.deleted'=>0]);
    }

    protected function revenuAnnuel()
    {
        
    }

    protected function tauxDeCroissance()
    {
        
    }

    protected function derniereCmd()
    {
        
    }

    protected function locations()
    {
        return Location::with('appartement')->where(['archived' => 0, 'deleted'=> 0, 'etat'=> 1,'agence_id'=>auth()->user()->agence->id]);
    }

    
    protected function appartements()
    {
        return Appartement::where(['etat'=>1,'deleted'=>0,'agence_id'=>auth()->user()->agence->id]);
    }

    protected function proprietaires()
    {
        return User::where(['type_user'=>0,'deleted'=>0,'agence_id'=>auth()->user()->agence->id]);
    }
    protected function locataires()
    {
        return User::where(['type_user'=>1,'deleted'=>0,'agence_id'=>auth()->user()->agence->id]);
    }
    protected function totalPaiement()
    {
        return PaiementLoyer::where(['deleted'=>0,'agence_id'=>auth()->user()->agence->id]);
    }
}
