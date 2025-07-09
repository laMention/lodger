@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Abonnement et Facturation / Historique opérations / </span>Details Facture FR46334440</h4>
        <div class="row">
          <div class="col-md-12">
            <div class="mb-4">
              <div class="row">
                <div class="col-lg-2">
                  <p>
                   <b class="mx-4">Référence</b><br>
                   
                   <b class="mx-4">Montant total</b>
                  </p>
                </div>
                <div class="col-lg-10">
                  <p>
                    FACTMENS19005228344 <br>
                
                   
                    
                    30 000 FCFA (XOF)  
                  </p>
                </div>
              </div>
              
            </div>
            <div class="card mb-4">
             
              <!-- Account -->
              <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table" id="example">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Operation</th>
                        <th>Etat</th>
                        <th>Montant</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        
                        <td>31 janv. 2022</td>
                        <td>
                          Création de la commande
                        </td>
                        <td><span class="badge bg-label-warning me-1">Complétée</span></td>
                        <td>30 000 FCFA</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                             
                              <a class="dropdown-item" href="javascript:void(0);"
                                >
                                
                                <span class="iconify-inline" data-icon="fa-solid:file-pdf"></span> Voir la version pdf</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        
                        <td>31 janv. 2022</td>
                        <td>
                          Paiement manuel sur carte de crédit
                        </td>
                        <td><span class="badge bg-label-success me-1">Payée</span></td>
                        <td>30 000 FCFA</td>
                        <td>
                          <!-- <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                             
                              <a class="dropdown-item" href="javascript:void(0);"
                                >
                                
                                <span class="iconify-inline" data-icon="fa-solid:file-pdf"></span> Voir la version pdf</a
                              >
                            </div>
                          </div> -->
                        </td>
                      </tr>
                      <tr>
                        
                        <td>31 janv. 2022</td>
                        <td>
                          Paiement automatique sur Mobile money
                        </td>
                        <td><span class="badge bg-label-success me-1">Payée</span></td>
                        <td>30 000 FCFA</td>
                        <td>
                          <!-- <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                             
                              <a class="dropdown-item" href="javascript:void(0);"
                                > 
                                <span class="iconify-inline" data-icon="fa-solid:file-pdf"></span> Voir la version pdf</a
                              >
                            </div>
                          </div> -->
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