<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>Gestion des locations </title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{asset{('backend/assets/img/favicon/favicon.ico')}}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/fonts/boxicons.css')}}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('backend/assets/css/demo.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->
    <script src="{{asset('backend/assets/vendor/js/helpers.js')}}"></script>
    <style type="text/css">
      #returnToSection1{
        margin-left: 10px;
      }
    </style>
    
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <!-- <a href="index.html" class="app-brand-link gap-2"> -->
                  <span class="app-brand-logo demo">
                    <svg
                      width="25"
                      viewBox="0 0 25 42"
                      version="1.1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs>
                        <path
                          d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                          id="path-1"
                        ></path>
                        <path
                          d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                          id="path-3"
                        ></path>
                        <path
                          d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                          id="path-4"
                        ></path>
                        <path
                          d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                          id="path-5"
                        ></path>
                      </defs>
                      <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                          <g id="Icon" transform="translate(27.000000, 15.000000)">
                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                              <mask id="mask-2" fill="white">
                                <use xlink:href="#path-1"></use>
                              </mask>
                              <use fill="#696cff" xlink:href="#path-1"></use>
                              <g id="Path-3" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-3"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                              </g>
                              <g id="Path-4" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-4"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                              </g>
                            </g>
                            <g
                              id="Triangle"
                              transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                            >
                              <use fill="#696cff" xlink:href="#path-5"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">{{env('APP_NAME')}}</span>
                </a>

              </div>
              <!-- /Logo -->
              <h4 class="mb-2">{{ __('Nouvel Abonnement') }}! 👋</h4>
              <p class="mb-4 infos">{{ __('Information Agence')}}</p>
              

              <form id="formAbonnement" class="mb-3" action="{{-- route('register') --}}" method="post"> @csrf
                <div id="section1">
                  <div class="mb-3">
                    <label for="societe" class="form-label">{{ __('Société') }}</label>
                    <input
                      type="text"
                      class="form-control"
                      id="societe"
                      name="societe"
                      placeholder="{{ __('Enter your company') }}"
                      autofocus
                    />
                    <span class="error_societe"></span>
                    
                  </div>

                  <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      name="email"
                      placeholder="{{ __('Enter your email ') }}"
                      autofocus
                    />
                    <span class="error_email"></span>
                    
                  </div>
                  
                  <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('N° téléphone') }}</label>
                    <input
                      type="text"
                      class="form-control"
                      id="phone"
                      name="phone"
                      placeholder="{{ __('Enter your N° téléphone') }}"
                      autofocus
                    />
                    <span class="error_tel"></span>

                    
                  </div>
                   
                  <div class="mb-3">
                    <label for="ville" class="form-label">{{ __('Ville') }}</label>
                    <input
                      type="text"
                      class="form-control "
                      id="ville"
                      name="ville"
                      placeholder="{{ __('Enter your N° ville') }}"
                      autofocus
                    />
                    <span class="error_ville"></span>
                    
                  </div>
                   
                  <div class="mb-3">
                    <label for="pays" class="form-label">{{ __('pays') }}</label>
                    <select class="form-select form-control show-tick" name="pays" id="pays">
                        <option value="">Sélectionnez le pays</option>
                      @foreach($countries as $pays)
                        <option value="{{$pays->id}}">{{$pays->name}}</option>
                      @endforeach
                    </select>
                    <span class="error_pays"></span>
                  </div>
                  
                 
                  <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" id="btnToSection2" type="button">{{ __('Continuer') }} </button>
                  </div>



                </div>
                <div id="section2" style="display: none;">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">{{ __('Nom') }}</label>
                        <input
                          type="text"
                          class="form-control"
                          id="firstname"
                          name="firstname"
                          placeholder="{{ __('Enter your name') }}"
                          autofocus
                        />
                        <span class="error_firstname"></span>
                    
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">{{ __('Prénom') }}</label>
                        <input
                          type="text"
                          class="form-control"
                          id="lastname"
                          name="lastname"
                          placeholder="{{ __('Enter your firstname') }}"
                          autofocus
                        />
                        <span class="error_lastname"></span>
                    
                    </div>

                  <div class="mb-3">
                    <label for="email_user" class="form-label">{{ __('Email') }}</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email_user"
                      name="email_user"
                      placeholder="{{ __('Enter your email ') }}"
                      autofocus
                    />
                    <span class="error_email_user"></span>
                    
                  </div>
                  
                  <div class="mb-3">
                    <label for="phone_user" class="form-label">{{ __('N° téléphone') }}</label>
                    <input
                      type="text"
                      class="form-control"
                      id="phone_user"
                      name="phone_user"
                      placeholder="{{ __('Enter your N° téléphone') }}"
                      autofocus
                    />
                    <span class="error_tel_user"></span>

                    
                  </div>
                   
                  <div class="mb-3">
                    <label for="ville_user" class="form-label">{{ __('Ville') }}</label>
                    <input
                      type="text"
                      class="form-control "
                      id="ville_user"
                      name="ville_user"
                      placeholder="{{ __('Enter your N° ville') }}"
                      autofocus
                    />
                    <span class="error_ville_user"></span>
                    
                  </div>
                  <input type="hidden" name="role" value="3">
                  <input type="hidden" name="type_user" value="2">
                 
                  <div class="mb-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="accepter_cgu" name="accepter_cgu" required>
                        <label class="form-check-label" for="accepter_cgu"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><a href="#">J'accepte les conditions générales d'utilisations</a></font></font></label>
                      </div>
                      <span class="error_cgu"></span>

                  </div>
                 
                  <div class="mb-3" style="display:inline-flex;">
                    <button class="btn btn-primary d-grid " id="btnToSection3" type="submit">{{ __('Continuer') }} </button>
                    <button  class="btn btn-danger d-grid " id="returnToSection1" >{{ __('revenir') }} </button>
                  </div>

                </div>

              </form>

              
              
            </div>
          </div>
          
          <!-- /Register -->
        </div>
      </div>
      
        
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('backend/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('backend/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('backend/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('backend/assets/vendor/js/menu.js')}}"></script>
    <!-- <script src="{{asset('backend/js/custom.js')}}"></script> -->

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{asset('backend/assets/js/main.js')}}"></script>
    <script src="{{asset('/js/validation.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <script type="text/javascript">
 

    $(document).ready(function() {
        $('.show-tick').select2();
    });

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
      $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    $("#error_societe").html(" ")
    $("#error_email").html(" ")
    $("#error_tel").html(" ")
    $("#error_ville").html(" ")
    $("#error_pays").html(" ")
    // $("#error_email").html(" ")
    $("#error_firstname").html(" ")
    $("#error_lastname").html(" ")
    $("#error_email_user").html(" ")
    $("#error_tel_user").html(" ")
    $("#error_ville_user").html(" ")
    $("#error_cgu").html(" ")


    $("#btnToSection2").click(function(e){
      e.preventDefault()
      
      // $("#societe").html(" ")

      /*verification des champs avant de changer de section*/
      if ($("#societe").val() == "") {
        $("#societe").addClass('is-invalid');
        $(".error_societe").html('<span class="text-danger">veuillez renseigner le champ</span>');
        return false;
      }
      if ($("#email").val() == "") {
        $("#email").addClass('is-invalid');
        $(".error_email").html('<span class="text-danger">veuillez renseigner le champ</span>');
        return false;
      }
      if (!validateEmail($("#email").val())) {
        $("#email").addClass('is-invalid');
        $(".error_email").html("<span class='text-danger'>Email non valide <em style='color:#a5a5a5;'>(ex: yourname@domain.com)</em></span>")
        return false;
      }
      if ($("#phone").val() == "") {
        $("#phone").addClass('is-invalid');
        $(".error_tel").html('<span class="text-danger">veuillez renseigner le champ</span>');
        return false;
      }

      if ($("#ville").val() == "") {
        $("#ville").addClass('is-invalid');
        $(".error_ville").html('<span class="text-danger">veuillez renseigner le champ</span>');
        return false;
      }
      if ($("#pays").val() == "") {
        $("#pays").addClass('is-invalid');
        $(".error_pays").html('<span class="text-danger">veuillez renseigner le champ</span>');
        return false;
      }
     
      $(".infos").text("Informations Personnelles")

      $("#section1").hide()
      $("#section2").show()
      $("#section3").hide()

    })
    $("#returnToSection1").click(function(e){
      e.preventDefault()

      $("#section1").show()
      $("#section2").hide()
      $("#section3").hide()

    })

    $("#btnToSection3").click(function(e){
      e.preventDefault()

      if ($("#firstname").val() == "") {
        $("#firstname").addClass('is-invalid');
        $(".error_firstname").html('<span class="text-danger">veuillez renseigner le champ</span>');
        return false;
      }
      if ($("#lastname").val() == "") {
        $("#lastname").addClass('is-invalid');
        $(".error_lastname").html('<span class="text-danger">veuillez renseigner le champ</span>');
        return false;
      }
      if ($("#email_user").val() == "") {
        $("#email_user").addClass('is-invalid');
        $(".error_email_user").html('<span class="text-danger">veuillez renseigner le champ</span>');
        return false;
      }
      if (!validateEmail($("#email_user").val())) {
        $("#email_user").addClass('is-invalid');
        $(".error_email_user").html("<span class='text-danger'>Email non valide <em style='color:#a5a5a5;'>(ex: yourname@domain.com)</em></span>")
        return false;
      }
      if ($("#phone_user").val() == "") {
        $("#phone_user").addClass('is-invalid');
        $(".error_tel_user").html('<span class="text-danger">veuillez renseigner le champ</span>');
        return false;
      }

      if ($("#ville_user").val() == "") {
        $("#ville_user").addClass('is-invalid');
        $(".error_ville_user").html('<span class="text-danger">veuillez renseigner le champ</span>');
        return false;
      }

      if ($("#accepter_cgu").val() == "") {
        $("#accepter_cgu").addClass('is-invalid');
        $(".error_cgu").html('<span class="text-danger">Vous devez accepter les conditions generales d\'utilisation</span>');
        return false;
      }

      createItem($("#formAbonnement"),'/register')
      

      window.location.replace('/verifyEmail')

    })
    // $("#btnToSection3").click(function(e){
    //   e.preventDefault()

    //   window.location.replace('/goforfait')

    // })


</script>
  </body>
</html>