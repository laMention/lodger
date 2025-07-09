@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Moyens de paiements / </span>Ajouter</h4>
      <hr class="my-5" />
       <div class="alert alert-warning" role="alert"><i class="bx bx-error"> </i> Si vous n'arrivez pas à ajouter un moyen de paiement, veuillez contacter notre service technique
       </div>
            
      <div class="card mb-4">
            <!-- Account -->
        <div class="card-body">
          <div class="col-md">
            
            <div class="form-check form-check-inline mt-3">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
              <label class="form-check-label" for="inlineRadio1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Carte bancaire</font></font></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
              <label class="form-check-label" for="inlineRadio2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Paiement mobile</font></font></label>
            </div>
            
          </div>
          <div class="form-check form-switch mb-2">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
            <label class="form-check-label" for="flexSwitchCheckChecked"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Je veux sélectionner ce moyen de paiement par défaut dès sa validation.</font></font></label>
          </div>
          <div class="alert alert-info" role="alert"><i class="bx bx-info-circle"> </i> 
            En cochant cette case, vous autorisez Notre système à enregistrer ce moyen de paiement comme moyen de paiement par défaut afin de faciliter le règlement de vos prochais abonnements. Il sera automatiquement utilisé, à chaque nouvelle échéance, pour le paiement de vos services en renouvellement automatique et en paiement à l’usage. Vous pouvez à tout moment modifier des moyens de paiement dans votre espace client. 
          </div>
          <form>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-4">
                  <div class="demo-vertical-spacing demo-only-element">
                    <label>Numéro de la carte </label>
                    <div class="input-group">
                      <span class="input-group-text" id="basic-addon11"><i class="bx bx-credit-card"></i></span>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="1234 5678 9012 3456"
                        aria-label="Numero de la carte"
                        aria-describedby="basic-addon11"
                      />
                    </div>

                    <div class="form-password-toggle">
                      <label class="form-label" for="basic-default-password12">Nom sur la carte</label>
                      <div class="input-group">
                        <span id="basic-default-password2" class="input-group-text cursor-pointer"
                          ><i class="bx bx-user"></i
                        ></span>
                        <input
                          type="text"
                          class="form-control"
                          id="basic-default-password12"
                          placeholder="John Doe"
                          aria-describedby="basic-default-password2"
                        />
                        
                      </div>
                    </div>

                    
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <div class="demo-vertical-spacing demo-only-element">
                    <label>Date d'expiration</label>
                    <div class="input-group">
                      <span class="input-group-text" id="basic-addon11"><i class="bx bx-calendar"></i></span>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="MM/AA"
                        aria-label="MM/AA"
                        aria-describedby="basic-addon11"
                      />
                    </div>

                    <div class="form-password-toggle">
                      <label class="form-label" for="basic-default-password12">CVC/CVV</label>
                      <div class="input-group">
                        <span id="basic-default-password2" class="input-group-text cursor-pointer"
                          ><i class="bx bx-credit-card"></i
                        ></span>
                        <input
                          type="text"
                          class="form-control"
                          id="basic-default-password12"
                          placeholder="3 chiffres"
                          aria-describedby="basic-default-password2"
                        />
                        
                      </div>
                    </div>

                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-4">
                  <div class="demo-vertical-spacing demo-only-element">
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

                    <div class="form-password-toggle">
                      <label class="form-label" for="basic-default-password12">Numéro du compte</label>
                      <div class="input-group">
                        <span id="basic-default-password2" class="input-group-text cursor-pointer"
                          ><i class="bx bx-user"></i
                        ></span>
                        <input
                          type="text"
                          class="form-control"
                          id="basic-default-password12"
                          placeholder="2251234567890"
                          aria-describedby="basic-default-password2"
                        />
                        
                      </div>
                    </div>

                    
                  </div>
                </div>
              </div>
              
            </div>

            <button type="button" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter</font></font></button>
          </form>
          
        </div>
        
        
        <!-- /Account -->
      </div>


  @stop