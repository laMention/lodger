<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facture;
use PDF;
use App\Models\User;
use App\Models\Location;
use App\Models\PaiementLoyer;
use App\Models\Appartement;
use App\Http\Traits\Generator;
use Carbon\Carbon;
use Auth;
use DB;


class FactureController extends Controller
{
    use Generator;

    public function index()
    {
        $factures = Facture::with('paiement_loyers')->where(['agence_id'=>auth()->user()->agence->id,'etat'=>1,'deleted'=>0])->get();
        // dd($factures);
        $invoice = new Facture;
        $appart = new Appartement;
        return view('backend.loyers',compact('factures','invoice','appart'));

    }
    public function print($id=null,$reference)
    {
        $facture = Facture::with('location','paiement_loyers','locataire','agence')->where(['reference'=>$reference])->first();
        $appart = new Appartement;

        $paiements = PaiementLoyer::where(['facture_id'=>$facture->id,'status'=>1])->sum('montant');

        $dernier_p = PaiementLoyer::where(['facture_id'=>$facture->id,'status'=>1])->latest('id')->first();

        $invoice = PDF::loadView('pdf.agences.locataires.facture',[
            'invoice' => $facture,
            'paiements'=>$paiements,
            'appart'=>$appart,
            'dernier_p'=>$dernier_p
        ]);

        return $invoice->stream('facture'.$facture->reference.'pdf');
    }

    public function show($id=null,$reference)
    {
        $facture = Facture::where(['reference'=>$reference])->first();
        $invoice = new Facture;
        $appart = new Appartement;

        $paiements = PaiementLoyer::where(['facture_id'=>$facture->id,'status'=>1])->sum('montant');

       // echo  date('F Y',strtotime($facture->next_date_echeance));die;

        return view('backend.detail_facture',compact('facture','invoice','paiements','appart'));
    }


    public function generationFacture()
    {
        $prefix = 'FAC-';

        // $this->info('Generate Facture: cron run successfully');
        $arr_location = Location::where(['agence_id'=>auth()->user()->agence->id,'etat' => 1,'deleted'=>0,'archived'=>0])->get();

        if (count($arr_location) > 0) {
            foreach ($arr_location as $key => $value) {
                // verifier si une facture existe pour une location donnée
                $factures = Facture::where(['etat' => 1,'location_id'=>$value->id])->get();
               

                if (count($factures) <= 0) {
                    // Si aucune facture n'existe dans la base de données
                    $facture = Facture::create([
                        'periode' => date('F Y',strtotime($value->date_location)) .'-'.date('F Y',strtotime($value->date_location.'+ 30 days')),
                        'user_id' => $value->user_id,
                        'location_id' => $value->id,
                        'fichier' => NULL,
                        'etat' => 1,
                        'status' => 0,
                        'agence_id' => $value->agence_id,
                        'locataire_id' => $value->locataire_id,
                        'date_echeance' => date('Y-m-d H:i:s',strtotime($value->date_location.'+ 30 days')),
                        'next_date_echeance' => NULL
                    ]);
                    if ($facture) {
                        Facture::where(['id'=>$facture->id])->update([
                        'reference' =>$prefix. $this->reference(),
                        'next_date_echeance' => date('Y-m-d H:i:s',strtotime($facture->date_echeance.'+ 30 days'))]);
                    }
                }else{
                    // Si une facture existe
                    $facture = Facture::latest('id')->first();

                    $next_facture = Facture::create([
                        // 'reference' => $this->reference(),
                        
                        'periode' =>date('F Y',strtotime($facture->next_date_echeance)).'-'. date('F Y',strtotime($facture->next_date_echeance.'+ 30 days')),
                        'user_id' =>  $value->user_id,
                        'location_id' => $value->id,
                        'fichier' => NULL,
                        'etat' => 1,
                        'status' => 0,
                        'agence_id' => $value->agence_id,
                        'locataire_id' => $value->locataire_id,
                        'date_echeance' => date('Y-m-d H:i:s',strtotime($facture->next_date_echeance.'+ 30 days')),
                        'next_date_echeance' => NULL
                    ]);

                    if ($next_facture) {
                        Facture::where(['id'=>$next_facture->id])->update([
                            'reference' =>$prefix. $this->reference(),

                            'next_date_echeance' => date('Y-m-d H:i:s',strtotime($next_facture->date_echeance.'+ 30 days'))]);
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'title' => 'Factures générées',
                'message' => "Génération effectuée avec succès"
            ]);
        }else{
            return response()->json([
                'status' => 401,
                'title' => 'Génération impossible',
                'message' => "Aucune donnée n'a été trouvée"
            ]);
        }



    }
}
