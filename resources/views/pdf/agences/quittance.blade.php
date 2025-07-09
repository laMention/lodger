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
         #invoice-POS{
      box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
      padding:2mm;
      margin: 0 auto;
      width: 100mm;
      background: #FFF;
      }
      
    ::selection {background: #f31544; color: #FFF;}
    ::moz-selection {background: #f31544; color: #FFF;}
    h1{
      font-size: 1.5em;
      color: #222;
    }
    h2{font-size: .9em;}
    h3{
      font-size: 1.2em;
      font-weight: 300;
      line-height: 2em;
    }
    p{
      font-size: 12px;
      color: #666;
      line-height: 1.2em;
    }
     
    #top, #mid,#bot{ /* Targets all id with 'col-' */
      border-bottom: 1px solid #EEE;
    }

    #top{min-height: 100px;}
    #mid{min-height: 80px;} 
    #bot{ min-height: 50px;}

    #top .logo{
      //float: left;
      height: 60px;
      width: 60px;
      background: url(http://michaeltruong.ca/images/logo.jpg) no-repeat;
      background-size: 60px 60px;
    }
    .clientlogo{
      float: left;
      height: 60px;
      width: 60px;
      background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
      background-size: 60px 60px;
      border-radius: 50px;
    }
    .info{
      display: block;
      //float:left;
      margin-left: 0;
    }
    .title{
      float: right;
    }
    .title p{text-align: right;} 
    table{
      width: 100%;
      border-collapse: collapse;
    }
    td{
      //padding: 5px 0 5px 15px;
      //border: 1px solid #EEE
    }
    .tabletitle{
      //padding: 5px;
      font-size: .5em;
      background: #EEE;
    }
    .service{border-bottom: 1px solid #EEE;}
    .item{width: 24mm;}
    .itemtext{font-size: .5em;}

    #legalcopy{
      margin-top: 5mm;
    }

  
  

    
      </style>
  </head>
  <body>
    <header>
        {{strtoupper(auth()->user()->agence->name)}}
    </header>
    
      <main>
        
  <div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 

        <h2>{{strtoupper(auth()->user()->agence->name)}}</h2>
        <p>
          <h3>QUITTANCE DE PAIEMENT DE LOYER</h2>
        </p>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p> 
            Address : {{auth()->user()->agence->adresse}}</br>
            Email   :  {{auth()->user()->agence->email}}</br>
            Phone   :  {{auth()->user()->agence->contact_fixe}}</br>
        </p>

       
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot"> 

          <div id="table">
            <table>
              <!-- <tr class="tabletitle">
                <td class="item"><h2>Designation</h2></td>
                <td class="Hours"><h2>Quantité</h2></td>
                <td class="Rate"><h2>Sous Total</h2></td>
              </tr> -->

              <tr class="service">
                <td class="tableitem"><p class="itemtext">{{'Location du mois de '. $periode[0]}}</p></td>
                <td class="tableitem"><p class="itemtext">{{$paiement->created_at}}</p></td>
                <td class="tableitem"><p class="itemtext">{{$paiement->montant}}</p></td>
              </tr>
              <tr class="service">
                <td class="tableitem"><p class="itemtext">Code appartement: {{$paiement->facture->location->appartement->code_appart}}</p></td>
                <td class="tableitem"><p class="itemtext"></p></td>
                <td class="tableitem"><p class="itemtext"></p></td>
              </tr>

              


              <tr class="tabletitle">
                <td></td>
                <td class="Rate"><h2>Total</h2></td>
                <td class="payment"><h2>{{$paiement->montant}}</h2></td>
              </tr>

            </table>
          </div><!--End Table-->

          <div id="legalcopy">
            <p class="legal"><strong>Thank you for your business!</strong>  Merci d'avoir utiliser nos services. Votre confiance nous rassure! 
            </p>
          </div>

        </div><!--End InvoiceBot-->
      </div><!--End Invoice-->

      </main>
     
      <!-- <div class="page-break"></div> -->
  </body>
</html>
