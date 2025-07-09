<?php

namespace App\Http\Controllers\Agence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Http\Traits\FileTrait;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    use FileTrait;
    //
    public function profil()
    {
        $breadcrumbs = '<span class="text-muted fw-light">Mon compte /</span> Account';
        $countries = Country::whereEtat(1)->get();
        
        return view('backend.Auth.User.profil',compact("breadcrumbs",'countries'));
    }
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        // Verification de la date de naissance
       
        // $second = new \DateTime($user->date_naissance);
        if (isset($user)) {


            if ($this->datediff($user->date_naissance) < 18) {
                return response()->json([
                    'status' => 401,
                    'title' => "Echec",
                    'message' => "Veuillez verifier l'âge avant de continuer"
                ]);
            }else{
                $update = $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'lastname' => $request->lastname,
                    'date_naissance' => $request->date_naissance,
                    'contact' => $request->contact,
                    'contact_fixe' => "",
                    'num_cni' => $request->num_cni,
                    'adresse' => $request->adresse,
                    'sexe' => $request->sexe,
                    'ville' => $request->ville,
                    'country_id' => $request->country,
                ]);

                if ($update) {
                    return response()->json([
                        'status' => 200,
                        'title' => "Succès",
                        'message' => "Modification effectuée",
                    ]);
                }else{
                    return response()->json([
                        'status' => 401,
                        'title' => "Echec",
                        'message' => "Veuillez verifier la connexion au serveur"
                    ]);
                }
            }                       
        }else{
            return response()->json([
                    'status' => 401,
                    'title' => "Echec",
                    'message' => "Impossible de retrouver vos informations, veuillez vous reconnecter"
                ]);
        }
        
    }

    public function uploadProfilPicture(Request $request)
    {
       $this->uploadImage('users',$request->file('avatar'),'/users/profil/pictures/',auth()->user()->id,'photo');
        
    }

    public function password(){
        $breadcrumbs = '<span class="text-muted fw-light">Mon compte /</span> Account';
        return view('backend.Auth.User.password',compact("breadcrumbs"));
    }

    public function updatepwd(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if (isset($user)) {
            $update = $user->update([
                    'password' => Hash::make($request->password)
                ]);
            if ($update) {
                return response()->json([
                        'status' => 200,
                        'title' => "Succès",
                        'message' => "Modification effectuée",
                    ]);
            }else{
                return response()->json([
                        'status' => 401,
                        'title' => "Echec",
                        'message' => "Impossible de mettre à jour le mot de passe"
                    ]);
            }
        }else{
            return response()->json([
                    'status' => 401,
                    'title' => "Echec",
                    'message' => "Impossible de retrouver vos informations, veuillez vous reconnecter"
                ]);
        }
    }

    public function datediff($user_birthdate)
    {
        $firstDate = date("Y-m-d");

        $dateDifference = abs(strtotime($user_birthdate) - strtotime($firstDate));

        $years  = floor($dateDifference / (365 * 60 * 60 * 24));

        return $years;
    }

   
}
