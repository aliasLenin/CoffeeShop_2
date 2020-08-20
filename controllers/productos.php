<?php 



switch ($_GET["op"]){

    case 'getProducts':

        $url = "https://iitd7euw75.execute-api.us-east-1.amazonaws.com/services/products/getProducts";
        $json = file_get_contents($url);
        $datos = json_decode($json,true);
      
        //$array = $datos["items"][0]
        //$array = $datos["items"][0]["name"];
        //$array = $datos["items"][0]["image"];
        $array = $datos["items"];
        
        var_dump($array);
    
    
        return $array ;

    break;


}




?>







