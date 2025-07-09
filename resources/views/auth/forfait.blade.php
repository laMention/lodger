<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>Gestion des locations </title>
    <meta name="description" content="" />
    <link rel="stylesheet" href="{{asset('backend/assets/css/forfait.css')}}" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{asset{('backend/assets/img/favicon/favicon.ico')}}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="header2020">
        <div class="mobileHeader">
            <div class="wrapper">
                <ul>
                    <li><a href="tel:+33177623003"><span class="iconfa iconfa-tel"></span> 01 77 62 30 03</a></li>
                    <li><a href="contact_formulaire.php" aria-label="Contacter LWS"><span class="iconfa iconfa-tchat"></span></a></li>
                    <li><a href="https://panel.lws.fr"><span class="iconfa iconfa-lock"></span> Espace client</a></li>
                </ul>
            </div>
        </div>
        <div class="wrapper">
            <div class="header_left">
                <img src="" alt="logo">
                <span class="text-logo">{{env('APP_NAME')}}</span>
            </div>
            <div class="header_right headertopLinks">
                <div class="top_header">
                    <ul>
                       <li class="number"> <i class="fa fa-phone"></i> 00000000000000</li>
                        <li class="client"><i class="fa fa-envelope"></i> support@mail.com</li>
                        <li class="contact">Contact</li>
                    </ul>

                </div>
            </div>
    </header>
    <section class="formule-3tabs bg_white m_tab mb70" id="nos_offres">
        <h2 style="margin-bottom: 40px;">Choisissez votre offre et continuez!</h2>

        <div class="wrapper with_h2" id="tab_remise">
            <div id="content_table_price">
                @if($forfaits->count() > 0)
                    @foreach($forfaits as $offre)
                        <!-- offre 1 -->
                        <div class="tabs-formule @if($offre->libelle == 'FORFAIT ANNUEL') special @endif">

                            <div class="head-tabs">
                                @if($offre->libelle == 'FORFAIT ANNUEL')
                                    <div class="best_seller">Le plus vendu</div>
                                @endif
                                <h3>{{$offre->libelle}}</h3>
                                <p class="sub-h3">Idéale pour lancer votre site rapidement</p>
                            </div>
                            <div class="content-price">
                                @if($offre->libelle == "ESSAI")
                                    <div class="price_element_percent">Période d'essai sur {{$offre->nb_jours}} {{strtolower($offre->duree)}}</div>
                                @else
                                    <div class="price_element_percent">Offre spéciale -{{round(100-(($offre->net_apres_reduction*100)/$offre->montant)).'%'}}</div>
                                @endif
                                <div class="price_element_main">
                                    @if($offre->libelle !== "ESSAI")
                                        <div class="price_element_stroke">{{$offre->montant}}</div>
                                    @endif
                                    <div class="price_element_price">{{$offre->net_apres_reduction}}</div>
                                    <div class="price_element_separator">,</div>
                                    <div class="price_element_decimal">00</div>
                                    <div class="price_element_ht">{{$offre->devise}} HT/mois</div>
                                </div>
                                <div class="price_element_ttc">({{$offre->net_apres_reduction}} {{$offre->devise}} TTC)</div>
                                
                                <form id="choixForfaitForm-{{$offre->id}}" method="POST" enctype="multipart/form-data" action="{{route('proceedToPayment')}}">@csrf
                                    <input type="hidden" name="offre_abonnement_id" class="offre_abonnement_id" value="{{$offre->id}}">
                                    <input type="hidden" class="offre_abonnement_montant" name="offre_abonnement_montant" value="{{$offre->net_apres_reduction}}">
                                    <input type="hidden" class="offre_abonnement_devise" name="offre_abonnement_devise" value="{{$offre->devise}}">
                                    <input type="hidden" class="agence_id" name="agence_id" value="{{$user->agence->id}}">
                                    <input type="hidden" class="user_id" name="user_id" value="{{$user->id}}">
                                    <button class="btn btn-orange btn-cmde " type="submit">Commander</button>
                                    <!-- <a class="btn btn-orange btn-cmde" href="/commander.php?f=1"></a> btnconfirmAbonnement -->
                                </form>


                            </div>
                            <div class="list-tabs v2">
                                <ul>
                                    <li>
                                        <div class="content">
                                            <p>
                                                
                                               {!! $offre->description !!}
                                                <a href="/popover/performances.html" data-toggle="popover" title="" data-placement="bottom" data-original-title="Performances" class="pop" style="font-size: 16px; line-height: 25px; font-weight: 400;">
                                                    <span class="tooltip_table"></span>
                                                </a>
                                            </p>
                                            <p class="no_check" style="text-align: center; margin-top: 20px; padding-left: 0;"></p>
                                        </div>
                                    </li>
                            
                                </ul>
                            </div>
                        </div>
                        
                    @endforeach
                @else
                    <h3>Aucune offre disponible à ce jour. Veuillez patienter</h3>
                @endif
                

                <button class="btn btn-orange btn-cmde btnRetourInscForm">Précedent</button>
            </div>


        </section>

{{-- @include('alerte.loader') --}}

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
    <script src="{{asset('/js/validation.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('backend/assets/js/main.js')}}"></script>
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

    $("#btnToSection2").click(function(e){
      e.preventDefault()

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

    $(".btnRetourInscForm").click(function(e){
      e.preventDefault()

        window.location.replace('/register')

    })
    $('.btnconfirmAbonnement').click(function(e){

        // var offre_id = $(".offre_abonnement_id").val()
        var offre_id = $(this).closest('.tabs-formule').find('.offre_abonnement_id').val();
        // var agence_id = $(this).closest('.tabs-formule').find('.agence_id').val();
        // var user_id = $(this).closest('.tabs-formule').find('.user_id').val();
        // var offre_id = $(this).closest('.tabs-formule').find('.offre_abonnement_id').val();
        e.preventDefault()
        // alert($("#choixForfaitForm"+offre_id))
        

        createItem($("#choixForfaitForm-"+offre_id),'/proceedToPayment')

        window.location.href = "{{route('payment_mode')}}"
        // btnconfirmAbonnement
    })
</script>

</body>
</html>