@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Type de contrat</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            <caption class="ms-4">
              Liste des contrats créés
            </caption>
            <thead>
              <tr>
                <th>N°</th>
                <th>Contrat</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($contrats as $row => $contrat)
              <tr class="liste_contrat">
                <td>
                  <input type="hidden" value="{{$contrat->reference}}" class="ref_contrat">
                 {{++$row}}
                </td>
                <td>{{$contrat->libelle}}</td>
                <td>
                 {!! $contrat->description !!}
                </td>
                <td>
                  @if($contrat->etat == 1)
                    <span class="badge bg-primary me-1">Activé</span>
                  @else
                    <span class="badge bg-primary me-1">Désactivé</span>

                  @endif
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn btn-icon btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$contrat->id}}">
                      <span class="tf-icons bx bx-pencil"></span>
                    </button>

                    <button type="button" class="btn btn-icon btn-outline-danger delete_contrat" title="Supprimer ce contrat" data-bs-original-title="Suppression" aria-describedby="popover359940">
                      <span class="tf-icons bx bx-trash"></span>
                    </button>


                  </div>
                </td>
              </tr>
              <div class="modal fade" id="editModal{{$contrat->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1">Modifier ce contrat {{$contrat->reference}}</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <form id="editContratForm" action="#" enctype="multipart/form-data" method="post"> @csrf
                      <div class="modal-body">
                        <div class="row">
                          <input type="hidden" name="contrat_ref" value="{{$contrat->reference}}" class="ref_contrat">
                          <div class="col mb-3">
                            <label for="nomContrat" class="form-label">Type de contrat</label>
                            <input type="text" id="nomContrat" class="form-control" placeholder="Bail" name="libelle" value="{{$contrat->libelle}}" />
                          </div>
                        </div>
                        <div class="row ">
                          <div class="col mb-0">
                            <label for="emailBasic" class="form-label">Description</label>
                            <textarea class="form-control" name="description">{{$contrat->description}}</textarea>
                          </div>
                          
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                          Fermer
                        </button>
                        <button type="submit" class="btn btn-primary update_contrat">Enregister</button>
                      </div>
                    </form>
                  </div>
                </div>
                
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <div class="buy-now">
      <a href="javascript:void(0);" class="btn btn-danger btn-buy-now" data-bs-toggle="modal" data-bs-target="#basicModal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter</font></font></a>
    </div>
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Ajouter un contrat de location</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <form id="createContratForm" action="#" enctype="multipart/form-data" method="post"> @csrf
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nomContrat" class="form-label">Type de contrat</label>
                  <input type="text" id="nomContrat" class="form-control" placeholder="Bail" name="libelle" />
                </div>
              </div>
              <div class="row ">
                <div class="col mb-0">
                  <label for="emailBasic" class="form-label">Description</label>
                  <textarea class="form-control" name="description"></textarea>
                </div>
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Fermer
              </button>
              <button type="submit" class="btn btn-primary save_contrat">Enregister</button>
            </div>
          </form>
        </div>
      </div>
      
    </div>
    @include('alerte.loader') 

  @stop