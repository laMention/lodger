@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Loyers</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            <caption class="ms-4">
              Gestion des loyers
            </caption>
            <thead>
              <tr>
                <th>N°</th>
                <th>Locataire</th>
                <th>Appartement</th>
                <th>Loyer</th>
                <th>Période</th>
                <th>Echeance</th>
                <th>Montant versé</th>
                <th>Arriéré</th>
                <!-- <th></th> -->
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($factures) && $factures->count() > 0)
                @foreach($factures as $factures)
                @php
                  $periode = explode('-',$factures->periode);
                  $totalpaiement = 0;
                @endphp
                 @foreach($factures->paiement_loyers as $p)
                  @php
                  $totalpaiement += $p->montant; 
                  @endphp
                 @endforeach
                <tr>
                  <td>
                   {{$factures->reference}}
                  </td>
                  <td>
                    @if(!empty($factures->location->locataire))
                    {{$factures->location->locataire->name}}
                    @endif
                  </td>
                  <td>
                    @if(!empty($factures->location->appartement))
                      {{$appart->getCategorie($factures->location->appartement->categorie)}}
                      @if($factures->location->appartement->categorie == 3)  
                        {{$factures->location->appartement->type_commerce}} 
                      @else 
                        {{$factures->location->appartement->libelle}} 
                      @endif<br>
                      @if($factures->location->appartement->categorie == 1)

                        {{$factures->location->appartement->num_appart.' '.$factures->location->appartement->niveau}}
                      @endif
                    @endif
                  </td>
                  <td>{{number_format($factures->location->appartement->montant_loyer,'0','.',' ')}}</td>
                  <td>{{$periode[0]}}</td>
                  <td>{{date_format(new \DateTime($factures->date_echeance),'d-M-Y')}}</td>
                  <td><span class="badge bg-info"> {{number_format($totalpaiement,'0','.',' ')}}</span></td>
                  <td>
                    
                      <span class="badge @if($factures->date_echeance < date('Y-m-d')) bg-label-danger @elseif($factures->date_echeance = date('Y-m-d')) bg-label-warning @else bg-label-secondary   @endif me-1">{{number_format($factures->location->appartement->montant_loyer - $totalpaiement,'0','.',' ')}} </span>
                   
                  </td>
                  
                  <td> <span class="badge @if($factures->status==0) bg-primary @elseif($factures->status==1) bg-warning @elseif($factures->status==2) bg-success @else bg-danger @endif me-1">
                      {{$invoice->getStatus($factures->status)}}

                    </span></td>
                  <td>
                    <div class="dropdown">
                      <a type="button" href="{{route('factures.details',[config('app.locale'),$factures->reference])}}" class="btn btn-icon btn-outline-primary" data-bs-toggle="tooltip" data-bs-title="information">
                        <span class="tf-icons bx bx-zoom-in"></span>
                      </a>
                      @if($factures->location->appartement->montant_loyer - $totalpaiement > 0)
                      <button type="button" class="btn btn-icon btn-outline-info" data-bs-toggle="modal" data-bs-target="#payer{{$factures->id}}"
                            data-bs-offset="0,4" title="Regler l'arriéré">
                        <!-- <box-icon type='solid' name='file-pdf' class="text-danger"></box-icon> -->
                        <span class="tf-icons bx bx-money"></span>
                      </button>
                      @endif
                      <a target="_blank" class="btn btn-icon btn-outline-info" title="Imprimer" href="{{route('agence.factures.print',[config('app.locale'),$factures->reference])}}">
                        <span class="tf-icons bx bx-file"></span>
                        
                      </a>
                   
                      

                      <button type="button" class="btn btn-icon btn-outline-danger" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="bottom" data-bs-html="true" data-bs-content="<p>Etes-vous sûr de vouloir supprimer ?<br> </p> <div class='d-flex justify-content-between'><button type='button' class='btn btn-sm btn-outline-secondary'>Non</button><button type='button' class='btn btn-sm btn-primary'>Continuer</button></div>" title="" data-bs-original-title="Supprimer ce paiement" aria-describedby="popover359940">
                      <!-- <span class="iconify" data-icon="clarity:close-line"></span> -->
                        <span class="tf-icons bx bx-trash"></span>
                      </button>


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
    <div class="buy-now">
      <a href="#" class="btn btn-danger btn-buy-now generateInvoices" id="generateInvoices"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Générer les factures de ce mois</font></font></a>
    </div>
    
    @include('alerte.loader')
  @stop
