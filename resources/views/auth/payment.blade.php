
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
      .transformcursor{cursor: pointer;}
    </style>
    <script type="text/javascript">
      $(document).ready(function(){
        window.location.reload()
      })
    </script>
    
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{!! $breadcrumbs !!}</h4>
        <form id="checkoutForm" method="post"> @csrf
          <div class="row">
           
           <input type="hidden" name="agence_id" value="{{$user->agence_id}}">
           <input type="hidden" name="user_id" value="{{$user->id}}">
           <input type="hidden" name="abonnement_id" value="{{$abn->id}}">
           <input type="hidden" name="offre_abonnement_id" value="{{$abn->offre->id}}">
           <input type="hidden" name="montant_paiement" value="{{$abn->offre->net_apres_reduction}}">
           <input type="hidden" name="devise" value="{{$abn->offre->devise}}">
           
            <!-- Default Checkboxes and radios & Default checkboxes and radios -->
            <div class="col-xl-6">
              <div class="card mb-4">
                <h5 class="card-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Choisissez votre mode de paiement</font></font></h5>
                <!-- Checkboxes and Radios -->
                <div class="card-body">
                  <div class="row gy-3">
                    <div class="col-md">
                      <!-- <small class="text-light fw-semibold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Radio</font></font></small> -->
                      <div class="form-check mt-3 ">
                        <input name="optionPaiementMode" class="form-check-input transformcursor" type="radio" value="mobile money" id="mobileMoney" checked="">
                        <label class="form-check-label transformcursor" for="mobileMoney"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">VIA MOBILE MONEY</font></font></label>
                      </div>
                    </div>
                    <div class="col-md">
                      
                      <div class="form-check mt-3 ">
                        <input name="optionPaiementMode" class="form-check-input transformcursor" type="radio" value="carte bancaire" id="bankwire" >
                        <label class="form-check-label transformcursor" for="bankwire"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> PAR CARTE BANCAIRE</font></font></label>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <hr class="m-0">
                <!-- Inline Checkboxes -->
                <div class="card-body mobile-money-section">
                  <div class="row gy-3">
                    
                    <div class="col-md">
                      <!-- <small class="text-light fw-semibold d-block"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Radio en ligne</font></font></small> -->
                      <div class="form-check form-check-inline mt-3 ">
                        <input class="form-check-input transformcursor valueOption " type="radio" name="operateur" id="checkedorange" value="orange" style="display:none;">
                        <label class="form-check-label transformcursor check-money orangechecked" for="checkedorange"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><img src="{{asset('storage/OrangeMoney.jpg')}}" width="100px;"></font></font></label>
                      </div>
                      <div class="form-check form-check-inline ">
                        <input class="form-check-input transformcursor valueOption " type="radio" name="operateur" id="checkedmtn" value="mtn" style="display:none;">
                        <label class="form-check-label transformcursor check-money mtnchecked" for="checkedmtn"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><img src="{{asset('storage/mtn.png')}}" width="114px;"></font></font></label>
                      </div>
                      <div class="form-check form-check-inline ">
                        <input class="form-check-input transformcursor valueOption " type="radio" name="operateur" id="checkedmoov" value="moov"  style="display:none;">
                        <label class="form-check-label transformcursor check-money moovchecked" for="checkedmoov"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><img src="{{asset('storage/moov-money.png')}}" width="114px;"></font></font></label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          
             
            </div>
             <!-- Input Sizing -->
            <div class="col-md-6">
              <div class="card mb-4">
                <h5 class="card-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Compte</font></font></h5>
                <div class="card-body">
                  <!-- <small class="text-light fw-semibold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Texte de saisie</font></font></small> -->
                    <input id="country_code" class="form-control form-control-lg" type="hidden"  name="country_code" value="CI">

                  <div class="mt-2 mb-3">
                    <label for="accountNber" class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Numéro de compte</font></font></label>
                    <input id="accountNber" class="form-control form-control-lg" type="text"  name="account">
                    <span class="error_accountNber"></span>
                  </div>
                  <div class="cb_section" style="display:none;">
                    <div class="mb-3">
                      <label for="date_expi" class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Expiration</font></font></label>
                      <input id="date_expi" name="carte_date_expiration" class="form-control" type="text" placeholder="Entrée par défaut" value="mm/yy">
                      <span class="error_date_expi"></span>
                    </div>
                    <div>
                      <label for="cvc" class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CVC</font></font></label>
                      <input id="cvc" name="cvc" class="form-control form-control-lg" type="text" placeholder="" maxlength="3">
                      <span class="error_cvc"></span>

                    </div>
                  </div>
                </div>
                <hr class="m-0">
                <div class="mt-2 mb-3 ml-5">
                  <button type="button" id="validerBtn" class="btn btn-danger validerBtn">Continuer</button>
                </div>
              </div>
            </div>
           
          </div>
        </form>

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
      var checkedorange = document.getElementById("checkedorange");
      var checkedmoov = document.getElementById("checkedmoov");
      var checkedmtn = document.getElementById("checkedmtn");
      var operateur = $(".valueOption").val()


      $("#mobileMoney").on('click',function(e){
        $(".mobile-money-section").show() 
        $(".cb_section").hide()     

      })
      
      $("#bankwire").on('click',function(e){
        $(".mobile-money-section").hide()
        $(".cb_section").show()     

      })

      $(".validerBtn").click(function(e){

        e.preventDefault()

        // alert('continue')
        if (document.getElementById("mobileMoney").checked == true )
        {
            if ( document.getElementById("checkedorange").checked == false && document.getElementById("checkedmoov").checked == false && document.getElementById("checkedmtn").checked == false) {
              swal({
                title: "Erreur",
                text:"Veuillez choisir un opérateur" ,
                icon: "error",
              }).then(() => {
                return false;
              });
              return false;
            }else{
               if ($("#accountNber").val() == "") {
                  $("#accountNber").addClass('is-invalid');
                  $(".error_accountNber").html('<span class="text-danger">Veuillez renseigner le numero du compte </span>');
                  return false;
                }
              // console.log("options choose: "+operateur)
              // createItem($("#checkoutForm"),'/checkout')
              checkoutAbonnement($("#checkoutForm"),'/checkout')
            }

        }else if(document.getElementById("bankwire").checked == true){
          // console.log("carte bancaire")


          if ($("#accountNber").val() == "") {
            $("#accountNber").addClass('is-invalid');
            $(".error_accountNber").html('<span class="text-danger">Veuillez renseigner le numero du compte </span>');
            return false;
          }
          if ($("#date_expi").val() == "mm/yy" || $("#date_expi").val() == "") {
            $("#date_expi").addClass('is-invalid');
            $(".error_date_expi").html('<span class="text-danger">Veuillez renseigner la date d\'expiration </span>');
            return false;
          }
          if ($("#cvc").val() == "" ) {
            $("#cvc").addClass('is-invalid');
            $(".error_cvc").html('<span class="text-danger">Veuillez renseigner le champ </span>');
            return false;
          }
          if (isNaN($("#cvc").val()) ) {
            $("#cvc").addClass('is-invalid');
            $(".error_cvc").html('<span class="text-danger">Uniquement des chiffres autorisés </span>');
            return false;
          }


          checkoutAbonnement($("#checkoutForm"),'/checkout')
        }else{
          swal({
            title: "Erreur",
            text:"Veuillez choisir une option" ,
            icon: "error",
          }).then(() => {
            return false;
          });
        }

      })

      $(".orangechecked").click(function()
      {
        $('.orangechecked').addClass('mobile-money-cheched')
        $('.mtnchecked').removeClass('mobile-money-cheched')
        $('.moovchecked').removeClass('mobile-money-cheched')
      })
      $(".mtnchecked").click(function()
      {
        $('.orangechecked').removeClass('mobile-money-cheched')

        $('.mtnchecked').addClass('mobile-money-cheched')
        $('.moovchecked').removeClass('mobile-money-cheched')
      })
      $(".moovchecked").click(function()
      {
        $('.orangechecked').removeClass('mobile-money-cheched')

        $('.mtnchecked').removeClass('mobile-money-cheched')
        $('.moovchecked').addClass('mobile-money-cheched')
      })

      // return redirect()->route('confirmPaswwordForm')->with(compact('user'));
    </script>
  </body>
</html>