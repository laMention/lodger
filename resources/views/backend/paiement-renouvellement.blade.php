@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Abonnement</span>/Renouveller</h4>
      <hr class="my-5" />
      <div class="row">
        <div class="col-lg-12 mb-4 order-0 mb-4">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="card-body">
                <h5 class="card-title text-primary">Votre abonnement actuel</h5>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="card-header">
                <h3>PAIEMENT</h3>
              </div>
              <div class="card-body">
                <form id="renouvellementForm" method="POST" enctype="multipart/form-data">@csrf
                   <div class="row gy-3">
                    <div class="col-md">
                      <!-- <small class="text-light fw-semibold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Radio</font></font></small> -->
                      <div class="form-check mt-3 ">
                        <input name="optionPaiementMode" class="form-check-input transformcursor" type="radio" value="mobile money" id="mobileMoney" checked="">
                        <label class="form-check-label transformcursor" for="mobileMoney"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">VIA MOBILE MONEY</font></font></label>
                      </div>
                    </div>
                    <div class="col-md">
                      
                      <div class="form-check mt-3 ">
                        <input name="optionPaiementMode" class="form-check-input transformcursor" type="radio" value="carte bancaire" id="bankwire" >
                        <label class="form-check-label transformcursor" for="bankwire"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> PAR CARTE BANCAIRE</font></font></label>
                      </div>
                      
                    </div>
                  </div>

                  <div class="mobile-money-section">
                  <div class="row gy-3">
                    
                    <div class="col-md">
                      <!-- <small class="text-light fw-semibold d-block"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Radio en ligne</font></font></small> -->
                      <div class="form-check form-check-inline mt-3 ">
                        <input class="form-check-input transformcursor valueOption " type="radio" name="operateur" id="checkedorange" value="orange" style="display:none;">
                        <label class="form-check-label transformcursor check-money orangechecked" for="checkedorange"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><img src="{{asset('storage/OrangeMoney.jpg')}}" width="100px;"></font></font></label>
                      </div>
                      <div class="form-check form-check-inline ">
                        <input class="form-check-input transformcursor valueOption " type="radio" name="operateur" id="checkedmtn" value="mtn" style="display:none;">
                        <label class="form-check-label transformcursor check-money mtnchecked" for="checkedmtn"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><img src="{{asset('storage/mtn.png')}}" width="114px;"></font></font></label>
                      </div>
                      <div class="form-check form-check-inline ">
                        <input class="form-check-input transformcursor valueOption " type="radio" name="operateur" id="checkedmoov" value="moov"  style="display:none;">
                        <label class="form-check-label transformcursor check-money moovchecked" for="checkedmoov"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><img src="{{asset('storage/moov-money.png')}}" width="114px;"></font></font></label>
                      </div>
                    </div>

                    

                  </div>
                </div>

                <div class="mt-2">
                      <input id="country_code" class="form-control form-control-lg" type="hidden"  name="country_code" value="CI">
                      
                      <input type="hidden" name="abonnement_id" value="{{$abonnement->id}}">
                      <input type="hidden" name="offre_abonnement_id" value="{{$abonnement->offre->id}}">
                      <input type="hidden" name="montant_abn" value="{{$abonnement->offre->net_apres_reduction}}">
                      <input type="hidden" name="devise" value="{{$abonnement->offre->devise}}">
                      <input type="hidden" name="montant_paiement" value="{{$abonnement->offre->net_apres_reduction}}">

                      <div class="mt-2 mb-3">
                        <label for="accountNber" class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Numéro de compte</font></font></label>
                        <input id="accountNber" class="form-control form-control-lg" type="text"  name="account">
                        <span class="error_accountNber"></span>
                      </div>
                      <div class="cb_section" style="display:none;">
                        <div class="mb-3">
                          <label for="date_expi" class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Expiration</font></font></label>
                          <input id="date_expi" name="carte_date_expiration" class="form-control" type="text" placeholder="Entrée par défaut" value="mm/yy">
                          <span class="error_date_expi"></span>
                        </div>
                        <div>
                          <label for="cvc" class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CVC</font></font></label>
                          <input id="cvc" name="cvc" class="form-control form-control-lg" type="text" placeholder="" maxlength="3">
                          <span class="error_cvc"></span>

                        </div>
                      </div>
                    </div>
                    <hr class="m-0">
                    <div class="mt-2 mb-3 ml-5">
                      <button type="button" id="validerBtn" class="btn btn-danger validerBtn">Continuer</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  @stop