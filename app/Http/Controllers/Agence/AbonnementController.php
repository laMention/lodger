<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Abonnement;
use App\Models\OffreAbonnement;
use App\Http\Services\Service;
use App\Repository\AbonnementRepository;
use Carbon\Carbon;
use App\Http\Traits\TransactionTrait;
use App\Http\Traits\Generator;
use App\Models\CommandeAbonnement;
use App\Models\PaiementAbonnement;
use App\Repository\ActiviteRepository;

class AbonnementController extends Controller
{
     use Generator,TransactionTrait;

    protected $forfait;
    protected $activite;

    public function __construct(AbonnementRepository $forfait,ActiviteRepository $activiteRepository)
    {
        $this->forfait = $forfait;
         $this->activite = $activiteRepository;
    }

    public function index()
    {
        $abonnement = $this->forfait->getAbonnement();
        $type_abonnement = '';
        // $has_suscribe = 0;

        if ($abonnement->offre->duree == "JOURS") {
            $type_abonnement = "Periode d'essai";
        }
        if ($abonnement->offre->duree == "MENSUEL") {
            $type_abonnement = "Abonnement mensuel";
        }
        if ($abonnement->offre->duree == "ANNEE") {
            $type_abonnement = "Abonnement annuel";
        }

        $forfaits = OffreAbonnement::where(['etat'=>1,'deleted'=>0])->orderby('id','asc')->get();
        
        return view('backend.changer_abonnement',compact('abonnement','forfaits','type_abonnement'));
    }

    public function changerForfait(Request $request)
    {
        // return $request->all();

        if (!empty($request->agence_id) && !empty($request->offre_abonnement_id) && !empty($request->abonnement_id)) {
            // where(['id' => $request->abonnement_id])
            $info_ab = Abonnement::where(['id' => $request->abonnement_id,'etat'=>1,'status'=>1,'deleted'=>0])->first();

            $abonnement = $this->forfait->createAbonnement($request->agence_id,$request->offre_abonnement_id,Carbon::now(),NULL);

            // $abonnement = Abonnement::create([
            //     'offre_abonnement_id' => $request->offre_abonnement_id,
            //     'date_changement_abonnement' => Carbon::now(),
            // ]);

            if ($abonnement) {
                $info_ab->update(['etat'=>0,'status'=>0,'date_changement_abonnement' => Carbon::now()]);

                $abonnement_updte = Abonnement::where(['id' => $abonnement->id])->first();


                $date_expiration = Service::nextDate($abonnement_updte->offre->nb_jours);

                $abonnement_updte->update([
                    'date_expiration' => $date_expiration,
                    'status'=> 1,
                    'etat'=> 1
                ]);

                // Creation de la facture d'abonnement
                $this->forfait->invoiceIssue($abonnement->id,$request->agence_id,auth()->user()->remember_token,0);

                return response()->json([
                    'status' => 200,
                    'title' => "Changement effectué",
                    'message' => "Votre forfait a été modifié avec succès",
                ]);
            }else{
                return response()->json([
                    'status' => 401,
                    'title' => "Changement échoué",
                    'message' => "L'operation a échoué veuillez réessayer",
                ]);
            }
        }else{
             return response()->json([
                    'status' => 401,
                    'title' => "Impossible d'envoyer la requête",
                    'message' => "Une donnée nécessaire à l'envoi de requête est manquante, veuillez contacter notre support",
                ]);
        }
    }

    public function abonnement()
    {
        $is_active = 0;

        $abonnement = $this->forfait->getAbonnement();

        $old_souscriptions = $this->forfait->oldSubscriptions();

        $date = Carbon::now();

        $date_explode = explode(" ",$date);

        $abon_date_exp = explode(" ",$abonnement->date_expiration);

        if (!empty($abonnement->date_expiration)) {
            if ($date_explode[0] < $abon_date_exp[0] ) {
                $is_active = 1;
            }
            if ($date_explode[0] == $abon_date_exp[0] && $date_explode[1] < $abon_date_exp[1]) {
                $is_active = 0.5;
            }
            if ($date_explode[0] == $abon_date_exp[0] && $date_explode[1] > $abon_date_exp[1]) {
                $is_active = 0;
            }
            if($date_explode[0] > $abon_date_exp[0]){
                $is_active = 0;
            }
        }
        
        return view('backend.abonnement',compact('abonnement','is_active','old_souscriptions'));
    }


    public function facturation()
    {
        $commandes = $this->forfait->getOrders();
        // echo "<pre>";print_r($);die;
        // echo "facture abonnements";die;
        return view('backend.facturation',compact('commandes'));
    }

    public function historique()
    {
        // $commandes = $this->forfait->getOrders();
        // echo "<pre>";print_r($commandes);die;
        $abonnements = Abonnement::with('offre')->orderby('id','desc')->get();

        return view('backend.historique',compact('abonnements'));
    }



    public function paymentpage()
    {
        // echo "page paiement renouvellement abonnement";die;
        // $user = auth()->user();
        $abonnement = Abonnement::with('offre')->whereAgence_id(auth()->user()->agence->id)->first();

        return view('backend.paiement-renouvellement',compact('abonnement'));

    }

    public function renouveller(Request $request)
    {
        $date_valide = date("y");
        $mois_valide = date("m");
        $carte_date_expiration = NULL;
        $date_exp = NULL;
        $date_expi = NULL;
        $date_expi_mois = NULL;

        if ($request->optionPaiementMode == 'carte bancaire') {
            if ($request->carte_date_expiration !== "mm/aa" && $request->carte_date_expiration <> "mm/aa") {
                $numb_ann = 20;


                $carte_date_expiration =$request->carte_date_expiration;
                $date_exp = explode("/", $carte_date_expiration);

                $date_expi = $numb_ann.''.$date_exp[1];
                $date_expi_mois = $date_exp[0];


                if ($mois_valide > $date_exp[0] && $date_valide > $date_exp[1]) {
                    return response()->json([
                            'status' => 401,
                            'title' => "Carte expirée",
                            'message' => "Votre carte a expirée"
                        ]);
                }elseif ($mois_valide <= $date_exp[0] && $date_valide > $date_exp[1]) {
                    return response()->json([
                            'status' => 401,
                            'title' => "Carte expirée",
                            'message' => "Votre carte a expirée"
                        ]);
                }
            }
        } 

        $ab = Abonnement::where([
            'id' => $request->abonnement_id,
            'agence_id'  =>  auth()->user()->agence->id,
            'offre_abonnement_id' => $request->offre_abonnement_id,
            ])->first();

        $offre_abonnement = OffreAbonnement::whereId($request->offre_abonnement_id)->first();

        // echo auth()->user()->agence->id;die;
        $paiement = PaiementAbonnement::create([
            'user_id' => auth()->user()->id,
            'agence_id' =>  auth()->user()->agence->id,
            'abonnement_id' => $request->abonnement_id,
            'montant_paiement' => $request->montant_paiement,
            'mode_paiement' => $request->optionPaiementMode,
            'source' => $request->operateur,
            'channel' => NULL,
            'currency' => $request->devise,
            'date_payment' => Carbon::now(),
            'country_code' => $request->country_code,
            'account' => $request->account,
            'entTransaction_id' => NULL,
            'extTransaction_id' => NULL,
            'annee_expiration_carte' => $date_expi,
            'mois_expiration_carte' => $date_expi_mois,
            'cvc' => $request->cvc,

        ]);

        if ($paiement) {
            // code...
            $paiement->update([
                'reference'=>'PA_'.$this->reference(),
                'statut' => 'success',
                'etat' => 1 ,
            ]);

            $date_expiration = Service::nextDate($offre_abonnement->nb_jours);

            Abonnement::where([
                'id' => $request->abonnement_id,
                'agence_id'  => auth()->user()->agence->id,
                'offre_abonnement_id' => $request->offre_abonnement_id,
            ])->update([
                // 'abonne' => 1
                'date_abonnement' => Carbon::now(),
                'date_expiration' => $date_expiration,
                'status' => 1
            ]);
            // Enregistrer dans l'historique des commandes
            CommandeAbonnement::create([
                'reference'  => 'FR_'.$this->reference(),
                // 'abonnement_id'  => $request->abonnement_id,
                'offre_abonnement_id'  => $request->offre_abonnement_id,
                'agence_id'  =>auth()->user()->agence->id,
                'date_abonnement' => $ab->date_abonnement,
                // 'remember_token'  =>,
                'status'  =>1,
                'deleted'  =>0
            ]);

            // enregistre la transaction
            $titre = "Renouvellement de l'abonnement effectué";
            $moyen_paiement = $request->optionPaiementMode ." ".$request->operateur;

            $this->saveTransaction($titre,Carbon::now(),$request->montant_paiement,$request->devise,$moyen_paiement,1,auth()->user()->agence->id);

            $titre = "Renouvellement d'abonnement";
            $description = "Renouvellement d'abonnement effectué par".auth()->user()->agence->name;
             $this->activite->createActivity($titre,$description,1);

            return response()->json([
                'status' => 200,
                'title' => 'Succès',
                'message' => "Renouvellement abonnement effectué"
            ]);
        }else{
            return response()->json([
                'status' => 401,
                'title' => 'Echec',
                'message' => "Paiement échoué, veuillez réessayer"
            ]);
        }
       

    }

    // protected function getAbonnement()
    // {
    //     return Abonnement::with('offre')->where(['agence_id' => auth()->user()->agence->id,'etat'=>1,'status'=>1])->first();
    // }
}
