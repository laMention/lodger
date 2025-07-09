@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
     
      <div class="row">
        <div class="col-lg-8 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-8">
                <div class="card-body">
                  <h5 class="card-title text-primary">
                    
                    {{__('Votre abonnement')}} : {!! $type_abonnement !!} 🎉</h5>
                  <p class="mb-4">
                    Votre abonnement expire le  <span class="fw-bold">{{date_format(new \DateTime($abonnement->date_expiration),'d/m/Y H:m:i')}}</span>.
                    <br>Pour changer l'offre rendez-vous dans la rubrique Abonnement
                  </p>
                  <!-- Si en cours -->
                  <a href="{{route('changeAbonnement',[config('app.locale')])}}" class="btn btn-sm btn-outline-primary"> Changer l'offre</a>
                  <!-- Si expirer -->
                  <!-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Renouveller</a> -->

                </div>

              </div>
              <div class="col-sm-4 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="{{asset('backend/assets/img/illustrations/man-with-laptop-light.png')}}"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <!-- <img
                    src="{{asset('backend/assets/img/icons/unicons/home.png')}}"
                    alt="chart success"
                    class="rounded"
                  /> -->
                  <span class="iconify-inline" data-icon="fa-solid:card"></span>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt3"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Solde de votre compte</span>
              <h3 class="card-title mb-2">{{number_format($compte->solde,'0','.',' ')}}</h3>
              <small class="badge bg-primary fw-semibold">
               <!--  <i class="bx bx-up-arrow-alt"></i> --> {{$compte->num_compte}}</small>
            </div>
          </div>
        </div>
        <!-- Racourcis -->
        
        <!-- Total Revenue -->
        <!-- <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
          <div class="card">
            <div class="row row-bordered g-0">
              <div class="col-md-8">
                <h5 class="card-header m-0 me-2 pb-3">Revenu annuel</h5>
                <div id="totalRevenueChart" class="px-2"></div>
              </div>
              <div class="col-md-4">
                <div class="card-body">
                  <div class="text-center">
                    <div class="dropdown">
                      <button
                        class="btn btn-sm btn-outline-primary dropdown-toggle"
                        type="button"
                        id="growthReportId"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        2022
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                        <a class="dropdown-item" href="javascript:void(0);">2021</a>
                        <a class="dropdown-item" href="javascript:void(0);">2020</a>
                        <a class="dropdown-item" href="javascript:void(0);">2019</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="growthChart"></div>
                <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

                <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                  <div class="d-flex">
                    <div class="me-2">
                      <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                    </div>
                    <div class="d-flex flex-column">
                      <small>2022</small>
                      <h6 class="mb-0">$32.5k</h6>
                    </div>
                  </div>
                  <div class="d-flex">
                    <div class="me-2">
                      <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                    </div>
                    <div class="d-flex flex-column">
                      <small>2021</small>
                      <h6 class="mb-0">$41.2k</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-12 col-md-8 col-lg-8 order-3 order-md-2">
          <div class="row">
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="{{asset('backend/assets/img/icons/unicons/paypal.png')}}" alt="Credit Card" class="rounded" />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt4"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                      </div>
                    </div>
                  </div>
                  <span class="d-block mb-1">Entrée du mois</span>
                  <h3 class="card-title text-nowrap mb-2">{{$em}}</h3>
                  <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
                </div>
              </div>
            </div>
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="{{asset('backend/assets/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded" />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt1"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="cardOpt1">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Total paiement</span>
                  <h3 class="card-title mb-2">{{number_format($tp,'0','.',' ')}}</h3>
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
                </div>
              </div>
            </div>
            
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2">Contrats</h5>
                        <!-- <span class="badge bg-label-warning rounded-pill">Année {{date('Y')}}</span> -->
                      </div>
                      <div class="mt-sm-auto">
                        <small class="text-success text-nowrap fw-semibold"
                          ><i class="bx bx-chevron-up"></i> 68.2%</small
                        >
                        <h3 class="mb-0">{{$nbc}}</h3>
                      </div>
                    </div>
                    <!-- <div id="profileReportChart"></div> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2">Appartements</h5>
                        <!-- <span class="badge bg-label-warning rounded-pill">Année {{date('Y')}}</span> -->
                      </div>
                      <div class="mt-sm-auto">
                        <small class="text-success text-nowrap fw-semibold"
                          ><i class="bx bx-chevron-up"></i> 68.2%</small
                        >
                        <h3 class="mb-0">{{$nba}}</h3>
                      </div>
                    </div>
                    <!-- <div id="profileReportChart"></div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Total Revenue -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
          <div class="row">
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="{{asset('backend/assets/img/icons/unicons/paypal.png')}}" alt="Credit Card" class="rounded" />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt4"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                      </div>
                    </div>
                  </div>
                  <span class="d-block mb-1">Locataires</span>
                  <h3 class="card-title text-nowrap mb-2">0</h3>
                  <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>

                </div>
              </div>
            </div>
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="{{asset('backend/assets/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded" />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt1"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="cardOpt1">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Propriétaires</span>
                  <h3 class="card-title mb-2">{{$p}}</h3>
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
                </div>
              </div>
            </div>
            
            <div class="col-12 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2">Contrats de locations</h5>
                        <span class="badge bg-label-warning rounded-pill">Année {{date('Y')}}</span>
                      </div>
                      <div class="mt-sm-auto">
                        <small class="text-success text-nowrap fw-semibold"
                          ><i class="bx bx-chevron-up"></i> 68.2%</small
                        >
                        <h3 class="mb-0">{{number_format($ctr,0,'.',' ')}}</h3>
                      </div>
                    </div>
                    <div id="profileReportChart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-lg-4 mb-4 order-0">
          <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    
                    <span class="iconify-inline" data-icon="fa-solid:wallet"></span>
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt3"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                      <a class="dropdown-item" href="{{route('abonnement',[config('app.locale')])}}">Détails de ma commande</a>
                      <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Votre commande</span>
                <!-- <h3 class="card-title mb-2">12</h3> -->
                <span class="badge rounded-pill bg-label-success">#{{$abonnement->reference}}</span><br>
                <p>
                  31/01/2022 Votre facture est disponible 
                </p>
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
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt3"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                      <a class="dropdown-item" href="javascript:void(0);">Voir mes factures</a>
                      <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                    </div>
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
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt3"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                   
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Moyen de paiement</span>
                <!-- <h3 class="card-title mb-2">12</h3> -->
                <p>VISA XXXXXXXXXX32 <i class="bx bx-right-arrow-alt"></i></p>
                <span class="badge rounded-pill bg-label-success">Valide </span><br>
                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
              </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Order Statistics -->
        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Locations</h5>
                <small class="text-muted">6 locataires</small>
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
                
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                
              </div>
              <ul class="p-0 m-0">
                @foreach($listel as $loc)
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"
                      ><i class="bx bx-mobile-alt"></i
                    ></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">{{$loc->user->lastname}}</h6>
                      <small class="text-muted">{{$cat->getCategorie($loc->appartement->categorie)}} {{$loc->appartement->libelle}} {{$loc->appartement->adresse}}</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">{{number_format($loc->appartement->montant_loyer,'0','.',' ')}}</small>
                    </div>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <!--/ Order Statistics -->

        <!-- Expense Overview -->
        <div class="col-md-6 col-lg-4 order-1 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Appartements</h5>
                <small class="text-muted">12 Appartements</small>
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
                  <a class="dropdown-item" href="javascript:void(0);">Selectionner tout</a>
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Refresh</a> -->
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Exporter</a> -->
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- x -->
                <div id="orderStatisticsChart"></div>
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
                      <small class="fw-semibold">50 000</small>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">app002</h6>
                      <small class="text-muted">Villa 4 pièces riviera golf</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">230 000</small>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">app003</h6>
                      <small class="text-muted">Studio angré 8e tranche</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">80 000</small>
                    </div>
                  </div>
                </li>
                <li class="d-flex">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-secondary"
                      ><i class="bx bx-football"></i
                    ></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">app006</h6>
                      <small class="text-muted">3 pièces koumassi remblais</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">90 000</small>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!--/ Expense Overview -->

        <!-- Transactions -->
        <div class="col-md-6 col-lg-4 order-2 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0 me-2">Transactions</h5>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="transactionID"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                
              </div>
            </div>
            <div class="card-body">
              <ul class="p-0 m-0">
                @foreach($listep as $paiements)
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <img src="{{asset('backend/assets/img/icons/unicons/paypal.png')}}" alt="User" class="rounded" />
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <small class="text-muted d-block mb-1">{{$paiements->passerelle}}</small>
                      <h6 class="mb-0">{{$paiements->description}}</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                      <h6 class="mb-0">{{$paiements->montant}}</h6>
                      <span class="text-muted">{{$paiements->devise}}</span>
                    </div>
                  </div>
                </li>
                @endforeach
                <!-- <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <img src="{{asset('backend/assets/img/icons/unicons/wallet.png')}}" alt="User" class="rounded" />
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <small class="text-muted d-block mb-1">Paiement bancaire VISA</small>
                      <h6 class="mb-0">Règlement arrièré du loyer du mois</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                      <h6 class="mb-0">270 000</h6>
                      <span class="text-muted">FCFA</span>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <img src="{{asset('backend/assets/img/icons/unicons/chart.png')}}" alt="User" class="rounded" />
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <small class="text-muted d-block mb-1">MTN</small>
                      <h6 class="mb-0">Avance sur le loyer du mois </h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                      <h6 class="mb-0">60 000</h6>
                      <span class="text-muted">FCFA</span>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <img src="{{asset('backend/assets/img/icons/unicons/cc-success.png')}}" alt="User" class="rounded" />
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <small class="text-muted d-block mb-1">Carte de crédit</small>
                      <h6 class="mb-0">Paiement du loyer du mois</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                      <h6 class="mb-0">838 71</h6>
                      <span class="text-muted">USD</span>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <img src="{{asset('backend/assets/img/icons/unicons/wallet.png')}}" alt="User" class="rounded" />
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <small class="text-muted d-block mb-1">Wallet</small>
                      <h6 class="mb-0">Starbucks</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                      <h6 class="mb-0">203 33</h6>
                      <span class="text-muted">FCFA</span>
                    </div>
                  </div>
                </li>
                <li class="d-flex">
                  <div class="avatar flex-shrink-0 me-3">
                    <img src="{{asset('backend/assets/img/icons/unicons/cc-warning.png')}}" alt="User" class="rounded" />
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <small class="text-muted d-block mb-1">Mastercard</small>
                      <h6 class="mb-0">Ordered Food</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                      <h6 class="mb-0">9245</h6>
                      <span class="text-muted">FCFA</span>
                    </div>
                  </div>
                </li> -->
              </ul>
            </div>
          </div>
        </div>
        <!--/ Transactions -->
      </div>

      <div class="row">
        <div class="col-md-6 col-lg-6 order-1 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Activités récentes</h5>
                <small class="text-muted">1352 actions effectuées</small>
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
                  <a class="dropdown-item" href="javascript:void(0);">Selectionner tout</a>
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Refresh</a> -->
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Exporter</a> -->
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- x -->
                <div id="orderStatisticsChart"></div>
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
                      <h6 class="mb-0">Facture génerée</h6>
                      <small class="text-muted">Envoyée à Botchi</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">12/07/2022</small>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Paiement effectué</h6>
                      <small class="text-muted">Paiement loyer du mois</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">15/07/2022</small>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Incident déclarée</h6>
                      <small class="text-muted">Par Botchi</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">14/04/2022</small>
                    </div>
                  </div>
                </li>
                <li class="d-flex">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-secondary"
                      ><i class="bx bx-football"></i
                    ></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Compte locataire créé</h6>
                      <small class="text-muted">Botchi</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">14/à7/2022</small>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 order-1 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Propriétaire</h5>
                <small class="text-muted">5 propriétaires</small>
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
                  <a class="dropdown-item" href="javascript:void(0);">Selectionner tout</a>
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Refresh</a> -->
                  <!-- <a class="dropdown-item" href="javascript:void(0);">Exporter</a> -->
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- x -->
                <div id="orderStatisticsChart"></div>
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
                      <h6 class="mb-0">Facture génerée</h6>
                      <small class="text-muted">Envoyée à Botchi</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">12/07/2022</small>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Paiement effectué</h6>
                      <small class="text-muted">Paiement loyer du mois</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">15/07/2022</small>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Incident déclarée</h6>
                      <small class="text-muted">Par Botchi</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">14/04/2022</small>
                    </div>
                  </div>
                </li>
                <li class="d-flex">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-secondary"
                      ><i class="bx bx-football"></i
                    ></span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Compte locataire créé</h6>
                      <small class="text-muted">Botchi</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">14/à7/2022</small>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 order-1 mb-4">
          <div class="card mb-3">
            <a href="#">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="{{asset('backend/assets/img/icons/unicons/wallet.png')}}"
                      alt="chart success"
                      class="rounded"
                    />
                    
                  </div>
                  
                </div>
                <span class="fw-semibold d-block mb-1">Méthodes de paiements</span>
                    <h3 class="card-title mb-2">2</h3>
                    
              </div>
            </a>
          </div>
          <div class="card">
            <a href="#">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="{{asset('backend/assets/img/icons/unicons/wallet.png')}}"
                      alt="chart success"
                      class="rounded"
                    />
                    
                  </div>
                  
                </div>
                <span class="fw-semibold d-block mb-1">Factures</span>
                    <h3 class="card-title mb-2">2</h3>
                    
              </div>
            </a>
          </div>

        </div>

      </div>

    </div>
    
  @stop
