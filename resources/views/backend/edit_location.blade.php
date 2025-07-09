@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Location/</span> Nouveau contrat</h4>

      <!-- Basic Layout -->
      <form id="editLocationForm" action="{{-- route('agence.locataire.store',[config('app.locale')]) --}}" enctype="multipart/form-data" method="post"> @csrf
        <div class="row">
          <input type="hidden" name="location_id" value="{{$location->reference}}">
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Locataire</h5>
                <small class="text-muted float-end">Détails</small>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  @if(empty($location->locataire->photo))
                    <img class="card-img card-img-left" src="{{asset('images/avatar.png')}}" alt="{{$location->locataire->name}}" style="width:100px; float: left; margin: 10px;">
                  @else
                    <img class="card-img card-img-left" src="{{asset('storage/images/users/'.$location->locataire->photo)}}" alt="{{$location->locataire->name}}" style="width:100px; float: left;">
                  @endif
                  <h5 class="card-title">{{ucwords($location->locataire->name.' '.$location->locataire->lastname)}}</h5>
                  <p class="card-text">
                    {{$location->locataire->email}}<br>
                    {{$location->locataire->contact.' '.$location->locataire->contact_fixe}}<br>
                    {{$location->locataire->ville.' - '.$location->locataire->country->name}}<br>
                    {{$location->locataire->adresse}} 
                  </p>
                </div>

              </div>
            </div>
            <div class="card">
              <span class="alert alert-warning">Pour changer de locataire veuillez supprimer ou résilier ce contrat</span>
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
                          <option {{$contrat->id == $location->contrat_id ? 'selected' : ' '}} value="{{$contrat->id}}">{{$contrat->libelle}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Appartement</label>
                    <select class="form-select show-tick select_appart" id="inputGroupSelect01" name="appartement">
                        <option selected>{{__('Choisir')}}...</option>
                    
                          @foreach($appartements as $appart)
                            <option {{$appart->id == $location->appartement_id ? 'selected' : ' '}} value="{{$appart->id}}">{{$appart->code_appart}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                    
                    <label for="html5-date-input" class="col-md-6 col-form-label">Date location</label>
                    <div class="col-md-12">
                      <input class="form-control" type="date" value="{{date_format(new \DateTime($location->date_location),'Y-m-d')}}" id="html5-date-input" name="date_location" />
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
                <button type="submit" class="btn btn-info update_location">Enregistrer</button>
                <!-- <a type="button" href="#" class="btn btn-primary">Contrats en cours</a> -->
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="modalinfoappart"></div>

    @include('alerte.loader') 
    
  @stop