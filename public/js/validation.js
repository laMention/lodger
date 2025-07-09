function validateEmail($email){
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}

function createItem(formName,urlToController){
	var formData = new FormData(formName[0])
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })

  $(".loader").show()

  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:urlToController,
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             
		if (response.status == 401) {
			$(".loader").hide()
			swal({
	          title: response.title,
	          text: response.message,
	          icon: "error",
	        })
		}
		if (response.status == 406) {
			// Redirection
			window.location.replace('/login')
		}
		if (response.status == 504) {
			$(".loader").hide()
			swal("Hors ligne!", "Vous appareil n'est pas connecté à internet!", "warning");
		} 
		if (response.status == 200) {
			$(".loader").hide()
			swal({
	          title: response.title,
	          text: response.message,
	          icon: "success",
	        })
		}
		if (response.status == 201) {
			$(".loader").hide()
			// swal("Hors ligne!", "Vous appareil n'est pas connecté à internet!", "warning");
		}
        if (response.status ==401) {
            $(".loader").hide()
            swal({
              title: response.title,
              text: response.message,
              icon: "error",
            })
        } 
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })
}

function checkoutAbonnement(formName,urlToController)
{
	var formData = new FormData(formName[0])
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })

  $(".loader").show()

  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:urlToController,
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             
		if (response.status == 401) {
			$(".loader").hide()
			alert("Impossible d'enregistrer le paiement")
			// swal({
	  //         title: response.title,
	  //         text: response.message,
	  //         icon: "error",
	  //       })
		}
		if (response.status == 504) {
			$(".loader").hide()
			alert("hors ligne")
			// swal("Hors ligne!", "Vous appareil n'est pas connecté à internet!", "warning");
		} 
		if (response.status == 200) {
			$(".loader").hide()
			// swal({
	  //         title: response.title,
	  //         text: response.message,
	  //         icon: "success",
	  //       })

			alert("Paiement effectué")
			window.location.replace('/confirm-password')
		}
		if (response.status == 201) {
			$(".loader").hide()
			// swal("Hors ligne!", "Vous appareil n'est pas connecté à internet!", "warning");
		} 
			 
    },error:function(response){
    	$(".loader").hide()
    	alert("Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur")
    	// swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })
}

function showloader(){
  $(".loader").hide()
}
function validateEmail($email){
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test($email);
}

let state = false;
let password = document.getElementById("password");
let passwordStrength = document.getElementById("password-strength");
let lowUpperCase = document.querySelector(".low-upper-case i");
let number = document.querySelector(".one-number i");
let specialChar = document.querySelector(".one-special-char i");
let eightChar = document.querySelector(".eight-character i");

// if ($(".password").val().length > 0) {
//   let pass = document.getElementById("password").value;
//   checkStrength(pass);
// }

password.addEventListener("keyup", function(){
    let pass = document.getElementById("password").value;
    checkStrength(pass);
});


function toggle(){
    if(state){
        document.getElementById("password").setAttribute("type","password");
        state = false;
    }else{
        document.getElementById("password").setAttribute("type","text")
        state = true;
    }
}

function passStrength(show){
    show.classList.toggle("fa-eye-slash");
}

function checkStrength(password) {
    let strength = 0;

    //If password contains both lower and uppercase characters
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
        strength += 1;
        lowUpperCase.classList.remove('fa-circle');
        lowUpperCase.classList.add('fa-check');
    } else {
        lowUpperCase.classList.add('fa-circle');
        lowUpperCase.classList.remove('fa-check');
    }
    //If it has numbers and characters
    if (password.match(/([0-9])/)) {
        strength += 1;
        number.classList.remove('fa-circle');
        number.classList.add('fa-check');
    } else {
        number.classList.add('fa-circle');
        number.classList.remove('fa-check');
    }
    //If it has one special character
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
        strength += 1;
        specialChar.classList.remove('fa-circle');
        specialChar.classList.add('fa-check');
    } else {
        specialChar.classList.add('fa-circle');
        specialChar.classList.remove('fa-check');
    }
    //If password is greater than 7
    if (password.length > 7) {
        strength += 1;
        eightChar.classList.remove('fa-circle');
        eightChar.classList.add('fa-check');
    } else {
        eightChar.classList.add('fa-circle');
        eightChar.classList.remove('fa-check');   
    }

    // If value is less than 2
    if (strength < 2) {
        passwordStrength.classList.remove('progress-bar-warning');
        passwordStrength.classList.remove('progress-bar-success');
        passwordStrength.classList.add('progress-bar-danger');
        passwordStrength.style = 'width: 10%';
    } else if (strength == 3) {
        passwordStrength.classList.remove('progress-bar-success');
        passwordStrength.classList.remove('progress-bar-danger');
        passwordStrength.classList.add('progress-bar-warning');
        passwordStrength.style = 'width: 60%';
    } else if (strength == 4) {
        passwordStrength.classList.remove('progress-bar-warning');
        passwordStrength.classList.remove('progress-bar-danger');
        passwordStrength.classList.add('progress-bar-success');
        passwordStrength.style = 'width: 100%';
    }
}


function generatePassword(inputName)
{
	var url = 'https://api.motdepasse.xyz/create/?include_digits&include_lowercase&include_uppercase&password_length=15&quantity=1';

    var myRequest = new Request(url);

    fetch(myRequest).then( (response) => response.json())
      .then(function(json_response){
        json_response.passwords.forEach(
          password => $(inputName).val(password),
        );           
         
    }); 
}


// $( "#addAppartForm" ).validate({
//   rules: {
//     inputGroupLocalisation: {
//       required: true
//     }
//   },
//    messages:{

//     inputGroupLocalisation :{
// 		required:"Ce champ est requis",
//     }
// 	}
// })
