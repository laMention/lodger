@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y container-justify-content">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paiement {{$paiement->reference}}</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="padding">
            <div class="card-header p-4">
              
              <div class="float-left"> <h3 class="mb-0">Paiement #{{$paiement->reference}}</h3>
              Paiement effectué le {{date_format(new \DateTime($paiement->date_paiement),'d-m-Y')}}</div>
              <div class="">
                <span class="badge @if($paiement->status_transaction=='success')  bg-success @else bg-danger @endif me-1">
                    {{$paiement->status_transaction}}

                  </span>
                <!-- <span class="badge bg-success">Payé</span> -->
              </div>
            </div>
            <div class="row mb-4 container">
              <div class="col-sm-10">
                <h3 class="text-dark mb-1">{{$paiement->facture->location->locataire->name.' '.$paiement->facture->location->locataire->lastname}}</h3>
                
                <div>{{$paiement->facture->location->locataire->contact}}</div>
              </div>
              
           

            </div>
           

          </div>
            
      </div>
      
      <div class="container">
        <div class="row m-0">
            <div class="col-lg-7 pb-5 pe-lg-5">
                <div class="row">
                    <div class="col-12 p-5">
                        <!-- <img src="https://www.freepnglogos.com/uploads/honda-car-png/honda-car-upcoming-new-honda-cars-india-new-honda-3.png"
                            alt=""> -->

                        <img src="{{asset('/images/appartements/'.$paiement->facture->location->appartement->image)}}"
                            alt="">
                    </div>
                    <div class="row m-0 bg-light">
                        <div class="col-md-4 col-6 ps-30 pe-0 my-4">
                            <p class="text-muted">Type Bien</p>
                            <p class="h5">{{$appart->getCategorie($paiement->facture->location->appartement->categorie)}}<span class="ps-1"></span></p>
                        </div>
                        <div class="col-md-4 col-6  ps-30 my-4">
                            <p class="text-muted">Nombre de pièces</p>
                            <p class="h5 m-0">@if(!empty($paiement->facture->location->appartement->libelle)) {{$paiement->facture->location->appartement->libelle}} @endif @if(!empty($paiement->facture->location->appartement->type_commerce)) {{$paiement->facture->location->appartement->type_commerce}} @endif {{$paiement->facture->location->appartement->num_appart}}</p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Montant</p>
                            <p class="h5 m-0">{{number_format($paiement->facture->location->appartement->montant_loyer,'0','.',' ')}}</p>
                        </div>
                        <!-- <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Total payé</p>
                            <p class="h5 m-0">{{number_format($totalp,'0','.',' ')}}</p>
                        </div> -->
                        <!-- <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Color</p>
                            <p class="h5 m-0">White</p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Daily UI</p>
                            <p class="h5 m-0">#002</p>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-5 p-0 ps-lg-4">
                <div class="row m-0">
                    <div class="col-12 px-4">
                        <div class="d-flex align-items-end mt-4 mb-2">
                            <p class="h4 m-0"><span class="pe-1">{{$paiement->reference}}</span></p>
                            <!-- <P class="ps-3 textmuted">1L</P> -->
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Période</p>
                            <p class="fs-14 fw-bold"></span>{{$paiement->facture->periode}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Prochaine écheance</p>
                            <p class="fs-14 fw-bold">{{date_format(new \DateTime($paiement->facture->location->next_date_echeance),'d-M-Y')}}</p>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <p class="textmuted fw-bold">Montant versé</p>
                            <div class="d-flex align-text-top ">
                                <span class="h4">{{number_format($paiement->montant,'0','.',' ')}}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Total versé</p>
                            <p class="fs-14 fw-bold">{{number_format($totalp,'0','.',' ')}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="textmuted">Montant restant</p>
                            <p class="fs-14 fw-bold">
                                @php 
                                    $rest = $paiement->facture->location->appartement->montant_loyer - $totalp;

                                @endphp
                                {{number_format($rest,'0','.',' ')}}
                            </p>
                        </div>
                        
                    </div>
                    <div class="col-12 px-0">
                        <div class="row bg-light m-0">
                            <div class="col-12 px-4 my-4">
                                <p class="fw-bold">Paiement detail</p>
                            </div>
                            <div class="col-12 px-4">
                                <div class="d-flex  mb-4">
                                    <span class="">
                                        <p class="text-muted">Mode paiement</p>
                                        <span>{{$paiement->mode_paiement}}</span>
                                    </span>
                                    <div class=" w-100 d-flex flex-column align-items-end">
                                        <p class="text-muted">Passerelle</p>
                                        <span>{{$paiement->passerelle}}</span>
                                    </div>
                                </div>
                                <div class="d-flex mb-5">
                                    <span class="me-5">
                                        <p class="text-muted">ID transaction</p>
                                        <span>{{$paiement->ref_transaction}}</span>
                                    </span>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-12  mb-4 p-0">
                                <div class="btn btn-primary">Quittance de paiement<span class="fas fa-arrow-right ps-2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      
    </div>
  @stop