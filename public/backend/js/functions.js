// $(document).ready(function(){

// 	separer_nombre_2('0512345678')

// 	recup('0512345678')
// })

	const isOffline = window.navigator.offLine;
		// true or false

		if (isOffline) {
		  swal("Hors ligne!", "Vous appareil n'est pas connecté à internet!", "warning");
		} 

var lang = navigator.language.substr(0,2).toLowerCase();

/*------------ APPARTEMENT MANAGEMENT -----------*/
// Validate and record new appart
$(".simple_save").click(function(e){
	e.preventDefault()
	getTynimceValue()
	
	var formData = new FormData($("#addAppartForm")[0])
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })

  $(".loader").show()

  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/appartement/store",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             
			if (response.status == 401) {
				$(".loader").hide()
				alertify.set('notifier','position', 'top-right');
				alertify.error(response.message);
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
        }).then(() => {
          $("#addAppartForm")[0].reset()
          
        });
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })

})
// Validate and update appart
$(".update_appart_btn").click(function(e){
	e.preventDefault()
	getTynimceValue()
	code_appart = $(".code_appart").val()
	// alert(code_appart)
	var formData = new FormData($("#editAppartForm")[0])
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
  $(".loader").show()
  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/appartement/update/"+code_appart,
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             
			if (response.status == 401) {
				$(".loader").hide()
				alertify.set('notifier','position', 'top-right');
				alertify.error(response.message);
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
        }).then(() => {
          window.location.reload()
        });
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })

})
// Delete appart
$(".delete_appart").click(function(e){
	e.preventDefault()

	var appartement = $(this).closest('.ligne_appartement').find('.appartement_id').val();
	
 swal({
  title: "Suppression",
  text:"Etes-vous sûr de vouloir supprimer ce bien ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/appartement/delete/"+appartement,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});


})

/*------------ CONTRAT MANAGEMENT ---------------*/
$(".save_contrat").click(function(e){
	e.preventDefault()
	getTynimceValue()
	// alert('save contrat')
	var formData = new FormData($("#createContratForm")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
  $(".loader").show()
  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/type-contrat/store",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             
			if (response.status == 401) {
				$(".loader").hide()
				alertify.set('notifier','position', 'top-right');
				alertify.error(response.message);
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
        }).then(() => {
          // window.location.replace("/"+lang+"/connected/company/type-contrats")
          window.location.reload()
        });
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Une erreur est survenue. contactez le technicien ou le dévéloppeur", "error");
    }
  })


})

$(".update_contrat").click(function(e){
	e.preventDefault()
	getTynimceValue()
	var reference = $(".ref_contrat").val()
	// alert('save contrat')
	var formData = new FormData($("#editContratForm")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
  $(".loader").show()
  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/type-contrat/update/",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             
			if (response.status == 401) {
				$(".loader").hide()
				alertify.set('notifier','position', 'top-right');
				alertify.error(response.message);
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
        }).then(() => {
          window.location.reload()
        });
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Une erreur est survenue. contactez le technicien ou le dévéloppeur", "error");
    }
  })


})
$(".delete_contrat").click(function(e){
	e.preventDefault()

	var contrat = $(this).closest('.liste_contrat').find('.ref_contrat').val();
	
 swal({
  title: "Suppression",
  text:"Etes-vous sûr de vouloir supprimer ce contrat ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/type-contrat/delete/"+contrat,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});


})

/*=============== PROPRIETAIRE MANAGEMENT ============*/
$(".save_proprietaire").click(function(e){
	e.preventDefault()

	
	var formData = new FormData($("#newProprioForm")[0])
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })

  $(".loader").show()

  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/proprietaires/store",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             
			if (response.status == 401) {
				$(".loader").hide()
				alertify.set('notifier','position', 'top-right');
				alertify.error(response.message);
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
        }).then(() => {
          $("#newProprioForm")[0].reset()
          
        });
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })

})
$(".update_proprietaire").click(function(e){
	e.preventDefault()

	
	var formData = new FormData($("#editProprioForm")[0])
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })

  $(".loader").show()

  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/proprietaires/update",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             
			if (response.status == 401) {
				$(".loader").hide()
				alertify.set('notifier','position', 'top-right');
				alertify.error(response.message);
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
        }).then(() => {
          // $("#newProprioForm")[0].reset()
          
        });
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })

})
$(".delete_proprio").click(function(e){
	e.preventDefault()

	var proprietaire = $(this).closest('.liste_proprietaire').find('.proprietaire_id').val();
	// alert(proprietaire)
 swal({
  title: "Êtes-vous sûr?",
  text:"Etes-vous sûr de vouloir supprimer ce proprietaire ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/proprietaires/delete/"+proprietaire,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});


})

$(".resilier_contrat_proprio").click(function(e){
	e.preventDefault()

	var proprietaire = $(this).closest('.liste_proprietaire').find('.proprietaire_id').val();
	// alert(proprietaire)
 swal({
  title: "Êtes-vous sûr?",
  text:"La résiliation du contrat entrainera la suppression automatique des biens lié à ce proprietaire. Voulez-vous continuer ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/proprietaires/resilier-contrat/"+proprietaire,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});


})
/*============= LOCATION MANAGEMENT ==================*/
$(".save_location").click(function(e){
	e.preventDefault()


	// alert("save location")
	var formData = new FormData($("#addLocationForm")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
  $(".loader").show()
  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/location/store",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             // console.log(response.location.reference)
			if (response.status == 401) {
				$(".loader").hide()
				alertify.set('notifier','position', 'top-right');
				alertify.error(response.message);
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
        }).then(() => {
          $("#addLocationForm")[0].reset()
          
          // generer le contrat en pdf
          // getHttpMethod("connected/company/print-pdf-contrat/"+response.location.reference)

        });
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })

})
$(".update_location").click(function(e){
	e.preventDefault()

	// var appartement = $(this).closest('.ligne_appartement').find('.appartement_id').val();
	
 swal({
  title: "Voulez-vous modifier",
  text:"Etes-vous sûr de vouloir modifier cette opération ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {


	var formData = new FormData($("#editLocationForm")[0])
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
	  	$.ajax({
			  	type:"post",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/location/update/",
			   	data:formData,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});


})

$(".delete_location").click(function(e){
	e.preventDefault()

	var location = $(this).closest('.liste_location').find('.location_id').val();
	// alert(location)
 swal({
  title: "Êtes-vous sûr?",
  text:"Attention Vous voulez supprimer un contrat de location en cours. Voulez-vous continuer ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/locations/delete/"+location,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});


})

$(".resilier_location").click(function(e){
	e.preventDefault()

	var location = $(this).closest('.liste_location').find('.location_id').val();
	// alert(location)
 swal({
  title: "Êtes-vous sûr?",
  text:"Attention Vous voulez résilier un contrat de location en cours. Voulez-vous continuer ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/locations/resilier/"+location,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});


})

/*=============LOCATAIRE MANANGEMENT =================*/
$(".update_locataire").click(function(e){
	e.preventDefault()

	
	var formData = new FormData($("#editLocataireForm")[0])
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })

  $(".loader").show()

  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/locataire/update/",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){			             
			if (response.status == 401) {
				$(".loader").hide()
				alertify.set('notifier','position', 'top-right');
				alertify.error(response.message);
			}
			if (response.status == 504) {
				$(".loader").hide()
				swal("Hors ligne!", "Votre appareil n'est pas connecté à internet!", "warning");
			} 
			if (response.status == 200) {
				$(".loader").hide()
				swal({
          title: response.title,
          text: response.message,
          icon: "success",
        }).then(() => {
          // $("#newProprioForm")[0].reset()
          
        });
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })

})

$(".resilier_contrat_location").click(function(e){
	e.preventDefault()

	var locataire = $(this).closest('.liste_locataire').find('.locataire_id').val();
	// alert(locataire)
 swal({
  title: "Êtes-vous sûr?",
  text:"La résiliation du contrat entrainera la suppression automatique de ce locataire. Voulez-vous continuer ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/locataire/resilier/"+locataire,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});


})
/*=============PAIEMENT FACTURE MANAGEMENT ===================*/
$(".save_payment").click(function(e){
	e.preventDefault()


	if($("#date_paiement").val() == "")
	{
		$("#date_paiement").addClass('is-invalid');
		$(".date_feedback").html('<span class="text-danger">Champ obligatoire</span>');
		return false;
	}
	if($("#montant_paiement").val() == "")
	{
		$("#montant_paiement").addClass('is-invalid');
		$(".montant_feedback").html('<span class="text-danger">Champ obligatoire</span>');
		return false;
	}
	if($("#mode_paiement").val() == "")
	{
		$("#mode_paiement").addClass('is-invalid');
		$(".mode_feedback").html('<span class="text-danger">Champ obligatoire</span>');
		return false;
	}

	// alert("save location")
	var formData = new FormData($("#savePaiement")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
  $(".loader").show()
  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/factures/payer",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             
			if (response.status == 401) {
				$(".loader").hide()
				alertify.set('notifier','position', 'top-right');
				alertify.error(response.message);
			}
			if (response.status == 200) {
				$(".loader").hide()
				alertify.set('notifier','position', 'top-right');
				alertify.success(response.message);
				$("#savePaiement")[0].reset()
				window.location.reload()
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })

})

$(".btnsave_moyenpaiement").click(function(e){
	e.preventDefault()
	if($("#locataire").val() == "")
	{
		$("#locataire").addClass('is-invalid');
		$(".loc_feedback").html('<span class="text-danger">Sélectionner le locataire</span>');
		return false;
	}
	if($("#passerelle").val() == "")
	{
		$("#passerelle").addClass('is-invalid');
		$(".passerelle_feedback").html('<span class="text-danger">Sélectionner le type de paiement</span>');
		return false;
	}
	if($("#num_compte").val() == "")
	{
		$("#num_compte").addClass('is-invalid');
		$(".num_compte_feedback").html('<span class="text-danger">Champ obligatoire</span>');
		return false;
	}
	var typepaiement =  $("#passerelle").val()
	if (typepaiement == 2) {
		if($("#carte_cvc").val() == "")
		{
			$("#carte_cvc").addClass('is-invalid');
			$(".cvc_feedback").html('<span class="text-danger">Champ obligatoire</span>');
			return false;
		}

		if($("#carte_date_expiration").val() == "mm/aa")
		{
			$("#carte_date_expiration").addClass('is-invalid');
			$(".carte_date_expiration_feedback").html('<span class="text-danger">Champ obligatoire</span>');
			return false;
		}

	}

	var formData = new FormData($("#moyenpaiementForm")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
	$.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/store-moyen-paiement",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			if (response.status == 208) {
				$(".loader").hide()
				// alertify.set('notifier','position', 'top-right');
				// alertify.warning(response.message);

				swal({
			          title: response.title,
			          text: response.message,
			          icon: "warning",
			        }).then(() => {
			          
			        });
			}           
			if (response.status == 401) {
				$(".loader").hide()
				// alertify.set('notifier','position', 'top-right');
				// alertify.error(response.message);

				swal({
			          title: response.title,
			          text: response.message,
			          icon: "error",
			        }).then(() => {
			          
			        });
			}
			if (response.status == 200) {
				$(".loader").hide()
				swal({
          title: response.title,
          text: response.message,
          icon: "success",
        }).then(() => {
          // window.location.reload()
					$("#moyenpaiementForm")[0].reset()

        });

				// alertify.set('notifier','position', 'top-right');
				// alertify.success(response.message);
				// window.location.reload()
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })
	// alert('save methode de paiement :'+typepaiement)

})

$(".UpdatemoyenpaiementBtn").click(function(e){
	e.preventDefault()
	if($(".locataire").val() == "")
	{
		$(".locataire").addClass('is-invalid');
		$(".loc_feedback").html('<span class="text-danger">Sélectionner le locataire</span>');
		return false;
	}
	if($(".passerelle").val() == "")
	{
		$(".passerelle").addClass('is-invalid');
		$(".passerelle_feedback").html('<span class="text-danger">Sélectionner le type de paiement</span>');
		return false;
	}
	if($(".num_compte").val() == "")
	{
		$(".num_compte").addClass('is-invalid');
		$(".num_compte_feedback").html('<span class="text-danger">Champ obligatoire</span>');
		return false;
	}
	var typepaiement =  $(".passerelle").val()
	if (typepaiement == 2) {
		if($(".carte_cvc").val() == "")
		{
			$(".carte_cvc").addClass('is-invalid');
			$(".cvc_feedback").html('<span class="text-danger">Champ obligatoire</span>');
			return false;
		}

		if($(".carte_date_expiration").val() == "mm/aa")
		{
			$(".carte_date_expiration").addClass('is-invalid');
			$(".carte_date_expiration_feedback").html('<span class="text-danger">Champ obligatoire</span>');
			return false;
		}

	}

	var formData = new FormData($("#UpdatemoyenpaiementForm")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
	$.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/update-moyen-paiement",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			stockage()

			if (response.status == 401) {
				$(".loader").hide()
				// alertify.set('notifier','position', 'top-right');
				// alertify.error(response.message);

				swal({
			          title: response.title,
			          text: response.message,
			          icon: "error",
			        }).then(() => {
			          
			        });
			}
			if (response.status == 200) {
				$(".loader").hide()
				swal({
          title: response.title,
          text: response.message,
          icon: "success",
        }).then(() => {
          // window.location.reload()
					$("#moyenpaiementForm")[0].reset()

        });

				// alertify.set('notifier','position', 'top-right');
				// alertify.success(response.message);
				// window.location.reload()
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })
	// alert('save methode de paiement :'+typepaiement)

})

function stockage()
{
	localStorage.setItem('locataire', document.getElementById('locataire').value);
  localStorage.setItem('paiement', document.getElementById('passerelle').value);
  localStorage.setItem('compte', document.getElementById('num_compte').value);
  // localStorage.setItem('authuser', document.getElementById('image').value);
}

$(".deletemp").click(function(e){
	e.preventDefault()

	var paiement = $(this).closest('.moyen_paiement_tr').find('.moyen_paiement_id').val();

	// console.log("paiement: "+paiement)


	 swal({
  title: "Supprimer ?",
  text:"Etes-vous sûr de vouloir supprimer cet enregistrement ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/delete-moyen-paiement/"+paiement,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			          // $('.moyen_paiement_tr').hide()
								// $('.tr'+paiement).hide()

			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});
})


$(".markAsdone").click(function(e){
	e.preventDefault()

	var incident = $(this).closest('.incidents-items').find('.incident_id').val();

	console.log("incident: "+incident)

	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/incident/mark-as-done/"+incident,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						if (response.status == 302) {
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "info",
			        }).then(() => {
			          // window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
		})
})

$(".readBtn").click(function(e){
	e.preventDefault()

	// console.log("show modal")
	var incident = $(this).closest('.incidents-items').find('.incident_id').val();
	// console.log("incident: "+incident)

	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/incident-read/"+incident,
			    processData:false,
			    contentType:false,
			    cache:false,
			    success:function(response){
						             
							console.log(response.title,response.message)
						
						
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
		})

})


$(".markAsdone1").click(function(e){
	e.preventDefault()
	// var formData = new FormData($("#incidentForm")[0])
	// $.ajaxSetup({
 //    headers:{
 //      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
 //    }
 //  })
 var incident = $(this).closest('.modal_incident').find('.incident_reference').val();

	// console.log("incident: "+incident)

	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/incident/mark-as-done/"+incident,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						if (response.status == 302) {
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "info",
			        }).then(() => {
			          // window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})


})

$(".deleteincident").click(function(e){
	e.preventDefault()

	var incident = $(this).closest('.incidents-items').find('.incident_id').val();

	// console.log("paiement: "+paiement)


	 swal({
  title: "Supprimer ?",
  text:"Etes-vous sûr de vouloir supprimer cet enregistrement ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/incident/delete/"+incident,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			          // $('.moyen_paiement_tr').hide()
								// $('.tr'+paiement).hide()

			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});
})


$(".readBtnReparation").click(function(e){
	e.preventDefault()

	// console.log("show modal")
	var reparation = $(this).closest('.reparation_items').find('.reparation_reference').val();
	// console.log("reaparation: "+reaparation)

	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/reparation-read/"+reparation,
			    processData:false,
			    contentType:false,
			    cache:false,
			    success:function(response){
						             
							console.log(response.title,response.message)
						
						
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
		})

})

$(".deletereparation").click(function(e){
	e.preventDefault()

	var reparation = $(this).closest('.reparation_items').find('.reparation_reference').val();

	 swal({
  title: "Supprimer ?",
  text:"Etes-vous sûr de vouloir supprimer cet enregistrement ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/reparation/delete/"+reparation,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			          // $('.moyen_paiement_tr').hide()
								// $('.tr'+paiement).hide()

			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});
})

$(".btn_modifierProfil").click(function(e){
	e.preventDefault()

	if ($("#lastname").val() == "") {
		$("#lastname").addClass('is-invalid');
		$(".error_lastname").html('<span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#name").val() == "") {
		$("#name").addClass('is-invalid');
		$(".error_name").html('<span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#email").val() == "") {
		$("#email").addClass('is-invalid');
		$(".error_email").html('<span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#date_naissance").val() == "") {
		$("#date_naissance").addClass('is-invalid');
		$(".error_date_naissance").html('<span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#contact").val() == "") {
		$("#contact").addClass('is-invalid');
		$(".error_contact").html('<br><span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}

	if (isNaN($("#contact").val())) {
		$("#contact").addClass('is-invalid');
		$(".error_contact").html('<br><span class="text-danger">Lettres ou caractères spéciaux non acceptés</span>');
		return false;
	}
	if ($("#contact").val().length > 14 || $("#contact").val().length < 8) {
		$("#contact").addClass('is-invalid');
		$(".error_contact").html('<br><span class="text-danger">Numéro non valide</span>');
		return false;
	}

	if ($("#num_cni").val() == "") {
		$("#num_cni").addClass('is-invalid');
		$(".error_num_cni").html('<br><span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#ville").val() == "") {
		$("#ville").addClass('is-invalid');
		$(".error_ville").html('<br><span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#country").val() == "") {
		$("#country").addClass('is-invalid');
		$(".error_pays").html('<br><span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#sexe").val() == "") {
		$("#sexe").addClass('is-invalid');
		$(".error_genre").html('<br><span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	$(".loader").show()

	var formData = new FormData($("#formAccountSettings")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })

  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/user/profil/update",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			// 
			// console.log(response.user)        
			if (response.status == 401) {
				$(".loader").hide()
				
				swal({
			          title: response.title,
			          text: response.message,
			          icon: "error",
			        }).then(() => {
			          
			        });
			}
			if (response.status == 200) {
				$(".loader").hide()
				swal({
          title: response.title,
          text: response.message,
          icon: "success",
        }).then(() => {
          window.location.reload()
					// $("#moyenpaiementForm")[0].reset()

        });

			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })
})
$(".btn_uploadAvatar").click(function(e){
	// alert("upload")
	e.preventDefault()

	$(".progress").show()
	
	var elem = document.getElementById("myBar2");   
  var width = 1;
  var id = setInterval(frame, 10);
  function frame() {
     if (width == 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 

    }
  }

  var formData = new FormData($("#uploadedAvatarForm")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
	$.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/user/avatar/upload",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			// 
			// console.log(response.user)        
			if (response.status == 401) {
				$(".loader").hide()
				
				swal({
			          title: response.title,
			          text: response.message,
			          icon: "error",
			        }).then(() => {
			          
			        });
			}
			if (response.status == 200) {
				$(".loader").hide()
				swal({
          title: response.title,
          text: response.message,
          icon: "success",
        }).then(() => {
          window.location.reload()
					// $("#moyenpaiementForm")[0].reset()

        });

			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })


})

$(".btn_modifierPassword").click(function(e){
	e.preventDefault()

	// alert('pwd')
	if ($("#password").val() == "") {
		$("#password").addClass('is-invalid');
		$(".error_password").html('<br><span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#password").val().length < 8) {
		$("#password").addClass('is-invalid');
		$(".error_password").html('<br><span class="text-danger">Mot de passe trop court</span>');
		return false;
	}

	if ($("#confirm_pwd").val() == "") {
		$("#confirm_pwd").addClass('is-invalid');
		$(".error_confirm_pwd").html('<br><span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#confirm_pwd").val().length < 8) {
		$("#confirm_pwd").addClass('is-invalid');
		$(".error_confirm_pwd").html('<br><span class="text-danger">Mot de passe trop court</span>');
		return false;
	}

	if ($("#confirm_pwd").val() !==  $("#password").val() ) {
		$("#confirm_pwd").addClass('is-invalid');
		$(".error_confirm_pwd").html('<br><span class="text-danger">Les mots de passe ne correspondent pas</span>');
		return false;
	}
	$(".loader").show()
	

	 var formData = new FormData($("#formPasswordSettings")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/user/password/update",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			// 
			// console.log(response.user)        
			if (response.status == 401) {
				$(".loader").hide()
				
				swal({
			          title: response.title,
			          text: response.message,
			          icon: "error",
			        }).then(() => {
			          
			        });
			}
			if (response.status == 200) {
				$(".loader").hide()
				swal({
          title: response.title,
          text: response.message,
          icon: "success",
        }).then(() => {
        	$("#formPasswordSettings")[0].reset()
        });

			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })


})

$(".btn_updateInfos").click(function(e){
	e.preventDefault()

	if ($("#societe").val() == "") {
		$("#societe").addClass('is-invalid');
		$(".error_societe").html('<span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#gerant").val() == "") {
		$("#gerant").addClass('is-invalid');
		$(".error_gerant").html('<span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#email").val() == "") {
		$("#email").addClass('is-invalid');
		$(".error_email").html('<span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#localisation").val() == "") {
		$("#localisation").addClass('is-invalid');
		$(".error_localisation").html('<span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#contact").val() == "") {
		$("#contact").addClass('is-invalid');
		$(".error_contact").html('<br><span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}

	if (isNaN($("#contact").val())) {
		$("#contact").addClass('is-invalid');
		$(".error_contact").html('<br><span class="text-danger">Lettres ou caractères spéciaux non acceptés</span>');
		return false;
	}
	if ($("#contact").val().length > 14 || $("#contact").val().length < 8) {
		$("#contact").addClass('is-invalid');
		$(".error_contact").html('<br><span class="text-danger">Numéro non valide</span>');
		return false;
	}
	if (isNaN($("#contact_2").val())) {
		$("#contact_2").addClass('is-invalid');
		$(".error_contact_2").html('<br><span class="text-danger">Lettres ou caractères spéciaux non acceptés</span>');
		return false;
	}
	
	if ($("#ville").val() == "") {
		$("#ville").addClass('is-invalid');
		$(".error_ville").html('<br><span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	if ($("#country").val() == "") {
		$("#country").addClass('is-invalid');
		$(".error_pays").html('<br><span class="text-danger">veuillez renseigner le champ</span>');
		return false;
	}
	
	$(".loader").show()

	var formData = new FormData($("#formUpdateAgenceSettings")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })

  $.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/agence/update",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			// 
			// console.log(response.user)        
			if (response.status == 401) {
				$(".loader").hide()
				
				swal({
			          title: response.title,
			          text: response.message,
			          icon: "error",
			        }).then(() => {
			          
			        });
			}
			if (response.status == 200) {
				$(".loader").hide()
				swal({
          title: response.title,
          text: response.message,
          icon: "success",
        }).then(() => {
          window.location.reload()

        });

			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })
})

$(".btn_uploadAvatarAgence").click(function(e){
	// alert("upload")
	e.preventDefault()

	$(".progress").show()
	
	var elem = document.getElementById("myBar2");   
  var width = 1;
  var id = setInterval(frame, 10);
  function frame() {
     if (width == 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 

    }
  }

  var formData = new FormData($("#uploadedAvatarAgenceForm")[0])
	$.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
	$.ajax({
  	type:"post",
    enctype:"multipart/form-data",
    url:"/"+lang+"/connected/company/agence/upload-image",
    data:formData,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			// 
			// console.log(response.user)        
			if (response.status == 401) {
				$(".loader").hide()
				
				swal({
			          title: response.title,
			          text: response.message,
			          icon: "error",
			        }).then(() => {
			          
			        });
			}
			if (response.status == 200) {
				$(".loader").hide()
				swal({
          title: response.title,
          text: response.message,
          icon: "success",
        }).then(() => {
          window.location.reload()
					// $("#moyenpaiementForm")[0].reset()

        });

			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })


});

$('.btnChangeForfait').click(function(e){
	e.preventDefault()
	
	var offre_id = $(this).closest('.tabs-formule').find('.offre_abonnement_id').val();

	// alert("offre:"+offre_id)

	$(".loader").show()

      createItem($("#changementForfaitAbonnement-"+offre_id),'/'+lang+'/connected/company/forfait-changement')
			window.location.reload()
			// confirm()
			// swal({
		 //        title:"Changement de votre abonnement",
		 //        text: "Etes-vous sûrs de vouloir effectuer cette operation de changement de forfait",
		 //        icon: "warning",
		 //    }).then(() => {
		 //      // Enregistrer le forfait
		 //      createItem($("#changementForfaitAbonnement-"+offre_id),'/'+lang+'/connected/company/forfait-changement')

      
 //  });
})
$('.error_description').html(" ")
$('.error_montant').html(" ")
$('.error_date_operation').html(" ")
$('.error_type_operation').html(" ")

$(".btnCreateAndNew").click(function(e){
	e.preventDefault()

	getTynimceValue()

	verifyFieldForOperation($("#type_operation"),$("#date_operation"),$("#montant_operation"),$("#description"))
	

	// alert(des)
	createItemWithoutReloading($("#operationForm"),'/'+lang+'/connected/company/store-operations')
})

$(".btnCreateAndClose").click(function(e){
	e.preventDefault()

	getTynimceValue()

	verifyFieldForOperation($("#type_operation"),$("#date_operation"),$("#montant_operation"),$("#description"))

	createItem($("#operationForm"),'/'+lang+'/connected/company/store-operations')
})

// Operation a corriger
$(".btnUpdateOperation").click(function(e){
	e.preventDefault()

	var operation_id = $(this).closest('.operation_items_form').find('.operation_id').val();

	alert('operation n°: '+ operation_id)
})

$(".accepterResiliation").click(function(e){
	e.preventDefault()


	var id_resiliation = $(this).closest('.resiliations_item').find('.resiliations_id').val();
	// alert(location)
	alert(id_resiliation)
 swal({
  title: "Voulez vous confirmer la rupture de contrat?",
  text:"Cliquez sur OK si vous souhaitez continuer ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/contrats/rompre/"+id_resiliation,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});


})

$(".annulerResiliation").click(function(e){
	e.preventDefault()


	var id_resiliation = $(this).closest('.resiliations_item').find('.resiliations_id').val();
	// alert(location)
	// alert(id_resiliation)
 swal({
  title: "Voulez vous annuler la rupture de contrat?",
  text:"Cliquez sur OK si vous souhaitez continuer ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
	})
	.then((willDelete) =>{
	  	// $(".loader").show()
	  if (willDelete) {
	  	$.ajax({
			  	type:"get",
			    enctype:"multipart/form-data",
			    url:"/"+lang+"/connected/company/contrats/rompre/annuler/"+id_resiliation,
			    processData:false,
			    contentType:false,
			    cache:false,
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
							
							swal({
			          title: response.title,
			          text: response.message,
			          icon: "success",
			        }).then(() => {
			          window.location.reload()
			        });
						}
						 
			    },error:function(response){
			    	$(".loader").hide()
			    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
			    }
			})
	  }
	  else {
	    // swal("Suppression annulée");
	  }
	});


})




function getTynimceValue()
{
	window.tinyMCE.triggerSave()
}

function verifyFieldForOperation(type_operation,date_operation,montant_operation,description)
{
	if (type_operation.val() == "") {
		type_operation.addClass('is-invalid');
		$(".error_type_operation").html("<span class='text-danger'>veuillez selectionner le type d'opération</span>");
		return false;
	}

	if (date_operation.val() == "") {
		date_operation.addClass('is-invalid');
		$(".error_date_operation").html("<span class='text-danger'>veuillez choisir la date</span>");
		return false;
	}
	if (montant_operation.val() == "") {
		montant_operation.addClass('is-invalid');
		$(".error_montant").html("<span class='text-danger'>veuillez renseigner le montant</span>");
		return false;
	}

	if (isNaN(montant_operation.val())) {
		montant_operation.addClass('is-invalid');
		$(".error_montant").html('<br><span class="text-danger">Lettres ou caractères spéciaux non acceptés</span>');
		return false;
	}

	if (description.val() == "") {
		description.addClass('is-invalid');
		$(".error_description").html("<span class='text-danger'>veuillez renseigner la description de l'opération</span>");
		return false;
	}
}

$(".generateInvoices").click(function(e){
	e.preventDefault()

	getMethodAjax('connected/company/generation-invoice')

})




//Fonction globale pour les traitements vers les controllers de l'API
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
			setTimeout(showloader,500)
		if (response.status == 401) {
			// alert(response.title)
			// $(".loader").hide()
			swal({
	          title: response.title,
	          text: response.message,
	          icon: "error",
	        })
		}
		
		if (response.status == 504) {
			$(".loader").hide()
			swal("Hors ligne!", "Vous appareil n'est pas connecté à internet!", "warning");
		} 
		if (response.status == 200) {
			// alert(response.title)
			// swal({
	  	//         title: response.title,
	  	//         text: response.message,
	  	//         icon: "success",
	  	//       })
	  	swal({
          title: response.title,
          text: response.message,
          icon: "success",
        }).then(() => {
          window.location.reload()
        });
		}
		if (response.status == 201) {
			$(".loader").hide()
			// swal("Hors ligne!", "Vous appareil n'est pas connecté à internet!", "warning");
		} 
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
  })
}

// enregistrer sans recharger la page
function createItemWithoutReloading(formName,urlToController){
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
			setTimeout(showloader,500)
		if (response.status == 401) {
			// alert(response.title)
			// $(".loader").hide()
			swal({
	          title: response.title,
	          text: response.message,
	          icon: "error",
	        })
		}
		
		if (response.status == 504) {
			$(".loader").hide()
			swal("Hors ligne!", "Vous appareil n'est pas connecté à internet!", "warning");
		} 
		if (response.status == 200) {
			// alert(response.title)
			// window.location.reload()
			formName[0].reset()
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
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
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


function getHttpMethod(uri)
{
	$.ajax({
  	type:"get",
    enctype:"multipart/form-data",
    url:"/"+lang+"/"+uri,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			             
			if (response.status == 401) {
				
				console.log(response.message)
			}
			
			if (response.status == 200) {
				console.log(response.message)
				
			}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
	})
}


function getMethodAjax(uri)
{
	$.ajax({
  	type:"get",
    enctype:"multipart/form-data",
    url:"/"+lang+"/"+uri,
    processData:false,
    contentType:false,
    cache:false,
    success:function(response){
			setTimeout(showloader,500)           
			if (response.status == 401) {
		
				swal({
		          title: response.title,
		          text: response.message,
		          icon: "error",
		        })
			}
			
			if (response.status == 200) {
			
	  	swal({
          title: response.title,
          text: response.message,
          icon: "success",
        }).then(() => {
          window.location.reload()
        });
		}
			 
    },error:function(response){
    	$(".loader").hide()
    	swal("Requête impossible", "Impossible d'envoyer la requête, contactez le technicien ou le dévéloppeur", "error");
    }
	})
}

$(".renouveller").click(function(){
	
	swal("Voulez-vous renouveller l'abonnement actuel ?", {
  buttons: {

    cancel: "Annuler",
    renouveller: {
      text: "Renouveller",
      value: "renouveller",
    },
    changer: true,
  },
})
.then((value) => {
  switch (value) {
 
    case "renouveller":
      	window.location.href = "/"+lang+"/connected/company/paiement-renouvellement"
      break;
 
    case "changer":
      window.location.href = "/"+lang+"/connected/company/0e86add4883f3ee078551f257a63617160d32f6f"

      break;
 
    default:
      
  }
});
})

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


// Paiement du renouvellement abonnement
$(".validerBtn").click(function(e){

    e.preventDefault()

    // alert('renouveller')
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
            if (document.getElementById("checkedorange").checked) {
            	// alert('orange')
            	if(recup($("#accountNber").val()) != "07"){
              $(".error_accountNber").html('<span class="text-danger">Un numéro Orange commence toujours par 07 ou 27. Veuillez entrer le bon numéro </span>');
              return false;

            	}
            }else if(document.getElementById("checkedmoov").checked){
            	// alert('moov')
              $(".error_accountNber").html('<span class="text-danger">Un numéro Moov commence toujours par 01 ou 21. Veuillez entrer le bon numéro </span>');

              return false;

            }else{
            	// alert('mtn')
              $(".error_accountNber").html('<span class="text-danger">Un numéro MTN commence toujours par 05 ou 25. Veuillez entrer le bon numéro </span>');
              return false;


            }

            // if(recup($("#accountNber").val()) )
            
          // console.log("options choose: "+operateur)
          // createItem($("#checkoutForm"),'/checkout')
          createItemWithoutReloading($("#renouvellementForm"),'/'+lang+'/connected/company/paiement-renouvellement')
          // checkoutAbonnement(,'/checkout')"/connected/company/
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

      createItemWithoutReloading($("#renouvellementForm"),'/'+lang+'/connected/company/paiement-renouvellement')
      // checkoutAbonnement($("#checkoutForm"),'/checkout')
      window.location.href = "/"+lang+"/connected/company/4a5e8a2f3cb61504b1d7f8e5c362eeeac27c251b"
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