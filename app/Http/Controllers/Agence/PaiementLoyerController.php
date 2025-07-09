<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\PaiementLoyer;
use App\Models\User;
use App\Models\Facture;
use App\Models\Appartement;
use App\Models\Compte;
use Carbon\Carbon;
use App\Http\Traits\Generator;
use App\Http\Traits\CheckConnectionTrait;
use PDF;

class PaiementLoyerController extends Controller
{
     use CheckConnectionTrait,Generator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paiements = PaiementLoyer::whereMonth('created_at',Carbon::now()->month)->where(['agence_id'=>auth()->user()->id,'etat'=>1,'deleted'=>0])->get();
        $invoice = new Facture;
        $appart = new Appartement;
        // dd($paiements);
        return view('backend.paiements',compact('paiements','invoice','appart'));

    }

    public function paiements()
    {
        $paiements = PaiementLoyer::orderby('created_at','desc')->where(['agence_id'=>auth()->user()->id,'etat'=>1,'deleted'=>0])->get();
        $invoice = new Facture;
        $appart = new Appartement;
        // dd($paiements);
        return view('backend.paiements_all',compact('paiements','invoice','appart'));
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
        $totalp = 0;
        $montant_solde = 0;


        // verifier la date
        if ($request->date_paiement > date('Y-m-d')) {
             return response()->json([
                'status' => 401,
                'title' => "Date érronée",
                'message' => "Vérifier la date: La date ne devrait pas être supérieure à aujourd'hui",

            ]);
        }
        
        if ($request->mode_paiement == "MOBILE MONEY" || $request->mode_paiement == "VIREMENT BANCAIRE" && PaiementLoyer::where(['ref_paiement'=>$request->id_transaction])->exists()) {
            return response()->json([
                'status' => 401,
                'title' => "ID transaction déjà enregistrée",
                'message' => "ID Transaction déjà enregistrée. Veuillez verifier que la référence est correcte",

            ]);
        }


        
        
        $paiement = PaiementLoyer::create([
            'reference' =>"QUIT-".$this->reference(),
            'facture_id' => $request->facture_id,
            'locataire_id' => $request->locataire_id,
            'location_id' => $request->location_id,
            'appartement_id' => $request->appartement_id,
            'montant' => $request->montant_paiement,
            'etat' => 1,
            'status'=> 1,
            'description' => "Paiement loyer du mois de ".$request->periode,
            'passerelle' => $request->passerelle,
            'date_paiement' => $request->date_paiement,
            'agence_id' => $request->agence_id,
            'devise' => 'Fr (XOF)',
            'mode_paiement' => $request->mode_paiement,
            'ref_paiement' => $request->id_transaction,
            'user_id' => auth()->user()->id
        ]);

        if ($paiement) {

            $allp = PaiementLoyer::where(['facture_id' => $request->facture_id,'status'=> 1,'deleted'=>0])->get();

            foreach ($allp as $key => $value) {
                $totalp += $value->montant;
            }

            if ($request->montant_loyer <= $totalp ) {
                // code...

                Facture::where(['id'=>$request->facture_id])->update(['status'=>2]);
                
            }
            else{
                Facture::where(['id'=>$request->facture_id])->update(['status'=>1]);
            }
            PaiementLoyer::where(['id'=>$paiement->id])->update(['status_transaction'=>'success']);

            $success_p = PaiementLoyer::where(['id'=>$paiement->id])->first();

            $compte = Compte::whereAgence_id($request->agence_id)->first();

            $montant_solde = $compte->solde + $request->montant_paiement;

            if ($success_p->status_transaction == 'success') {
                $solde = $compte->update([
                    'solde' => $montant_solde
                ]);
            }

            return response()->json([
                'status' => 200,
                // 'total_p' => $totalp,
                // 'loyer' => $request->montant_loyer,
                'title' => "Paiement enregistré",
                'message' => "Paiement de loyer du mois de ".$request->periode." effectué avec succès",
            ]);
        }else{
            PaiementLoyer::where(['id'=>$paiement->id])->update(['status_transaction'=>'failed']);

            return response()->json([
                'status' => 401,
                'title' => "Echec",
                'message' => "Enregistrement du paiement echoué",

            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=null, $reference)
    {
        $totalp = 0;
        $paiement = PaiementLoyer::where(['reference'=> $reference])->first();
        $appart = new Appartement;

        $allp = PaiementLoyer::where(['facture_id' => $paiement->facture->id,'status'=> 1,'deleted'=>0])->get();

        // echo "<pre>";print_r($allp);die;

        foreach ($allp as $key => $value) {
            $totalp += $value->montant;
        }

        return view('backend.detail-paiement',compact('paiement','appart','totalp'));

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=null,$reference)
    {
        $paiement = PaiementLoyer::where(['reference'=> $reference])->first();
        if ($paiement->exists()) {
            $paiement->update(['deleted' => 0]);

            return response()->json([
                'status' => 200,
                // 'total_p' => $totalp,
                // 'loyer' => $request->montant_loyer,
                'title' => "Suppression effectuée",
                'message' => "Paiement supprimé avec succès",
            ]);
        }else{
            return response()->json([
                'status' => 401,
                'title' => "Echec",
                'message' => "Echec de suppression du paiement",

            ]);
        }
    }

    public function printReceipt($id = null, $reference)
    {
        // echo "print";die;
        // $total_paiements = 0;
        $reste_a_payer = 0;
        $paiement = PaiementLoyer::with('facture')->where(['reference'=>$reference])->first();

        $paiements = PaiementLoyer::where(['facture_id'=>$paiement->facture->id,'status'=>1])->sum('montant');

        $periode = explode('-',$paiement->facture->periode);

        $loyer =  $paiement->facture->location->appartement->montant_loyer;

        if (isset($loyer)) {
            $reste_a_payer = $loyer - $paiements;
        }



        $quittance = PDF::loadView('pdf.agences.quittance',[
            'paiement' => $paiement,
            'paiements' => $paiements,
            'loyer' => $loyer,
            'reste_a_payer'=>$reste_a_payer,
            'periode'=>$periode
        ]);

         return $quittance->download('quittance_paiement.pdf');
    }
}
