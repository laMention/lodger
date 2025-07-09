@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Moyens de paiements</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            <caption class="ms-4">
              Liste des moyens de paiements
            </caption>
            <thead>
              <tr>
                <th>#</th>
                <th>Compte</th>
                <th>Libellé</th>
                <th>Date d'expiration</th>
                <th>Paiement auto</th>
                <th>Moyen de paiement par défaut</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach($paiements_mode as $paiement)
                <tr class="moyen_paiement_tr tr{{$paiement->id}}">
                  
                  <td>
                    <input type="hidden" class="moyen_paiement_id" name="moyen_paiement_id" value="{{$paiement->reference}}">
                   {{$paiement->user->name}}
                  </td>
                  <td>{{$paiement->compte}}</td>
                  <td>
                    {{$typepaiements->getType_paiement($paiement->type_paiement)}}
                  </td>
                  <td>
                    @if(isset($paiement->date_expiration) and $paiement->date_expiration !== "")
                    {{$paiement->mois_expiration_carte.'/'.$paiement->date_expiration}}
                    @else
                      <span class="badge bg-info">Paiement par carte non sélectionné</span>
                    @endif
                  </td>
                  <td>
                    @if($paiement->paiement_auto == 1)
                    <span class="badge bg-label-success me-1">Oui</span>
                    @else 
                    <span class="badge bg-label-danger me-1">Non</span>

                    @endif
                  </td>

                  <td>
                    @if($paiement->defaut == 1)
                    <span class="badge bg-label-success me-1">Oui</span>
                    @else 
                    <span class="badge bg-label-danger me-1">Non</span>

                    @endif
                  </td>
                  <td>
                    @if($paiement->etat == 1)
                    <span class="badge bg-label-success me-1">Activé</span>
                    @else 
                    <span class="badge bg-label-danger me-1">Désactivé</span>

                    @endif
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn btn-icon btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModalUpdate{{$paiement->id}}">
                        <span class="tf-icons bx bx-pencil"></span>
                      </button>
                      <!-- <a href="{{route('moyenpaiement.delete',[config('app.locale'),$paiement->reference])}}"> -->
                      <button type="button" class="btn btn-icon btn-outline-danger deletemp"  title="" aria-describedby="popover359940">
                      <!-- <span class="iconify" data-icon="clarity:close-line"></span> -->
                        <span class="tf-icons bx bx-trash"></span>
                      </button>
                      <!-- </a> -->


                    </div>
                  </td>
                  <div class="modal fade" id="exLargeModalUpdate{{$paiement->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel4">Modifier Methode de paiement du locataire {{$paiement->user->name}}</h5>
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          ></button>
                        </div>
                        <form class="UpdatemoyenpaiementForm" id="UpdatemoyenpaiementForm" action="" enctype="multipart/form-data" method="post">
                        <div class="modal-body">
                          <div class="row g-2">
                            <div class="col mb-0">
                              <input type="hidden" name="moyen_paiement_id" value="{{$paiement->reference}}">
                              <label for="locataire" class="form-label">Locataire</label>
                              <input type="text" id="locataire" class="form-control" value="{{$paiement->user->name}}" name="locataire" readonly />
                            </div>
                            <div class="col mb-0">
                              <label for="passerelle" class="form-label">Type de paiement</label>
                              <!-- <input type="text"  name="passerelle" id="passerelle" class="form-control" placeholder="Orange" /> -->
                              <select  class="form-select passerelle" name="passerelle" id="passerelle" >
                                <option value="">Selectionner un type de paiement</option>
                                @foreach($typepaiements->type_paiement() as $key => $type_p)
                                <option {{$paiement->type_paiement == $key ? 'selected' : ''}} value="{{$key}}">{{$type_p}}</option>
                                @endforeach
                              </select>
                              <span class="passerelle_feedback"></span>

                            </div>

                          </div>
                          <div class="row g-2">
                            <div class="col mb-0">
                              <label for="num_compte" class="form-label ">{{__('Numéro du compte')}}</label>
                              <input type="text" id="num_compte" name="num_compte"  class="form-control num_compte" value="{{$paiement->compte}}" />
                              <span class="num_compte_feedback"></span>

                            </div>
                            
                                           
                          </div>
                          
                          <div class="row g-2 cb_option">
                            <div class="col mb-0">
                              <label for="carte_cvc" class="form-label">{{__('CVC')}}</label>
                              <input type="text" id="carte_cvc" name="carte_cvc"  class="form-control carte_cvc" value="{{$paiement->cvc}}" minlength="3" maxlength="3" />
                              <span class="cvc_feedback"></span>

                            </div>

                            <div class="col mb-0 ">
                              <label for="carte_date_expiration" class="form-label">{{__('Date expiration')}}</label>
                              <input type="text" id="carte_date_expiration" name="carte_date_expiration"  class="form-control carte_date_expiration" @if(!empty($paiement->date_expiration)) value="{{$paiement->mois_expiration_carte.'/'. substr($paiement->date_expiration,2,4)}}" @endif />
                              <span class="carte_date_expiration_feedback"></span>

                            </div>
                          
                          </div>
                          
                          <!-- <div  class="row g-2">
                            <div class="col mb-0">
                              <div class="form-check form-switch mb-2 mt-4" >
                                <input class="form-check-input autopayment" type="checkbox"  name="paiement_auto" {{$paiement->paiement_auto == 1 ? "checked" : ''}}>
                                <label class="form-check-label" for="autopayment"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('Activer le paiement automatique')}}</font></font></label>
                              </div>
                            </div>
                            <div class="col mb-0">
                              <div class="form-check form-switch mb-2 mt-4" >
                                <input class="form-check-input defaut" type="checkbox" name="paiement_defaut" {{$paiement->defaut == 1 ? "checked" : ''}}>
                                <label class="form-check-label" for="defaut"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('Utiliser comme moyen de paiement par defaut')}} ?</font></font></label>
                              </div>
                            </div>
                          </div> -->
                           <div  class="row g-2">
                            <div class="col mb-0">
                              <div class="form-check form-switch mb-2 mt-4" >
                                <input class="" type="checkbox" id="autopayment" name="autopayment">
                                <label class="form-check-label" for="autopayment"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activer le paiement automatique</font></font></label>
                              </div>
                            </div>
                            <div class="col mb-0">
                              <div class="form-check form-switch mb-2 mt-4" >
                                <input class="" type="checkbox" id="defaut" name="defaut">
                                <label class="form-check-label" for="defaut"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Utiliser comme moyen de paiement par defaut ?</font></font></label>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                          </button>
                          <button type="button" class="btn btn-primary UpdatemoyenpaiementBtn">Mettre à jour</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>

                </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <div class="buy-now">
      <a href="javascript:void(0);" class="btn btn-danger btn-buy-now"  data-bs-toggle="modal" data-bs-target="#exLargeModal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter</font></font></a>
    </div>
    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel4">{{__('Méthode de paiement')}}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <form class="moyenpaiementForm" id="moyenpaiementForm" action="" enctype="multipart/form-data" method="post">
            <div class="modal-body">
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="locataire" class="form-label">Locataire</label>
                  <select  class="form-select" name="locataire" id="locataire">
                    <option value="">Choisir le locataire</option>

                    @foreach($users as $locataire) 
                      <option value="{{$locataire->id}}">{{$locataire->lastname.' '.$locataire->name}}</option>

                    @endforeach
                  </select>
                  <!-- <input type="text" id="nameExLarge" class="form-control" placeholder="ORGE" /> -->
                  <span class="loc_feedback"></span>

                </div>
                <div class="col mb-0">
                  <label for="passerelle" class="form-label">Type de paiement</label>
                  <!-- <input type="text"  name="passerelle" id="passerelle" class="form-control" placeholder="Orange" /> -->
                  <select  class="form-select passerelle" name="passerelle" id="passerelle">
                    <option value="">Selectionner un type de paiement</option>
                    @foreach($typepaiements->type_paiement() as $key => $type_p)
                    <option value="{{$key}}">{{$type_p}}</option>
                    @endforeach
                  </select>
                  <span class="passerelle_feedback"></span>

                </div>

              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="num_compte" class="form-label">{{__('Numéro du compte')}}</label>
                  <input type="text" id="num_compte" name="num_compte"  class="form-control" placeholder="225XXXXXXXXXX" />
                  <span class="num_compte_feedback"></span>

                </div>
                
                               
              </div>
              <div class="row g-2 cb_option">
                <div class="col mb-0">
                  <label for="carte_cvc" class="form-label">{{__('CVC')}}</label>
                  <input type="text" id="carte_cvc" name="carte_cvc"  class="form-control" placeholder="103" minlength="3" maxlength="3" />
                  <span class="cvc_feedback"></span>

                </div>

                <div class="col mb-0 ">
                  <label for="carte_date_expiration" class="form-label">{{__('Date expiration')}}</label>
                  <input type="text" id="carte_date_expiration" name="carte_date_expiration"  class="form-control" value="mm/aa" />
                  <span class="carte_date_expiration_feedback"></span>

                </div>
              
              </div>
              <div  class="row g-2">
                <div class="col mb-0">
                  <div class="form-check form-switch mb-2 mt-4" >
                    <input class="form-check-input" type="checkbox" id="autopayment"  name="autopayment">
                    <label class="form-check-label" for="autopayment"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activer le paiement automatique</font></font></label>
                  </div>
                </div>
                <div class="col mb-0">
                  <div class="form-check form-switch mb-2 mt-4" >
                    <input class="form-check-input" type="checkbox" id="defaut" name="defaut">
                    <label class="form-check-label" for="defaut"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Utiliser comme moyen de paiement par defaut ?</font></font></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Fermer
              </button>
              <button type="button" class="btn btn-primary btnsave_moyenpaiement" id="">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  @stop