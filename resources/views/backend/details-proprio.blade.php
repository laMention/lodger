@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Propriétaire #{{$proprietaire->reference}} /</span> Détails</h4>
      <div class="row mb-5">
        <div class="col-md-8 col-lg-8 mb-3">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">{{ucwords($proprietaire->lastname.' '.$proprietaire->name)}}</h5>
              <p class="card-text">
                {{$proprietaire->email}} <br>
                {{$proprietaire->contact}}<br>
                {{$proprietaire->ville.' - '.$proprietaire->country->name}}<br>
                {{$proprietaire->adresse}}
              </p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Propriétaire de {{$proprietaire->appartements->count()}}  {{$proprietaire->appartements->count() <= 1 ? 'bien' : 'biens'}}</h5>
              <div class="table-responsive text-nowrap">
                <table class="table">
                  <caption class="ms-4">
                    Liste des appartements
                  </caption>
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>Libellé</th>
                      <th>Localisation</th>
                      <th>Loyer</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($appartements as $appart)
                      <tr>
                        <td>
                          <b>{{$appart->code_appart}}</b>
                          
                        </td>
                        <td>
                          @if($appart->categorie == 1 || $appart->categorie == 2)

                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$appartement->getCategorie($appart->categorie).' '.$appart->libelle}}</strong><br>
                          <i class="fab fa-angular fa-lg text-danger me-3"></i>{{$appart->niveau}}

                          @else
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>                          {{$appartement->getCategorie($appart->categorie)}} </strong><br>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i>{{$appart->type_commerce}}
                          @endif
                        </td>
                        
                        <td>{{$appart->adresse}}</td>
                        <td>{{number_format($appart->montant_loyer,'2','.',' ')}} {{$appart->devise}}</td>
                        <td>@if($appart->statut == 0)
                            <span class="badge bg-label-success me-1">{{$appartement->getStatut($appart->statut)}}</span>
                            @else
                            <span class="badge bg-label-danger me-1">{{$appartement->getStatut($appart->statut)}}</span>

                          @endif
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('agence.appart.details',[config('app.locale'),$appart->code_appart]) }}"
                                ><i class="iconify" data-icon="octicon:eye-16"></i> {{__('Détails')}}</a
                              >
                              
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            @if($appartements->count() > 0)
            <div class="card-footer">
              <a href="{{route('agence.proprio.appart',[config('app.locale'),strtolower($proprietaire->name)])}}">Voir tout</a>
            </div>
            @endif  
          </div>

        </div>
        <div class="col-md-4 col-lg-4 mb-3">
          <div class="card mb-4">
            <div class="card-body">
              @if(empty($proprietaire->photo))
                <img class="card-img card-img-left" src="{{asset('images/avatar.png')}}" alt="Card image">
              @else
                <img class="card-img card-img-left" src="{{asset('images/users/'.$proprietaire->photo)}}" alt="Card image">

              @endif
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              @if(empty($proprietaire->num_cni))
                <img class="card-img card-img-left" src="{{asset('images/cni_avatar.png')}}" alt="Card image">
              @else
                <img class="card-img card-img-left" src="{{asset('images/identities/'.$proprietaire->num_cni)}}" alt="Card image">

              @endif
             
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="buy-now">
      <a href="{{route('agence.proprietaire.edit',[config('app.locale'),$proprietaire->reference])}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('Modifier')}}</font></font></a>
    </div>

  @stop