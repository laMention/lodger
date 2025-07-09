@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Abonnement et Facturation / Historique opérations/ </span>Details PA_FR19005228</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-4">
                    <div class="row">
                      <div class="col-lg-2">
                        <p>
                         <b class="mx-4">Référence</b><br>
                         <b class="mx-4">Date</b><br>
                         <b class="mx-4">Montant total</b>
                        </p>
                      </div>
                      <div class="col-lg-10">
                        <p>
                          PA_FR19005228 <br>
                      
                          31 janv. 2022<br>
                          
                          30 000 FCFA (XOF)  
                        </p>
                      </div>
                    </div>
                    
                  </div>
                  <div class="card mb-4">
                   
                    <!-- Account -->
                    <div class="card-body">
                      <div class="table-responsive text-nowrap">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Reference de la facture</th>
                              <th>Date emission</th>
                              <th>Montant de l'operation</th>
                              <th>Document</th>
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
                              <td>
                               <span class="iconify-inline" data-icon="fa-solid:file-pdf"></span>FACTFM142535664647
                              </td>
                              <td>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    
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