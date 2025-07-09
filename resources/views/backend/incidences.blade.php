@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Incidents signalés</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            <caption class="ms-4">
              Liste des incidents signalés
            </caption>
            <thead>
              <tr>
                <th>Reference</th>
                <th>Emis par</th>
                <th>Biens</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Status</th>
                <th></th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($incidents as $incident)
                <tr class="incidents-items" @if($incident->read_at == NULL) style="font-weight: bolder;" @endif >
                  <input type="hidden" class="incident_id" value="{{$incident->reference}}">
                  <td>
                   {{$incident->reference}}
                  </td>
                  <td>
                    {{$incident->locataire->name}}
                  </td>
                  <td>{{$incident->appartement->code_appart}}<br>{{$appart->getCategorie($incident->appartement->categorie).' '.$incident->appartement->libelle}}</td>
                  <td>{{$incident->sujet}}</td>
                  <td>
                    {{substr($incident->description,0,25)}}...
                  </td>
                  <td>
                    @if($incident->status == 0)
                    <span class="badge bg-label-danger me-1">En attente de reparation</span>
                    @endif
                    @if($incident->status == 1)
                    <span class="badge bg-label-success me-1">Réparation effectuée</span>
                    @endif
                  </td>
                  <td>
                    {{$incident->created_at->diffForHumans()}}
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn btn-icon btn-outline-primary readBtn" data-bs-toggle="modal" data-bs-target="#fullscreenModal{{$incident->id}}">
                        <span class="tf-icons bx bx-zoom-in"></span>
                      </button>
                      <button type="button" class="btn btn-icon btn-outline-success markAsdone" data-bs-toggle="tooltip" data-bs-title="Marqué comme fait">
                        <span class="tf-icons bx bx-check"></span>
                      </button>

                      <button type="button" class="btn btn-icon btn-outline-danger deleteincident" data-bs-toggle="tooltip" data-bs-title="Supprimer la tâche à effectuer">
                      <span class="iconify" data-icon="clarity:close-line"></span>

                        <!-- <span class="tf-icons bx bx-trash"></span> -->
                      </button>


                    </div>
                  </td>
                  <div class="modal fade modal_incident" id="fullscreenModal{{$incident->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalFullTitle">{{$incident->sujet}}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="incidentForm" class="incidentForm" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                          <h4>Constaté par {{ucwords($incident->appartement->location->locataire->lastname.' '.$incident->appartement->location->locataire->name)}}</h4>
                          <h4>

                            @if($incident->appartement->categorie == 3)
                              {{$appart->getCategorie($incident->appartement->categorie).' '.$incident->appartement->type_commerce}} -
                            @else
                              {{$appart->getCategorie($incident->appartement->categorie).' '.$incident->appartement->libelle}}<br>
                              {{$incident->appartement->niveau}} - 
                            @endif
                            {{$incident->appartement->adresse}}

                           

                          </h4>
                          {!! $incident->description !!}
                          
                         
                        <input type="hidden" class="incident_reference" value="{{$incident->reference}}">
                         
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                          <button type="button" class="btn btn-primary markAsdone1">Marqué comme fait</button>
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
    <!-- <div class="buy-now">
      <a href="javascript:void(0);" class="btn btn-danger btn-buy-now" data-bs-toggle="modal" data-bs-target="#basicModal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter</font></font></a>
    </div> -->
    

  @stop