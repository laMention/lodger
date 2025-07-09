@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Location/</span> Nouveau contrat</h4>

      <!-- Basic Layout -->
      <form id="addLocationForm" action="{{route('agence.locataire.store',[config('app.locale')])}}" enctype="multipart/form-data" method="post"> @csrf
        <div class="row">
          
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Locataire</h5>
                <small class="text-muted float-end">Détails</small>
              </div>
              <div class="card-body">
                
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="John Doe"
                        aria-label="John Doe"
                        aria-describedby="basic-icon-default-fullname2"
                        name="name"
                      />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Prénoms</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="John Doe"
                        aria-label="John Doe"
                        aria-describedby="basic-icon-default-fullname2"
                        name="lastname"
                      />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-email">Email</label>
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                      <input
                        type="text"
                        id="basic-icon-default-email"
                        class="form-control"
                        placeholder="john.doe@example.com"
                        aria-label="john.doe@example.com"
                        aria-describedby="basic-icon-default-email2"
                        name="email"
                      />
                      <!-- <span id="basic-icon-default-email2" class="input-group-text">@example.com</span> -->
                    </div>
                    <div class="form-text">You can use letters, numbers & periods</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-phone">No téléphone</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-phone2" class="input-group-text"
                        ><i class="bx bx-phone"></i
                      ></span>
                      <input
                        type="text"
                        id="basic-icon-default-phone"
                        class="form-control phone-mask"
                        placeholder="2250747098499"
                        aria-label="2250747098499"
                        aria-describedby="basic-icon-default-phone2"
                        name="contact"
                      />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-phone">No téléphone sécondaire</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-phone2" class="input-group-text"
                        ><i class="bx bx-phone"></i
                      ></span>
                      <input
                        type="text"
                        id="basic-icon-default-phone"
                        class="form-control phone-mask"
                        placeholder="2250747098499"
                        aria-label="2250747098499"
                        aria-describedby="basic-icon-default-phone2"
                        name="contact_2"
                      />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-company">Pays</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text"
                        ><i class="bx bx-buildings"></i
                      ></span>
                      <select
                        class="form-select show-tick"
                        id="inputGroupSelectProprioPays"
                        aria-label="Example select with button addon" name="pays_id"
                      >
                        @foreach($countries as $pays)
                          <option value="{{$pays->id}}">{{$pays->name}}</option>
                        @endforeach
                        <option selected value=" ">{{__('Choisir')}}...</option>
                        
                      </select>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-company">Ville</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text"
                        ><i class="bx bx-buildings"></i
                      ></span>
                      <input
                        type="text"
                        id="basic-icon-default-company"
                        class="form-control"
                        placeholder="Abidjan, cocody"
                        aria-label="Abidjan, cocody"
                        aria-describedby="basic-icon-default-company2"
                        name="ville"
                      />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-company">Adresse</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text"
                        ><i class="bx bx-buildings"></i
                      ></span>
                      <input
                        type="text"
                        id="basic-icon-default-company"
                        class="form-control"
                        placeholder="Treichville avenue 13"
                        aria-label="Treichville avenue 13"
                        aria-describedby="basic-icon-default-company2"
                        name="adresse"
                      />
                    </div>
                  </div>

                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupFile01">Photo</label>
                      <input type="file" class="form-control" id="inputGroupFile01" name="image_photo" />
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupFile02">Copie CNI</label>
                      <input type="file" class="form-control" id="inputGroupFile02" name="copie_cni" />
                    </div>
                  </div>

              </div>
            </div>
          </div>
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Contrat</h5>
                <small class="text-muted float-end">Détails</small>
              </div>
              
              <div class="card-body">
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupSelect01">Type de contrat</label>
                      <select class="form-select" id="inputGroupSelect01" name="contrat">
                        <option selected>{{__('Choisir')}}...</option>
                        @foreach($contrats as $contrat)
                          <option value="{{$contrat->id}}">{{$contrat->libelle}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Appartement</label>
                    <select class="form-select show-tick select_appart" id="inputGroupSelect01" name="appartement">
                        <option selected>{{__('Choisir')}}...</option>
                        @if(empty($appartements->location) || $appartements->location->count() == 0 )
                          @foreach($appartements as $appart)
                            <option value="{{$appart->id}}">{{$appart->code_appart}}</option>
                          @endforeach
                        @endif
                      </select>
                  </div>
                  <div class="mb-3">
                    
                    <label for="html5-date-input" class="col-md-6 col-form-label">Date location</label>
                    <div class="col-md-12">
                      <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" name="date_location" />
                    </div>
                  </div>
                  <div class="mb-3">
                    <span class="info_to_print"></span>

                  </div>
                  
                
              </div>
            </div>

             <div class="card mb-4 frais_box" style="display:none;">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Frais</h5>
                <small class="text-muted float-end">Frais à payer</small>
              </div>
              
              <div class="card-body">
                  <span class="badge bg-label-warning">Veuillez cocher les frais que le locataire a payé</span>
                <div class="demo-inline-spacing mb-3">
                  <div class="list-group">
                    <label class="list-group-item">
                      <input class="form-check-input me-1 check_caution" type="checkbox" name="caution">
                      Caution
                      <span class="badge bg-warning float-right paid_caution">En attente</span>
                    </label>
                    <label class="list-group-item">
                      <input class="form-check-input me-1 check_avance" type="checkbox" name="avance">
                      Avance
                      <span class="badge bg-warning float-right paid_avance">En attente</span>
                    </label>
                    <label class="list-group-item">
                      <input class="form-check-input me-1 check_commission" type="checkbox" name="commission" >
                      Commission agence
                      <span class="badge bg-warning float-right paid_commission">En attente</span>
                    </label>
                   
                  </div>
                </div>
              </div>
            </div>
            <div class="card mb-4 ">
              <div class="card-body">
                <button type="submit" class="btn btn-info save_location">Enregistrer</button>
                <a type="button" href="{{route('agence.locations.index',[config('app.locale')])}}" class="btn btn-primary">Contrats en cours</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="modalinfoappart"></div>

    @include('alerte.loader') 
    
  @stop