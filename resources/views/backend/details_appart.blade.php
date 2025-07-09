@extends('backend.partials._template')
  @section('content')
    <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Appartement {{$appartement->code_appart}} /</span> Détails</h4>

              <!-- Examples -->
              <div class="row mb-3">
                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card h-100">
                    <img class="card-img-top" src="{{asset('/storage/images/appartements/'.$appartement->image)}}" alt="Card image cap" />
                  </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="card-title">{{$appart->getCategorie($appartement->categorie)}}</h5>
                      <h6 class="card-subtitle text-muted">@if($appartement->categorie == 3)  {{$appartement->type_commerce}} @else {{$appartement->libelle}} @endif</h6>
                      @if($appartement->categorie == 1)
                        <h6 class="card-subtitle text-info mt-2">{{$appartement->niveau}}</h7>
                      @endif
                    </div>
                   
                    <div class="card-body">
                      <p class="card-text">{{$appartement->adresse}}</p>
                      <p class="card-text">{{$appartement->description}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="card-title">{{number_format($appartement->montant_loyer,'2','.',' ')}} {{$appartement->devise}} / Mois</h5>
                      <h6 class="card-subtitle text-muted mb-3">
                        @if($appart->statut == 0)
                        <span class="badge bg-label-info">{{$appartement->getStatut($appart->statut)}}</span>
                        @else
                        <span class="badge bg-label-success">{{$appartement->getStatut($appart->statut)}}</span>
                        @endif
                      </h6>
                      
                      <p class="card-text">
                        @if(!empty($appartement->caution->periode))
                        Caution: {{$appartement->caution->periode}} mois ({{number_format($appartement->caution->montant,'2','.',' ')}} {{$appartement->caution->devise}} ) 
                        @endif
                        <br>
                        @if(!empty($appartement->avance->periode))
                        Avance: {{$appartement->avance->periode}} mois ({{number_format($appartement->avance->montant,'2','.',' ')}} {{$appartement->avance->devise}} )
                        @endif
                        <br>
                        @if(!empty($appartement->commission->periode))
                        Agence: {{$appartement->commission->periode}} mois ({{number_format($appartement->commission->montant,'2','.',' ')}} {{$appartement->commission->devise}} )
                        @endif
                        @php  
                          $total_a_verser = 0;
                          if(!empty($appartement->avance->montant))
                          $total_a_verser = $appartement->avance->montant + $appartement->caution->montant + $appartement->commission->montant;

                          
                        @endphp
                      </p>
                      <a href="javascript:void(0);" class="text-right">
                        A payer : {{number_format($total_a_verser,'2','.',' ')}} FCFA(XOF)
                      </a>
                      
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-4">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">{{ __('Points forts')}}</h5>
                      <small class="text-muted float-end">{{__('Points forts du quartier')}}</small>
                    </div>
                    
                    <div class="card-body">
                        <div class="mb-3">
                            @foreach($appartement->points_forts as $p)
                            <div class="form-check form-check-inline mt-3 col-3">
                              <input class="form-check-input" type="checkbox" name="points_forts[]" id="inlineRadio1" checked value="{{$p->id}}">
                              <label class="form-check-label" for="inlineRadio1">{{$p->libelle_point_fort}}</label>
                            </div>
                            @endforeach
                            
                        </div>
                        
                      
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">{{ __('Accesoires et comodités')}}</h5>
                      <small class="text-muted float-end">{{__('Accesoires et comodités')}}</small>
                    </div>
                    
                    <div class="card-body">
                        <div class="mb-3">
                          @foreach($appartement->comodites as $c)
                            <div class="form-check form-check-inline mt-3 col-3">
                              <input class="form-check-input" type="checkbox" name="points_forts[]" id="inlineRadio1" checked value="{{$c->id}}">
                              <label class="form-check-label" for="inlineRadio1">{{$c->libelle_comodite}}</label>
                            </div>
                          @endforeach
                            
                        </div>
                        
                      
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">{{ __('Equipements')}}</h5>
                      <small class="text-muted float-end">{{__('Equipements')}}</small>
                    </div>
                    
                    <div class="card-body">
                        <div class="mb-3">
                          @foreach($appartement->equipements as $e)
                            <div class="form-check form-check-inline mt-3 col-3">
                              <input class="form-check-input" type="checkbox" name="points_forts[]" id="inlineRadio1" checked value="{{$e->id}}">
                              <label class="form-check-label" for="inlineRadio1">{{$e->libelle_equipement}}</label>
                            </div>
                          @endforeach
                            
                        </div>
                        
                      
                    </div>
                  </div>
                </div>
              </div>

              <!-- Examples -->
              @if(!empty($appartement->location) && $appartement->location->etat == 1)
                <h5 class="pb-1 mb-4">Locataire</h5>

                <div class="row mb-5">
                  <div class="col-md-6 col-lg-6">

                    <h6 class="mt-2 text-muted">Informations personnelles</h6>


                    <div class="col-md">
                    <div class="card mb-3">
                      <div class="row g-0">
                        <div class="col-md-4">
                          @if(empty($appartement->location->locataire->photo))
                            <img class="card-img card-img-left" src="{{asset('images/avatar.png')}}" alt="{{$appartement->location->locataire->name}}">
                          @else
                            <img class="card-img card-img-left" src="{{asset('/storage/images/users/'.$appartement->location->locataire->photo)}}" alt="{{$appartement->location->locataire->name}}">
                          @endif
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">{{ucwords($appartement->location->locataire->name.' '.$appartement->location->locataire->lastname)}}</h5>
                            <p class="card-text">
                              {{$appartement->location->locataire->email}}<br>
                              {{$appartement->location->locataire->contact.' '.$appartement->location->locataire->contact_fixe}}<br>
                              {{$appartement->location->locataire->ville.' - '.$appartement->location->locataire->country->name}}<br>
                              {{$appartement->location->locataire->adresse}} 
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
                              <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel3">{{__('Location')}}</h5>
                                      <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                      ></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="table-responsive text-nowrap">
                                      <table class="table">
                                        <thead class="table-dark">
                                          <tr>
                                            <th>{{__('Periode de location')}}</th>
                                            <th>{{__('Montant payé')}}</th>
                                            <th>{{__('Reste')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                          @foreach($appartement->location->factures as $facture)
                                            @php 
                                              $totalpaiement = 0;

                                              $periode = explode('-',$facture->periode);
                                            @endphp
                                              @if(count($facture->paiement_loyers ) > 0)
                                                @foreach($facture->paiement_loyers as $paiements)
                                                  @php
                                                  $totalpaiement += $paiements->montant;
                                                  @endphp
                                                @endforeach
                                              @endif
                                          <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$periode[0]}}</strong></td>
                                            <td>{{$totalpaiement}}</td>
                                            <td>
                                              {{ $appartement->montant_loyer - $totalpaiement}}
                                            </td>
                                            <td>
                                              <span class="badge @if($facture->status==0) bg-label-success @elseif($facture->status==1) bg-label-warning @elseif($facture->status==2) bg-label-success @else bg-label-danger @endif me-1">{{$invoice->getStatus($facture->status)}}</span>
                                            </td>
                                            <td>
                                              <a class="badge bg-info" href="javascript:void(0);"
                                                    ><i class="fa fa-print me-1"></i> Quittance</a
                                                  >
                                            </td>
                                          </tr>
                                          @endforeach
                                         
                                        </tbody>
                                      </table>
                                    </div>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                          
                            </p>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                    
                    
                  </div>
                  @if(!empty($last_invoice) )
                    <div class="col-md-6 col-lg-6">
                      <h6 class="mt-2 text-muted">Loyer</h6>
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Contrat en cours</h5>
                          
                          <p>Dernière facture générée le {{date_format(new \DateTime($last_invoice->created_at),'d-m-Y')}}</p>
                          
                          <a href="#" class="text-danger"><i class="iconify-inline text-danger" data-icon="bi:file-earmark-pdf-fill"></i>{{$last_invoice->reference}}</a>
                        </div>
                        @if(!empty($last_payment))
                        <div class="card-body">
                          <span class="text-muted">Dernier paiement effectué le {{date_format(new \DateTime($last_payment->date_paiement),'d-m-Y')}}</span><br>
                          Location depuis le {{date_format(new \DateTime($appartement->location->date_location),'d-m-Y')}}
                        </div>
                        @endif
                      </div>
                    </div>
                  @endif

                </div>
              @endif


              <!-- Content types -->
              <h5 class="pb-1 mb-4">Propriétaire</h5>

              <div class="row mb-5">
                <div class="col-md-6 col-lg-6">

                  <h6 class="mt-2 text-muted">Informations personnelles</h6>


                  <div class="col-md">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img class="card-img card-img-left" src="
                          @if(empty($appartement->proprietaire->photo))
                            {{asset('images/avatar.png')}} 
                          @else 
                            {{asset('images/users/'.$appartement->proprietaire->photo)}} 
                          @endif"
                         alt="photo {{$appartement->proprietaire->name}}">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">{{ucwords($appartement->proprietaire->lastname). ' '.strtoupper($appartement->proprietaire->name)}}</h5>
                          <p class="card-text">
                            {{strtolower($appartement->proprietaire->email)}} <br>
                            {{$appartement->proprietaire->contact}}<br>
                            {{$appartement->proprietaire->ville}}<br>
                            {{$appartement->proprietaire->adresse}} 
                          </p>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  
                  
                </div>
                
                <div class="col-md-6 col-lg-6">
                  <h6 class="mt-2 text-muted">Appartements associés</h6>
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">{{$biens_proprio->count()}} biens associés à ce propriétaire</h5>
                    </div>
                    
                    <div class="card-body">
                      <a href="{{route('agence.proprio.appart',[config('app.locale'),strtolower($appartement->proprietaire->name)])}}" class="card-link"><i class="iconify fa-2x" data-icon="fa-solid:home"></i> Voir les appartements associés</a>
                      <a href="javascript:void(0)" class="card-link"><i class="iconify fa-2x" data-icon="typcn:edit"></i>Rediger une note</a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Locataire -->


              <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <!-- <caption class="ms-4">
                      List des appartements
                    </caption> -->
                    <thead>
                      <tr>
                        <th>Libellé</th>
                        <th>Période</th>
                        <th>Montant</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Caution</td>
                        <td>{{$appartement->caution->periode}} mois</td>
                        <td>{{number_format($appartement->caution->montant,'2','.',' ')}}</td>
                        <td>
                          @if($appartement->caution->paid == 0)
                          <span class="badge bg-label-warning me-1">{{$caution->getPaid($appartement->caution->paid)}}</span>
                          @else
                           <span class="badge bg-label-success me-1">{{$caution->getPaid($appartement->caution->paid)}}</span>

                          @endif
                        </td>
                        
                      </tr>
                      <tr>
                        <td>Avance</td>
                        <td>{{$appartement->avance->periode}} mois</td>
                        <td>{{number_format($appartement->avance->montant,'2','.',' ')}}</td>
                        <td>
                          @if($appartement->avance->paid == 0)
                          <span class="badge bg-label-warning me-1">{{$avance->getPaid($appartement->avance->paid)}}</span>
                          @else
                           <span class="badge bg-label-success me-1">{{$avance->getPaid($appartement->avance->paid)}}</span>

                          @endif
                        </td>
                        
                      </tr>
                      <tr>
                        <td>Agence</td>
                        <td>{{$appartement->commission->periode}} mois</td>
                        <td>{{number_format($appartement->commission->montant,'2','.',' ')}}</td>
                        <td>
                          @if($appartement->commission->paid == 0)
                          <span class="badge bg-label-warning me-1">{{$commission->getPaid($appartement->commission->paid)}}</span>
                          @else
                           <span class="badge bg-label-success me-1">{{$commission->getPaid($appartement->commission->paid)}}</span>

                          @endif
                        </td>
                        
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

             
              <!--/ Card layout -->
            </div>
            <!-- / Content -->

    <div class="buy-now">
      <a href="{{route('agence.appart.edit',[config('app.locale'),$appartement->code_appart])}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('Modifier')}}</font></font></a>
    </div>
  @stop