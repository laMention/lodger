@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Locataires</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            
            <thead>
              <tr>
                <th>Photo</th>
                <th>Nom complet</th>
                <th>Contact</th>
                <th>Adresse</th>
                <th>Bien.s loué</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($locataires as $loc)
                <tr class="liste_locataire">
                  <td>
                    <input type="hidden" class="locataire_id" value="{{$loc->reference}}">
                    <b>
                      @if(empty($loc->photo))
                        <img src="{{asset('images/avatar.png')}}" alt="{{$loc->name}}" class="rounded-circle" width="50" />
                      @else
                        <img src="{{asset('storage/images/users/'.$loc->photo)}}" alt="{{$loc->name}}" class="rounded-circle" width="50" />

                      @endif
                    </b>
                    
                  </td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$loc->name.' '.$loc->lastname}}</strong></td>
                  <td>{{$loc->contact.' - '.$loc->contact_fixe}} <br>
                    {{$loc->email}}
                  </td>
                  <td>{{substr($loc->adresse,0,36)}}...<br>
                    {{$loc->ville.' - '.$loc->country->name}}
                  </td>
                  <td>

                    @foreach($loc->locations as $appart)
                      <a href="{{ route('agence.appart.details',[config('app.locale'),$appart->appartement->code_appart]) }}" class="badge bg-label-primary me-1" >
                        {{$appart->appartement->code_appart}}
                      </a>
                    
                    @endforeach
                  </td>
                  
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('agence.locataire.details',[config('app.locale'),$loc->reference])}}"
                          ><i class="iconify" data-icon="octicon:eye-16"></i> Détails</a
                        >
                        <a class="dropdown-item" href="{{route('agence.locataire.edit',[config('app.locale'),$loc->reference])}}"
                          ><i class="bx bx-edit-alt me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#basicModal"
                          ><i class="iconify" data-icon="octicon:home-16"></i> Ajouter des appartements</a
                        >
                        <!-- <a class="dropdown-item" href="javascript:void(0);"
                          ><i class="bx bx-trash me-1"></i> Delete</a> -->
                          <a class="dropdown-item badge bg-label-danger resilier_contrat_location" href="javascript:void(0);"
                          title="Résilier le contrat avec ce locataire" data-bs-toggle="tooltip">
                          <i class="bx bx-exclamation me-1"></i> Résilier
                        </a>
                      </div>
                    </div>

                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel3">Nouveau contrat de location Botchi</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="emailLarge" class="form-label">Appartement</label>
                                    <select class="form-select" id="inputGroupSelect01">
                                      <option selected>Choose...</option>
                                      <option value="1">Appartement_00002</option>
                                      <option value="2">Appartement_00004</option>
                                      <option value="3">Appartement_00005</option>
                                      <option value="4">Villa_00002</option>
                                      <option value="5">Maison_00001</option>
                                    </select>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobLarge" class="form-label">Type de contrat</label>
                                    <select class="form-select" id="inputGroupSelect01">
                                      <option selected>Choose...</option>
                                      <option value="1">Bail</option>
                                      <option value="2">Location particulier</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label class="form-label" for="basic-icon-default-fullname">Localisation</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="basic-icon-default-fullname"
                                      aria-describedby="basic-icon-default-fullname2" disabled
                                      value="Abidjan cocody riviera faya"
                                    />
                                  </div>
                                  <div class="col mb-0">
                                    <label class="form-label" for="basic-icon-default-fullname">Loyer</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="basic-icon-default-fullname"
                                      placeholder="John Doe"
                                      aria-label="John Doe"
                                      aria-describedby="basic-icon-default-fullname2"
                                       disabled value="60 000 FCFA/Mois"
                                    />
                                  </div>
                                  <div class="col mb-0">
                                    <label class="form-label" for="basic-icon-default-fullname">Caution</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="basic-icon-default-fullname"
                                      placeholder="John Doe"
                                      aria-label="John Doe"
                                      aria-describedby="basic-icon-default-fullname2"
                                       disabled value="120 000 FCFA"
                                    />
                                  </div>
                                  <div class="col mb-0">
                                    <label class="form-label" for="basic-icon-default-fullname">Avance</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="basic-icon-default-fullname"
                                      placeholder="John Doe"
                                      aria-label="John Doe"
                                      aria-describedby="basic-icon-default-fullname2"
                                       disabled value="120 000 FCFA"
                                    />
                                  </div>
                                </div>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Fermer
                                </button>
                                <button type="button" class="btn btn-info">Enregistrer</button>
                                <button type="button" class="btn btn-danger">Enregistrer et nouveau</button>

                              </div>
                            </div>
                          </div>
                    </div>
                    
                  </td>

                </tr>
             @endforeach
              
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <div class="buy-now">
      <a href="{{route('agence.locataires.create',[config('app.locale')])}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nouveau contrat de location</font></font></a>
    </div>

  @stop