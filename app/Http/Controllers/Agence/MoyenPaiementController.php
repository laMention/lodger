<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MoyenPaiement;
use App\Models\User;
use App\Models\Location;

class MoyenPaiementController extends Controller
{
    public function index()
    {
        $user = new User;
        $typepaiements = new MoyenPaiement;
        $users = $user->locataires()->get();
        $paiements_mode = MoyenPaiement::where(['agence_id'=>auth()->user()->agence->id,'etat'=>1])->orderby('type_paiement','asc')->get();

        return view('backend.methodes_paiement',compact('users','typepaiements','paiements_mode'));
    }

    public function store(Request $request)
    {   
        // print_r($request->locataire);die;
        $user = User::where(['id'=>$request->locataire])->first();
        $date_valide = date("y");
        $mois_valide = date("m");

        $agence = auth()->user()->agence->name;

        // echo $agence;die;
        if ($request->autopayment == "on") {
            $autopayment = 1;
        }else{
            $autopayment = 0;
        }
        // $autopayment = $this->autoPaiement($request->autopayment);

        if ($request->defaut == "on") {
            $defaut = 1;
        }else{
            $defaut = 0;
        }

        // $defaut = $this->checkDefaultPayment($request->defaut);
        $numb_ann = 20;
        if ($request->carte_date_expiration !== "mm/aa") {
            $carte_date_expiration =$request->carte_date_expiration;
            $date_exp = explode("/", $carte_date_expiration);

            $date_expi = $numb_ann.''.$date_exp[1];
            $date_expi_mois = $date_exp[0];

            if ($mois_valide > $date_exp[0] && $date_valide > $date_exp[1]) {
                return response()->json([
                        'status' => 401,
                        'title' => "Carte expirée",
                        'message' => "Votre carte a expirée"
                    ]);
            }elseif ($mois_valide <= $date_exp[0] && $date_valide > $date_exp[1]) {
                return response()->json([
                        'status' => 401,
                        'title' => "Carte expirée",
                        'message' => "Votre carte a expirée"
                    ]);
            }
        }else{
            $date_exp = NULL;
            $date_expi = Null;
            $date_expi_mois = Null;
        }

        if (MoyenPaiement::where(['user_id'=>$request->locataire,'type_user'=>$user->type_user,'compte'=>$request->num_compte])->exists()) {
                return response()->json([
                    'status' => 208,
                    'title' => "Déjà enregistré",
                    'message' => "Ce numéro de compte est déjà enregistré"
                ]);
                
            }else{

                

                $savemp = MoyenPaiement::firstOrCreate([
                    'reference' => 'MP'.$agence.''.random_int(1111111, 9999999), 
                    'user_id'=>$request->locataire,
                    'type_user'=>$user->type_user,
                    'description'=>"", 
                    'compte'=>$request->num_compte,
                    'paiement_auto'=>$autopayment,
                    'etat'=>true,
                    'defaut'=> $defaut,
                    'date_expiration'=>$date_expi,
                    'cvc'=>$request->carte_cvc,
                    'agence_id'=>auth()->user()->agence->id,
                    'type_paiement' => $request->passerelle,
                    'mois_expiration_carte' => $date_expi_mois
                ]);
                if ($savemp) {
                    return response()->json([
                    'status' => 200,
                    'title' => "Enregistrement effectué",
                    'message' => "Moyen de paiement sauvegardé avec succès"
                ]);
                }
            }
        

        
    }

    public function update(Request $request,$id=null,$reference){
       $my = MoyenPaiement::where(['reference'=>$request->moyen_paiement_id])->first();
        // $user = User::where(['id'=>$request->locataire])->first();
        $date_valide = date("y");
        $mois_valide = date("m");

        // echo "<pre>";print_r($request->all());die;

        $agence = auth()->user()->agence->name;
        if ($request->autopayment == "on") {
            $autopayment = 1;
        }else{
            $autopayment = 0;
        }
        // $autopayment = $this->autoPaiement($request->autopayment);

        if ($request->defaut == "on") {
            $defaut = 1;
        }else{
            $defaut = 0;
        }

        $numb_ann = 20;
        $date_exp = NULL;
        if (!empty($request->carte_date_expiration)) {

            $carte_date_expiration =$request->carte_date_expiration;
            $date_exp = explode("/", $carte_date_expiration);

            $date_expi = $numb_ann.''.$date_exp[1];
            $date_expi_mois = $date_exp[0];

            if ($mois_valide > $date_exp[0] && $date_valide > $date_exp[1]) {
                return response()->json([
                        'status' => 401,
                        'title' => "Carte expirée",
                        'message' => "Votre carte a expirée"
                    ]);
            }elseif ($mois_valide <= $date_exp[0] && $date_valide > $date_exp[1]) {
                return response()->json([
                        'status' => 401,
                        'title' => "Carte expirée",
                        'message' => "Votre carte a expirée"
                    ]);
            }
        }else{
            $date_exp = NULL;
            $date_expi = Null;
            $date_expi_mois = Null;
        }
       $updatemp = $my->update([
        
            'compte'=>$request->num_compte,
            'paiement_auto'=>$autopayment,
            'etat'=>true,
            'defaut'=> $defaut,
            'date_expiration'=>$date_expi,
            'cvc'=>$request->carte_cvc,
            'agence_id'=>auth()->user()->agence->id,
            'type_paiement' => $request->passerelle,
            'mois_expiration_carte' => $date_expi_mois
        ]);
                if ($updatemp) {
                    return response()->json([
                    'status' => 200,
                    'title' => "Modification effectuée",
                    'message' => "Moyen de paiement Modifié avec succès"
                    ]);
                }else{
                    return response()->json([
                    'status' => 401,
                    'title' => "Echec de la mise à jour",
                    'message' => "Veuillez verifier les information ou contacter votre administrateur"
                    ]);
                }
        
                

                
            
        
    }

    public function autoPaiement($autopayment)
    {
        if ($autopayment == "on") {
            $auto = 1;
        }else{
            $auto = 0;
        }
        return $auto;
        
    }

    public function checkDefaultPayment($defaut)
    {
        if ($defaut == "on") {
            $d = 1;
        }else{
            $d = 0;
        }

        return $d;
    }

    public function destroy($id=null, $reference)
    {
        // 
        $my = MoyenPaiement::where('reference',$reference)->first();
        if (isset($my) || !empty($my)) {
            // code...
            $my->delete();

            return response()->json([
                    'status' => 200,
                    'title' => "Suppression effectuée",
                    'message' => "Moyen de paiement Supprimé avec succès"
                    ]);
        }else{
            return response()->json([
                    'status' => 401,
                    'title' => "Echec de la suppression",
                    'message' => "Impossible de recuperer l'enregistrement"
                    ]);
        }

        

    }
}
