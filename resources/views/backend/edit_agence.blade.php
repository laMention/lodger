@extends('backend.partials._template')
  @section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">{!! $breadcrumbs !!}</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('agence.user.profil',[config('app.locale')])}}"><i class="bx bx-user me-1"></i> Compte</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('agence.user.password',[config('app.locale')])}}"
                        ><i class="bx bx-bell me-1"></i> Mot de passe</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="{{route('agence.infos',[config('app.locale')])}}"
                        ><i class="bx bx-link-alt me-1"></i> Informations générales</a
                      >
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Informations de votre entreprise</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4" id="imgpreview">
                        <img
                        @if(!empty(auth()->user()->agence->photo))
                          src="{{asset('storage/company/pictures/'.auth()->user()->agence->photo)}}"

                        @else

                          src="{{asset('backend/assets/img/avatars/1.png')}}"
                        @endif
                          alt="user-avatar"
                          class="d-block rounded uploadedAvatarAgence"
                          height="100"
                          width="100"
                          id="uploadedAvatarAgence"
                        />
                        <div class="button-wrapper">
                          <form id="uploadedAvatarAgenceForm" method="POST" enctype="multipart/form-data">
                            {{-- <label for="uploadAgence" class="btn btn-primary me-2 mb-4" tabindex="0">
                              <span class="d-none d-sm-block">Télécharger une image</span> --}}
                              <i class="bx bx-upload d-block d-sm-none"></i>
                              <input
                                type="hidden"
                                id="uploadAgence"
                                class="account-file-input"
                                hidden
                                accept="image/png, image/jpeg"
                                name="avatar_agence"
                              />
                            </label>

                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4 btn_uploadAvatar" style="display:none;">
                              <i class="bx bx-reset d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Valider</span>
                            </button>
                          </form>

                          {{-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> --}}
                          <div class="progress" style="display: none;">
                            <div class="progress-bar bg-info" role="progressbar" style="width:1%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="myBar2"></div>
                          </div>
                        </div>
                    
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAgenceAccountSettings" method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="societe" class="form-label">Nom société <span class="text-danger">*</span></label>
                            <input
                              class="form-control"
                              type="text"
                              id="societe"
                              name="societe"
                              value="{{auth()->user()->agence->name}}"
                              autofocus
                            />
                            <span class="error_societe"></span>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="gerant" class="form-label">Nom et prenom du gérant<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="gerant" id="gerant"  value="{{auth()->user()->agence->gerant}}"/>
                            <span class="error_gerant"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail<span class="text-danger">*</span></label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="{{auth()->user()->agence->email}}"
                              placeholder="john.doe@example.com"
                            />
                            <span class="error_email"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="agrement" class="form-label">Numéro agrément</label>
                            <input
                              type="text"
                              class="form-control"
                              id="agrement"
                              name="agrement"
                              value="{{auth()->user()->agence->agrement}}"
                            />
                            

                          <span class="error_date_naissance"></span>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="contact">Contact<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                              <!-- <span class="input-group-text">
                                <select class="input-group-text" style="border: none;">
                                  <option>(CIV)+225</option>
                                </select>
                              </span> -->
                              <input
                                type="text"
                                id="contact"
                                name="contact"
                                class="form-control"
                                placeholder="2250102030405"
                                maxlength="14"
                                value="{{auth()->user()->agence->contact}}"
                              />

                            </div>
                            <span class="error_contact"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="sexe" class="form-label">Contact 2</label>
                            <input
                              type="text"
                              class="form-control"
                              id="contact_2"
                              name="contact_2"
                              placeholder="Abidjan"
                              value="{{auth()->user()->agence->contact_fixe}}"
                            />
                            <span class="error_contact_2"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Address" value="{{auth()->user()->agence->adresse}}"/>
                            <span class="error_adresse"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="registre_commerce" class="form-label">Registre de commerce</label>
                            <input class="form-control" type="text" id="registre_commerce" name="registre_commerce" placeholder="California" value="{{auth()->user()->agence->registre_commerce}}"/>
                            <span class="error_registre_commerce"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="ville" class="form-label">Ville<span class="text-danger">*</span></label>
                            <input
                              type="text"
                              class="form-control"
                              id="ville"
                              name="ville"
                              placeholder="Abidjan"
                              value="{{auth()->user()->agence->ville}}"
                            />
                            <span class="error_ville"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">Pays<span class="text-danger">*</span></label>
                            <select id="country" name="country" class="select2 form-select show-tick">
                              @if($countries->count() > 0)
                                <option value="">Select</option>
                                @foreach($countries as $country)
                                  <option {{auth()->user()->country_id == $country->id ? 'selected' : ' '}} value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                              @else
                                <option value="">Aucun pays enregistré</option>

                              @endif
                            </select>
                            <span class="error_pays"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="localisation" class="form-label">Situation géographique<span class="text-danger">*</span></label>
                            <input
                              type="text"
                              class="form-control"
                              id="localisation"
                              name="localisation"
                              placeholder="riviera faya carrefour menuisierie rue 10"
                              value="{{auth()->user()->agence->localisation}}"
                            />
                            <span class="error_localisation"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="site_web" class="form-label">Site web</label>
                            <input
                              type="text"
                              class="form-control"
                              id="site_web"
                              name="site_web"
                              placeholder="www.siteweb.com"
                              value="{{auth()->user()->agence->site_web}}"
                            />
                            <span class="error_site_web"></span>

                          </div>
                         
                        </div>
                      </form>
                        <div class="mt-2">
                          <!-- <a href="{{route('agence.infos',[config('app.locale')])}}" class="btn btn-primary me-2 btn_updateInfos">{{__('Modifier')}}</a> -->
                          <button type="submit" class="btn btn-primary me-2 btn_modifierInfos">{{__('Modifier')}}</button>
                          <!-- <button type="reset" class="btn btn-outline-secondary">{{__('Annuler')}}</button> -->
                        </div>
                      
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
              </div>
            </div>


    @include('alerte.loader')
  @stop