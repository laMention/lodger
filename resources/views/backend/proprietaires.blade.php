@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Propriétaires</span></h4>
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
                <th>Appartements</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($proprietaires as $proprietaire)
                <tr class="liste_proprietaire">
                  <td>
                    <input type="hidden" class="proprietaire_id" value="{{$proprietaire->reference}}">
                    <b>
                      @if(empty($proprietaire->photo))
                        <img src="{{asset('backend/assets/img/avatars/5.png')}}" alt="{{$proprietaire->name}}" class="rounded-circle" width="50" />
                      @else
                        <img src="{{asset('images/users/'.$proprietaire->photo)}}" alt="{{$proprietaire->name}}" class="rounded-circle" width="50" />

                      @endif
                    </b>
                    
                  </td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ucfirst($proprietaire->lastname).' '.strtoupper($proprietaire->name)}}</strong></td>
                  <td>{{$proprietaire->contact}} <br>
                    {{$proprietaire->email}}
                  </td>
                  <td>{{$proprietaire->adresse}}<br>
                    {{$proprietaire->ville.' '.$proprietaire->country->name}}
                  </td>
                  <td><a href="{{route('agence.proprio.appart',[config('app.locale'),strtolower($proprietaire->name)])}}" class="badge bg-label-primary me-1" >{{$proprietaire->appartements->count()}}</a></td>

                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('agence.proprietaire.details',[config('app.locale'),$proprietaire->reference])}}"
                          ><i class="iconify" data-icon="octicon:eye-16"></i> {{__('Détails')}}</a
                        >
                        <a class="dropdown-item" href="{{route('agence.proprietaire.edit',[config('app.locale'),$proprietaire->reference])}}"
                          ><i class="bx bx-edit-alt me-1"></i> {{__('Modifier')}}</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#basicModal"
                          ><i class="iconify" data-icon="octicon:home-16"></i> Ajouter des appartements</a
                        >
                        
                        <a class="dropdown-item delete_proprio" href="javascript:void(0);"
                          ><i class="bx bx-trash me-1"></i> Delete</a
                        >
                        <a class="dropdown-item badge bg-label-danger resilier_contrat_proprio" href="javascript:void(0);"
                          title="Résilier le contrat avec ce Propriétaire" data-bs-toggle="tooltip">
                          <i class="bx bx-exclamation me-1"></i> Résilier
                        </a>
                      </div>
                    </div>

                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel3">Appartement de ce propriétaire</h5>
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
                                    <label for="emailLarge" class="form-label">Libellé</label>
                                    <select class="form-select" id="inputGroupSelect01">
                                        <option selected>Choose...</option>
                                        <option value="1">Studio</option>
                                        <option value="2">2 pièces</option>
                                        <option value="3">3 pièces</option>
                                        <option value="4">4 pièces</option>
                                        <option value="5">5 pièces</option>
                                        <option value="6">Plus de 6 pièces</option>
                                      </select>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobLarge" class="form-label">Catégorie</label>
                                    <select class="form-select" id="inputGroupSelect01">
                                      <option selected>Choose...</option>
                                      <option value="1">Appartement</option>
                                      <option value="2">Villa</option>
                                      <option value="3">Magasin</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="emailLarge" class="form-label">Niveau</label>
                                    <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="1er étage" />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobLarge" class="form-label">Localisation</label>
                                    <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="Abidjan, cocody, riviera faya. Carrefour menuisierie. rue 12" />
                                  </div>
                                </div>
                                
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="emailLarge" class="form-label">Type de contrat</label>
                                    <select class="form-select" id="inputGroupSelect01">
                                      <option selected>Choose...</option>
                                      <option value="1">Bail</option>
                                      <option value="2">Standard</option>
                                    </select>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobLarge" class="form-label">Image de l'appartement</label>
                                     <input type="file" class="form-control" id="inputGroupFile01" />
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-3">
                                    <div class="input-group">
                                      <label class="input-group-text" for="inputGroupSelect01">Description</label>
                                      <textarea id="basic-default-message" class="form-control" placeholder="Salle de séjour etc..."></textarea>
                                    </div>
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
      <a href="{{route('agence.proprietaire.create',[config('app.locale')])}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter</font></font></a>
    </div>

  @stop