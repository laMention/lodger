@extends('frontend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Loyer / </span>infos</h4>
      <hr class="my-5" />

      <div class="row mb-5">
          <div class="col-md-6 col-lg-6">

            <h6 class="mt-2 text-muted">Informations personnelles</h6>


            <div class="col-md">
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-4">
                  <img class="card-img card-img-left" src="{{asset('backend/assets/img/elements/12.jpg')}}" alt="Card image">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Appartement 0001</h5>
                    <p class="card-text">
                      Type: 2 pièces <br>
                      Niveau: 1er étage<br>
                      Loyer: 65 000 fr<br>
                    </p>
                    
                  </div>
                  <div class="card-body">
                    <span class="text-muted">Location depuis le 10/03/2022</span>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
            
            
          </div>
          
          <div class="col-md-6 col-lg-6">
            <h6 class="mt-2 text-muted">Loyer</h6>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Contrat en cours</h5>

                <p>Dernière facture générée</p>
                <a href="#" class="text-danger"><i class="iconify-inline text-danger" data-icon="bi:file-earmark-pdf-fill"></i>fact_loc_000505072022</a>
              </div>
              
              <div class="card-body">

                <span class="text-muted">Dernier paiement effectué le 10/07/2022</span>
              </div>
            </div>
          </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table">
            <caption class="ms-4">
              Liste des Paiements
            </caption>
            <thead>
              <tr>
                <th>Montant</th>
                <th>Reste</th>
                <th>Date paiement</th>
                <th>Période</th>
                <th>Passerelle</th>
                <th>Type de paiement</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               
                <td>65 000</td>
                <td>0</td>
                <td>10-08-2022 10:00</td>
                <td>Mois de Juillet 2022</td>
                <td>Orange</td>
                <td><span class="badge rounded-pill bg-primary me-1">Paiement auto</span></td>
                <td><span class="badge bg-label-success me-1">Soldé</span></td>
                <td>
                  <div class="dropdown">
                   
                    <button type="button" class="btn btn-icon btn-outline-warning">
                      <box-icon type='solid' name='file-pdf' class="text-danger"></box-icon>
                      <!-- <span class="tf-icons bx bx-file-pdf"></span> -->
                    </button>
                    

                    <button type="button" class="btn btn-icon btn-outline-danger" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="bottom" data-bs-html="true" data-bs-content="<p>Etes-vous sûr de vouloir supprimer ?<br> </p> <div class='d-flex justify-content-between'><button type='button' class='btn btn-sm btn-outline-secondary'>Non</button><button type='button' class='btn btn-sm btn-primary'>Continuer</button></div>" title="" data-bs-original-title="Supprimer ce paiement" aria-describedby="popover359940">
                    <!-- <span class="iconify" data-icon="clarity:close-line"></span> -->
                      <span class="tf-icons bx bx-trash"></span>
                    </button>


                  </div>
                </td>


              </tr>
              <tr>
                
                <td>45 000</td>
                <td>20 000</td>
                <td>10-08-2022 10:00</td>
                <td>Mois de Juillet 2022</td>
                <td>MTN</td>
                <td><span class="badge rounded-pill bg-warning me-1">Paiement manuel</span></td>
                <td><span class="badge bg-label-danger me-1">Non soldé</span></td>
                <td>
                  <div class="dropdown">
                    
                    <button type="button" class="btn btn-icon btn-outline-warning">
                      <box-icon type='solid' name='file-pdf' class="text-danger"></box-icon>
                      <!-- <span class="tf-icons bx bx-file-pdf"></span> -->
                    </button>
                    <button type="button" class="btn btn-icon btn-outline-info">
                      <!-- <box-icon type='solid' name='file-pdf' class="text-danger"></box-icon> -->
                      <span class="tf-icons bx bx-money"></span>
                    </button>

                    <button type="button" class="btn btn-icon btn-outline-danger" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="bottom" data-bs-html="true" data-bs-content="<p>Etes-vous sûr de vouloir supprimer ?<br> </p> <div class='d-flex justify-content-between'><button type='button' class='btn btn-sm btn-outline-secondary'>Non</button><button type='button' class='btn btn-sm btn-primary'>Continuer</button></div>" title="" data-bs-original-title="Supprimer ce paiement" aria-describedby="popover359940">
                    <!-- <span class="iconify" data-icon="clarity:close-line"></span> -->
                      <span class="tf-icons bx bx-trash"></span>
                    </button>


                  </div>
                </td>


               
              </tr>
            </tbody>
          </table>
        </div>
      </div>
        </div>
      </div>
    </div>


  @stop