@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paiements des loyers</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      <h3>Mois de {{date('F Y')}}</h3>

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            <caption class="ms-4">
              Gestion des paiements
            </caption>
            <thead>
              <tr>
                <th>N°</th>
                <th>Locataire</th>
                <th>Appartement</th>
                <th>Loyer</th>
                <th>Affectation</th>
                <th>Montant</th>
                <th>Date paiement</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($paiements as $paiements)
              
              <tr>
                <td>
                 {{$paiements->reference}}
                </td>
                <td>{{$paiements->facture->location->locataire->name}}</td>
                <td>
                    {{$appart->getCategorie($paiements->facture->location->appartement->categorie)}}
                    @if($paiements->facture->location->appartement->categorie == 3)  
                      {{$paiements->facture->location->appartement->type_commerce}} 
                    @else 
                      {{$paiements->facture->location->appartement->libelle}} 
                    @endif<br>
                    @if($paiements->facture->location->appartement->categorie == 1)

                      {{$paiements->facture->location->appartement->num_appart.' '.$paiements->facture->location->appartement->niveau}}
                    @endif
                </td>
                <td>{{number_format($paiements->facture->location->appartement->montant_loyer,'0','.',' ')}}</td>
                <td>Pour la période de {{$paiements->facture->periode}}</td>
                <td>{{number_format($paiements->montant,'0','.',' ')}}</td>
                <td>{{date_format(new \DateTime($paiements->date_paiement),'d-M-Y')}}</td>
                
               
                <td> <span class="badge @if($paiements->status_transaction=='success') bg-success @else bg-danger @endif me-1">
                    {{$paiements->status_transaction}}

                  </span></td>
                <td>
                  <div class="dropdown">
                    <a type="button" href="{{route('paiements.show',[config('app.locale'),$paiements->reference])}}" class="btn btn-icon btn-outline-primary">
                      <span class="tf-icons bx bx-zoom-in"></span>
                    </a>
                    <a type="button" href="{{ route('printReceipt',[config('app.locale'),$paiements->reference])}}" class="btn btn-icon btn-outline-info">
                      <!-- <span class="tf-icons bx bx-print"></span> -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M19 7h-1V2H6v5H5c-1.654 0-3 1.346-3 3v7c0 1.103.897 2 2 2h2v3h12v-3h2c1.103 0 2-.897 2-2v-7c0-1.654-1.346-3-3-3zM8 4h8v3H8V4zm8 16H8v-4h8v4zm4-3h-2v-3H6v3H4v-7c0-.551.449-1 1-1h14c.552 0 1 .449 1 1v7z"/><path fill="currentColor" d="M14 10h4v2h-4z"/></svg>
                    </a>
                   
                    <button type="button" class="btn btn-icon btn-outline-danger" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="bottom" data-bs-html="true" data-bs-content="<p>Etes-vous sûr de vouloir supprimer ?<br> </p> <div class='d-flex justify-content-between'><button type='button' class='btn btn-sm btn-outline-secondary'>Non</button><button type='button' class='btn btn-sm btn-primary'>Continuer</button></div>" title="" data-bs-original-title="Supprimer ce paiement" aria-describedby="popover359940">
                    <!-- <span class="iconify" data-icon="clarity:close-line"></span> -->
                      <span class="tf-icons bx bx-trash"></span>
                    </button>


                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <!-- <div class="buy-now">
      <a href="javascript:void(0);" class="btn btn-danger btn-buy-now"  data-bs-toggle="modal" data-bs-target="#exLargeModal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter</font></font></a>
    </div> -->
    
    @include('alerte.loader')
  @stop
