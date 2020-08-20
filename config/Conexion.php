<?php 


//incluimos el archivo global.php que contiene las variables globales que realizan nuestra conexion
require "global.php";

//instancia de la variable conexion que recibe por parametro
$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);//ip ,usuario, pass, nombre dbs que estan en el archivo global.php

// establecemos conexion con nuestra base de datos y le indicamos la codificación de los caracteres
mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"'); // ya declararados en el archivo global.php


//Si tenemos un posible error en la conexión lo mostramos
if (mysqli_connect_errno())
{
	printf("Falló conexión a la base de datos: %s\n",mysqli_connect_error());//junto con el error que no nos esta permitiendo conectarnos a la bd
	exit();
}

// desarrollamos las funciones que van a realizar las peticiones a la base de datos
//pero antes validamos si ya huvo conexion

if (!function_exists('ejecutarConsulta')) // si no existe la funcion 'ejecutarConsulta'
{

//esta funcion tambien ejecuta consultas como las que se necesta todos los registros en general por ejemplo: select * from departamento
	function ejecutarConsulta($sql){//recibe por parametro codigo sql que se decea ejecutar
		global $conexion; // variable del tipo objeto total del archivo global.php que establece la conexion
		$query = $conexion->query($sql); //y esta variable ejecuta el codigo sql que viene por parametro 
		return $query;
	}



// obtiene todos los campos de un registro en especifico osea por ejemplo: es un select * from departamento where id......
	function ejecutarConsultaSimpleFila($sql)//recibe por parametro codigo sql que se decea ejecutar
	{
		global $conexion;// variable del tipo objeto total del archivo global.php que establece la conexion
		$query = $conexion->query($sql);//y esta variable ejecuta el codigo sql que viene por parametro 		
		$row = $query->fetch_assoc();// pero nos va a traer una fila completa en un array 
		return $row;//entonces devolvemos solo esa fila
	}



	function ejecutarConsulta_retornarID($sql)//recibe por parametro codigo sql que se decea ejecutar
	{
		global $conexion;// variable del tipo objeto total del archivo global.php que establece la conexion
		$query = $conexion->query($sql);//y esta variable ejecuta el codigo sql que viene por parametro 		
		return $conexion->insert_id;// pero va a retornar unicamente el id			
	}




	function limpiarCadena($str)//recibe por parametro una variable que es de tipo string
	{
		global $conexion;// variable del tipo objeto total del archivo global.php que establece la conexion
		$str = mysqli_real_escape_string($conexion,trim($str));//filtra unicamente los caracteres ya establecidos para la conexion osea de tipo "utf8"
		return htmlspecialchars($str);
	}






}



?>