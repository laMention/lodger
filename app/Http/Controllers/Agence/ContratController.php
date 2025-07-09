<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contrat;
use App\Models\Resiliation;
use App\Http\Traits\Generator;
use App\Models\Location;
use App\Models\Caution;
use App\Models\AvanceLoyer;
use App\Models\CommissionAgence;
use App\Models\HistoriqueLocation;
use App\Repository\ActiviteRepository;
use App\Models\Appartement;
use App\Models\User;

class ContratController extends Controller
{
    use Generator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrat = new Contrat;

        $contrats = $contrat->contrats()->get();
        return view('backend.type_contrat',compact('contrats'));
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
        if (empty($request->libelle)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __('Le nom du contrat est requis'),
            ]);
        }
        if (Contrat::where(['libelle' => $request->libelle,'agence_id' =>auth()->user()->agence->id])->exists()) {
            $exists = Contrat::where(['libelle' => $request->libelle,'agence_id' =>auth()->user()->agence->id])->first();

            if($exists->etat == 1 ) {
            
                return response()->json([
                    'status' => 401,
                    'title' => "Error",
                    'message' => __('Ce contrat existe déjà'),
                ]);
            }else{
                $contrat = Contrat::where(['libelle' => $request->libelle,'agence_id' =>auth()->user()->agence->id])->update([
                    'libelle' => $request->libelle,
                    'description' => $request->description,
                    'etat' => 1,
                    'archived' => 0,
                    'deleted' => 0,
                ]);
                 
            }
        }else{
            $contrat = Contrat::create([
                'reference'  =>$this->reference(),
                'libelle' => $request->libelle,
                'description' => $request->description,
                'user_id' => auth()->user()->id,
                'agence_id' => auth()->user()->agence->id,
                'etat' => 1,
            ]);
        }
        if ($contrat) {
            return response()->json([
                'status' => 200,
                'title' => "Succès",
                'message' => __('Enregistrement effectué')
              ]);
        }else{
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("Une erreur est survenu. Veuillez contacter votre technicien")
              ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $reference)
    {
        if (empty($request->libelle)) {
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __('Le nom du contrat est requis'),
            ]);
        }

        $contrat = Contrat::where(['reference'=>$request->contrat_ref])->update([
            'libelle' => $request->libelle,
            'description' => $request->description,
        ]);

        if ($contrat) {
            return response()->json([
                'status' => 200,
                'title' => "Succès",
                'message' => __('Modification effectuée')
              ]);
        }else{
            return response()->json([
                'status' => 401,
                'title' => "Error",
                'message' => __("Une erreur est survenu. Veuillez contacter votre technicien")
              ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=null,$reference)
    {
        //
        $contrat = Contrat::where(['reference'=>$reference])->first();

        $contrat->update(['etat' => 0,'archived' => 1]);

        return response()->json([
            'status' => 200,
            'title' => "Succès",
            'message' => __('Suppression effectuée ')
        ]);
    }


    public function resiliations()
    {
        $resiliations = Resiliation::where(['deleted'=>0,'agence_id'=>auth()->user()->agence->id])->orderby('id','desc')->get();

        return view('backend.resiliations',compact('resiliations'));
    }

    public function rompreContrat($id=null, $reference)
    {
        $resiliation = Resiliation::where(['reference'=> $reference])->first();

        $location = Location::where(['id' => $resiliation->id])->first();

        if ($location) {

            $location->update(['etat'=> 0,'archived'=>0]);

            $appartement = Appartement::where(['id'=>$location->appartement_id])->update(['statut' =>0]);

            $caution = Caution::where(['id'=>$location->appartement->caution->id])->update(['paid'=>0]);

            $avance = Caution::where(['id'=>$location->appartement->avance->id])->update(['paid'=>0]);

            $commission = Caution::where(['id'=>$location->appartement->commission->id])->update(['paid'=>0]);

            $locataire = User::where(['id' => $location->locataire_id])
            ->update([ 'etat' => 1 ,'deleted' => 0 ]);

            $resiliation->update([
                'user_id'=> auth()->user()->id,
                'motif'=> "Rupture de contrat de location gérance avec le locataire ".$location->locataire->name ."validé avec succès",
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
                'title' => "Rupture de contrat validé",
                'message' => __('Contrat de location résilié avec succès')
            ]);
        }
    }


    public function annulerRuptureContrat($id=null, $reference)
    {
         $resiliation = Resiliation::where(['reference'=> $reference])->first();

        $location = Location::where(['id' => $resiliation->id])->first();

        if ($location) {

            $location->update(['etat'=> 0,'archived'=>0]);

            $appartement = Appartement::where(['id'=>$location->appartement_id])->update(['statut' =>1]);

            $caution = Caution::where(['id'=>$location->appartement->caution->id])->update(['paid'=>1]);

            $avance = Caution::where(['id'=>$location->appartement->avance->id])->update(['paid'=>1]);

            $commission = Caution::where(['id'=>$location->appartement->commission->id])->update(['paid'=>1]);

            $locataire = User::where(['id' => $location->locataire_id])
            ->update([ 'etat' => 1 ,'deleted' => 0 ]);

            $resiliation->update([
                'user_id'=> auth()->user()->id,
                'motif'=> "Rupture de contrat de location gérance avec le locataire ".$location->locataire->name ."annulée avec succès",
                'etat'=> 2
            ]);

            $historique = HistoriqueLocation::where(['location_id' => $location->id])->update([                
                'etat' => 0,                
            ]);

           return response()->json([
                'status' => 200,
                'title' => "Rupture de contrat Annulée",
                'message' => __('rupture du Contrat de location annulé avec succès')
            ]);
        }
    }
}
