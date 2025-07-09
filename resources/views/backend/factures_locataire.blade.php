@extends('backend.partials._template')
  @section('content')
    @if($location->count() > 0)
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Location effectué le {{date_format(new \DateTime($location->date_location),'d-m-Y')}} par {{ucwords($location->locataire->name.' '.$location->locataire->lastname)}}</span></h4>

      <hr class="my-5" />
      <div class="row">
        <div class="col-md-6 col-lg-4 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">#{{$location->appartement->code_appart}} - {{$appart->getCategorie($location->appartement->categorie)}}</h5>
                <h6 class="card-subtitle text-muted">@if($location->appartement->categorie == 3)  {{$location->appartement->type_commerce}} @else {{$location->appartement->libelle}} @endif</h6>
                @if($location->appartement->categorie == 1)
                  <h6 class="card-subtitle text-info mt-2">{{$location->appartement->niveau}}</h6>
                @endif
              <h5 class="card-title">Loyer: {{number_format($location->appartement->montant_loyer,'0','.',' ')}} {{$location->appartement->devise}} / Mois</h5>
             <h5>Locataire: {{ucwords($location->locataire->name.' '.$location->locataire->lastname)}}</h5>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">Propriétaire:{{ucwords($location->appartement->proprietaire->name.' '.$location->appartement->proprietaire->lastname)}}</h5>
               <h6 class="card-subtitle text-info mt-2">Bien: Immeuble Résidence X</h7>
              
            </div>
          </div>
        </div>
      </div>
      
      <!-- Responsive Table -->
      

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            <caption class="ms-4">
              Liste des factures de loyer
            </caption>
            <thead>
              <tr>
                <th>Reference</th>
                <!-- <th>Appartement</th> -->
                <th>Periode</th>
                <th>Echéance</th>
                <th>Montant versé</th>
                <th>Reste</th>
                <th>Prochaine échéance</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($location->factures))
                @foreach($location->factures as $factures)
                  @php 
                    $totalpaiement = 0;

                    $periode = explode('-',$factures->periode);
                  @endphp
                    @if(count($factures->paiement_loyers ) > 0)
                      @foreach($factures->paiement_loyers as $paiements)
                        @php
                        $totalpaiement += $paiements->montant;
                        @endphp
                      @endforeach
                    @endif
                  
                  <tr>
                    <td>
                      <b>{{$factures->reference}}</b>
                     
                    </td>
                    <!-- <td>Botchi dagou</td> -->
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$periode[0]}}</strong></td>
                    <td>
                      <a href="{{url('/detail-facture')}}" >{{date_format(new \DateTime($factures->date_echeance),'d-M-Y')}}</a>
                    </td>
                    <td>
                      {{$totalpaiement}}
                    </td>

                    <td>
                      {{number_format($factures->location->appartement->montant_loyer - $totalpaiement,'0','.',' ')}}
                    </td>
                    <td>{{date_format(new \DateTime($factures->next_date_echeance),'d-M-Y')}}</td>

                    <td>


                      <span class="badge @if($factures->status==0) bg-primary @elseif($factures->status==1) bg-warning @elseif($factures->status==2) bg-success @else bg-danger @endif me-1">
                        {{$facture->getStatus($factures->status)}}

                      </span>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{route('factures.details',[config('app.locale'),$factures->reference])}}"
                            ><i class="iconify" data-icon="octicon:eye-16"></i> Détails</a
                          >
                          @if($factures->location->appartement->montant_loyer - $totalpaiement > 0)
                          <a class="dropdown-item" href="javascript:void(0);"
                            data-bs-toggle="modal" data-bs-target="#payer{{$factures->id}}"
                            data-bs-offset="0,4"><i class="bx bx-edit-alt me-1" ></i> Payer</a
                          >
                          @endif
                          <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-edit-alt me-1"></i> Imprimer</a
                          >
                          <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-trash me-1"></i> Delete</a
                          >
                        </div>
                      </div>
                    </td>


                    @include('backend.partials.paiementForm')
                  </tr>
                @endforeach

                @endif
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    @else
      <center>Aucune location en cours</center>
    @endif

    <!-- <div class="buy-now">
      <a href="{{url('/nouvel-appart')}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Générer les factures de ce mois</font></font></a>
    </div> -->

  @stop

  @include('alerte.loader')