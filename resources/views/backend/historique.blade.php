@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Abonnement et Facturation /</span> Facturation</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link " href="{{route('facturation_abonnement',[config('app.locale')])}}"><i class="bx bx-user me-1"></i> Factures</a>
                    </li>
                   
                    <li class="nav-item">
                      <a class="nav-link active" href="{{route('historique',[config('app.locale')])}}"><i class="bx bx-user me-1"></i> Historique des abonnements</a>
                    </li>
                    
                  </ul>
                  <div class="card mb-4">
                   
                    <!-- Account -->
                    <div class="card-body">
                      <div class="table-responsive text-nowrap">
                        <table class="table" id="example">
                          <thead>
                            <tr>
                              <th>Reference</th>
                              <th>Offre</th>
                              <th>Date abonnement</th>
                              <th>Statut</th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            @foreach($abonnements as $forfait)
                              <tr class="ligne_appartement">

                                <td>
                                  <b>{{$forfait->reference}}</b>
                                  
                                </td>
                                <td>
                                  <!-- <i class="fab fa-angular fa-lg text-danger me-3"></i>  -->
                                  <strong>
                                    {{$forfait->offre->libelle}}
                                  </strong>
                                </td>
                                <td>{{date_format(new \DateTime($forfait->date_abonnement),'d-m-Y')}}</td>
                                <td>
                                  @if($forfait->status == 1)
                                    <span class="badge bg-label-success">En cours</span>

                                  @else
                                    <span class="badge bg-label-danger">Resilié</span>

                                  @endif
                                </td>

                               
                                
                               
                              </tr>
                            @endforeach
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                    
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>

  @stop