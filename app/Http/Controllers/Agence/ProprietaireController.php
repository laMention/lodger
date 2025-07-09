<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appartement;
use App\Models\User;
use App\Models\Country;
use App\Http\Traits\Generator;
use App\Http\Traits\FileTrait;
use App\Repository\UserRepository;
use DB;

class ProprietaireController extends Controller
{
    use Generator,FileTrait;

    private $userRepository;

    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User;
        $proprietaires = $user->proprietaires()->get();
        // dd($proprietaires);
        return view('backend.proprietaires',compact('proprietaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = Country::get();
        return view('backend.nouveau_proprietaire',compact('countries'));
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
        if ($request->adresse == '') {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("L'adresse est réquise"),
            ]);
        }

        if (User::where(['name' => $request->name,'lastname' => $request->lastname,'email' =>$request->email,'contact' =>$request->contact,'type_user' => 0])->exists()) {

            $proprietaire = User::where(['name' => $request->name,'lastname' => $request->lastname,'email' =>$request->email,'contact' =>$request->contact,'type_user' => 0])->first();

            if ($proprietaire->etat == 0 && $proprietaire->deleted == 1) {
                $proprietaire = User::where(['id',$proprietaire->id])->update([
                  'etat' =>1,
                  'deleted' =>0,
                  'type_user' => 0,
                  'role' => NULL,
                  'agence_id' => auth()->user()->agence->id
                ]);

                return response()->json([
                      'status' => 200,
                      'title' => "Success",
                      'message' => __('Enregistrement effectué ')
                  ]);
            }
            if ($proprietaire->etat == 1 && $proprietaire->deleted == 0) {
                return response()->json([
                    'status' => 401,
                    'title' => "Error",
                    'message' => __('Ce proprietaire est déjà enregistré')
                ]);
            }
        }
        $proprietaire = $this->userRepository->create($request->name,$request->lastname,$request->email,$request->contact,null,$request->pays_id,$request->ville,$request->adresse,0,null,auth()->user()->agence->id);
            // $proprietaire = User::create([
            //   'reference' => $this->reference(),
            //   'name' => $request->name,
            //   'lastname' => $request->lastname,
            //   'email' =>$request->email,
            //   'contact' =>$request->contact,
            //   'country_id' =>$request->pays_id,
            //   'ville' =>$request->ville,
            //   'adresse' =>$request->adresse,
            //   'type_user' => 0,
            //   'role' => NULL,
            //   'agence_id' => auth()->user()->agence->id
            // ]);

            if ($proprietaire) {
                $this->uploadImage('users',$request->file('image_photo'),'/images/users/',$proprietaire->id,'photo');
                $this->uploadImage('users',$request->file('copie_cni'),'/images/identities/',$proprietaire->id,'num_cni');

                return response()->json([
                      'status' => 200,
                      'title' => "Success",
                      'message' => __('Enregistrement effectué ')
                  ]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null, $reference)
    {
        $proprietaire = User::where('reference',$reference)->first();
        $appartement = new Appartement;
        $appartements = Appartement::where(['proprietaire_id'=>$proprietaire->id,'etat' => 1,'deleted'=>0,'archived' => 0])->limit(6)->get();

        return view('backend.details-proprio',compact('proprietaire','appartements','appartement'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id= null, $reference)
    {
        $proprietaire = User::where('reference',$reference)->first();
        $countries = Country::get();
        return view('backend.edit_proprietaire',compact('countries','proprietaire'));

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
      

        $proprietaire = User::where('reference',$request->reference)->first();
        $proprietaire->update([
              
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

        if ($proprietaire) {
            if ($request->file('image_photo')) {
                $this->uploadImage('users',$request->file('image_photo'),'/images/users/',$proprietaire->id,'photo');

            }
            if ($request->file('copie_cni')) {
                $this->uploadImage('users',$request->file('copie_cni'),'/images/identities/',$proprietaire->id,'num_cni');

            }

            return response()->json([
                  'status' => 200,
                  'title' => "Success",
                  'message' => __('Modification effectuée ')
              ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null, $reference)
    {
        $proprietaire = User::where('reference',$reference)->first();

        // des appart sont-ils liés à lui
        if (!empty($proprietaire->appartements) && $proprietaire->appartements->count() > 0) {
            return response()->json([
                'status' => 401,
                'title' => "Erreur",
                'message' => __("Des biens sont liés à ce proprietaire"),
            ]);
        }

        $proprietaire->update(['etat' => 0,"deleted" => 1]);

        return response()->json([
            'status' => 200,
            'title' => "Success",
            'message' => __('Suppression effectuée')
        ]);
    }

    /**
     * Terminate the contract with the landlord
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function resilier($id = null, $reference)
    {
        $proprietaire = User::where('reference',$reference)->first();

        $appartements = Appartement::where('proprietaire_id',$proprietaire->id)->update(['archived'=>1,'etat'=>0,'deleted' =>0]);

        $proprietaire->update(['etat' => 0,"deleted" => 1]);

        return response()->json([
            'status' => 200,
            'title' => "Résiliation effectuée",
            'message' => __('Le contrat avec le proprietaire '.$proprietaire->name.' a été résilié avec succès')
        ]);
    }
}
