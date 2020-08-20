<?php 

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class usuario
{
	
	//Implementamos nuestro constructor para poder realizar instancias en los otros archivos 
	public function __construct()
	{

    }

    //Implementamos un método para insertar registros
	public function insertar($nombre,$email,$login,$clave)
	{
		
		$sql="INSERT INTO usuario (nombre,email,login,clave)
		VALUES ('$nombre','$email','$login','$clave')";
		return ejecutarConsulta($sql);
	}

	
	//Función para verificar el acceso al sistema desde el login
	public function verificar($login,$clave) // el alias y la contrasena
    {
    	$sql="SELECT 
		idusuario,
    	nombre,
    	email,
    	login,
		clave

    	FROM usuario 

    	WHERE login='$login' AND clave='$clave'"; 

    	return ejecutarConsulta($sql);  
    }


    
    
}


?>