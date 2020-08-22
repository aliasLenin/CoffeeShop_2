<?php 

error_reporting(E_ALL ^ E_NOTICE);


require "../models/usuario.php";
require "../models/encriptar.php";


$objUsuario = new usuario();
$objEncriptar = new encriptar();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave1=isset($_POST["clave1"])? limpiarCadena($_POST["clave1"]):"";
$clave2=isset($_POST["clave2"])? limpiarCadena($_POST["clave2"]):"";



switch ($_GET["op"]){

    case 'guardaryeditar':

        $clavehash=$objEncriptar->encryption($clave1); 

      
        $rspta=$objUsuario->verificar($login, $clavehash);  
      
        while ($reg = $rspta->fetch_object()) 
            {
              $aux_login = $reg->login; 
              $aux_clave = $reg->clave;         
            } 
       $clavehash2=$objEncriptar->decryption($aux_clave);
          //echo $clavehash2;
        
       if (empty($clavehash2) && empty($aux_login) ){ 
        //echo 'vacio:'.$clavehash2;
          $rspta=$objUsuario->insertar($nombre,$email,$login,$clavehash); 
          echo $rspta ? "Usuario registrado" : "Usuario no se pudo registrar";
          //echo $nombre .$email.$login.$clave1 ;

      }else{ 
        echo 'El usuario: '. $aux_login . ' ya se encuentra registrado';      
      } 
       
    break;


    case 'iniciar_session':
                      
      $clavehash=$objEncriptar->encryption($clave1); // envio la contrasena a encriptar 

    
      $rspta=$objUsuario->verificar($login, $clavehash);  
    
     

      while ($reg = $rspta->fetch_object()) // recorro el objeto encontrado
          {
            $aux_login = $reg->login; 
            $aux_clave = $reg->clave;  
            $aux_idUsuario = $reg->idusuario;        
          } 
     $clavehash2=$objEncriptar->decryption($aux_clave); // envio a desencriptar la clave encontrada encriptada proviniente de la bd
      //echo $clavehash2;

      if (empty($clavehash2) && empty($aux_login) ){
        $existe = 0;
        echo $existe;    
      
      }else{ // si las variables se encuentran llenas es por que existe se encuentra registrado
        $existe = 1;

        echo $existe;    
      } 
      
          
    break;



    case 'salir':


          //Limpiamos las variables de sesión   
          session_unset();
  
          //Destruìmos la sesión
          session_destroy();
          
          //Redireccionamos al login
          header("Location: ../index.php");
         
  
    break;
  








}


?>