<?php

error_reporting(0); // ULTIMA ACTUALIZACION

require 'header.php';

?>

<section>

    <div>
      <h2>Cola</h2>
      <div>
        <div>
          <span id="id">234567</span>
          <span>eliosinH</span>
        </div>
        <hr/>
        <p><strong>5</strong> Sandwich, <strong>2</strong> Café </p>
      </div>
    </div>

    <div>
      <h2>Preparación</h2>
    </div>

    <div>
      <h2>Finalizado</h2>
    </div>

    <div>
      <h2>Entregado</h2>
    </div>

    <div id="ulListado"></div>

</section>

<?php

require 'footer.php';

?>

<script>


  $(document).ready(function () {

    cargarProducts();

  });

  function cargarProducts(){

    <?php 
        $url = "https://iitd7euw75.execute-api.us-east-1.amazonaws.com/services/products/getProducts";
        $json = file_get_contents($url);
        $datos = json_encode($json);

    ?>  
    var arrayAPI = <?php echo $datos; ?>;
    console.log(arrayAPI);
    //listarProducts(arrayAPI);


  }







  function listarProducts(arrayAPI){

  console.log(arrayAPI);



}



</script>