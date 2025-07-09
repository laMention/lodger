<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operation;
use App\Models\Compte;
use App\Http\Services\Service;
use App\Http\Traits\Generator;
use Carbon\Carbon;

class OperationController extends Controller
{
    use Generator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operation = new Operation;
        $operations = Operation::where(['agence_id'=>auth()->user()->agence->id,'etat' => 1])->orderby('date_operation','desc')->get();
        return view('backend.operations',compact('operations','operation'));
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
        // return $request->all();
        $compte_agence = Compte::whereAgence_id(auth()->user()->agence->id)->first();

        $new_amount = 0;

        // check account if amount of an account is enough to proceed to any operation
        if ($request->type_operation == 2 && $compte_agence->solde < $request->montant_operation) 
        {
            // si c'est une sortie de caisse
             return response()->json([
                'status' => 401,
                'title' => "Montant en caisse insuffisant",
                'message' => "Veuillez réapprovisionner votre caisse avant toute opération de sortie"
            ]);
        }else{



        $store = Operation::create([
            'reference' => 'COMPTA_'.$this->reference(),
            'user_id' => auth()->user()->id,
            'agence_id' => auth()->user()->agence->id,
            'type_operation' => $request->type_operation,
            'designation' => NULL,
            'description' => $request->description,
            'date_operation' => $request->date_operation,
            'montant' => $request->montant_operation,
            'remarque' => $request->remarque,
            'etat' => 1,
        ]);

        if ($store) {
             
            if ($request->type_operation == 2) {
                $new_amount = $compte_agence->solde - $request->montant_operation;
            }else{
                $new_amount = $compte_agence->solde + $request->montant_operation;
            }

            $compte_agence->update([
                'solde' => $new_amount
            ]);
            return response()->json([
                'status' => 200,
                'title' => 'Opération enregistrée',
                'message' => "Opération enregistrée avec succès"
            ]);


        }else{
            return response()->json([
                'status' => 401,
                'title' => "Echec d'enregistrement",
                'message' => "L'enregistrement de l'opération a échoué. Veuillez réessayer ou contacter notre support"
            ]);
        }

        
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
    public function update(Request $request, $id=NULL)
    {
        
        $compte_agence = Compte::whereAgence_id(auth()->user()->agence->id)->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
