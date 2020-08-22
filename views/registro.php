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

    <form name="form_registro" id="form_registro" method="POST" class="login"> 
		
	  <figure class="image">
	    	<img src="../public/images/coffeeShop.svg" alt="CoffeeShop" />
		</figure>

        <div class="form-group">
          <input type="hidden" name="idusuario" id="idusuario">
          <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="nombre" required >  
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name="email" id="email" maxlength="100" placeholder="ejemplo@gmail.com" min="4">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name="login" id="login" maxlength="50" placeholder="Usuario" required  > <!-- required -->
        </div>


        <div class="form-group">
          <input type="password" class="form-control" name="clave1" id="clave1" maxlength="50" placeholder="Password 1" min="4" required>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="clave2" id="clave2" maxlength="50" placeholder="Password 2" min="4" required>
        </div>


        <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
           <button onclick="cancelarform()" class="form-control btn-block button red">Cancelar</button>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
       
               <button class="form-control btn-block button verde" type="submit" id="btnGuardar" >Guardar</button> 
          
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


  //Función cancelarform
  function cancelarform()
  {
      
      location.href="http://localhost/CoffeeShop_2/views/login.php"
      limpiar();
  }

  //Función limpiar
  function limpiar()
  {
    $("#idusuario").val("");
    $("#nombre").val("");
    $("#email").val("");
    $("#login").val("");
    $("#clave1").val("");
    $("#clave2").val("");
  }


  $("#form_registro").on('submit',function(e) 
  {
  
    e.preventDefault();
  
      
   if (validarUsuario() == false || validarEmail() == false || validarClaves() == false) {


      }else{

              console.log('entro a guardar');
              var formData = new FormData($("#form_registro")[0]);

              //console.log('datos del form_registro :' + formData );

              $.ajax({
                  url: "../controllers/usuario.php?op=guardaryeditar",
                  type: "POST",
                  data: formData,
                  contentType: false,
                  processData: false,

                  success: function(datos)
                  {                    
                        bootbox.alert(datos);	   
                        //var respuesta = JSON.stringify(data); 
                        console.log('respuesta:'+ datos);       
                  }

              });
              limpiar();
           }
  })
  



function validarUsuario() {

    var expresion, expresion2, expresion3, expresion4, expresionEmail;
    expresion = /[a-z]+[0-9]/; //numero + letra + numero
    expresion2 = /[$%&|<>+?#!@=*(){}"":''//]/;
    expresion3 = /[0-9]+[a-z]/;
    expresion4 = /[0-9]/;
    expresion5 =  /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/; // obligatoriamente valla con numeros letras y mayusculas
	

	var nombre;
  var email;
	var login;
	var clave1;
	var clave2;

  nombre = $("#nombre").val();
  email =  $("#email").val();
	login = $("#login").val();
	clave1 = $("#clave1").val();
	clave2 = $("#clave2").val();
   

   if (nombre == ""){

    bootbox.alert("El campo nombre de usuario es requerido");
    return false;

    }else if (nombre.length > 50){

    bootbox.alert("El nombre de usuario supera la cantidad de caracteres permitidos, maximo son 50");
    return false;

    }else if (expresion.test(nombre) ){

    bootbox.alert("El campo nombre solo debe contener letras"); 
        return false;
    }else if (expresion2.test(nombre) ){

    bootbox.alert("El campo nombre prohibe caracteres especiales"); 
        return false;
    }else if (expresion3.test(nombre) ){

    bootbox.alert("El campo nombre solo debe contener letras"); 
        return false;
    }else if (expresion4.test(nombre) ){

    bootbox.alert("El campo nombre solo debe contener letras"); 
        return false;
    }if (login == ""){

    bootbox.alert("El campo nombre de usuario es requerido");
    return false;

    }else if (login.length > 50){

    bootbox.alert("El nombre de usuario supera la cantidad de caracteres permitidos, maximo son 50");
    return false;

    }else if (clave1 == ""){

    bootbox.alert("El campo de la primer contrasena es requerido");
    return false;

    }else if (clave1.length < 8){

      bootbox.alert("Error, la primer contrasena no cumple con la cantidad  minimo permitida, para registrar a este usuario minimo son 8 caracteres");
      return false;

    }else if (clave1.length > 50){

    bootbox.alert("El campo de la primer contrasena supera la cantidad de caracteres permitidos, maximo son 50 caracteres");
    return false;

    }else if (clave2 == ""){ 

    bootbox.alert("El campo de la segunda contrasena es requerido");
    return false;

    }else if (clave2.length < 8){

      bootbox.alert("Error, de la segunda contrasena no cumple con la cantidad  minimo permitida, para registrar a este usuario minimo son 8 caracteres");
      return false;

    }else if (clave2.length > 50){

    bootbox.alert("El campo de la de la segunda contrasena supera la cantidad de caracteres permitidos, maximo son 50 caracteres");
    return false;

    }else if (clave1 != clave2){

    bootbox.alert("Error, Las contrasenas no coinciden, por favor vuelva a intentarlo de nuevo ...");	
    return false;

    }else{

    return true;

    }


}



function validarEmail(){

var expresionEmail;
	  expresionEmail =  /\w+@\w+\.+[a-z]/; 

var email;
email = $("#email").val();


   
    if (email != ""){ 

		    if (email.length > 50){

				bootbox.alert("El campo email supera la cantidad de caracteres permitidos, maximo son 50 caracteres");
				return false;

		    }

			if (!expresionEmail.test(email)){

				bootbox.alert("El correo electronico que escribio no cumple con el formato");
				return false;
		    }

	}

}

function validarClaves(){

  var expresion;
  expresion =  /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/; 
  clave1 = $("#clave1").val();
	clave2 = $("#clave2").val();

  if (expresion.test(clave1 || clave2 )  ){

  return true;

  }else{

  bootbox.alert("Error, la contrasena minimo debe de contener 8 caracteres entres los cuales deben de estar numeros, letras Minusculas y Mayusculas");
  return false;

  }

}



</script>