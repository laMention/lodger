@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Abonnement et Facturation /</span> Suivi paiements</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link " href="{{url('/facturation')}}"><i class="bx bx-user me-1"></i> Factures</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"
                        ><i class="bx bx-bell me-1"></i> Suivi des paiements</a
                      >
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-connections.html"
                        ><i class="bx bx-link-alt me-1"></i> Connections</a
                      >
                    </li> -->
                  </ul>
                  <div class="card mb-4">
                   
                    <!-- Account -->
                    <div class="card-body">
                      <div class="table-responsive text-nowrap">
                        <table class="table" id="example">
                          <thead>
                            <tr>
                              <th>Reference</th>
                              <th>Date paiement</th>
                              <th>Montant</th>
                              <th>Moyen de paiement</th>
                              <th>Statut</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            <tr>
                              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>FR46334440</strong></td>
                              <td>31 janv. 2022</td>
                              <td>
                                25 000 FCFA
                              </td>
                              <td>Orange</td>
                              <td><span class="badge bg-label-success me-1">Succes</span></td>
                              <td>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('/facturation/paiments/details')}}"
                                      ><i class="bx bx-edit-alt me-1"></i> Details pour ce paiement</a
                                    >
                                    <a class="dropdown-item" href="javascript:void(0);"
                                      >
                                      <!-- <i class="bx bx-trash me-1"></i> -->
                                      <span class="iconify-inline" data-icon="fa-solid:file-pdf"></span> Voir la version pdf</a
                                    >
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>FR46334440</strong></td>
                              <td>31 janv. 2022</td>
                              <td>
                                25 000 FCFA
                              </td>
                              <td>MTN</td>
                              <td><span class="badge bg-label-danger me-1">Annulé</span></td>
                              <td>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"
                                      ><i class="bx bx-edit-alt me-1"></i> Details pour ce paiement</a
                                    >
                                    <a class="dropdown-item" href="javascript:void(0);"
                                      >
                                      <!-- <i class="bx bx-trash me-1"></i> -->
                                      <span class="iconify-inline" data-icon="fa-solid:file-pdf"></span> Voir la version pdf</a
                                    >
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>FR46334440</strong></td>
                              <td>31 janv. 2022</td>
                              <td>
                                25 000 FCFA
                              </td>
                              <td>VISA</td>
                              <td><span class="badge bg-label-danger me-1">Non terminé</span></td>
                              <td>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"
                                      ><i class="bx bx-edit-alt me-1"></i> Details pour ce paiement</a
                                    >
                                    <a class="dropdown-item" href="javascript:void(0);"
                                      >
                                      <!-- <i class="bx bx-trash me-1"></i> -->
                                      <span class="iconify-inline" data-icon="fa-solid:file-pdf"></span> Voir la version pdf</a
                                    >
                                  </div>
                                </div>
                              </td>
                            </tr>
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