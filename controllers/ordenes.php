<?php 

error_reporting(E_ALL ^ E_NOTICE);


switch ($_GET["op"]){

    case 'getOrders':

          $url = "https://iitd7euw75.execute-api.us-east-1.amazonaws.com/services/orders/getOrders"; 
          $json = file_get_contents($url);
          echo($json);

    break;





}













?>