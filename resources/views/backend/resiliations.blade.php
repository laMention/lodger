@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Résiliations de contrat de location</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            <caption class="ms-4">
              Liste des résiliations demandées
            </caption>
            <thead>
              <tr>
                <th>N° du contrat</th>
                <th>Locataire</th>
                <th>Motif de résiliation</th>
                <th>Bien</th>
                <th>Date émission</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($resiliations as $r)
                <tr class="resiliations_item">
                  <td>
                    <input type="hidden" class="resiliations_id" value="{{$r->reference}}">
                   {{$r->location->reference}}
                  </td>
                  <td>{{$r->location->locataire->name}}</td>
                  <td>
                    {{$r->motif}}
                  </td>
                  <td>
                   <a href="{{ route('agence.appart.details',[config('app.locale'),$r->location->appartement->code_appart]) }}"data-bs-toggle="tooltip" data-bs-title="Cliquez pour vour voir le bien"> {{$r->location->appartement->code_appart}}</a>
                  </td>
                  <td>{{date_format(new \DateTime($r->created_at),'d-m-Y')}}</td>
                  <td>
                    @if($r->etat == 0)
                      <span class="badge bg-primary me-1">En attente</span>
                    @elseif($r->etat == 1)
                      <span class="badge bg-danger me-1">Validé</span>
                    @else
                      <span class="badge bg-success me-1">Annulée</span>

                    @endif
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn btn-icon btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalScrollable">
                        <span class="tf-icons bx bx-zoom-in"></span>
                      </button>
                      @if($r->etat == 0)
                        <button type="button" class="btn btn-icon btn-outline-success accepterResiliation" data-bs-toggle="tooltip" data-bs-title="Valider la resiliation">
                          <span class="tf-icons bx bx-check"></span>
                        </button>
                      @endif
                      @if($r->etat == 1)
                     
                          <button type="button" class="btn btn-icon btn-outline-danger annulerResiliation" data-bs-toggle="tooltip" data-bs-title="Annuler la resiliation">
                          <span class="tf-icons bx bx-minus"></span>
                        </button>
                      @endif

                      <button type="button" class="btn btn-icon btn-outline-danger" data-bs-toggle="tooltip" data-bs-title="Supprimer cette info">
                      <span class="iconify" data-icon="clarity:close-line"></span>
                        <!-- <span class="tf-icons bx bx-closet"></span> -->
                      </button>


                    </div>
                  </td>


                  <div class="modal fade" id="modalScrollable" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalScrollableTitle">Modal title</h5>
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          ></button>
                        </div>
                        <div class="modal-body">
                          <p>
                           Botchi DAgou

                          </p>
                          <p>
                            Contrat N° locat_0000110082(2+1)
                            Depuis le 03-06-2022
                          </p>
                          <p>
                            Appartement_00001 Abidjan cocody
                          </p>
                          <p>
                            Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis
                            in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                          </p>
                          
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Fermer
                          </button>
                          <button type="button" class="btn btn-primary">Accepter</button>
                          <button type="button" class="btn btn-danger">Annuler</button>
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