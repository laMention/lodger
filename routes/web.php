<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Agence\IndexController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\Agence\AppartementController;
use App\Http\Controllers\Agence\ContratController;
use App\Http\Controllers\Agence\ProprietaireController;
use App\Http\Controllers\Agence\LocationController;
use App\Http\Controllers\Agence\LocataireController;
use App\Http\Controllers\Agence\PaiementLoyerController;
use App\Http\Controllers\Agence\FactureController;
use App\Http\Controllers\Agence\IncidentController;
use App\Http\Controllers\Agence\MoyenPaiementController;
use App\Http\Controllers\Agence\ReparationController;
use App\Http\Controllers\Agence\UserController;
use App\Http\Controllers\Agence\AgenceController;
use App\Http\Controllers\Agence\AbonnementController;
use App\Http\Controllers\Agence\OperationController;
use App\Http\Controllers\HomeController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home',[HomeController::class,'index'])->name('home');

Route::get('/',[LoginController::class,'showLoginForm'])->name('login');
Route::get('login',[LoginController::class,'showLoginForm'])->name('login');
Route::get(sha1('register'),[RegisterController::class,'showRegistrationForm'])->name('register');
Route::get('verifyEmail',[AgenceController::class,'showverifyEmailForm'])->name('verifyEmail');
Route::post('register',[RegisterController::class,'register'])->name('register');
Route::post('resendCodeEmail',[AgenceController::class,'resendCodeEmail'])->name('resendCodeEmail');
// Route::post('verifyEmail',[AgenceController::class,'verifyEmail'])->name('verifyEmail');

/*faire un middleware*/
Route::post('verifyEmail',[AgenceController::class,'verifyEmail'])->name('verifyEmail');
Route::get(sha1('goforfait'),[AgenceController::class,'showForfaitForm'])->name('forfait');
Route::post('proceedToPayment',[AgenceController::class,'proceedToPayment'])->name('proceedToPayment');
Route::get(sha1('payment_mode'),[AgenceController::class,'showPaymentForm'])->name('payment_mode');
Route::post('checkout',[AgenceController::class,'checkout'])->name('checkout');
Route::get('confirm-password',[AgenceController::class,'confirmPaswwordForm'])->name('confirmPaswwordForm');
Route::post('create-password',[AgenceController::class,'createPassword'])->name('createPwd');



Route::post('login',[LoginController::class,'login'])->name('login');
// Route::post('login',[LoginController::class,'login'])->name('login');
Route::get('logout',[LoginController::class,'logout'])->name('logout');

Route::prefix('{locale}')->group(function($locale){   
    
    Route::middleware('auth')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::prefix('connected/company')->group(function(){
            Route::get('', [IndexController::class,'index'])->name('agence.index');
            Route::get(sha1('dashboard'), [IndexController::class,'index'])->name('agence.index');
            Route::get(sha1('appartements'), [AppartementController::class,'index'])->name('agence.appartements');
            Route::get(sha1('nouvel-appart'), [AppartementController::class,'create'])->name('agence.nouvel-appart');

            Route::post('appartement/store', [AppartementController::class,'store'])->name('agence.appart.store');

            Route::get('{code_appart}/'.sha1('details'),[AppartementController::class,'show'])->name('agence.appart.details');
            Route::get('{code_appart}/'.sha1('appartement/edit'),[AppartementController::class,'edit'])->name('agence.appart.edit');
            Route::post('appartement/update/{code_appart}',[AppartementController::class,'update'])->name('agence.appart.update');

            Route::get(sha1('appartement/delete').'/{code_appart}',[AppartementController::class,'destroy'])->name('agence.appart.delete');

            Route::get(sha1('proprietaire-appartements').'/{name}',[AppartementController::class,'appartOwner'])->name('agence.proprio.appart');

            Route::get(sha1('type-contrats'),[ContratController::class,'index'])->name('agence.typecontrats');

            Route::get(sha1('modèle-contrat'),[ContratController::class,'modele'])->name('agence.modelecontrats');

            Route::post('type-contrat/store',[ContratController::class,'store'])->name('agence.typecontrat.store');
            Route::post('type-contrat/update',[ContratController::class,'update'])->name('agence.typecontrat.update');
            Route::get(sha1('type-contrat/delete').'/{reference}',[ContratController::class,'destroy'])->name('agence.typecontrat.delete');

            Route::get(sha1('proprietaires'),[ProprietaireController::class,'index'])->name('agence.proprietaires');

            Route::get(sha1('proprietaire').'/{reference}',[ProprietaireController::class,'show'])->name('agence.proprietaire.details');

            Route::get(sha1('proprietaires/create'),[ProprietaireController::class,'create'])->name('agence.proprietaire.create');
            Route::post('proprietaires/store',[ProprietaireController::class,'store'])->name('agence.proprietaire.store');
            Route::get(sha1('proprietaires/edit').'/{reference}',[ProprietaireController::class,'edit'])->name('agence.proprietaire.edit');
            Route::post('proprietaires/update',[ProprietaireController::class,'update'])->name('agence.proprietaire.update');
            
            Route::get(sha1('proprietaires/delete').'/{reference}',[ProprietaireController::class,'destroy'])->name('agence.proprietaire.delete');
            Route::get(sha1('proprietaires/resilier-contrat').'/{reference}',[ProprietaireController::class,'resilier'])->name('agence.proprietaire.resilier');

            Route::get(sha1('locataires'),[LocataireController::class,'index'])->name('agence.locataires.index');

            Route::get(sha1('location/create'),[LocationController::class,'create'])->name('agence.locataires.create');

            Route::get('getInfoAppart',[LocationController::class,'getInfoAppart'])->name('agence.getInfoAppart');

            Route::post('location/store',[LocationController::class,'store'])->name('agence.locataire.store');

            Route::get('print-pdf-contrat/{reference}',[LocationController::class,'generateContratPdf'])->name('generateContratPdf');

            Route::get(sha1('locataire/edit/').'{reference}',[LocataireController::class,'edit'])->name('agence.locataire.edit');

            Route::get(sha1('locataire/details/').'{reference}',[LocataireController::class,'show'])->name('agence.locataire.details');

            Route::post('locataire/update/',[LocataireController::class,'update'])->name('agence.locataire.update');
            
            Route::get('locataire/resilier/{reference}',[LocataireController::class,'destroy'])->name('agence.locataire.resilier');

            Route::get(sha1('locations'),[LocationController::class,'index'])->name('agence.locations.index');

            Route::get(sha1('locations/details').'/{reference}',[LocationController::class,'show'])->name('agence.locations.details');

            Route::get(sha1('locations/edit').'/{reference}',[LocationController::class,'edit'])->name('agence.locations.edit');

            Route::post('location/update/',[LocationController::class,'update'])->name('agence.location.update');

            Route::get('locations/delete/{reference}',[LocationController::class,'destroy'])->name('agence.locations.delete');

            Route::get('locations/resilier/{reference}',[LocationController::class,'resilier'])->name('agence.locations.resilier');

            Route::get(sha1('/locations/').'/{reference}'.sha1('/factures'), [LocationController::class,'factures'])->name('factures.locataires');

            Route::post('/factures/payer', [PaiementLoyerController::class,'store'])->name('paiementloyer.store');

            // Route::get('/factures/print', [PaiementLoyerController::class,'print'])->name('facture.print');
            Route::get(sha1('details/facture').'/{reference}', [FactureController::class,'show'])->name('factures.details');
            Route::get(sha1('factures'), [FactureController::class,'index'])->name('factures.index');
            Route::get(sha1('print/facture/').'/{reference}', [FactureController::class,'print'])->name('agence.factures.print');

            Route::get(sha1('paiements-loyer'), [PaiementLoyerController::class,'index'])->name('paiements.index');
            Route::get(sha1('paiement-loyer/details/').'/{reference}', [PaiementLoyerController::class,'show'])->name('paiements.show');
            Route::get(sha1('paiements'), [PaiementLoyerController::class,'paiements'])->name('paiements.all');
            Route::get(sha1('incidents'), [IncidentController::class,'index'])->name('incidents.index');
            Route::get('incident/mark-as-done/{reference}', [IncidentController::class,'update'])->name('incidents.markasdone');
            Route::get('incident-read/{reference}', [IncidentController::class,'markAsRead'])->name('incidents.read');
            Route::get('incident/delete/{reference}', [IncidentController::class,'destroy'])->name('incidents.delete');


            Route::get(sha1('moyens-paiement'), [MoyenPaiementController::class,'index'])->name('moyenpaiment.index');
            Route::post('store-moyen-paiement', [MoyenPaiementController::class,'store'])->name('moyenpaiment.store');
            Route::post('update-moyen-paiement', [MoyenPaiementController::class,'update'])->name('moyenpaiment.update');
            Route::get('delete-moyen-paiement/{reference}', [MoyenPaiementController::class,'destroy'])->name('moyenpaiement.delete');

            Route::get(sha1('/reparations'), [ReparationController::class,'index'])->name('reparations.index');
            Route::get('reparation-read/{reference}', [ReparationController::class,'markAsRead'])->name('reparation.read');
            Route::get('reparation/delete/{reference}', [ReparationController::class,'destroy'])->name('reparation.delete');

            Route::get(sha1('user/profil'), [UserController::class,'profil'])->name('agence.user.profil');
            Route::post('user/profil/update', [UserController::class,'update'])->name('agence.user.profil.update');
            Route::post('user/profil/update', [UserController::class,'update'])->name('agence.user.profil.update');
            Route::post('user/avatar/upload', [UserController::class,'uploadProfilPicture'])->name('agence.user.avatar.upload');

            Route::get(sha1('user/password'), [UserController::class,'password'])->name('agence.user.password');
            Route::post('user/password/update', [UserController::class,'updatepwd'])->name('agence.user.update.password');

            Route::get(sha1('agence/infos'), [AgenceController::class,'show'])->name('agence.infos');
            Route::get(sha1('agence/edit'), [AgenceController::class,'edit'])->name('agence.edit');
            Route::post('agence/update', [AgenceController::class,'update'])->name('agence.update');
            Route::post('agence/upload-image', [AgenceController::class,'uploadPicture'])->name('agence.image.upload');

            Route::get(sha1('/changer-abonnement'), [AbonnementController::class,'index'])->name('changeAbonnement');
            Route::post('/forfait-changement', [AbonnementController::class,'changerForfait'])->name('changerForfait');
            Route::get(sha1('/abonnement'), [AbonnementController::class,'abonnement'])->name('abonnement');
            Route::get(sha1('/operations'), [OperationController::class,'index'])->name('operations');
            Route::post('/store-operations', [OperationController::class,'store'])->name('operations.store');

            

            Route::get('/generation-invoice',[FactureController::class,'generationFacture'])->name('generation_facture');

            Route::get(sha1('/contrats/resiliations'),[ContratController::class,'resiliations'])->name('resiliations');
            Route::get('/contrats/rompre/{reference}',[ContratController::class,'rompreContrat'])->name('rompre-contrat');
            Route::get('/contrats/rompre/annuler/{reference}',[ContratController::class,'annulerRuptureContrat'])->name('annuler-rompre-contrat');

            Route::get('/print-receipt/{reference}',[PaiementLoyerController::class,'printReceipt'])->name('printReceipt');


            Route::get('paiement-renouvellement',[AbonnementController::class,'paymentpage'])->name('paiement-renouvellement');
            
            Route::get('paiement-renouvellement',[AbonnementController::class,'paymentpage'])->name('paiement-renouvellement');
            Route::post('paiement-renouvellement',[AbonnementController::class,'renouveller'])->name('renouveller');

            Route::get(sha1('/facturation'), [AbonnementController::class,'facturation'])->name('facturation_abonnement');
            Route::get(sha1('/historique-abonnements'), [AbonnementController::class,'historique'])->name('historique');


        });




        Route::prefix('user/locataire')->group(function(){
            Route::get('', [AccountController::class,'index'])->name('locataire.index');
            Route::get('index', [AccountController::class,'index'])->name('locataire.index');
        });
        
        
        
    });
    
});



Route::get('/facturation/paiments', function () {
    return view('backend.facturation_paiments');
});
Route::get('/historique-operations', function () {
    return view('backend.historique_operations');
});
Route::get('/facturation/paiments/details', function () {
    return view('backend.details_paiement_facturation');
});
Route::get('/paiements/methodes', function () {
    return view('backend.moyens_paiement');
});
Route::get('/paiements/methode/ajouter', function () {
    return view('backend.add_moyen_paiement');
});
Route::get('/stats/locations', function () {
    return view('backend.stats_location');
});
Route::get('/stats/paiements', function () {
    return view('backend.stats_paiements');
});
Route::get('/stats/analytics', function () {
    return view('backend.stats_analytics');
});


Route::get('/locataire/loyer', function () {
    return view('frontend.loyer');
});
Route::get('/locataire/loyer/regler', function () {
    return view('frontend.regler_loyer');
});
Route::get('/locataire/paiements/mes-paiements', function () {
    return view('frontend.mes_paiements');
});
Route::get('/locataire/paiements/moyens-paiement', function () {
    return view('frontend.moyens_paiement');
});
Route::get('/locataire/paiements/moyens-paiement/ajouter', function () {
    return view('frontend.nouveau_moyens_paiement');
});
Route::get('/locataire/factures/', function () {
    return view('frontend.factures');
});
Route::get('/locataire/resiliation/', function () {
    return view('frontend.resiliation');
});
Route::get('/locataire/incidences/', function () {
    return view('frontend.incidences');
});
Route::get('/locataire/incidences/nouveau', function () {
    return view('frontend.declarer-incidence');
});
Route::get('/locataire/reparations/', function () {
    return view('frontend.reparations');
});
Route::get('/locataire/suggestions', function () {
    return view('frontend.suggestions');
});
Route::get('/locataire/suggestions/nouveau', function () {
    return view('frontend.envoyer-suggestion');
});

Route::prefix('admin/security-access/')->group(function () 
{
    Route::get('index', function () {
        return view('admin.auth.login');
    });
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    });
});
Auth::routes();


// Illuminate\Support\Facades\App\Http\Controllers\HomeController@index