  var existe;
  $login=$("#login").val(); // almaceno lo que el usuario escriba en el imput del formulario cullo id es $login
  $clave1=$("#clave1").val();


  function registro(){
     // alert('Redireccionando a registro.php');
      location.href="http://localhost/CoffeeShop_2/views/registro.php"
  }



  //Función limpiar
  function limpiar()
  {
    $("#login").val("");
    $("#clave1").val("");
  }

  $("#frmAcceso").on('submit',function(e) 
  { 
    e.preventDefault();
      //console.log('entro');
      //bootbox.alert("Redireccionando a pedidos.php");
      //location.href="http://localhost/CoffeeShop_2/views/pedidos.php"
	  
	  if (validarUsuario()== false){
		  

	  }else{
		
		      var formData = new FormData($("#frmAcceso")[0]);
				
			  $.ajax({
                  url: "../controllers/usuario.php?op=iniciar_session",
                  type: "POST",
				  data:  formData,    
                  contentType: false,
                  processData: false,
				  success: function(datos)
                  {                    
                        //bootbox.alert(datos);	   
						var respuesta = JSON.stringify(datos); 
						console.log(datos);
						var respuesta = datos;
						iniciar_session(respuesta) 
                  }

              });
              limpiar();
            
	  }
   
  })
  
  function iniciar_session(respuesta){
	console.log('respuesta:'+ respuesta);
	if(respuesta == 0){

		 bootbox.alert('El usuario:' + $login + 'no se encuntra registrado');	 

	}else{

		location.href="http://localhost/CoffeeShop_2/views/pedidos.php"
	}

  }
  

function validarUsuario() {

	var expresion, expresion2;
	expresion =  /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/; // obligatoriamente valla con numeros letras y mayusculas
	expresion2 = /[$%&|<>+?#!@=*(){}"":''//]/;


	$login=$("#login").val(); // almaceno lo que el usuario escriba en el imput del formulario cullo id es $login
	$clave1=$("#clave1").val(); // lo mismo 




	if ($login == ""){

	bootbox.alert("El campo nombre de usuario es requerido");
	return false;

	}else if ($login.length > 50){

	bootbox.alert("El nombre de usuario supera la cantidad de caracteres permitidos, maximo son 50");
	return false;

	}else if (expresion2.test($login) ){

	bootbox.alert("El campo nombre prohibe caracteres especiales"); 
		return false;

	}else if ($clave1 == ""){ 

	bootbox.alert("El campo contrasena es requerido");
	return false;

	}else if ($clave1.length > 50){

	bootbox.alert("Error, la contrasena supera la cantidad de caracteres permitidos, maximo son 50 caracteres");
	return false;

	}else if ($clave1.length < 8){
	bootbox.alert("Error, la contrasena no cumple con la cantidad minima permitida, para ingresar con este usuario minimo son 8 caracteres"); 
	return false;

	}else if (expresion.test($clave1)  ){

	return true;

	}else{

	bootbox.alert("Error, la contrasena minimo debe de contener 8 caracteres entres los cuales deben de estar numeros, letras Minusculas y Mayusculas");
	return false;

	}

}

