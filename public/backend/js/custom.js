$(document).ready(function(){
	$(".box_new_proprio").hide()
	$(".type_commerce_appart").hide()
	$(".niveau_appart").hide()
	$(".nb_chambre").hide()
	$(".num_appart").hide()

	// swal("Bonjour!", "Bienvenue sur votre tableau de bord", "success");
})

var lang = navigator.language.substr(0,2).toLowerCase();

$(".new_proprio_btn").click(function(){
	$(".box_new_proprio").show()
})

$(".select_categorie").on('change',function(){
	var categorie = $(this).val()

	if(categorie == 1){
		$(".niveau_appart").show()
		$(".type_maison").show()
		$(".num_appart").show()

		$(".edit_niveau_appart").show()
		$(".edit_type_maison").show()
	}
	if(categorie == 2){
		$(".niveau_appart").hide()
		$(".type_commerce_appart").hide()
		$(".type_maison").show()
		$(".num_appart").hide()


		$(".edit_niveau_appart").hide()
		$(".edit_type_commerce_appart").hide()
		$(".edit_type_maison").show()
	}
	if(categorie == 3){
		$(".niveau_appart").hide()
		$(".type_commerce_appart").show()
		$(".type_maison").hide()
		$(".num_appart").hide()


		$(".edit_niveau_appart").hide()
		$(".edit_type_commerce_appart").show()
		$(".edit_type_maison").hide()

	}
})
$(".type_appartement").on('change',function(){
	var typemaison = $(this).val()

	if(typemaison == "4 pièces" || typemaison == "5 pièces" || typemaison == "Plus de 6 pièces"){
		$(".nb_chambre").show()
	}
	if(typemaison == "Studio" || typemaison == "2 pièces" || typemaison == "3 pièces"){
		$(".nb_chambre").hide()
	}
	
})


$("#inputGroupSelectPeriode").on('change',function(){
	var loyer = $(".loyer").val()
	
	$("#montant").val(loyer * $(this).val())

})

$("#inputGroupSelectPeriodeCommission").on('change',function(){
	var loyer = $(".loyer").val()

	$("#montantCommission").val(loyer * $(this).val())

})

$("#inputGroupSelectPeriodeAvance").on('change',function(){
	var loyer = $(".loyer").val()

	$("#montantAvance").val(loyer * $(this).val())

})

$(".loyer").on('blur',function(){
	var loyer = $(this).val()
	// alert(loyer)
	var periode_caution = $("#inputGroupSelectPeriode").val()
	var periode_avance = $("#inputGroupSelectPeriodeAvance").val()
	var periode_commission = $("#inputGroupSelectPeriodeCommission").val()
	if ($("#montant").val() == 0 || $("#montant").val() == " ") {

		$("#montant").val(loyer * periode_caution)

	}
	if($("#montantCommission").val() == 0 || $("#montantCommission").val() == ""){
		$("#montantCommission").val(loyer * periode_commission)

	}
	if ($("#montantAvance").val() == 0 || $("#montantAvance").val() == " ") {
		$("#montantAvance").val(loyer * periode_avance)

	}
})

$(".select_proprio").on('change',function(){
	var proprio = $(this).val()

	if(proprio !== "" ){
		$(".new_proprio_btn").hide()
	}
	if(proprio == "" ){
		$(".new_proprio_btn").show()
	}
	
})

$(".select_appart").on("change",function(e){
	e.preventDefault()

	var appartement = $(this).val()

	$(".frais_box").show()

	// alert(appartement)

	$.ajaxSetup({
      headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    })

    $.ajax({
    	type:"get",
    	enctype:"multipart/form-data",
    	url:"/"+lang+"/connected/company/getInfoAppart",
    	data:{appartement:appartement},
    	success:function(response){
    		if (response.status == 401) {
				swal({
		          title: response.title,
		          text: response.message,
		          icon: "error",
		        }).then(() => {
		          
		        });
			}
			if (response.status == 200) {
				var categorie = " "
				var libelle = " "
				var description = ""
    			console.log(response.data)
    			// console.log(response.equipements)
    			// console.log(response.comodites)
    			// console.log(response.points_forts)

    			// const obj = JSON.parse(response.comodites);

    			// console.log(obj)

    			if (response.data.categorie == 1) {
    				categorie = "Appartement"
    				libelle = response.data.libelle
    				// details = 
    			}
    			if (response.data.categorie == 2) {
    				categorie = "Maison villa"
    				libelle = response.data.libelle
    				
    			}
    			if (response.data.categorie == 3) {
    				categorie = "Commerce"
    				libelle = response.data.type_commerce
    			}

    			// response.comodites.forEach(function(com){
    			// 	console.log(com.libelle_comodite)
    			// });

    // 			Object.entries(response.data.equipements).forEach(entry => {
				//   const [key, value] = entry;
				//   console.log(key, value);
				// });
    			

    			$(".info_to_print").html('<label class="form-label" for="basic-icon-default-email">Infos</label><div class="input-group input-group-merge"><span class="badge bg-label-info w-100"> <span class="bg-label-info w-100"><p> REF: '+response.data.code_appart+'; '+categorie+' '+libelle+'</p><p>'+response.data.adresse+'</p><p>'+response.data.niveau+'; LOYER: '+response.data.montant_loyer+' '+response.data.devise+'</p><p>Numero appartement :'+response.data.num_appart+'; Nombre de chambre: '+response.data.nb_chambre+'</p> </span><a href="#" data-bs-toggle="modal" data-bs-target="#infoappart'+appartement+'">Afficher les détails</a></div>')
    			$(".modalinfoappart").html('<div class="modal fade" id="infoappart'+appartement+'" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel3">Détails appartement '+response.data.code_appart+'</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button></div><div class="modal-body"><div class="row"><center><h3>'+categorie+' '+libelle+'</h3></center><p>Caution: '+response.data.caution.montant+' '+response.data.caution.devise+'</p><p>Avance: '+response.data.avance.montant+' '+response.data.avance.devise+'</p><p>Commission: '+response.data.commission.montant+' '+response.data.commission.devise+'</p><p>'+response.data.description+'</p></div></div></div></div></div>')

			}
    	},error:function(response)
	    {
	        console.log("No data found")
	    }
    })
})

$(".check_caution").change(function() {
    if(this.checked) {
        //Do stuff
        $(".paid_caution").removeClass('bg-warning')
        $(".paid_caution").addClass('bg-success')

        $(".paid_caution").text('payé')

    }else{
    	$(".paid_caution").removeClass('bg-success')
        $(".paid_caution").addClass('bg-warning')

        $(".paid_caution").text('En attente')
    }
});

$(".check_avance").change(function() {
    if(this.checked) {
        //Do stuff
        $(".paid_avance").removeClass('bg-warning')
        $(".paid_avance").addClass('bg-success')

        $(".paid_avance").text('payé')

    }else{
    	$(".paid_avance").removeClass('bg-success')
        $(".paid_avance").addClass('bg-warning')

        $(".paid_avance").text('En attente')
    }
});


$(".check_commission").change(function() {
    if(this.checked) {
        //Do stuff
        $(".paid_commission").removeClass('bg-warning')
        $(".paid_commission").addClass('bg-success')

        $(".paid_commission").text('payé')

    }else{
    	$(".paid_commission").removeClass('bg-success')
        $(".paid_commission").addClass('bg-warning')

        $(".paid_commission").text('En attente')
    }
});

$("#mode_paiement").change(function(e){
	var modepaiement = $(this).val()

	if (modepaiement == "ESPECES") {
		$(".id_transaction").hide()
	}

	if (modepaiement == "CHEQUE") {
		$(".id_transaction").hide()
	}

	if (modepaiement == "MOBILE MONEY") {
		$(".id_transaction").show()
	}

	if (modepaiement == "VIREMENT BANCAIRE") {
		$(".id_transaction").show()
	}
})
$(".passerelle").change(function(e){
	var typepaiement =  $(this).val()
	


	if (typepaiement !== 2) {
		$(".cb_option").hide()
	}
	if (typepaiement == 2) {
		$(".cb_option").show()
	}


})
$("#num_compte").keyup(function(e){
	e.preventDefault()
	$(".num_compte_feedback").html('');
	$("#num_compte").addClass('is-valid');


	var valnum = $("#num_compte").val()
	var longnum = valnum.length
	var typepaiement =  $("#passerelle").val()

	if (typepaiement == 3 || typepaiement == 4 || typepaiement == 5  ) {
		// console.log(longnum)

		if (longnum < 8 || longnum > 13) {
			$("#num_compte").addClass('is-invalid');
			$(".num_compte_feedback").html('<span class="text-danger">Le numéro de téléphone est incorrect. veuillez re-saisir</span>');
			return false;
		}
	}
})

// Image photo de profil
const main_img = document.getElementById("upload");
const previewContainer_mainImg = document.getElementById("uploadedAvatar");

// image photo de l'agence
// const img_agence = document.getElementById("uploadAgenceUpdate");
// const previewContainer_imgagence = document.getElementById("uploadedAvatarAgence");

main_img.addEventListener("change", function(){

	const file = this.files[0];
	if (file) {
	  const reader = new FileReader();
	  
	  previewContainer_mainImg.style.display = "block";
	  $(".btn_uploadAvatar").show()
	  $(".btn_uploadAvatarAgence").show()
	  
	  reader.addEventListener("load", function(){
	  console.log(this);
	    //TAille en octets
	    console.log("Taille: "+file.size);
	    // Conversion en mega octets
	    const file_size = file.size / 1048576; 
	    console.log("Taille: "+file_size+" Mo")
	    if (file_size >= 10  ) {
	        swal({
	            title: "Fichier trop lourd",
	            text: "Veuillez télécharger une image de moins de 10Mo",
	            icon: "error",
	        }).then(() => {
	            //code
	            previewContainer_mainImg.setAttribute("src", "backend/assets/img/avatars/1.png");

	        });
	    }

	    previewContainer_mainImg.setAttribute("src", this.result);
	  });

	  reader.readAsDataURL(file);
	  console.log('Photo de profil importée avec succès')

	}else{
	  
	  previewContainer_mainImg.style.display = null;

	  previewContainer_mainImg.setAttribute("src", "backend/assets/img/avatars/1.png");
	}
});


// img_agence.addEventListener("change", function(){

// 	const file = this.files[0];
// 	if (file) {
// 	  const reader = new FileReader();
	  
// 	  previewContainer_imgagence.style.display = "block";
// 	  $(".btn_uploadAvatarAgence").show()
	  
// 	  reader.addEventListener("load", function(){
// 	  console.log(this);
// 	    //TAille en octets
// 	    console.log("Taille: "+file.size);
// 	    // Conversion en mega octets
// 	    const file_size = file.size / 1048576; 
// 	    console.log("Taille: "+file_size+" Mo")
// 	    if (file_size >= 10  ) {
// 	        swal({
// 	            title: "Fichier trop lourd",
// 	            text: "Veuillez télécharger une image de moins de 10Mo",
// 	            icon: "error",
// 	        }).then(() => {
	            
// 	            previewContainer_imgagence.setAttribute("src", "backend/assets/img/avatars/1.png");

// 	        });
// 	    }

// 	    previewContainer_imgagence.setAttribute("src", this.result);
// 	  });

// 	  reader.readAsDataURL(file);
// 	  console.log('Logo importée avec succès')

// 	}else{
	  
// 	  previewContainer_imgagence.style.display = null;

// 	  previewContainer_imgagence.setAttribute("src", "backend/assets/img/avatars/1.png");
// 	}
// });


var password = document.querySelector('.newpassword');
var passwordconfirm = document.querySelector('.confirmpassword');

$(".generate_password").click(function(e){
    e.preventDefault()

    // alert("generer mot de passe")
    var url = 'https://api.motdepasse.xyz/create/?include_digits&include_lowercase&include_uppercase&password_length=15&quantity=1';

    var myRequest = new Request(url);

    // console.log(myRequest)

    fetch(myRequest).then( (response) => response.json())
      .then(function(json_response){
        json_response.passwords.forEach(
          password => $(".newpassword").val(password),
          // password_confirm => $(".confirmpassword").val(password_confirm)
          // $(".show_password").show()
          
        );           
        if( password.type = "text"){
			$(".show_password").hide()
			$(".hide_password").show()
		}else{
			$(".show_password").show()
			$(".hide_password").hide()
		}      
    }); 
})




$(".newpassword").keyup(function(e){
	e.preventDefault()
	var newpass = $(".newpassword").val();
	if(newpass !== "")
	{
		$(".show_password").show()
		$(".hide_password").hide()
		if( password.type = "text"){
			$(".show_password").hide()
			$(".hide_password").show()
		}else{
			$(".show_password").show()
			$(".hide_password").hide()
		}
	}else{
		$(".show_password").hide()
		$(".hide_password").show()

	}
})

$(".confirmpassword").keyup(function(e){
	e.preventDefault()
	var newpass = $(".confirmpassword").val();
	if(newpass !== "")
	{
		$(".show_password_confirm").show()
		$(".hide_password_confirm").hide()
		if( passwordconfirm.type = "text"){
			$(".show_password_confirm").hide()
			$(".hide_password_confirm").show()
		}else{
			$(".show_password_confirm").show()
			$(".hide_password_confirm").hide()
		}

	}else{
		$(".show_password_confirm").hide()
		$(".hide_password_confirm").show()

	}
})




$(".show_password").click(function(e){
  e.preventDefault()
  $(".show_password").hide()
  $(".hide_password").show()
  
  password.type = "text";
  // $('.passwordreset').type = "text";
  // passwordconfirm.type = "text";
 

})
$(".hide_password").click(function(e){
  e.preventDefault()
  $(".hide_password").hide()
  $(".show_password").show()
  
  password.type = "password";
  // $('.passwordreset').type = "password";
  // passwordconfirm.type = "password";
 
  
})


$(".show_password_confirm").click(function(e){
  e.preventDefault()
  $(".show_password_confirm").hide()
  $(".hide_password_confirm").show()
  
  // password.type = "text";
  // $('.passwordreset').type = "text";
  passwordconfirm.type = "text";
 

})
$(".hide_password_confirm").click(function(e){
  e.preventDefault()
  $(".hide_password_confirm").hide()
  $(".show_password_confirm").show()
  
  // password.type = "password";
  // $('.passwordreset').type = "password";
  passwordconfirm.type = "password";
 
  
})




// $("#")
