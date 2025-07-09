@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Liste des appartements</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            <caption class="ms-4">
              Liste des appartements
            </caption>
            <thead>
              <tr>
                <th>Code</th>
                <th>Libellé</th>
                <th>Loyer</th>
                <th>Localisation</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @if($appartements->count() > 0)
                @foreach($appartements as $appart)
                  <tr class="ligne_appartement">

                    <td>
                      <input type="hidden" class="appartement_id" value="{{$appart->code_appart}}">
                      <b>{{$appart->code_appart}}</b>
                      {{-- <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                          <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            class="avatar avatar-xs pull-up" title="Lilian Fuller" >
                            <img src="{{asset('backend/assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle" />
                          </li>
                        </ul> --}}
                    </td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> 
                      <strong>
                        @if($appart->categorie == 3)
                          {{$appartement->getCategorie($appart->categorie).' '.$appart->type_commerce}}
                        @else
                          {{$appartement->getCategorie($appart->categorie).' '.$appart->libelle}}<br>
                          {{$appart->niveau}}
                        @endif
                      </strong>

                    </td>
                    <td>{{number_format($appart->montant_loyer,'2','.',' ')}} {{$appart->devise}}</td>

                    <td>{{$appart->adresse}}</td>
                    <td>
                      @if($appart->statut == 0)
                      <span class="badge bg-label-info me-1">{{$appartement->getStatut($appart->statut)}}</span>
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
                            ><i class="iconify" data-icon="octicon:eye-16"></i>{{__('Détails')}}</a
                          >
                          <a class="dropdown-item" href="{{ route('agence.appart.edit',[config('app.locale'),$appart->code_appart]) }}"
                            ><i class="bx bx-edit-alt me-1"></i> {{__('Modifier')}}</a
                          >
                          <a class="dropdown-item delete_appart" href="javascript:void(0);"
                            ><i class="bx bx-trash me-1"></i> {{__('Supprimer')}}</a
                          >
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
      @include('alerte.loader')
    </div>
    <div class="buy-now">
      <a href="{{route('agence.nouvel-appart',[config('app.locale')])}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter</font></font></a>
    </div>

  @stop