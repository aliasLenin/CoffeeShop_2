<?php 

error_reporting(E_ALL ^ E_NOTICE);

require "../models/usuario.php";


$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$name=isset($_POST["name"])? limpiarCadena($_POST["name"]):"";
$price=isset($_POST["price"])? limpiarCadena($_POST["price"]):"";
$image=isset($_POST["image"])? limpiarCadena($_POST["image"]):"";




switch ($_GET["op"]){

    case 'getProducts':

          $url = "https://private-anon-38e958a387-coffeeshop3.apiary-proxy.com/services/products/getProducts"; 
          $json = file_get_contents($url);
          echo($json);

    break;




    case 'guardaryeditar':

        if (empty($id)){

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://iitd7euw75.execute-api.us-east-1.amazonaws.com/services/products/createProduct");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);  
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");      
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{
              \"name\": \"$name\",
              \"image\": \"$image\",
              \"price\": $price
            }");
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              "Content-Type: application/json"
            ));
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            var_dump($response);
    
            echo $response;

			
		}else {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://iitd7euw75.execute-api.us-east-1.amazonaws.com/services/products/updateProduct");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");        
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{
            \"image\": \"$image\",
            \"price\": $price,
            \"id\": \"$id\",
            \"name\": \"$name\"
            }");
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
            ));
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            var_dump($response);

            echo $response;
        
		}
			
		
    break;



    case 'eliminar':

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://iitd7euw75.execute-api.us-east-1.amazonaws.com/services/products/deleteProduct');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);  // DO NOT RETURN HTTP HEADERS
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // curl_setopt($ch, CURLOPT_PUT, true); - for PUT
        curl_setopt($ch, CURLOPT_POSTFIELDS, '$id');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        

        $response = curl_exec($ch);
        curl_close($ch);
        var_dump($response);
        echo $response;
        

    break;


}












?>