<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Reparation;
use App\Models\Appartement;
use Carbon\Carbon;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appart = new Appartement;

        $incidents = Incident::with('appartement')->where(['agence_id'=>auth()->user()->agence->id,'deleted'=>0])->get();
        return view('backend.incidences',compact('incidents','appart'));
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
     * Reparations des incidents
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
     * lire l'incident déclaré
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
     * @param string $reference
     * @return \Illuminate\Http\Response
     * Mettre à jour la tâche de l'incidents (marqué comme fait)
     */
    public function update(Request $request, $id=null, $reference)
    {
        $incident = Incident::where('reference',$reference)->first();
        
        if (isset($incident) || !empty($incident)) {
            // code...
            if ($incident->status == 1) {
                return response()->json([
                    'status' => 302,
                    'title' => "Tâche déjà effectuée",
                    'message' => "La tâche a déjà été marquée comme fait"
                    ]);
            }else{
                $fait = $incident->update(['status' => 1]);
                if ($fait) {
                    Reparation::firstOrCreate([
                        'reference' =>"INC_".random_int(111111, 999999),
                        // 'description' =>$incident->description,
                        'etat' =>1,
                        'incident_id' =>$incident->id,
                        'user_id' =>auth()->user()->id,
                        'agence_id' =>auth()->user()->agence->id
                    ]);
                    return response()->json([
                        'status' => 200,
                        'title' => "Réparation effectuée",
                        'message' => "Cette tâche vient d'être marquée comme fait"
                        ]);

                }else{
                    return response()->json([
                        'status' => 401,
                        'title' => "Echec de la mise à jour",
                        'message' => "Impossible de mettre à jour l'enregistrement"
                        ]);
                }   
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
        $incident = Incident::where('reference',$reference)->first();
        if (isset($incident) || !empty($incident)) {
            $lu = $incident->update(['read_at' => Carbon::now()]);
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
    public function destroy($id=null, $reference)
    {
        //
        $incident = Incident::where('reference',$reference)->first();
        if (isset($incident) || !empty($incident)) {
            $delete = $incident->update(['deleted' => 1,'etat'=>0]);
            if ($delete) {
                Reparation::whereIncident_id($incident->id)->update([
                        'deleted'=>1,
                        'etat'=>0,
                    ]);
                return response()->json([
                        'status' => 200,
                        'title' => "Suppression effectuée",
                        'message' => "Incident supprimé avec succès"
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
