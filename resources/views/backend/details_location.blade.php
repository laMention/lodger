@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Location #{{$location->reference}} /</span> Détails</h4>

      <div class="row mb-5">
          <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
              <img class="card-img-top" src="{{asset('storage/images/appartements/'.$location->appartement->image)}}" alt="Card image cap" />
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
              <div class="card-body">

                <!-- modal -->
                <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4">{{$location->appartement->code_appart}} - {{$appart->getCategorie($location->appartement->categorie)}}</h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
                        



                        <div class="row">
                          
                          
                          <h4>Equipements</h4>
                          @foreach($location->appartement->equipements as $e)
                          <div class="col-2 mb-3">
                           <i class="fa fa-check"></i>{{$e->libelle_equipement}}
                          </div>
                          @endforeach
                          <hr>
                        </div>
                        <div class="row ">
                          <h4>Comodités</h4>

                          @foreach($location->appartement->comodites as $e)
                          <div class="col-2 mb-3">
                            <i class="fa fa-check"></i>{{$e->libelle_comodite}}
                          </div>
                          @endforeach
                          <hr>
                        </div>
                        <div class="row ">
                          <h4>Points forts du quartier</h4>

                          @foreach($location->appartement->points_forts as $e)
                          <div class="col-2 mb-3">
                            <i class="fa fa-check"></i>{{$e->libelle_point_fort}}
                          </div>
                          @endforeach
                          <hr>
                        </div>


                      </div>
                      
                    </div>
                  </div>
                </div>

                <h5 class="card-title">#{{$location->appartement->code_appart}} - {{$appart->getCategorie($location->appartement->categorie)}} <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#exLargeModal" class="badge bg-label-danger"><small>Details</small></a> --><a href="#" 
                          
                          class="badge bg-label-danger"
                          data-bs-toggle="modal"
                          data-bs-target="#exLargeModal"
                        >
                          Details
                        </a></h5>
                <h6 class="card-subtitle text-muted">@if($location->appartement->categorie == 3)  {{$location->appartement->type_commerce}} @else {{$location->appartement->libelle}} @endif</h6>
                @if($location->appartement->categorie == 1)
                  <h6 class="card-subtitle text-info mt-2">{{$location->appartement->niveau}}</h7>
                @endif
              </div>
             
              <div class="card-body">
                <p class="card-text">{{$location->appartement->adresse}}</p>
                <p class="card-text">{!! $location->appartement->description !!}</p>
              </div>
            </div>
          </div>


          <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">{{number_format($location->appartement->montant_loyer,'0','.',' ')}} {{$location->appartement->devise}} / Mois</h5>
                <h6 class="card-subtitle text-muted mb-3">
                  @if($location->appartement->statut == 0)
                  <span class="badge bg-label-info">{{$appart->getStatut($location->appartement->statut)}}</span>
                  @else
                  <span class="badge bg-label-success">{{$appart->getStatut($location->appartement->statut)}}</span>
                  @endif
                </h6>
                
                @if(!empty($dernier_f))
                <p class="card-text">
                  Facture récente<br>
                  <a href="#" class="text-danger"><i class="iconify-inline text-danger" data-icon="bi:file-earmark-pdf-fill"></i>{{$dernier_f->fichier}}</a>
                </p>
                @else
                  <em><small>Aucune facture disponible</small></em><br>
                
                @endif
                <a href="javascript:void(0);" class="text-right">
                  Toutes les factures
                </a>
                
              </div>
            </div>
          </div>
        </div>
        <h5 class="pb-1 mb-4">Locataire</h5>

        <div class="row mb-5">
          <div class="col-md-6 col-lg-6">

            <h6 class="mt-2 text-muted">Informations personnelles</h6>


            <div class="col-md">
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-4">
                  @if(empty($location->locataire->photo))
                    <img class="card-img card-img-left" src="{{asset('images/avatar.png')}}" alt="{{$location->locataire->name}}">
                  @else
                    <img class="card-img card-img-left" src="{{asset('storage/images/users/'.$location->locataire->photo)}}" alt="{{$location->locataire->name}}">
                  @endif
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ucwords($location->locataire->name.' '.$location->locataire->lastname)}}</h5>
                    <p class="card-text">
                      {{$location->locataire->email}}<br>
                      {{$location->locataire->contact.' '.$location->locataire->contact_fixe}}<br>
                      {{$location->locataire->ville.' - '.$location->locataire->country->name}}<br>
                      {{$location->locataire->adresse}} 
                    </p>
                    <p>
                      <a href="javascript:void(0);"
                            class="card-link"
                            data-bs-toggle="modal"
                            data-bs-target="#largeModal"
                            data-bs-offset="0,4"
                            data-bs-placement="right"
                            data-bs-html="true"
                            title="Afficher les reglements des loyers de ce locataire">
                          {{__('Loyer')}}
                      </a>
                      
                  
                    </p>
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
                <h5 class="card-title">Location depuis le {{date_format(new \DateTime($location->date_location),'d-m-Y')}} <small><em>({{$location->date_location->diffForHumans()}})</em></small></h5>

                <!-- <p>Dernier paiement</p> -->
                @if(!empty($dernier_p) && isset($dernier_p))
                <span class="text-muted">{{'Dernier paiement effectué le '.date_format(new \DateTime($dernier_p->created_at),'d M Y')}}</span><br>
                @else
                  <em><small>Aucun paiement effectué </small></em><br>
                @endif
                Location depuis le {{date_format(new \DateTime($location->date_location),'d/m/Y')}}
                
              </div>
              
              <div class="card-body">
                  @if($paiements->count() > 0)
                   
                    <table class="table">
                      
                      <thead>
                        <tr>
                          <th>Montant</th>
                          <th>Reste</th>
                          <th>Date </th>
                          <th>Mode paiement</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach($paiements as $p)
                         @php
                          $mont_l = $location->appartement->montant_loyer;
                          $mont_p = $p->montant;
                          $r = $mont_l - $mont_p;

                         @endphp
                          <tr>
                            <td>{{number_format($p->montant,'0','.',' ')}}</td>
                            <td>{{number_format($r,'0','.',' ')}}</td>
                            <td>{{date_format(new \DateTime($p->created_at),'d-m-Y')}}</td>
                            <td>{{$p->mode_paiement.' '.$p->passerelle}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                      
                    </table>

                  @endif


              </div>
            </div>
          </div>
        </div>

    </div>
    

    <div class="buy-now">
      <a href="{{-- route('agence.appart.edit',[config('app.locale'),$location->reference]) --}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('Enregistrer un paiement')}}</font></font></a>
    </div>



  @stop