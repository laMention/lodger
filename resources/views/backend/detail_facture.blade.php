@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y container-justify-content">
      <h4 class="fw-bold py-3 mb-4">Location / Loyers / Details / <span class="text-muted fw-light">Facture {{$facture->reference}}</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="padding">
            <div class="card-header p-4">
              
              <div class="float-left"> <h3 class="mb-0">Facture #{{$facture->reference}}</h3>
              Générée le {{date_format(new \DateTime($facture->created_at),'d-m-Y')}}</div>
              <div class="">
                <span class="badge @if($facture->status==0) bg-primary @elseif($facture->status==1) bg-warning @elseif($facture->status==2) bg-success @else bg-danger @endif me-1">
                    {{$invoice->getStatus($facture->status)}}

                  </span>
                <!-- <span class="badge bg-success">Payé</span> -->
              </div>
            </div>
            <div class="row mb-4 container">
              <div class="col-sm-4">
                <h5 class="mb-3">Emetteur:</h5>
                <h3 class="text-dark mb-1">{{$facture->agence->name}}</h3>
                <div>{{$facture->agence->pays->name}}</div>
                <div>{{$facture->agence->localisation}}</div>
                <div>Email: {{$facture->agence->email}}</div>
                <div>Phone: {{$facture->agence->contact}}</div>
              </div>
              <div class="col-sm-4 ">
                <h5 class="mb-3">Recipiendaire:</h5>
                <h3 class="text-dark mb-1">{{$facture->locataire->name.' '.$facture->locataire->lastname}}</h3>
                <div>{{$facture->locataire->country->name}}</div>
                <div>{{$facture->locataire->adresse}}</div>
                <div>Email: {{$facture->locataire->email}}</div>
                <div>Phone: {{$facture->locataire->contact}}</div>
              </div>
              <div class="col-sm-4 ">
                <h5 class="mb-3">Loyer:</h5>
                <div class="text-dark mb-1">PERIODE : {{$facture->periode}}</div>
                <div>ECHEANCE : {{date_format(new \DateTime($facture->date_echeance),'d-M-Y')}}</div>
                <div> <span class="badge bg-danger me-1"> PROCHAINE ECHEANCE : {{date_format(new \DateTime($facture->next_date_echeance),'d-M-Y')}}</span></div>
                <div>PAIEMENT TOTAL : {{number_format($paiements,'0','.',' ')}}</div>
                <div><b>RESTE : {{number_format($facture->location->appartement->montant_loyer - $paiements,'0','.',' ')}} </b></div>
              </div>

              @php
                $periode = explode('-',$facture->periode);
              @endphp
            </div>
            <div class="table-responsive-sm container">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="center">#</th>
                    <th>Libellé</th>
                    <th>Localisation</th>
                    <th class="right">Loyer</th>
                    <th class="center">Durée</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="center">{!! 'Location du mois de '. $periode[0] !!}</td>
                    <td class="left strong">Location 
                      <a href="#">#{{$facture->location->appartement->code_appart}}</a><br>
                    {{$appart->getCategorie($facture->location->appartement->categorie)}}
                    @if($facture->location->appartement->categorie == 3)  
                      {{$facture->location->appartement->type_commerce}} 
                    @else 
                      {{$facture->location->appartement->libelle}} 
                    @endif<br>
                    @if($facture->location->appartement->categorie == 1)

                      {{$facture->location->appartement->num_appart.' '.$facture->location->appartement->niveau}}
                    @endif
                    </td>
                    <td class="left">{{$facture->location->appartement->adresse}} </td>
                    <td class="right">{{number_format($facture->location->appartement->montant_loyer,'0','.',' ')}}</td>
                    <td class="center">{{$facture->location->date_location->diffForHumans()}}</td>
                  </tr>                
                </tbody>
              </table>
            </div>

          </div>
            
        </div>
      

      <div class="card mt-3">
        <div class="card-header p-4">
              
          PAIEMENTS
           
        </div>
        <div class="table-responsive-sm container">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="center">#</th>
                <th>DATE</th>
                <th>MONTANT</th>
                <th class="right">MODE</th>
                <th class="center">PASSERELLE</th>
                <th class="center">ID TRANSACTION</th>
                <th class="center">STATUS</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($facture->paiement_loyers as $p)
              <tr>
                <td class="center">{!! $p->reference !!}</td>
                <td class="left strong">{{date_format(new \DateTime($p->date_paiement),'d-m-Y H:i:s')}}
                </td>
                <td class="left">{{number_format($p->montant,'0','.',' ')}} </td>
                <td class="right">{{$p->mode_paiement}}</td>
                <td class="right">{{$p->passerelle}}</td>
                <td class="center">{{$p->ref_paiement}}</td>
                <td class="center"><span class="badge @if($p->status_transaction =='success') bg-label-success @else bg-danger @endif">{{$p->status_transaction}}</td>
                <td> <a  href="{{ route('printReceipt',[config('app.locale'),$p->reference])}}" class="text-primary"><i class="fa fa-print"></i></a></td>
              </tr>        
              @endforeach        
            </tbody>
          </table>
        </div>

      </div>
    </div>
  @stop