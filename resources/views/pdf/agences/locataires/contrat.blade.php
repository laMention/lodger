<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8" />
      <meta name="description" content="Reserver des lots sur bolomba, et obtenez votre bien moins de 48 heures">
      <meta name="author" content="Patrick Elysee Botchi">
      <meta name="keywords" content="reservation,reserver,lot,lots,ilot,ilots,facture,confirmation,refrence,lotissement,amenagement,amenageur">
      <title>{{config('app.name')}} | Fiche de reservation</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

      <!-- <link href="css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
      
      <link href="assets/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

      <link rel="icon" type="image/png" href="icones/favicon.png" />

      <!-- <link href="css/fichereservation.css" rel="stylesheet" type="text/css" media="all" /> -->

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
      

      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

      <style type="text/css">
          
          body {
            margin: 0px auto !important;
          }
          
          .page-break {
            page-break-after: always;
          }

          @media only screen and (max-width: 300px){ 
       
        thead, tbody{width: 100%}
        .table {width:100% !important;margin:auto !important;}
        .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto !important;display: block !important;}    
        span.title{font-size:20px !important;line-height: 23px !important}
        span.subtitle{font-size: 14px !important;line-height: 18px !important;padding-top:10px !important;display:block !important;}    
        td.box p{font-size: 12px !important;font-weight: bold !important;}
        .table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr { 
          display: block !important; 
        }
        
      }
  @media only screen and (min-width: 301px) and (max-width: 500px) { 
        thead, tbody{width: 100%}
        .table {margin:auto!important;} 
        .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}  
        .table-recap{width: 295px !important;}
        .table-recap tr td, .conf_body td{text-align:center !important;}
        .table-recap tr th{font-size: 10px !important}
        
      }
  @media only screen and (min-width: 501px) and (max-width: 768px) {
        thead, tbody{width: 100%}
        .table {margin:auto!important;} 
        .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}      
      }
  @media only screen and (max-device-width: 480px) { 
        thead, tbody{width: 100%}
        .table {margin:auto!important;} 
        .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
        
        .table-recap{width: 295px!important;}
        .table-recap tr td, .conf_body td{text-align:center!important;} 
        .address{display: block !important;margin-bottom: 10px !important;}
        .space_address{display: none !important;} 
      }
      .
      @page {
                margin: 0px auto;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
                background-color: #fff;
                color: white;
                text-align: center;
                line-height: 35px;
            }

            footer {
                /*position: fixed; */
                /*bottom: -50px; */
                
                /*height: 50px; */

                /** Extra personal styles **/
                /*background-color: #03a9f4;*/
                color: white;
                text-align: center;
                /*line-height: 35px;*/
            }
            .textfooter{
              font-size: 12px;
              text-align: center;
              position: fixed; 
                bottom: -40px;
                /*left: 0px; 
                right: 0px;
*/            }
    
      </style>
  </head>
  <body>
    <header>
        <img class="d-block mx-auto mb-4" src="" alt="logo bolomba" style="width:100px;"><br>
        <h3>{{$title}}</h3>
    </header>
    <p class="textfooter"> {{auth()->user()->agence->name.'-'.auth()->user()->agence->adresse.''.auth()->user()->agence->localisation.'-'.auth()->user()->agence->registre_commerce}}<br>
            Tel: {{auth()->user()->agence->contact}}  @if(!empty(auth()->user()->agence->contact_fixe)) - {{auth()->user()->agence->contact_fixe}}  @endif </p>
      <main>
        <table style="border:2px solid #000;">
            <tr  align="center"><td style="font-family:Verdana, Geneva, sans-serif; font-weight:600; font-size:13px; border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" width="34%" height="32" align="center">CONTRAT DE LOCATION
                  {{strtoupper($location->contrat->libelle)}}</td></tr>
          </table>
        <p style="page-break-after: never;">
          
          

          <div class="container">
						<p>       	
						Entre les soussignés <b>{{strtoupper(auth()->user()->agence->name)}}</b> <br>
						Agissant au nom et comme mandataire de <b>{{strtoupper($location->appartement->proprietaire->name.' '.$location->appartement->proprietaire->lastname)}}</b><br>
						Propriétaire, désigné dans tout ce va suivre « le bailleur »<br>
						Cel :<b>{{auth()->user()->agence->contact}}</b> .…<br>
						Tel :<b>{{auth()->user()->agence->contact_fixe}}</b>.………<br>
						Adresse postale :<b>{{auth()->user()->agence->adresse}}.{{auth()->user()->agence->localisation}}</b><br>
					
					</p>
					<p>
							D’une part<br>
              Et
              <b>
							 {!! strtoupper($location->locataire->name.' '.$location->locataire->lastname) !!}.
              </b>
					</p>
					<p>
						Locataire, désigné dans tout ce qui va suivre « le preneur »<br>
						Cel : <b>{!! strtoupper($location->locataire->contact) !!}</b>.<br>
						Tel :<b>{!! strtoupper($location->locataire->contact_fixe) !!}</b>.<br>
            Adresse postale :<b>{!! strtoupper($location->locataire->adresse) !!}</b>.<br>
            Ville :<b>{!! strtoupper($location->locataire->ville) !!}</b>.<br>
						Pays :<b>{!! strtoupper($location->locataire->country->name) !!}</b>.<br>

					</p>
					<p>
						D’autre part<br>
						Il a été convenu et arrêté ce qui suit :<br>
						Le bailleur loue les présentes au preneur qui accepte, les locaux dont la désignation suit :<br>

					</p>
					<p>
						<h5> DESIGNATION</h5>

					Il est précisé que l’emplacement est livré, et que le preneur devra supporter les coûts et frais de peinture, électricité, téléphone et en général ; tous les travaux d’aménagement.<br>
					Tel au surplus des coûts se poursuit et se comporte sans plus ample description, le preneur déclarant avoir vu, visité et parfaitement connaitre les locaux loués, qu’il consent à occuper dans son état actuel.

					</p>
					<p>
						<h5>OBJET</h5>

La société donne en location au preneur, qui accepte, le local situé à {{$location->appartement->adresse}} (rue, N° de l’appartement, localité, si connues lot, ilot,), en vue de l’exercice de {{$location->appartement->destination_local}}(type d’activité: boucherie, magasin de vêtements, café,etc.).<br>

Avant l’entrée en jouissance du bien loué par le preneur, le bailleur et le preneur dresseront ensemble un état des lieux détaillé. Ce dernier fera partie intégrante du contrat. Le preneur s’engage à restituer le bien loué au bailleur dans le même état au terme du bail.<br>

					</p>
          <p>
            Le présent contrat a pour objet la location d’un logement ainsi déterminé : <br>

A. Consistance du logement 

Adresse du logement [exemples : adresse / bâtiment / étage / porte etc.] :

{{$location->appartement->adresse}}_______________________<br>
Type d’habitat : @if($location->appartement->categorie == 1) Appartement @elseif($location->appartement->categorie == 2) Villa @else Commerce @endif {{$location->appartement->type_immobilier}}

Période de construction : {{$location->appartement->annee_construction}}<br>

- surface habitable : {{$location->appartement->surface_habitable}}_ m2     <br>                - nombre de pièces principales : _{{$location->appartement->nb_piece_principale}}_ <br>
- Autres parties du logement : 
□ Autres : ______________________________________________________________________________

Éléments d’équipements du logement : cuisine équipée, détail des installations sanitaires ... :

@foreach($location->appartement->comodites as $c) □ {{$c->libelle_comodite}}   @endforeach

________________________________________________________________________________________
<br>
B. Destination des locaux : {{$location->appartement->destination_local}}
<br>

C. Le cas échéant, Énumération des locaux, parties, équipements et accessoires de l’immeuble à usage commun : @foreach($location->appartement->equipements as $c) □ {{$c->libelle_equipement}} -  @endforeach □ autres  : _____________________________________________________
<br>
D. Montant du loyer : {{$location->appartement->montant_loyer}} {{$location->appartement->devise}} 
<br>
E. Caution: {{$location->appartement->caution->montant}} {{$location->appartement->devise}} <br>
F. Avance: {{$location->appartement->avance->montant}} {{$location->appartement->devise}} <br>
G. Commission Agence: {{$location->appartement->commission->montant}} {{$location->appartement->devise}} 
          </p>
        
      	</div>
      </p>
      <p style="page-break-after: never;"></p>
      </main>
     
      <!-- <div class="page-break"></div> -->
  </body>
</html>
