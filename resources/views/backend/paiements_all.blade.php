@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paiements des loyers</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      <h3>Tous les paiements</h3>

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
                <th>Période</th>
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
                <td>{{$paiements->facture->periode}}</td>
                <td>{{number_format($paiements->montant,'0','.',' ')}}</td>
                <td>{{date_format(new \DateTime($paiements->date_paiement),'d-M-Y')}}</td>
                
               
                <td> <span class="badge @if($paiements->status_transaction=='success') bg-success @else bg-danger @endif me-1">
                    {{$paiements->status_transaction}}

                  </span></td>
                <td>
                  <div class="dropdown">
                    <a  href="{{route('paiements.show',[config('app.locale'),$paiements->reference])}}" >
                      <span class="tf-icons bx bx-zoom-in"></span>
                    </a>
                    <a  href="{{ route('printReceipt',[config('app.locale'),$paiements->reference])}}" class="text-primary"><i class="fa fa-print"></i></a>
                    <a href="#" class="text-danger" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="bottom"  aria-describedby="popover359940">
                    <!-- <span class="iconify" data-icon="clarity:close-line"></span> -->
                      <span class="tf-icons bx bx-trash"></span>
                    </a>


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
