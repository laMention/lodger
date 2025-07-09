@extends('frontend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
     
      <div class="row">
        <div class="col-lg-4 col-md-12 col-4 mb-4">
          <div class="card">
            <div class="card-body">
             
              <span class="fw-semibold d-block mb-1">Status du contrat</span>
              <h6 class="card-title mb-2 badge bg-success">En cours</h6>
              <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-4 mb-4">
          <div class="card">
            <div class="card-body">
              
              <span class="fw-semibold d-block mb-1">Type de Contrat</span>
              <h6 class="card-title text-nowrap mb-2 badge bg-success">Bail</h6>
              <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-4 mb-4">
          <div class="card">
            <div class="card-body">
              
              <span class="fw-semibold d-block mb-1">Appartement</span>
              <h6 class="card-title text-nowrap mb-2 badge bg-primary">Appart_0001</h6>
              <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
            </div>
          </div>
        </div>
        <!-- Total Revenue -->
        
        <!--/ Total Revenue -->
        
      </div>
      <div class="row">
        <div class="col-lg-4 mb-4 order-0">
          <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    
                    <span class="iconify-inline" data-icon="fa-solid:wallet"></span>
                  </div>
                  
                </div>
                <span class="fw-semibold d-block mb-3">Loyer</span>
                <!-- <h3 class="card-title mb-2">12</h3> -->
                <span class="mb-3">65 000 FCFA(XOF)</span><br>
                <!-- <p>31/01/2022 Votre facture est disponible </p> -->
                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
              </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4 order-0">
          <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    
                    <span class="iconify-inline" data-icon="fa-solid:file-pdf"></span>
                  </div>
                  
                </div>
                <span class="fw-semibold d-block mb-1">Dernière facture</span>
                <!-- <h3 class="card-title mb-2">12</h3> -->
                <!-- <span class="badge rounded-pill bg-label-success">N° 12453777484949</span><br> -->
                <p>Pas de facture pour cette période</p>
                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
              </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4 order-0">
          <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    
                    <span class="iconify-inline" data-icon="fa-solid:credit-card"></span>
                  </div>
                  <div class="dropdown">
                    <span class="badge rounded-pill bg-label-success">Valide </span>
                   
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Moyen de paiement</span>
                <!-- <h3 class="card-title mb-2">12</h3> -->
                <p>Orange XXXXXXXXXX32 <i class="bx bx-right-arrow-alt"></i></p>
                
                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
              </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Order Statistics -->
        <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Informations </h5>
                <small class="text-muted">personnelles</small>
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="orederStatistics"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Selectionner tout</a> -->
                  <a class="dropdown-item" href="javascript:void(0);">Modifier mon profil</a>
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Exporter</a> -->
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
              </div>
              <ul class="p-0 m-0">
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"
                      ><i class="bx bx-mobile-alt"></i
                    ></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Elysee Botchi</h6>

                      <small class="text-muted">botchi@yopmail.com, cocody</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">07086376533</small>
                    </div>
                  </div>
                </li>
              
              </ul>
            </div>
          </div>
        </div>
        <!--/ Order Statistics -->

        <!-- Expense Overview -->
        <div class="col-md-6 col-lg-6 order-1 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Mes appartements</h5>
                <small class="text-muted">Informations</small>
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="orederStatistics"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <!-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics"> -->
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Selectionner tout</a> -->
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Refresh</a> -->
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Exporter</a> -->
                <!-- </div> -->
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
              </div>
              <ul class="p-0 m-0">
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"
                      ><i class="bx bx-mobile-alt"></i
                    ></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">app001</h6>
                      <small class="text-muted">2 pièces cocody faya</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">65 000</small>
                    </div>
                  </div>
                </li>
                
              </ul>
            </div>
          </div>
        </div>
        
      </div>


    </div>
    
  @stop
