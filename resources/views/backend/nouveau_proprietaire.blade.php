@extends('backend.partials._template')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Proprietaire/</span>Nouveau</h4>

  <!-- Basic Layout -->
  <form id="newProprioForm" action="#" enctype="multipart/form-data" method="post"> @csrf
    <div class="row">
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Propriétaire</h5>
            <small class="text-muted float-end">Informations personnelles</small>
          </div>
          
          <div class="card-body">
              
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="Doe"
                        aria-label="Doe"
                        aria-describedby="basic-icon-default-fullname2"
                        name = "name"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="basic-icon-default-fullname">Prénoms</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="John"
                        aria-label="John"
                        aria-describedby="basic-icon-default-fullname2"
                        name ="lastname"
                      />
                    </div>
                  </div>
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
                    name = "email"
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
                    name = "contact"
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
                    name = "ville"
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
                    <label class="input-group-text" for="inputGroupFile02">Copie CNI</label>
                    <input type="file" class="form-control" id="inputGroupFile02" name="copie_cni" />
                  </div>
              </div>
              <div class="mb-3">
                 <div class="input-group">
                    <label class="input-group-text" for="inputGroupFile02">Photo de profil</label>
                    <input type="file" class="form-control" id="inputGroupFile02" name="image_photo" />
                  </div>
              </div>
              <button type="submit" class="btn btn-info save_proprietaire" data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<i class='bx bx-plus bx-xs' ></i> <span>Enregistrer ce Propriétaire</span>">Enregistrer</button>
              <a type="button" href="{{route('agence.proprietaires',[config('app.locale')])}}" class="btn btn-primary" data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<i class='bx bx-eye bx-xs' ></i> <span>Afficher la liste des Propriétaires</span>">Liste des propriétaires</a>
              
              
            
          </div>
        </div>
      </div>
     
    </div>
  </form>
  @include('alerte.loader') 
</div>
@stop