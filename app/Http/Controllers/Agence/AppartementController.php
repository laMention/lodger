<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\ActiviteRepository;
use App\Http\Requests\StoreAppartementRequest;
use App\Models\Appartement;
use App\Models\User;
use App\Models\Country;
use App\Models\Caution;
use App\Models\Avance;
use App\Models\Loyer;
use App\Models\AvanceLoyer;
use App\Models\CommissionAgence;
use App\Models\Location;
use App\Models\PaiementLoyer;
use App\Models\Facture;
use App\Models\Equipement;
use App\Models\PointFort;
use App\Models\Comodite;
use App\Models\AppartementComodite;
use App\Models\AppartementEquipement;
use App\Models\AppartementPointFort;
use App\Http\Traits\FileTrait;
use App\Http\Traits\Generator;
use App\Http\Traits\CheckConnectionTrait;
use Auth;
use DB; 

class AppartementController extends Controller
{
  use FileTrait,CheckConnectionTrait,Generator;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    protected $activite;

    public function __construct(ActiviteRepository $activiteRepository){
        $this->activite = $activiteRepository;
    }
  public function index()
  {
    $appartement = new Appartement;
    $appartements = Appartement::where(['agence_id'=>auth()->user()->agence->id,'deleted' => 0,'archived' => 0])->orderby('created_at','desc')->get();
      return view('backend.appartements',compact('appartements','appartement'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $user = new User;
      $proprietaires = $user->proprietaires()->get();
      $countries = Country::get();
      $appart = new Appartement;

      $equipements = Equipement::whereEtat(1)->get();
      $points_forts = PointFort::whereEtat(1)->get();
      $comodites = Comodite::whereEtat(1)->get();


      return view('backend.add_appart',compact('proprietaires','countries','appart','equipements','points_forts','comodites'));
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
    $is_conn = $this->checkconnection();

      if ($is_conn = false) {
          return response()->json([
          'status' => 504,
          'title' => __('Erreur Réseau'),
          'message' => __("Votre appareil n'est pas connecté au réseau"),
        ]);
      }

    if (empty($request->categorie)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Sélectionnez la catégorie'),
        ]);
    }
    if (empty($request->localisation)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner la localisation du bien'),
        ]);
    }
    if (empty($request->description)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Description du bien obligatoire'),
        ]);
    }
    if (empty($request->image_appart)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Veuillez charger une image'),
        ]);
    }
    if (empty($request->loyer)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le montant du loyer'),
        ]);
    }
    if (empty($request->periode_commission)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner la periode de commission'),
        ]);
    }
    if (empty($request->montant_commission)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le montant de commission'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_name == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Vous devez attribuer le proprietaire à ce bien ou le créer en cliquant sur nouveau'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_email == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner email du proprietaire'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_phone == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le contact du proprietaire'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_pays == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Sélectionnez le pays du proprietaire'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_ville == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner la ville du proprietaire'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_address == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner l\'adresse du proprietaire'),
        ]);
    }
    if (empty($request->periode) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner la periode de la caution'),
        ]);
    }
    if (empty($request->montant) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le montant de la caution'),
        ]);
    }
    if (empty($request->periode_avance) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner la periode de l\'avance'),
        ]);
    }
    if (empty($request->montant_avance) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le montant de l\'avance'),
        ]);
    }
    if ($request->categorie == 1 && empty($request->libelle) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le type d\'appartement'),
        ]);
    }
    if ($request->categorie == 1 && empty($request->niveau) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le niveau'),
        ]);
    }
    if ($request->categorie == 2 && empty($request->libelle) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le type d\'appartement'),
        ]);
    }
    if ($request->categorie == 3 && empty($request->commerce) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le type de commerce'),
        ]);
    }
  
    // proprio
    $get_proprio = $this->setProprietaire($request->selectproprietaire,$request->proprio_name,$request->proprio_lastname,$request->proprio_email,$request->proprio_phone,$request->proprio_pays,$request->proprio_ville,$request->proprio_address);

    if ($get_proprio != '') {
      // Appartement
      if ($request->categorie == 1) {
        $cod = "AP";
      }
      elseif ($request->categorie == 2) {
        $cod = "MA";
      }
      else{
        $cod = "CO";
      }

      $appart = Appartement::create([
        'reference' => random_int(1111111111, 9999999999),
        'user_id' => auth()->user()->id,
        'proprietaire_id' => $get_proprio,
        'categorie' => $request->categorie,
        'libelle' =>$request->libelle,
        'niveau' => $request->niveau,
        'adresse' => $request->localisation,
        'description' => $request->description,
        'etat' => 1,
        'agence_id' => auth()->user()->agence->id,
        'montant_loyer' => $request->loyer,
        'devise' => "Fr (XOF)",
        'statut' => 0,
        'type_commerce' => $request->commerce,
        'nb_chambre' => $request->nb_chambre,
        'meuble' => $request->contenu_appart,
        'num_appart' => $request->num_appart,
        'type_immobilier' => $request->type_immobilier,
        'quartier' => $request->quartier,
        'rue' => $request->rue,
        'annee_construction'=> $request->annee_const,
        'destination_local'=> $request->destination_local,
        'surface_habitable'=> $request->surface_habitable,
        'nb_piece_principale' => $request->nb_piece_principale

      ]);
      
      if ($appart) {
        Appartement::where(['id' => $appart->id])->update(['code_appart'=> $cod.''.sprintf("%07d",$appart->id)]);
        if ($request->file('image_appart')) {
        $this->uploadImage('appartements',$request->file('image_appart'),'/images/appartements/',$appart->id,'image');
        }

         $caution = Caution::firstOrCreate([
          'montant' => $request->montant,
          'appartement_id' => $appart->id,
          'devise' => "Fr (XOF)",
          'periode' => $request->periode,
          'etat' => 1
        ]);

        $avance = AvanceLoyer::firstOrCreate([
          'montant' => $request->montant_avance,
          'appartement_id' => $appart->id,
          'devise' => "Fr (XOF)",
          'periode' => $request->periode_avance,
          'etat' => 1
        ]);

        $commission = CommissionAgence::firstOrCreate([
          'montant' => $request->montant_commission,
          'appartement_id' => $appart->id,
          'devise' => "Fr (XOF)",
          'periode' => $request->periode_commission,
          'etat' => 1
        ]);


        // Ajouer les comodites et autres equipements
        if (isset($request->equipements)) {
            foreach ($request->equipements as $key => $value) {
                DB::table('appartement_equipement')->updateOrInsert([
                    'appartement_id'=>$appart->id,
                    'equipement_id'=>$value,
                    'etat'=>1,
                ]);
            }
        }

        if (isset($request->comodites)) {
            foreach ($request->comodites as $key => $value) {
               DB::table('appartement_comodite')->updateOrInsert([
                    'appartement_id'=>$appart->id,
                    'comodite_id'=>$value,
                    'etat'=>1,
                ]);
            }
        }

        if (isset($request->points_forts)) {
            foreach ($request->points_forts as $key => $value) {
                DB::table('appartement_point_fort')->updateOrInsert([
                    'appartement_id'=>$appart->id,
                    'point_fort_id'=>$value,
                    'etat'=>1,
                ]);
            }
        }

        $titre = "Nouveau bien immobilier ajouté" ;
        $description = "Bien immobilier ajouté par " .auth()->user()->agence->name;

        $this->activite->createActivity($titre,$description,1); 
      }

      return response()->json([
          'status' => 200,
          'title' => "Success",
          'message' => __('Enregistrement effectué ')
      ]);

    }else{
      return response()->json([
          'status' => 401,
          'title' => "Error",
          'message' => __("Impossible d'enregistrer le proprietaire ")
      ]);
    }
      
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @param str $code_appart
   * @return \Illuminate\Http\Response
   */
  public function show($id = null, $code_appart)
  {
    $appart = new Appartement;
    $caution = new Caution;
    $avance = new AvanceLoyer;
    $commission = new CommissionAgence;
    $invoice = new Facture;

    


     
    $appartement = Appartement::with('equipements','points_forts','comodites')->where(['code_appart' => $code_appart])->first();

    $location = Location::where('appartement_id',$appartement->id)->count();
    $last_invoice = "";
    $last_payment = "";
    if ($location >0) {
        // echo "true";die;
        $last_invoice = Facture::where(['location_id'=>$appartement->location->id])->latest('id')->first();
        $last_payment = PaiementLoyer::where(['location_id'=>$appartement->location->id])->latest('id')->first();
    }

    $biens_proprio = Appartement::where(['proprietaire_id' => $appartement->proprietaire_id,'etat'=>1,'deleted'=>0,'agence_id'=>auth()->user()->agence->id])->get();
    // echo $appartement->location->date_location;die;
  

    return view('backend.details_appart',compact('appartement','appart','caution','avance','commission','invoice','last_invoice','last_payment','biens_proprio'));
  }

  /**
   * Display real estates for an owner
   * 
   * @param str $code_appart
   * @return \Illuminate\Http\Response
  */
  public function appartOwner($id=null,$name)
  {
    $proprietaire = User::with('appartements')->where(['name'=>$name])->first();

    $appartements = Appartement::where('proprietaire_id',$proprietaire->id)->get();

    $appartement = new Appartement;
    // dd($appartements);

    return view('backend.appart-proprio',compact('proprietaire','appartement','appartements'));

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id=null, $code_appart)
  {
    $appartement = Appartement::with('equipements','points_forts','comodites')->where(['code_appart' => $code_appart])->first();
    $user = new User;
    $proprietaires = $user->proprietaires()->get();
    $countries = Country::get();
    $appart = new Appartement;

    $equipements = Equipement::whereEtat(1)->get();
    $points_forts = PointFort::whereEtat(1)->get();
    $comodites = Comodite::whereEtat(1)->get();

    $arr_points_forts_quartier = [];
    $arr_comodites = [];
    $arr_equipements = [];

    $appartement_points_forts  = DB::table('appartement_point_fort')->whereEtat(1)->get();
    $appartement_comodites  =DB::table('appartement_comodite')->whereEtat(1)->get();
    $appartement_equipements  = DB::table('appartement_equipement')->whereEtat(1)->get();

    $arr_points_forts_quartier = json_decode(json_encode($appartement_points_forts),true);
    $arr_comodites = json_decode(json_encode( $appartement_comodites),true);
    $arr_equipements = json_decode(json_encode($appartement_equipements),true);

    // echo "<pre>";print_r($arr_points_forts_quartier);die;


    return view('backend.edit_appart',compact('proprietaires','countries','user','appartement','appart','equipements','points_forts','comodites','arr_points_forts_quartier','arr_comodites','arr_equipements'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id=null,$code_appart)
  {
    //
    $is_conn = $this->checkconnection();
    if ($is_conn = false) {
        return response()->json([
        'status' => 504,
        'title' => __('Erreur Réseau'),
        'message' => __("Votre appareil n'est pas connecté au réseau"),
      ]);
    }
    if (empty($request->categorie)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Sélectionnez la catégorie'),
        ]);
    }
    if (empty($request->localisation)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner la localisation du bien'),
        ]);
    }
    if (empty($request->description)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Description du bien obligatoire'),
        ]);
    }
    
    if (empty($request->loyer)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le montant du loyer'),
        ]);
    }
    if (empty($request->periode_commission)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner la periode de commission'),
        ]);
    }
    if (empty($request->montant_commission)) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le montant de commission'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_name == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Vous devez attribuer le proprietaire à ce bien ou le créer en cliquant sur nouveau'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_email == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner email du proprietaire'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_phone == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le contact du proprietaire'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_pays == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Sélectionnez le pays du proprietaire'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_ville == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner la ville du proprietaire'),
        ]);
    }
    if (empty($request->selectproprietaire) && $request->proprio_address == '') {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner l\'adresse du proprietaire'),
        ]);
    }
    if (empty($request->periode) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner la periode de la caution'),
        ]);
    }
    if (empty($request->montant) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le montant de la caution'),
        ]);
    }
    if (empty($request->periode_avance) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner la periode de l\'avance'),
        ]);
    }
    if (empty($request->montant_avance) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le montant de l\'avance'),
        ]);
    }
    if ($request->categorie == 1 && empty($request->libelle) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le type d\'appartement'),
        ]);
    }
    if ($request->categorie == 1 && empty($request->niveau) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le niveau'),
        ]);
    }
    if ($request->categorie == 2 && empty($request->libelle) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le type d\'appartement'),
        ]);
    }
    if ($request->categorie == 3 && empty($request->commerce) ) {
        return response()->json([
            'status' => 401,
            'title' => "Error",
            'message' => __('Renseigner le type de commerce'),
        ]);
    }

    $appartement = Appartement::where(['code_appart' => $code_appart])->first();
    // proprio
    $get_proprio = $this->setProprietaire($request->selectproprietaire,$request->proprio_name,$request->proprio_lastname,$request->proprio_email,$request->proprio_phone,$request->proprio_pays,$request->proprio_ville,$request->proprio_address);

    if ($get_proprio != '') {
      // Appartement
      if ($request->categorie == 1) {
        $cod = "AP";
      }
      elseif ($request->categorie == 2) {
        $cod = "MA";
      }
      else{
        $cod = "CO";
      }

      $appart = $appartement->update([
        'user_id' => auth()->user()->id,
        'proprietaire_id' => $get_proprio,
        'categorie' => $request->categorie,
        'libelle' =>$request->libelle,
        'niveau' => $request->niveau,
        'adresse' => $request->localisation,
        'description' => $request->description,
        'etat' => 1,
        'agence_id' => auth()->user()->agence->id,
        'montant_loyer' => $request->loyer,
        'devise' => "Fr (XOF)",
        'statut' => 0,
        'type_commerce' => $request->commerce,
        'nb_chambre' => $request->nb_chambre,
        'meuble' => $request->contenu_appart,
        'num_appart' => $request->num_appart,
        'type_immobilier' => $request->type_immobilier,
        'quartier' => $request->quartier,
        'rue' => $request->rue,
        'annee_construction'=> $request->annee_const,
        'destination_local'=> $request->destination_local,
        'surface_habitable'=> $request->surface_habitable,
        'nb_piece_principale' => $request->nb_piece_principale
      ]);
      
      if ($appart) {
        Appartement::where(['id' => $appartement->id])->update(['code_appart'=> $cod.''.sprintf("%07d",$appartement->id)]);
        if (!empty($request->file('image_appart'))) {
          $this->uploadImage('appartements',$request->file('image_appart'),'/images/appartements/',$appartement->id,'image');
        }
         $caution = Caution::where(['appartement_id'=>$appartement->id])->update([
          'montant' => $request->montant,
          'appartement_id' => $appartement->id,
          'devise' => "Fr (XOF)",
          'periode' => $request->periode,
          'etat' => 1
        ]);

        $avance = AvanceLoyer::where(['appartement_id'=>$appartement->id])->update([
          'montant' => $request->montant_avance,
          'appartement_id' => $appartement->id,
          'devise' => "Fr (XOF)",
          'periode' => $request->periode_avance,
          'etat' => 1
        ]);

        $commission = CommissionAgence::where(['appartement_id'=>$appartement->id])->update([
          'montant' => $request->montant_commission,
          'appartement_id' => $appartement->id,
          'devise' => "Fr (XOF)",
          'periode' => $request->periode_commission,
          'etat' => 1
        ]);


         // Ajouer les comodites et autres equipements
        if (isset($request->equipements)) {
            foreach ($request->equipements as $key => $value) {
                DB::table('appartement_equipement')->updateOrInsert([
                    'appartement_id'=>$appartement->id,
                    'equipement_id'=>$value,
                    'etat'=>1,
                ]);
            }
        }

        if (isset($request->comodites)) {
            foreach ($request->comodites as $key => $value) {
                DB::table('appartement_comodite')->updateOrInsert([
                    'appartement_id'=>$appartement->id,
                    'comodite_id'=>$value,
                    'etat'=>1,
                ]);
            }
        }

        if (isset($request->points_forts)) {
            foreach ($request->points_forts as $key => $value) {
                DB::table('appartement_point_fort')->updateOrInsert([
                    'appartement_id'=>$appartement->id,
                    'point_fort_id'=>$value,
                    'etat'=>1,
                ]);
            }
        }

        $titre = "Modification de bien immobilier" ;
        $description = "Bien immobilier ".$appartement->reference." modifié par " .auth()->user()->agence->name;

        $this->activite->createActivity($titre,$description,1);
      }

      return response()->json([
          'status' => 200,
          'title' => "Success",
          'message' => __('Modification effectuée ')
      ]);

    }else{
      return response()->json([
          'status' => 401,
          'title' => "Error",
          'message' => __("Impossible d'enregistrer le proprietaire ")
      ]);
    }


  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id=null,$code_appart)
  {
    $appartement = Appartement::with('location')->where(['code_appart'=>$code_appart])->first();
    // dd($appartement->location);
    // Check if this appart has a current contract

    if (!empty($appartement->location) && $appartement->location->etat == 0) {
      
      Caution::where(['appartement_id' => $appartement->id])->update(['deleted' => 1, 'etat' => 0]);
      
      CommissionAgence::where(['appartement_id' => $appartement->id])->update(['deleted' => 1, 'etat' => 0]);
      
      AvanceLoyer::where(['appartement_id' => $appartement->id])->update(['deleted' => 1, 'etat' => 0]);

      $appartement->update(['deleted' => 0, 'etat' => 0,'archived' => 1]);

      $titre = "Suppression bien immobilier ".$appartement->reference ;
        $description = "Bien immobilier ".$appartement->reference." supprimé par " .auth()->user()->agence->name;

        $this->activite->createActivity($titre,$description,1);

      return response()->json([
          'status' => 200,
          'title' => "Succès",
          'message' => __('Suppression effectuée ')
      ]);
    }
    elseif (empty($appartement->location)) {
      Caution::where(['appartement_id' => $appartement->id])->update(['deleted' => 1, 'etat' => 0]);
      
      CommissionAgence::where(['appartement_id' => $appartement->id])->update(['deleted' => 1, 'etat' => 0]);
      
      AvanceLoyer::where(['appartement_id' => $appartement->id])->update(['deleted' => 1, 'etat' => 0]);

      $appartement->update(['deleted' => 0, 'etat' => 0,'archived' => 1]);

      return response()->json([
          'status' => 200,
          'title' => "Succès",
          'message' => __('Suppression effectuée ')
      ]);
    }
    else{
      // Send alert
      return response()->json([
          'status' => 401,
          'title' => "Contrat en cours",
          'message' => __("Cet appartement fait l'objet d'un contrat de location en cours ")
      ]);
    }


  }

  public function setProprietaire($selectproprietaire,$proprio_name,$proprio_lastname,$proprio_email,$proprio_phone,$proprio_pays,$proprio_ville,$proprio_address){
    // proprio
    if (empty($selectproprietaire)) {
      if (User::where(['name' => $proprio_name,'lastname' => $proprio_lastname,'email' =>$proprio_email,'contact' =>$proprio_phone])->exists()) {
        $proprietaire = User::where(['name' => $proprio_name,'lastname' => $proprio_lastname,'email' =>$proprio_email,'contact' =>$proprio_phone])->first();
        $get_proprio = $proprietaire->id;
      }else{
        $proprietaire = User::create([
          'reference' => $this->reference(),
          'name' => $proprio_name,
          'lastname' => $proprio_lastname,
          'email' =>$proprio_email,
          'contact' =>$proprio_phone,
          'country_id' =>$proprio_pays,
          'ville' =>$proprio_ville,
          'adresse' =>$proprio_address,
          'type_user' => 0,
          'role' => NULL,
          'agence_id' => auth()->user()->agence->id
        ]);
      }

      $get_proprio = $proprietaire->id;
    }else{
      $get_proprio = $selectproprietaire;
    }

    return $get_proprio;
  }
}
