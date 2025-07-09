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
                      <a class="nav-link active" href="{{route('agence.user.password',[config('app.locale')])}}"
                        ><i class="bx bx-bell me-1"></i> Mot de passe</a
                      >
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-connections.html"
                        ><i class="bx bx-link-alt me-1"></i> Notifications</a
                      >
                    </li> -->
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('agence.infos',[config('app.locale')])}}"
                        ><i class="bx bx-home me-1"></i> Information générales</a
                      >
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Mot de passe</h5>
                    <!-- Account -->
                    <div class="card-body" style="display:none;">
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
                      <form id="formPasswordSettings" method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">{{__('Nouveau mot de passe')}} <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge" id="password_input">
                              
                              <input
                                class="form-control newpassword"
                                type="password"
                                id="password"
                                name="password"
                                autofocus
                              />
                              <span class="input-group-text cursor-pointer hide_password" style="display:none;"><i class="bx bx-hide"></i></span>
                              <span class="input-group-text cursor-pointer show_password" style="display:none;"><i class="bx bx-show"></i></span>
                            </div>
                            <!-- <progress max="100" value="0" id="meter"></progress>  -->
                            <span class="error_password"></span>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="confirm_pwd" class="form-label">{{__('Confirmer le mot de passe')}}<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                              
                              <input class="form-control confirmpassword" type="password" name="confirm_pwd" id="confirm_pwd" />
                              <span class="input-group-text cursor-pointer hide_password_confirm" style="display:none;"><i class="bx bx-hide"></i></span>
                                <span class="input-group-text cursor-pointer show_password_confirm" style="display:none;"><i class="bx bx-show"></i></span>
                            </div>

                            <span class="error_confirm_pwd"></span>
                            <!-- <progress max="100" value="0" id="meter"></progress> -->
                            <!-- <div class="textbox text-center">  </div> -->

                          </div>
                          
                        
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2 btn_modifierPassword">{{__('Enregistrer')}}</button>
                          <button type="reset" class="btn btn-outline-secondary">{{__('Annuler')}}</button>
                          <a href="javascript:void(0)" class="btn btn-outline-warning generate_password">{{__('Generer un mot de passe')}}</a>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
    @include('alerte.loader')
  @stop