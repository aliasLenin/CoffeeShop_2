<!DOCTYPE html>
<html lang="es">
<head>
  <title>Login</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	
	<link rel="stylesheet" href="../public/css/login.css">
	
</head>
<body>

    <form name="frmAcceso" id="frmAcceso"  method="POST" class="login">
		
	  <figure class="image">
	    	<img src="../public/images/coffeeShop.svg" alt="CoffeeShop" />
		</figure>

		<div class="form-group">
			
			<input type="text" id="login" name="login" class="form-control" placeholder="Usuario" maxlength="50" >
		</div>
		<div class="form-group">
		
			<input type="password" id="clave1" name="clave1" class="form-control" placeholder="Password" maxlength="50" >    
		</div>

		<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<button class=" form-control  btn-block button cafe"  onclick="registro()" >Registro</button> 
		</div>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<button id="btnSubmit" class="form-control btn-block button verde" type="submit" (click)="onSubmit()">Ingresar</button>
		</div>
    </div>

		<figure class="image">
			<img src="../public/images/poweredBySysco.svg" alt="poweredBySysco" width="200" />
		</figure>

	</form>
	 <!-- jQuery -->
	<script src="../public/js/jquery-3.1.1.min.js"></script>
	<!-- Bootstrap -->
	<script src="../public/js/bootstrap.min.js"></script>
	 <!-- Bootbox -->
	 <script src="../public/js/bootbox.min.js"></script>

</body>
</html>

<script>

  var existe;
  $login=$("#login").val(); 
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
						var respuesta = JSON.parse(datos);  
						//var respuesta = JSON.stringify(datos); 
						iniciar_session(respuesta) 
                  }

              });
              limpiar();
            
	  }
   
  })
  
  function iniciar_session(respuesta){
	console.log('respuesta:'+ respuesta);
	if(respuesta === 0 || respuesta === '' || respuesta === "0"){

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


  
  
  </script>
