<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Reparation;
use App\Models\Appartement;
use Carbon\Carbon;

class ReparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appart = new Appartement;
        $reparations = Reparation::where(['deleted'=>0])->orderby('created_at','desc')->get();
        return view('backend.reparations',compact('reparations','appart'));
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
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Mark as read function
     * Update the specified resource in storage
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param string $reference
     * 
     * Marqué comme lu
    */
    public function markAsRead(Request $request, $id=null,$reference)
    {
        $reparation = Reparation::where('reference',$reference)->first();
        if (isset($reparation) || !empty($reparation)) {
            $lu = $reparation->update(['read_at' => Carbon::now()]);
            if ($lu) {
                return response()->json([
                        'status' => 200,
                        'title' => "Réparation effectuée",
                        'message' => "Cette tâche vient d'être marquée comme fait"
                        ]);
            }else{
                return response()->json([
                        'status' => 401,
                        'title' => "Lecture impossible",
                        'message' => "Impossible de lire le texte"
                        ]);

            }
        }else{
            return response()->json([
                    'status' => 401,
                    'title' => "Echec de la mise à jour",
                    'message' => "Impossible de recuperer l'enregistrement"
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
        $reparation = Reparation::where('reference',$reference)->first();
        if (isset($reparation) || !empty($reparation)) {
            $delete = $reparation->update(['deleted' => 1,'etat'=>0]);
            if ($delete) {
                
                return response()->json([
                        'status' => 200,
                        'title' => "Suppression effectuée",
                        'message' => "Réparation supprimée avec succès"
                        ]);
            }else{
                return response()->json([
                        'status' => 401,
                        'title' => "Suppression impossible",
                        'message' => "Impossible de supprimer l'enregistrement"
                        ]);

            }
        }else{
            return response()->json([
                    'status' => 401,
                    'title' => "Echec de la suppression",
                    'message' => "Impossible de supprimer l'enregistrement"
                    ]);
        }
    }
}
