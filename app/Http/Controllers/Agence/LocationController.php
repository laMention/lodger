<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Contrat;
use App\Models\Country;
use App\Models\Appartement;
use App\Models\User;
use App\Models\Caution;
use App\Models\AvanceLoyer;
use App\Models\CommissionAgence;
use App\Models\Facture;
use App\Models\PaiementLoyer;
use App\Models\FichierContrat;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use App\Http\Traits\Generator;
use App\Http\Traits\CheckConnectionTrait;
use App\Repository\UserRepository;
use App\Repository\ActiviteRepository;
use Carbon\Carbon;
use App\Models\Resiliation;
use App\Models\HistoriqueLocation;
use PDF;

class LocationController extends Controller
{
    use FileTrait,CheckConnectionTrait,Generator;

    private $userRepository;

    function __construct(UserRepository $userRepository,ActiviteRepository $activiteRepository)
    {
        $this->userRepository = $userRepository;
        $this->activite = $activiteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appart = new Appartement;
        $contrat = new Contrat;

        
        // echo $facture = Location::latest('id')->first();die;

        // $jour = "2022-09-13"; // Notre date par default
        // echo date('Y-m-d', strtotime($jour. ' + 27 days'));die;

        $locations = Location::with('locataire','contrat')->where(['etat'=>1,'agence_id'=>auth()->user()->agence->id,'deleted'=>0,'archived'=>0])->orderby('created_at','desc')->get();
        // dd($locations);

        return view('backend.locations',compact('locations','appart','contrat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contrats = Contrat::where(['etat' => 1, "agence_id" => auth()->user()->agence->id])->get();
        $countries = Country::get();
        // apartements qui n'ont pas de contrat en cours en non supprimé et actifs
        $appartements = Appartement::with('location')->where(['etat'=>1,'deleted'=>0,"archived"=>0,"agence_id"=>auth()->user()->agence->id,'statut'=>0])->get();

        // echo "<pre>";print_r($appartements);die;



        return view('backend.add_location',compact('contrats','countries','appartements'));
    }

    public function getInfoAppart(Request $request)
    {
        $appartement = $request->appartement;

        // echo "<pre>";print_r($appartement);die;
        $data = Appartement::with('caution','avance','commission','equipements','points_forts','comodites')->where(['id'=>$request->appartement])->first();

        $equipements = $data->equipements;
        $comodites = $data->comodites;
        $points_forts = $data->points_forts;

        

        if ($data) {
            return response()->json([
                'status' => 200,

                'data' => $data,
                'equipements' => $equipements,
                'comodites' => $comodites,
                'points_forts' => $points_forts,
            ]);
        }else{
            return response()->json([
                'status' => 401,
                'data' => NULL,
                'title' => "Données introuvables",
                'message' => "Aucun enregistrement trouvé",
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        if (empty($request->name)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __('Le nom est réquis'),
            ]);
        }
        if (empty($request->lastname)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __('Le prénom est réquis'),
            ]);
        }
        if (empty($request->contact)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __('Le contact est réquis'),
            ]);
        }
        if (empty($request->pays_id)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __('Le pays est réquis'),
            ]);
        }
        if (empty($request->ville)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __('La ville est réquise'),
            ]);
        }
        if (empty($request->adresse)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("L'adresse  est réquise"),
            ]);
        }
        if (empty($request->contrat)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("Sélectionnez le contrat"),
            ]);
        }
        if (empty($request->appartement)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("Choisissez l'appartement"),
            ]);
        }

        // Enregistrement Locataire
        if (User::where(['name' => $request->name,'lastname' => $request->lastname,'email' =>$request->email,'contact' =>$request->contact,'type_user' => 1])->exists()) {

            $locataire = User::where(['name' => $request->name,'lastname' => $request->lastname,'email' =>$request->email,'contact' =>$request->contact,'type_user' => 1])->first();

            if ($locataire->etat == 0 && $locataire->deleted == 1) {
                $locataire = User::where(['id',$locataire->id])->update([
                  'etat' =>1,
                  'deleted' =>0,
                  'type_user' => 1,
                  'agence_id' => auth()->user()->agence->id
                ]);
            }
            if ($locataire->etat == 1 && $locataire->deleted == 0) {
                return response()->json([
                    'status' => 401,
                    'title' => "Error",
                    'message' => __('Ce locataire est déjà enregistré')
                ]);
            }
        }else{
           $locataire = $this->userRepository->create($request->name,$request->lastname,$request->email,$request->contact,$request->contact_2,$request->pays_id,$request->ville,$request->adresse,1,NULL,auth()->user()->agence->id); 
        }
        if ($locataire) {
            if ($request->file('image_photo')) {
                // code...
                $this->uploadImage('users',$request->file('image_photo'),'/images/users/',$locataire->id,'photo');
            }
            if ($request->file('copie_cni')) {
                // code...
                $this->uploadImage('users',$request->file('copie_cni'),'/images/identities/',$locataire->id,'num_cni');  
            }
        }
        if (Location::where(['appartement_id' => $request->appartement,'locataire_id' => $locataire->id])->exists()) 
        {
            return response()->json([
                'status' => 401,
                'title' => "Déjà enregistré",
                'message' => __("Contrat de location a déjà enregistré")
            ]);
        }
        $location = Location::create([
            'reference' => $this->reference(),
            'user_id' => auth()->user()->id,
            'appartement_id' => $request->appartement,
            'contrat_id' => $request->contrat,
            'agence_id' => auth()->user()->agence->id,
            'locataire_id' => $locataire->id,
            'etat' => 1,
            'date_location' => $request->date_location,
            // 'libelle_contrat' => $request->contrat
        ]);

        if ($location) {
            // Mettre a jour statut appartement
            $appartement = Appartement::where(['id'=>$request->appartement])->update(['statut'=>1]);

            // Mettre a jour la caution et les autres frais
            if ($request->caution == "on") {
                Caution::where(['appartement_id'=>$request->appartement])->update([
                    'paid' => 1,
                    'deleted' => 0,
                    'etat' => 1
                ]);            
            }

            if ($request->avance == "on") {
                 AvanceLoyer::where(['appartement_id'=>$request->appartement])->update([
                    'paid' => 1,
                    'deleted' => 0,
                    'etat' => 1
                ]);
            }
            if ($request->commission == "on") {
                
                 CommissionAgence::where(['appartement_id'=>$request->appartement])->update([
                    'paid' => 1,
                    'deleted' => 0,
                    'etat' => 1
                ]);
            }

            // FichierContrat::firstOrCreate([

            // ]);
            $titre = "Nouveau contrat" ;
            $description = "Un nouveau contrat de location vient d'être enregistré pour le client ".$locataire->name;

            $this->activite->createActivity($titre,$description,1);

            return response()->json([
                'status' => 200,
                'title' => "Location enregistrée",
                'message' => __("Un nouveau contrat de location vient d'être enregistré"),
                'location' => $location
            ]);
        }

    }


    public function generateContratPdf($id=null,$reference)
    {
        $location = Location::with('locataire','contrat','appartement')->where(['reference'=>$reference,'agence_id'=>auth()->user()->agence->id])->first();

        $data = [
            'title' => 'Contrat de location',
            'date' => date('d/m/Y'),
            'location' => $location
        ];             
        $pdf = PDF::loadView('pdf.agences.locataires.contrat', $data);

     
        return $pdf->download('contrat.pdf');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id=null,$reference)
    {
        $location = Location::where(['reference' => $reference])->first();

        $paiements = PaiementLoyer::where(['location_id'=>$location->id,'etat'=>1,'deleted'=>0,'agence_id'=>auth()->user()->agence->id])->orderby('created_at','desc')->limit(3)->get();

        $dernier_p = PaiementLoyer::where(['location_id'=>$location->id])->latest('id')->first();
        $dernier_f = Facture::where(['location_id'=>$location->id])->latest('id')->first();

        if ($location) {
            // code...
            // echo $location ;die;
            $appart = new Appartement;
        return view('backend.details_location',compact('location','appart','paiements','dernier_p','dernier_f'));

        }else{
             return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __('Impossible de trouver cet enregistrement'),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null,$reference)
    {
        //
        $location = Location::where(['reference' => $reference])->first();
        $contrats = Contrat::where(['etat' => 1, "agence_id" => auth()->user()->agence->id])->get();
        $appart = new Appartement;
        // $countries = Country::get();
        // apartements qui n'ont pas de contrat en cours en non supprimé et actifs
        $appartements = Appartement::with('location')->where(['etat'=>1,'deleted'=>0,"archived"=>0,"agence_id"=>auth()->user()->agence->id])->get();

        return view('backend.edit_location',compact('location','contrats','appartements','appart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
       
        if (empty($request->contrat)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("Sélectionnez le contrat"),
            ]);
        }
        if (empty($request->appartement)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("Choisissez l'appartement"),
            ]);
        }
        $location = Location::where(['reference' => $request->location_id])->first();

        $location->update([
            'user_id' => auth()->user()->id,
            'appartement_id' => $request->appartement,
            'contrat_id' => $request->contrat,
            'etat' => 1,
            'date_location' => $request->date_location,
        ]);
        return response()->json([
                'status' => 200,
                'title' => "Modification effectuée",
                'message' => __("Contrat de location modifié avec succès")
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null, $reference)
    {
        $location = Location::where(['reference' => $reference])->first();

        if ($location) {
            $location->update(['etat'=> 0,'archived'=>0]);

            $appartement = Appartement::where(['id'=>$location->appartement_id])->update(['statut' =>0]);

           $caution = Caution::where(['id'=>$location->appartement->caution->id])->update(['paid'=>0]);

           $avance = Caution::where(['id'=>$location->appartement->avance->id])->update(['paid'=>0]);

           $commission = Caution::where(['id'=>$location->appartement->commission->id])->update(['paid'=>0]);

           return response()->json([
                'status' => 200,
                'title' => "Suppression effectuée",
                'message' => __('Location archivée avec succès')
            ]);
        }
    }

    public function resilier($id = null, $reference)
    {
       $location = Location::where(['reference' => $reference])->first();

        if ($location) {

            $location->update(['etat'=> 0,'archived'=>0]);

            $appartement = Appartement::where(['id'=>$location->appartement_id])->update(['statut' =>0]);

            $caution = Caution::where(['id'=>$location->appartement->caution->id])->update(['paid'=>0]);

            $avance = Caution::where(['id'=>$location->appartement->avance->id])->update(['paid'=>0]);

            $commission = Caution::where(['id'=>$location->appartement->commission->id])->update(['paid'=>0]);

            $locataire = User::where(['id' => $location->locataire_id])
            ->update([ 'etat' => 0 ,'deleted' => 1 ]);

            $resiliation = Resiliation::create([
                'reference'=> $this->reference(),
                'location_id'=> $location->id,
                'user_id'=> auth()->user()->id,
                'agence_id'=> auth()->user()->agence->id,
                'motif'=> "Rupture de contrat de location gérance avec le locataire ".$location->locataire->name,
                'etat'=> 1
            ]);

            $historique = HistoriqueLocation::create([
                'reference' => $this->reference(),
                'locataire_id' => $location->locataire->id,
                'appartement_id' => $location->appartement_id,
                'contrat_id' => $location->contrat_id,
                'agence_id' => auth()->user()->agence->id,
                'etat' => 1,
                'date_location' => $location->date_location,
                'date_resiliation' => $resiliation->created_at,
                'user_id' => auth()->user()->id,
                'caution_id' =>$location->appartement->caution->id,
                'avance_loyer_id' =>$location->appartement->avance->id,
                'commission_agence_id' =>$location->appartement->commission->id,
                'location_id' => $location->id
            ]);

           return response()->json([
                'status' => 200,
                'title' => "Resiliation effectuée",
                'message' => __('Contrat de location résilié avec succès')
            ]);
        }
    }

    public function factures($id=null, $reference)
    {
        $facture = new Facture;
        $location = Location::with('factures')->where(['reference'=>$reference])->first();
        

        $appart = new Appartement;
        return view('backend.factures_locataire',compact('location','appart','facture'));
    }
}
