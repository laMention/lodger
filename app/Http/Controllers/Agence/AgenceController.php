<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Repository\ActiviteRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Agence;
use App\Models\Activite;
use App\Models\Compte;
use App\Http\Requests\StoreAgenceRequest;
use App\Http\Requests\UpdateAgenceRequest;
use App\Models\Country;
use App\Models\User;
use App\Models\OffreAbonnement;
use App\Models\Abonnement;
use App\Models\PaiementAbonnement;
use App\Http\Traits\FileTrait;
use App\Http\Traits\TransactionTrait;
use App\Http\Services\Service;
use App\Http\Traits\Generator;
use App\Repository\AbonnementRepository;
use Carbon\Carbon;
use Hash;
use Auth;
use App\Models\CommandeAbonnement;

class AgenceController extends Controller
{
    use FileTrait,Generator,TransactionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $activite;
    protected $order;

    public function __construct(ActiviteRepository $activiteRepository, AbonnementRepository $orderRepository){
        $this->activite = $activiteRepository;
        $this->order = $orderRepository;
    }

    public function index()
    {
        //AbonnementRepository $forfait
    }

    public function showverifyEmailForm()
    {
        // echo $value = session('user');die;
        // echo $request_body = file_get_contents('php://input');die;
        // $forfaits = OffreAbonnement::where('etat',1)->orderby('id','asc')->get();
        return view('auth.verify');
    }
    /**
     * Update the verification code of the specified user using session
     * 
     * @return \Illuminate\Http\Response
    */
    public function resendCodeEmail(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;

        $session = $this->sessionUser();
        // $session = Service::getUserSession(session('user'));

        $user = $this->userInfoSession($session->user_id); 

        
        if ($user) {

            // $user = User::whereRemember_token($session)->first();
             $user->update([
                'code_verification'=>$this->generateCodeEmailVerification(),
            ]);

             $code = $this->userInfoSession($session->user_id);
             // $code = User::whereRemember_token($session)->first();
            if($code){
                $new_code = $code->code_verification;
            }

            $this->sendMail($user->email,'mail.code_verification',
                          [
                            'email'=>$request->email,
                            'code_verification'=>$new_code
                          ]);


            return response()->json([
                'status' => 200,
                'title' => "code: ".$new_code,
                'message' => "Verifiez votre adresse email ou copiez le code",
            ]);

        }else{
            return response()->json([
                'status' => 200,
                'title' => "Session expirée",
                'message' => "Votre session a expiré"
            ]);
        }
    }
    
    /**
     * Verify user's email and update the specified resource
     * 
     * @return \Illuminate\Http\Response
    */
    public function  verifyEmail(Request $request)
    {
        // echo $request->code;die;
        if (User::whereCode_verification($request->code)->exists()) {
            $user = User::whereCode_verification($request->code)->update([
                'email_verified_at' => Carbon::now(),
                'etat' => 1,
            ]);
            if ($user) {
                return response()->json([
                    // 'status' => 200,
                    'title' => "Vérification effectuée",
                    'message' => "Email vérifiée avec succès. vous pouvez continuer",
                ]);
            }
        }else{
            return response()->json([
                'status' => 401,
                'title' => "Vérification Impossible",
                'message' => "Le code n'existe pas. Veuillez entrer un code valide",
            ]);
        }
    }

    public function showForfaitForm()
    {
       
        // echo  session('user');die;

        $forfaits = OffreAbonnement::where('etat',1)->orderby('id','asc')->get();

        $session = $this->sessionUser();
        // $session = Service::getUserSession(session('user'));


        $user = $this->userInfoSession($session->user_id); //User::with('agence')->whereId($session->user_id)->first();

        return view('auth.forfait',compact('forfaits','session','user'));
    }
    


    public function proceedToPayment(Request $request)
    {
        // echo "string";die;
        // $date_now = date('Y-m-d H:i:s');
        $date_expiration = NULL;
        $session = $this->sessionUser();
       
        $abonne =  Abonnement::where(['agence_id'  => $request->agence_id])->count();
           
        $offre_abonnement = OffreAbonnement::whereId($request->offre_abonnement_id)->first();
        // echo $abonne;die;

        if ($abonne == 0 ) {
             // echo "existe pas";die;
           $suscribe = Abonnement::create([
                'agence_id'  => $request->agence_id,
                'offre_abonnement_id' => $request->offre_abonnement_id,
                'user_id' => $request->user_id,
            ]);
            if ($suscribe) {
                $suscribe->update([
                    'reference' => 'AB_'.$this->reference(),
                    'etat' => 1,
                    'status' => 0,
                    // 'date_expiration' => $date_expiration
                 ]);
                $titre = "Nouvel abonnement";
                $description = "Demande d'un nouvel abonnement de ".$offre_abonnement->net_apres_reduction.' '.$offre_abonnement->devise."  par l'agence ".$suscribe->agence->name;

                $this->order->invoiceIssue($suscribe->id,$request->agence_id,session('user'),0);

                $this->activite->createActivity($titre,$description,1);
            }else{
                 return response()->json([
                    'status' => 401,
                    'title' => "Impossible de continuer",
                    'message' => "Si le problème persiste, veuillez contacter notre support",
                ]);
            }


        }else{
            // echo "existe";die;
            $abonnement = Abonnement::where(['agence_id'  => $request->agence_id])->first();

            $suscribe = Abonnement::where(['agence_id'  => $request->agence_id])->update([
                // 'agence_id'  => $request->agence_id,
                'offre_abonnement_id' => $request->offre_abonnement_id,
                'user_id' => $request->user_id,
            ]);
            $this->order->invoiceIssue($abonnement->id,$request->agence_id,session('user'),0);

            $titre = "Modification d'un abonnement";
            $description = "Modification du forfait abonnement effectuee par l'agence ".$abonnement->agence->name." le ".date_format(new \DateTime($abonnement->created_at),'d-m-Y');

            $this->activite->createActivity($titre,$description,1);

           
        }


        // $session = Service::getUserSession(session('user'));

        $user = $this->userInfoSession($session->user_id); 

        // $user = User::with('agence')->whereRemember_token(session('user'))->first();
        // dd($user->agence_id);
        
        $abn = Abonnement::with('offre')->whereAgence_id($user->agence_id)->first();

        // return response()->json(['status' => 201]);
        return redirect()->route('payment_mode');

       
        
    }

    /**
     * Show payment form to finish order
     * 
     * @return \Illuminate\Http\Response
    */
    public function showPaymentForm()
    {
        $session = $this->sessionUser();
        $user = $this->userInfoSession($session->user_id);
        // $user = User::with('agence')->whereRemember_token(session('user'))->first();
        // dd($user->agence_id);
        
        $abn = Abonnement::with('offre')->whereAgence_id($user->agence_id)->first();
        // dd($abn);die;

        $breadcrumbs = '<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Abonnement /</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Mode de paiement</font></font>';
        
        return view('auth.payment',compact('breadcrumbs','abn','user'));
    }


    public function checkout(Request $request)
    {
        $session = $this->sessionUser();

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

        $user = $this->userInfoSession($session->user_id);

        $ab = Abonnement::where([
            'id' => $request->abonnement_id,
            'agence_id'  => $request->agence_id,
            'offre_abonnement_id' => $request->offre_abonnement_id,
            'user_id' => $request->user_id,
            ])->first();

        $offre_abonnement = OffreAbonnement::whereId($request->offre_abonnement_id)->first();

        // $paiement = Abonnement::whereAgence_id($)
        // return $request->all();

        $paiement = PaiementAbonnement::create([
            'user_id' => $request->user_id,
            'agence_id' => $request->agence_id,
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
            

            $paiement->update([
                'reference'=>'PA_'.$this->reference(),
                'statut' => 'success',
                'etat' => 1 ,
            ]);

            Agence::whereId($request->agence_id)->update([
                'abonne' => 1
            ]);

            $date_expiration = Service::nextDate($offre_abonnement->nb_jours);
            // date('Y-m-d H:i:s',strtotime(Carbon::now().'+'.$offre_abonnement->nb_jours.' days'));
            

            $ab = Abonnement::where([
                'id' => $request->abonnement_id,
                'agence_id'  => $request->agence_id,
                'offre_abonnement_id' => $request->offre_abonnement_id,
                'user_id' => $request->user_id,
            ])->update([
                // 'abonne' => 1
                'date_abonnement' => Carbon::now(),
                'date_expiration' => $date_expiration,
                'status' => 1
            ]);

            $this->createSoldeAccount($request->agence_id);

            // creer aussi la facture(enregistrer la commande)
             $this->orderRepository->invoiceIssue($request->abonnement_id,$request->agence_id,$user->remember_token,0);

            // enregistre la transaction
            $titre = "Paiement de l'abonnement effectué";
            $moyen_paiement = $request->optionPaiementMode ." ".$request->operateur;

            $this->saveTransaction($titre,Carbon::now(),$request->montant_paiement,$request->devise,$moyen_paiement,1,$request->agence_id);

            $abonnement = Abonnement::where([
                'id' => $request->abonnement_id,
                'agence_id'  => $request->agence_id,
                'offre_abonnement_id' => $request->offre_abonnement_id,
                'user_id' => $request->user_id,
            ])->first();

            $titre = "Nouvel abonnement";
            $description = "Paiement et activation suite à l'abonnement effectuée par l'agence ".$abonnement->agence->name;

            $this->activite->createActivity($titre,$description,1);

            $this->order->updateStatusOrder($abonnement->id,1);

            return response()->json([
                'status' => 200,
                // 'title' => 'Echec de paiement',
                // 'message' => "Paiement de l'abonnement echoué. Veuillez réessayer"
            ]);


        }else{
            $paiement->update([
                'reference'=>'PA_'.$this->reference(),
                'statut' => 'failed',
                'etat' => 0 ,
            ]);

            return response()->json([
                'status' => 401,
                'title' => 'Echec de paiement',
                'message' => "Paiement de l'abonnement echoué. Veuillez réessayer"
            ]);
        }

        // $abonnement = Abonnement::with('offre')->where()
    }

    public function confirmPaswwordForm()
    {
       // echo  $session = session('user');die;
        $lastpaiement = PaiementAbonnement::latest('id')->first();

        // dd($lastpaiement);

        $user = User::whereId($lastpaiement->user_id)->first();
        return view('auth.passwords.confirm',compact('user'));
    }

    public function createPassword(Request $request)
    {
        $user_new = User::whereId([$request->user_id])->first();

        if (!empty($request->password)) {
            $user = User::whereId($request->user_id)->update([
                'password' => Hash::make($request->password)
            ]);
            if ($user) {
                if (Auth::attempt(['email' => $user_new->email,'password' => $request->password])) {
            
                    if ($request->hasSession()) {
                        $request->session()->put('auth.password_confirmed_at', time());
                    }            
                   
                    // $request->session()->put('user', $request->_token);
                    $session = $request->session()->get('auth.password_confirmed_at');

                    // Service::createSession($request->_token,auth()->user()->id);

                    if (auth()->user()->type_user == 2) {
                        return redirect()->route('agence.index',[App::getLocale()]);
                    }
                    if (auth()->user()->type_user == 1) {
                        return redirect()->route('locataire.index',[App::getLocale()]);
                    }
                    // return response()->json(['status' => 201]);


                }else{
                   return response()->json([
                        'status' => 406,
                        // 'title' => 'Echec',
                        // 'message' => "Impossible d\'enregistrer le mot de passe"
                    ]); 
                }


                $titre = "Création de mot de passe";
                $description = "Un mot de passe a été créé par ".$user_new->name;

                $this->activite->createActivity($titre,$description,1);
            }else{
                $titre = "Echec de création de mot de passe";
                $description = "La création du mot de passe par ".$user_new->name.'a échoué';

                $this->activite->createActivity($titre,$description,1);

                return response()->json([
                    'status' => 401,
                    'title' => 'Echec',
                    'message' => "Impossible d\'enregistrer le mot de passe"
                ]);
            }
            
          
        }

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgenceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function show(Agence $agence)
    {
        $countries = Country::whereEtat(1)->get();
        $breadcrumbs = '<span class="text-muted fw-light">Infos générales Agence /</span> Account';
        return view('backend.edit_agence',compact("breadcrumbs","countries"));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function edit(Agence $agence)
    {
        $countries = Country::whereEtat(1)->get();
        $breadcrumbs = '<span class="text-muted fw-light">Mettre à jour /</span> Account';
        return view('backend.update_agence',compact("breadcrumbs","countries"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgenceRequest  $request
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agence $agence)
    {
        $agence = Agence::where('reference',auth()->user()->agence->reference)->first();
        if (isset($agence)) {
            $update = $agence->update([
                   'name' => $request->societe,
                   'email' => $request->email,
                   'contact' => $request->contact,
                   'contact_fixe' => $request->contact_2,
                   'agrement' => $request->agrement,
                   'registre_commerce' => $request->registre_commerce,
                   'adresse' => $request->adresse,
                   'localisation' => $request->localisation,
                   'ville_id' => $request->ville,
                   'pays_id' => $request->country,
                   'gerant'=> $request->gerant
                ]);
            if ($update) {
                $titre = "Mise à jour informations agence" ;
                $description = "Modification des informations de l'agence " .$agence->name." par l'utilisateur ".auth()->user()->name;

                $this->activite->createActivity($titre,$description,1); 

                return response()->json([
                    'status' => 200,
                    'title' => "Succès",
                    'message' => "Modification effectuée",
                ]);


            }else{

                $titre = "Echec de Mise à jour informations agence" ;
                $description = "Echec de Modification des informations de l'agence " .$agence->name." par l'utilisateur ".auth()->user()->name;

                $this->activite->createActivity($titre,$description,1); 

                return response()->json([
                    'status' => 401,
                    'title' => "Echec",
                    'message' => "Impossible de mettre à jour les informations"
                ]);
            }
        }else{
            return response()->json([
                    'status' => 401,
                    'title' => "Echec",
                    'message' => "Impossible de retrouver les informations, veuillez vous reconnecter"
                ]);
        }
    }

    public function uploadPicture(Request $request)
    {
        
        $this->uploadImage('agences',$request->file('avatar_agence'),'/company/pictures/',auth()->user()->agence->id,'photo');

        $titre = "Mise à jour logo" ;
        $description = "Modification du logo de l'agence " .auth()->user()->agence->name." par l'utilisateur ".auth()->user()->name;

        $this->activite->createActivity($titre,$description,1); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agence $agence)
    {
        //
    }

    protected function sendMail($recipient,$path,$data)
    {
      // $subject = "";
      // $datasujet = $datasujet;
      try {
          $email = $recipient;
          $data = $data;
      Mail::send($path,$data,function($message)use($email){
              $message->to($email)->subject(env('APP_NAME').": Votre code de vérification");
          });
              
        } catch (Exception $e) {
            return redirect()->back()->with('error','Oops! Impossible d\'envoyer le mail. Problème rencontré avec le serveur de messagerie');
        }

    }

    protected function createSoldeAccount($agence_id)
    {
        return Compte::create([
            'agence_id' => $agence_id,
            'num_compte' => $this->soldeAccount(),
            'solde' => 0,
            'etat' => 1,
        ]);
    }


    protected function sessionUser()
    { 
        return Service::getUserSession(session('user'));
    }

    protected function userInfoSession($session_id)
    {
        return User::with('agence')->whereId($session_id)->first();
    }
}
