<?php
  use App\Models\Devise;

  $currency = new Devise;
?>
<nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <!-- <i class="bx bx-search fs-4 lh-0"></i> -->
        <!-- <input
          type="text"
          class="form-control border-0 shadow-none"
          placeholder="Search..."
          aria-label="Search..."
        /> -->
        <select class="form-control shadow-none js-example-basic-single">
          @foreach($currency->devises() as $currency)
            <option>{{$currency->symbol .'('.$currency->name_fr.')' }}</option>
           
          @endforeach
        </select>
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- Place this tag where you want the button to render. -->
      <li class="nav-item lh-1 me-3">
        <a href="" class="btn btn-sm btn-outline-danger">
          <span class="iconify" data-icon="octicon:bell-16"></span>
          Notifications (0)
        </a>
       
      </li>

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            @if(!empty(auth()->user()->photo))
              <img src="{{asset('storage/users/profil/pictures/'.auth()->user()->photo)}}" alt="{{auth()->user()->name}}" class="w-px-40 h-auto rounded-circle" />
             @else
              <img src="{{asset('backend/assets/img/avatars/1.png')}}"
                alt="{{auth()->user()->name}}" class="w-px-40 h-auto rounded-circle" />

             @endif
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    @if(!empty(auth()->user()->photo))
                    <img src="{{asset('storage/users/profil/pictures/'.auth()->user()->photo)}}" alt="{{auth()->user()->name}}" class="w-px-40 h-auto rounded-circle" />
                     @else
                      <img src="{{asset('backend/assets/img/avatars/1.png')}}"
                        alt="{{auth()->user()->name}}" class="w-px-40 h-auto rounded-circle" />

                     @endif
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block">{{auth()->user()->name}}</span>
                  <small class="text-muted">{{auth()->user()->getRoleUser(auth()->user()->role)}}</small><br>

                  <!-- <small>Renouvellement automatique</small> -->
                </div>
                
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('agence.user.profil',[config('app.locale')])}}">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">Profil</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Paramètres</span>
            </a>
          </li>
          <!-- <li>
            <a class="dropdown-item" href="#">
              <span class="d-flex align-items-center align-middle">
                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                <span class="flex-grow-1 align-middle">Compte</span>
              </span>
            </a>
             <span class="badge badge-center rounded-pill bg-danger w-px-20 h-px-20">{{auth()->user()->agence->compte->num_compte}}</span>
          </li> -->
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('logout')}}">
              <span class="d-flex align-items-center align-middle">
                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                <span class="flex-grow-1 align-middle">Compte</span>
              </span>
              <div class="badge bg-danger">{{auth()->user()->agence->compte->num_compte}}</div>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('logout')}}">
              <span class="d-flex align-items-center align-middle">
                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                <span class="flex-grow-1 align-middle">Solde</span>
                 <span class="badge bg-label-primary me-1">{{number_format(auth()->user()->agence->compte->solde,'2','.',' ')}}</span>
              </span>
             
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('logout')}}">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Déconnexion</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>