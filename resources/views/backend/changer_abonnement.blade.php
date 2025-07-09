@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Changer abonnement</span></h4>
      <hr class="my-5" />


      <div class="row ">
        @if($forfaits->count() > 0)
          @foreach($forfaits as $forfait)
            <div class="@if($forfaits->count() == 1) col-12 @elseif ($forfaits->count() == 2) col-6 @else  col-4 @endif tabs-formule">
              <form id="changementForfaitAbonnement-{{$forfait->id}}">
                <div class="card mb-4 ">
                  
                  <h5 class="card-header">
                    @if($forfait->periode == "JOUR")
                      Période d'éssai
                    @elseif($forfait->periode == "MENSUEL")
                      Abonnement mensuel
                    @else
                      Abonnement Annuel
                    @endif 
                    @if($abonnement->offre_abonnement_id == $forfait->id && auth()->user()->agence->id == $abonnement->agence_id && auth()->user()->agence->abonne == 1)
                    <span class="badge bg-label-success float-right mx-5">Abonné </span>
                    @endif
                  </h5>
                  <div class="card-body">
                    <p class="card-text ">
                      <h1 class="display-6 mb-0">{{$forfait->net_apres_reduction .' '. ($forfait->devise)}}/{{strtolower($forfait->duree)}} </h1>
                      @if($forfait->montant !== 0)
                      <small class="text-danger"><s><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$forfait->montant .' '. $forfait->devise}} </font></font></s></small>
                      @endif
                      <hr>
                      <i class="bx bx-chevron-right"></i> Accès à toutes les fonctionnalités<br>
                      <i class="bx bx-chevron-right"></i> Durée d'utilisation: {{$forfait->nb_jours}} jours <br>
                      @if($forfait->periode == "JOUR")
                        @if($abonnement->offre_abonnement_id == $forfait->id && auth()->user()->agence->id == $abonnement->agence_id && auth()->user()->agence->abonne == 1 || $abonnement->offre->montant == 0)
                        <i class="bx bx-chevron-right"></i>Expiration le {{$abonnement->date_expiration}}

                        @endif
                      @elseif($forfait->periode == "MENSUEL")
                        <i class="bx bx-chevron-right"></i>Paiement mensuel
                      @else
                        <i class="bx bx-chevron-right"></i>Paiement annuel
                      @endif
                    </p>
                    
                    <input type="hidden" class="offre_abonnement_id" name="offre_abonnement_id" value="{{$forfait->id}}">

                    <input type="hidden" class="offre_abonnement_montant" name="offre_abonnement_montant" value="{{$forfait->net_apres_reduction}}">

                    <input type="hidden" class="offre_abonnement_devise" name="offre_abonnement_devise" value="{{$forfait->devise}}">

                    <input type="hidden" class="abonnement_id" name="abonnement_id" value="{{$abonnement->id}}">

                    <input type="hidden" class="agence_id" name="agence_id" value="{{auth()->user()->agence->id}}">

                    <input type="hidden" class="user_id" name="user_id" value="{{auth()->user()->id}}">

                    <p class="demo-inline-spacing">

                      <button type="submit" class="btn btn-primary me-1 btnChangeForfait" @if($abonnement->offre_abonnement_id == $forfait->id && auth()->user()->agence->id == $abonnement->agence_id && auth()->user()->agence->abonne == 1 || $forfait->montant == 0) disabled  @endif
                        data-bs-toggle="tooltip"
                        title="Choisir ce forfait"
                      >
                         Choisir ce forfait
                      </button>
                     
                    </p>
                    
                  </div>
                </div>
              </form>

            </div>
          @endforeach
        <!-- <div class="col-4">
          <div class="card mb-4">
            <h5 class="card-header">Abonnement Annuel</h5>
            <div class="card-body">
               <p class="card-text ">
                <h1 class="display-6 mb-0">250 000 FCFA (XOF)/mois </h1><small class="text-danger"><s><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">360 000 FCFA (XOF)</font></font></s></small>
                <hr>
                <i class="bx bx-chevron-right"></i> Accès à toutes les fonctionnalités<br>
                <i class="bx bx-chevron-right"></i> Durée d'utilisation: 365 jours<br>
                <i class="bx bx-chevron-right"></i> Paiement annuel
              </p>
              <p class="demo-inline-spacing">
                <button
                  class="btn btn-primary me-1"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseExample"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  Choisir ce forfait
                </button>

                
              </p>

              
            </div>
          </div>
        </div> -->

        @endif
        
      </div>
      <div class="row" style="display: none;">
        <div class="col-md-12">
          

          <div class="mb-3">
            <div class="collapse" id="collapseExample">
              <div class="card">
                  <div class="card-body">

                  <div class="d-grid d-sm-flex p-3 border">
                    <span class="mx-4">
                    Forfait annuel<br>
                    250 000 FCFA
                    </span>
                    <span>
                      Vous souhaitez changer l'offre et basculer sur l'abonnement annuel. Vous serez facturé <b>5 000 FCFA (XOF)</b> comme frais de changement. <br>
                      Pour continuer, veuillez renseigner le numero de votre compte Mobile money ou bancaire sur lequel vous souhaitez être prelever. <br>Si vous avez enregistrer une methode de paiement par défaut le système pourra le prelever sur ce compte par défaut. Dans ce cas veuillez cocher utilisateur le compte de facturation par défaut.
                     
                      <div class="mt-2">
                        <form>
                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" data-bs-toggle="collapse"
                          data-bs-target="#collapseMobile"
                          aria-expanded="false"
                          aria-controls="collapseMobile">
                            <label class="form-check-label" for="inlineRadio1" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Paiement Mobile</font></font></label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Carte Bancaire</font></font></label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Utiliser la methode de paiement par défaut</font></font></label>
                          </div>
                          <!-- PAiement mobile -->
                          
                          <div class="collapse" id="collapseMobile">
                            <div class="d-grid d-sm-flex p-3 border">
                              
                              <span>
                               <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            <label class="form-check-label" for="inlineRadio1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Orange</font></font></label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Moov</font></font></label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">MTN</font></font></label>
                          </div>
                              </span>
                            </div>
                          </div>
                          <button type="button" class="btn btn-primary">Valider</button>
                        </form>
                      </div>
                    </span>
                    
                  </div>
                </div>
            
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                  <h6 class="alert-heading fw-bold mb-1"><i class="bx bx-error"></i> Attention</h6>
                  <p class="mb-0">
                    Tout changement de forfait d'abonnement entrainera des frais de changement. Ces frais peuvent aller jusqu'à 5000 FCFA

                  </p>
                  <p>
                    <b><i class="bx bx-chevron-right"></i> 2 500 FCFA forfait annuel vers forfait mensuel <br>
                    <i class="bx bx-chevron-right"></i> 5 000 FCFA forfait mensuel vers forfait annuel <br></b>
                  </p>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('alerte.loader')
  @stop