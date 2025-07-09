@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Réparations</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            <caption class="ms-4">
              Liste des réparations
            </caption>
            <thead>
              <tr>
                <th>Reference reparation</th>
                <th>Incident</th>
                <th>Emeteur</th>
                <th>Demande</th>
                <th>Date réparation</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reparations as $reparation)
              <tr class="reparation_items" @if($reparation->read_at == NULL) style="font-weight: bolder;" @endif>
                 <input type="hidden" class="reparation_reference" value="{{$reparation->reference}}">
                <td>
                 {{$reparation->reference}}
                </td>
                <td>{{$reparation->incident->sujet}}</td>
                <td>{{$reparation->incident->appartement->location->locataire->lastname.' '.$reparation->incident->appartement->location->locataire->name}}</td>
                <td>{{date_format(new \DateTime($reparation->incident->created_at),'d-m-Y')}}</td>
                <td>
                  {{date_format(new \DateTime($reparation->created_at),'d-m-Y')}}
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn btn-icon btn-outline-primary readBtnReparation" data-bs-toggle="modal" data-bs-target="#modalScrollable{{$reparation->id}}">
                      <span class="tf-icons bx bx-zoom-in"></span>
                    </button>
                    <!-- <button type="button" class="btn btn-icon btn-outline-success">
                      <span class="tf-icons bx bx-check"></span>
                    </button> -->

                    <button type="button" class="btn btn-icon btn-outline-danger deletereparation" data-bs-toggle="tooltip" data-bs-title="Supprimer cet enregistrement">
                    <span class="iconify" data-icon="clarity:close-line"></span>

                      <!-- <span class="tf-icons bx bx-trash"></span> -->
                    </button>


                  </div>
                </td>
                <div class="modal fade modal_reparation" id="modalScrollable{{$reparation->id}}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalScrollableTitle">Réparation de l'incident {{$reparation->incident->reference}}</h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>

                      <div class="modal-body">
                         <h4>Constaté par {{ucwords($reparation->incident->appartement->location->locataire->lastname.' '.$reparation->incident->appartement->location->locataire->name)}}</h4>
                          <h4>
                            <h5>Reparation: {{$reparation->incident->sujet}}</h5>

                            @if($reparation->incident->appartement->categorie == 3)
                              {{$appart->getCategorie($reparation->incident->appartement->categorie).' '.$reparation->incident->appartement->type_commerce}} -
                            @else
                              {{$appart->getCategorie($reparation->incident->appartement->categorie).' '.$reparation->incident->appartement->libelle}}<br>
                              {{$reparation->incident->appartement->niveau}} - 
                            @endif
                            {{$reparation->incident->appartement->adresse}}

                           

                          </h4>
                          {!! $reparation->incident->description !!}
                         
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                          Fermer
                        </button>
                      </div>
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