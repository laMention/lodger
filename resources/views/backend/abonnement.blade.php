@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Abonnement</span></h4>
      <hr class="my-5" />
      <div class="row">
        <div class="col-lg-8 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">
                    @if($abonnement->offre->periode == "JOUR")
                      Période d'Essai
                    @elseif($abonnement->offre->periode == "MENSUEL")
                      Abonnement Mensuel
                    @else
                      Abonnement Annuel
                    @endif 🎉
                  </h5>
                  <p class="mb-4">
                    Votre abonnement expire le  <span class="fw-bold">{{date_format( new \DateTime($abonnement->date_expiration),'d/m/Y').' à '.date_format( new \DateTime($abonnement->date_expiration),'H:i:s')}}</span>.
                    <br>Pour changer l'offre, cliquez sur le bouton <b>Changer l'offre</b> ci-dessous
                  </p>
                  <!-- Si en cours -->
                  <a href="{{route('changeAbonnement',[config('app.locale')])}}" class="btn btn-sm btn-outline-primary"> Changer l'offre</a>
                  <!-- Si expirer -->
                  @if($abonnement->offre->net_apres_reduction != 0)
                    <a href="javascript:;" class="btn btn-sm btn-outline-danger renouveller">Renouveller</a>
                  @endif

                </div>

              </div>
              <div class="col-sm-5 text-center text-sm-left">
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
          <div class="row">
            <div class="col-lg-12 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <div class="avatar flex-shrink-0">
                      <img
                        src="{{asset('backend/assets/img/icons/unicons/wallet-info.png')}}"
                        alt="Credit Card"
                        class="rounded"
                      />
                    </div>
                      <!-- <span class="tf-icons bx bx-money"></span> -->
                      <!-- <span class="iconify-inline" data-icon="fa-solid:home"></span> -->
                    </div>
                    <div class="dropdown">
                      <!-- <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button> -->
                        <span class="fw-semibold d-block mb-1"> <span class="badge
                          @if($is_active == 1)
                             bg-success
                          @elseif($is_active == 0.5)
                             bg-warning
                          @else
                             bg-danger
                          @endif
                        "> 
                          @if($is_active == 1)
                            Actif
                          @elseif($is_active == 0.5)
                            Expire aujourd'hui
                          @else
                            Expiré
                          @endif
                         
                        </span>
                      </span>
                    </div>
                  </div>
                  

                  <h3 class="card-title mb-2">
                    @if($abonnement->offre->net_apres_reduction == 0)
                      Gratuit
                    @else
                      {{number_format($abonnement->offre->net_apres_reduction,'0','.',' ').' '.$abonnement->offre->devise}} 
                    @endif
                  </h3>
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> 
                    @if($abonnement->offre->net_apres_reduction == 0)
                      sur {{$abonnement->offre->nb_jours}} {{strtolower($abonnement->offre->duree)}}
                    @else
                      Par {{$abonnement->offre->duree}}
                    @endif
                    
                  </small><br>
                  <small><em>

                    Abonné depuis le {{date_format( new \DateTime($abonnement->date_abonnement),'d-m-Y')}}
                  </em></small>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-md-12 col-lg-12 mt-3">
          @if($old_souscriptions->count() > 0)
            <div class="card">
              <div class="table-responsive text-nowrap">
                <table class="table" id="example">
                  <caption class="ms-4">
                    Mes abonnements
                  </caption>
                  <thead>
                    <tr>
                      <th>Reference</th>
                      <th>Offre</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($old_souscriptions as $forfait)
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

                       
                        
                       
                      </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
            </div>
          @endif
        </div>
        
      </div>
    </div>

  @stop