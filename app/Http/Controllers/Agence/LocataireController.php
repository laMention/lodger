<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use App\Http\Traits\Generator;
use App\Http\Traits\CheckConnectionTrait;
use App\Models\User;
use App\Models\Location;
use App\Models\Appartement;
use App\Models\Caution;
use App\Models\AvanceLoyer;
use App\Models\CommissionAgence;
use App\Models\Resiliation;
use App\Models\HistoriqueLocation;
use App\Models\Contrat;
use App\Models\Country;

class LocataireController extends Controller
{
    use FileTrait,CheckConnectionTrait,Generator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = new User;
        $locataires = User::with('locations')->where(['etat' => 1,'type_user' => 1,'agence_id'=>auth()->user()->agence->id])->orderby('created_at','desc')->get();
        // $locations = Location::with('locataire')->where(['etat'=>1,'agence_id'=>auth()->user()->agence->id,'deleted'=>0,'archived'=>0])->orderby('created_at','desc')->get();

        // dd($locataires);

        // echo "hdhd";die;

        return view('backend.locataires',compact('locataires'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=null,$reference)
    {
        $locataire = User::where('reference',$reference)->first();
        $appartement = new Appartement;
        $locations = Location::with('appartement')->where(['locataire_id'=>$locataire->id,'etat' => 1,'deleted'=>0,'archived' => 0])->limit(6)->get();

        return view('backend.details_locataire',compact('locataire','locations','appartement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id=null,$reference)
    {
        $locataire = User::where('reference',$reference)->first();
        $countries = Country::get();
        return view('backend.edit_locataire',compact('countries','locataire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->name == '') {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __('Le nom est réquis'),
            ]);
        }
        if ($request->email == '') {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("L'adresse email est réquis"),
            ]);
        }
        if ($request->contact == '') {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("Le contact est réquis"),
            ]);
        }
        if ($request->pays_id == '') {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("Le pays est réquis"),
            ]);
        }
        if ($request->ville == '') {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("La ville est réquise"),
            ]);
        }
        if ($request->adresse == '') {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("L'adresse est réquise"),
            ]);
        }
        $locataire = User::where('reference',$request->reference)->first();

        $locataire->update([
              
              'name' => $request->name,
              'lastname' => $request->lastname,
              'email' =>$request->email,
              'contact' =>$request->contact,
              'country_id' =>$request->pays_id,
              'ville' =>$request->ville,
              'adresse' =>$request->adresse,
              'role' => " ",
              'agence_id' => auth()->user()->agence->id
        ]);

        if ($locataire) {
            if ($request->file('image_photo')) {
                $this->uploadImage('users',$request->file('image_photo'),'/images/users/',$locataire->id,'photo');

            }
            if ($request->file('copie_cni')) {
                $this->uploadImage('users',$request->file('copie_cni'),'/images/identities/',$locataire->id,'num_cni');

            }

            return response()->json([
                  'status' => 200,
                  'title' => "Success",
                  'message' => __('Modification effectuée ')
              ]);
        }else{
            return response()->json([
                  'status' => 401,
                  'title' => "Echec d'enregistrement",
                  'message' => __("Impossible de faire la mise à jour. Réessayer ou contacter votre technicien ")
              ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null,$reference)
    {
        //
        $locataire = User::with('locations')->where('reference',$reference)->first();

        // echo $locataire->id;
        // $getlocation = Location::where(['locataire_id',$locataire->id])->get();
        // echo "<pre>";print_r($locataire->locations);die;

        
        if ($locataire) {
            foreach ($locataire->locations as $key => $value) {
                // echo $value->id;die;

               $location = Location::where(['locataire_id'=>$locataire->id])->update(['etat'=> 0]);

               $appartement = Appartement::where(['id'=>$value->appartement_id])->update(['statut' =>0]);

               $caution = Caution::where(['id'=>$value->appartement->caution->id])->update(['paid'=>0]);

               $avance = Caution::where(['id'=>$value->appartement->avance->id])->update(['paid'=>0]);

               $commission = Caution::where(['id'=>$value->appartement->commission->id])->update(['paid'=>0]);

                $resiliation = Resiliation::create([
                    'reference'=> $this->reference(),
                    'location_id'=> $value->id,
                    'user_id'=> auth()->user()->id,
                    'agence_id'=> auth()->user()->agence->id,
                    'motif'=> "Rupture de contrat de location gérance avec le locataire ".$locataire->name,
                    'etat'=> 1
                ]);

                $historique = HistoriqueLocation::create([
                    'reference' => $this->reference(),
                    'locataire_id' => $locataire->id,
                    'appartement_id' => $value->appartement_id,
                    'contrat_id' => $value->contrat_id,
                    'agence_id' => auth()->user()->agence->id,
                    'etat' => 1,
                    'date_location' => $value->date_location,
                    'date_resiliation' => $resiliation->created_at,
                    'user_id' => auth()->user()->id,
                    'caution_id' =>$value->appartement->caution->id,
                    'avance_loyer_id' =>$value->appartement->avance->id,
                    'commission_agence_id' =>$value->appartement->commission->id
                ]);
            }

            $locataire->update(['etat' => 0,'status'=>0, "deleted" => 1]);
            
            return response()->json([
                'status' => 200,
                'title' => "Résiliation effectuée",
                'message' => __('Le contrat avec le locataire '.$locataire->name.' a été résilié avec succès')
            ]);
        }else{
            return response()->json([
                'status' => 401,
                'title' => "Echec de résiliation",
                'message' => __("La résiliation de contrat de locataion avec le locataire ".$locataire->name." a échoué")
            ]);
        }



    }

    
}
