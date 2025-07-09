@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Locations en cours</span></h4>
      <hr class="my-5" />

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            
            <thead>
              <tr>
                <th>Reference</th>
                <th>Nom complet</th>
                <th>Bien </th>
                <th>Contrat</th>
                <th>Date location</th>
                <!-- <th>Prochaine échéance</th> -->
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($locations as $loc)
                <tr class="liste_location">
                  <td>
                    <input type="hidden" class="location_id" value="{{$loc->reference}}">
                    <b>
                      {{$loc->reference}}
                    </b>
                    
                  </td>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$loc->locataire->name.' '.$loc->locataire->lastname}}</strong></td>
                  <td>
                     <a href="{{ route('agence.appart.details',[config('app.locale'),$loc->appartement->code_appart]) }}" class="badge bg-label-primary me-1" >
                      {{$loc->appartement->code_appart.' - '.$appart->getCategorie($loc->appartement->categorie)}} 
                      {{$loc->appartement->categorie == 3 ? $loc->appartement->type_commerce : $loc->appartement->libelle}}
                      </a>
                  </td>
                  <td>
                    {{$loc->contrat->libelle}}                    
                  </td>
                  <td>
                    {{date_format(new \DateTime($loc->date_location),'d-m-Y')}}<br>
                    {{$loc->date_location->diffForHumans()}}
                  </td>
                 
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('agence.locations.details',[config('app.locale'),$loc->reference])}}"
                          ><i class="iconify" data-icon="octicon:eye-16"></i> Détails</a
                        >
                        <a class="dropdown-item" href="{{route('factures.locataires',[config('app.locale'),$loc->reference])}}">Factures</a>

                        <a class="dropdown-item" href="{{route('agence.locations.edit',[config('app.locale'),$loc->reference])}}"
                          ><i class="bx bx-edit-alt me-1"></i> {{__('Modifier')}}</a
                        >
                        
                        <a class="dropdown-item delete_location" href="javascript:void(0);"
                          >
                          <i class="bx bx-trash me-1"></i> {{__('Supprimer')}}
                        </a>

                        <a class="dropdown-item" href="{{route('generateContratPdf',[config('app.locale'),$loc->reference])}}" target="_blank" 
                            ><i class="bx bx-edit-alt me-1"></i> Imprimer le contrat
                        </a>

                        <a class="dropdown-item badge bg-label-danger resilier_location" href="javascript:void(0);" title="Résilier le contrat avec ce locataire" data-bs-toggle="tooltip">
                          <i class="bx bx-exclamation me-1"></i> {{__('Résilier')}}
                        </a>

                      </div>
                    </div>

                  </td>

                </tr>
             @endforeach
              
            </tbody>
          </table>
        </div>
      </div>
      
    </div>
    <div class="buy-now">
      <a href="{{route('agence.locataires.create',[config('app.locale')])}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Nouveau contrat de location</font></font></a>
    </div>

  @stop