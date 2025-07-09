@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Locataires</span></h4>
      <hr class="my-5" />

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table">
            
            <thead>
              <tr>
                <th>Reference</th>
                <th>Nom complet</th>
                <th>Bien </th>
                <th>Contrat</th>
                <th>Date location</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($locations as $loc)
                <tr class="liste_locataire">
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
                      </a>
                    <br>

                    {{$loc->appartement->categorie == 3 ? $loc->appartement->libelle : $loc->appartement->type_commerce}}

                  </td>
                  <td>
                    {{$loc->contrat->libelle}}
                    
                  </td>
                  <td>
                    {{$loc->date_location->diffForHuman()}}
                  </td>
                  
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{-- route('agence.locataire.details',[config('app.locale'),$loc->locataire->reference]) --}}"
                          ><i class="iconify" data-icon="octicon:eye-16"></i> Détails</a
                        >
                        <a class="dropdown-item" href="{{-- route('agence.locataire.edit',[config('app.locale'),$loc->locataire->reference]) --}}"
                          ><i class="bx bx-edit-alt me-1"></i> {{__('Modifier')}}</a
                        >
                        
                        <a class="dropdown-item" href="javascript:void(0);"
                          >
                          <i class="bx bx-trash me-1"></i> {{__('Supprimer')}}
                        </a>

                        <a class="dropdown-item badge bg-label-danger resilier_contrat_location" href="javascript:void(0);"
                          title="Résilier le contrat avec ce locataire" data-bs-toggle="tooltip">
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