@extends('frontend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Loyer / </span>Regler</h4>
      <hr class="my-5" />
      <form>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Facture</h5>
                <!-- <small class="text-muted float-end">Default label</small> -->
              </div>
              <div class="card-body">
                
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Full Facture non soldé</label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                      <option selected>Choisir la facture</option>
                      <option value="1">Fact_mois_dec_2022</option>
                      <option value="2">Fact_mois_avril_2022</option>
                    </select>
                  </div>
                  <div class="col-md">
                      <small class="text-light fw-semibold">Moyen de paiement</small>
                      <div class="form-check mb-3 mt-3">
                        <input
                          name="default-radio-1"
                          class="form-check-input"
                          type="radio"
                          value=""
                          id="defaultRadio1"
                        />
                        <label class="form-check-label" for="defaultRadio1"> Mobile money </label>
                      </div>
                      <div class="form-check">
                        <input
                          name="default-radio-1"
                          class="form-check-input"
                          type="radio"
                          value=""
                          id="defaultRadio2"
                          checked
                        />
                        <label class="form-check-label" for="defaultRadio2"> Carte bancaire </label>
                      </div>
                     
                    </div>
                    <div class="col-md mb-4">
                    <label class="form-label" for="basic-icon-default-fullname">Montant à regler</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-credit-card"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="50000"
                        aria-label="50000"
                        aria-describedby="basic-icon-default-fullname2"
                      />
                    </div>
                  </div>
                  
                  <!-- <button type="submit" class="btn btn-primary">Send</button> -->
              </div>
            </div>
          </div>
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Infos</h5>
                <!-- <small class="text-muted float-end">Merged input group</small> -->
              </div>
              <div class="card-body">
                
                 
                  <div class="mb-3">
                   <p>
                     Fact_mois_dec_2022<br>
                     Payé 60 000 FCFA <br>

                     Reste 5 000 FCFA <br>

                   </p>
                  </div>
                  <button type="submit" class="btn btn-primary">Payer</button>
                
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>
  @stop