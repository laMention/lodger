@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Abonnement et Facturation /</span> Facturation</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="{{route('facturation_abonnement',[config('app.locale')])}}"><i class="bx bx-user me-1"></i> Factures</a>
                    </li>
                   
                    <li class="nav-item">
                      <a class="nav-link " href="{{route('historique',[config('app.locale')])}}"><i class="bx bx-user me-1"></i> Historique des abonnements</a>
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
                              <th>Date emission</th>
                              <th>Montant</th>
                              <th>Statut</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            @foreach($commandes as $order)
                              <tr>
                                <td>#<strong>{{$order->reference}}</strong></td>
                                <td>{{date_format(new \DateTime($order->created_at),'d-m-Y')}}</td>
                                <td>
                                  {{$order->offre->net_apres_reduction}} {{$order->offre->devise}}
                                </td>
                                <td>
                                  @if($order->status == 1)
                                    <span class="badge bg-label-success me-1">Payé</span>
                                  @else
                                    <span class="badge bg-label-danger me-1">Paiement en attente</span>

                                  @endif
                                </td>
                                <td>
                                  <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                      <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item"  href="{{url('/historique-operations')}}"
                                        ><i class="bx bx-edit-alt me-1"></i> Details</a
                                      >
                                      <a class="dropdown-item" href="#"
                                        >
                                        <!-- <i class="bx bx-trash me-1"></i> -->
                                        <span class="iconify-inline" data-icon="fa-solid:file-pdf"></span> Voir la version pdf</a
                                      >
                                    </div>
                                  </div>
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