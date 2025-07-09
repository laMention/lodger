@extends('backend.partials._template')
  @section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">{!! $breadcrumbs !!}</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Compte</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('agence.user.password',[config('app.locale')])}}"
                        ><i class="bx bx-bell me-1"></i> Mot de passe</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('agence.infos',[config('app.locale')])}}"
                        ><i class="bx bx-link-alt me-1"></i> Informations générales</a
                      >
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Profil</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4" id="imgpreview">
                        <img
                        @if(!empty(auth()->user()->photo))
                          src="{{asset('storage/users/profil/pictures/'.auth()->user()->photo)}}"

                        @else

                          src="{{asset('backend/assets/img/avatars/1.png')}}"
                        @endif
                          alt="user-avatar"
                          class="d-block rounded uploadedAvatar"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <form id="uploadedAvatarForm" method="POST" enctype="multipart/form-data">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                              <span class="d-none d-sm-block">Télécharger une nouvelle photo</span>
                              <i class="bx bx-upload d-block d-sm-none"></i>
                              <input
                                type="file"
                                id="upload"
                                class="account-file-input"
                                hidden
                                accept="image/png, image/jpeg"
                                name="avatar"
                              />
                            </label>

                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4 btn_uploadAvatar" style="display:none;">
                              <i class="bx bx-reset d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Valider</span>
                            </button>
                          </form>

                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                          <div class="progress" style="display: none;">
                            <div class="progress-bar bg-info" role="progressbar" style="width:1%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="myBar2"></div>
                          </div>
                        </div>
                    
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="lastname" class="form-label">Prénom <span class="text-danger">*</span></label>
                            <input
                              class="form-control"
                              type="text"
                              id="lastname"
                              name="lastname"
                              value="{{auth()->user()->lastname}}"
                              autofocus
                            />
                            <span class="error_lastname"></span>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nom<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" id="name" value="{{auth()->user()->name}}"/>
                            <span class="error_name"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail<span class="text-danger">*</span></label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="{{auth()->user()->email}}"
                              placeholder="john.doe@example.com"
                            />
                            <span class="error_email"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="date_naissance" class="form-label">Date de naissance<span class="text-danger">*</span></label>
                            <input
                              type="date"
                              class="form-control"
                              id="date_naissance"
                              name="date_naissance"
                              value="{{auth()->user()->date_naissance}}"
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
                                value="{{auth()->user()->contact}}"
                              />

                            </div>
                            <span class="error_contact"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Address" value="{{auth()->user()->adresse}}"/>
                            <span class="error_adresse"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="num_cni" class="form-label">N° CNI<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="num_cni" name="num_cni" placeholder="California" value="{{auth()->user()->num_cni}}"/>
                            <span class="error_num_cni"></span>

                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="ville" class="form-label">Ville<span class="text-danger">*</span></label>
                            <input
                              type="text"
                              class="form-control"
                              id="ville"
                              name="ville"
                              placeholder="Abidjan"
                              value="{{auth()->user()->ville}}"
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
                            <label for="sexe" class="form-label">Genre<span class="text-danger">*</span></label>
                            <select id="sexe" class="select2 form-select" name="sexe">
                              <option value="">Selectionner le genre</option>
                              <option {{auth()->user()->sexe == "M" ? 'selected' : ' '}} value="M">Masculin</option>
                              <option {{auth()->user()->sexe == "F" ? 'selected' : ' '}}  value="F">Feminin</option>
                            </select>
                            <span class="error_genre"></span>

                          </div>
                         
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2 btn_modifierProfil">{{__('Enregistrer')}}</button>
                          <button type="reset" class="btn btn-outline-secondary">{{__('Annuler')}}</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  <div class="card">
                    <h5 class="card-header">{{__('Supprimer le compte')}}</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">{{__('Etes vous sûr de vouloir supprimer le compte')}} ?</h6>
                          <p class="mb-0">{{__('Cette action est irreversible, une fois supprimé vous n\'aurez plus accès à votre espace de gestion.')}}</p>
                        </div>
                      </div>
                      <form id="formAccountDeactivation" onsubmit="return false">
                        <div class="form-check mb-3">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            name="accountActivation"
                            id="accountActivation"
                          />
                          <label class="form-check-label" for="accountActivation"
                            >{{__('Je confirme la désactivation de mon compte')}}</label
                          >
                        </div>
                        <button type="submit" class="btn btn-danger deactivate_account">{{__('Désactiver')}}</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    @include('alerte.loader')
  @stop