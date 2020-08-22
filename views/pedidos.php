<?php

error_reporting(0); // ULTIMA ACTUALIZACION

require 'header.php';

?>

<section class="section">

<div class="col-lg-3 col-md-3 col-sm-12">  
  <div class="row color-coffe">      
    <div>
        <h2 class="title">cola</h2>
            
            <div class="color-dist" id="orden" name="orden"> 
                <div class="aling-text">
                    <span>234567</span>
                    <span class="color-oro">eliosinH</span>
                </div>
                    <hr/>
                <p class="text-center">
                    <strong>5</strong> Sandwich,
                    <strong>2</strong> Café 
                </p>
            </div>

            <div class="color-dist"> 
                <div class="aling-text">
                    <span>234567</span>
                    <span class="color-oro">eliosinH</span>
                </div>
                    <hr/>
                <p class="text-center">
                    <strong>5</strong> Sandwich,
                    <strong>2</strong> Café 
                </p>
            </div>

    </div>
  </div>
</div>
 
<div class="col-lg-3 col-md-3 col-sm-12">
   <div class="row color-coffe">  
    <div>
      <h2 class="title">Preparación</h2>
    </div>
  </div>
</div>

<div class="col-lg-3 col-md-3 col-sm-12">
  <div class="row color-coffe">  
    <div>
      <h2 class="title">Finalizado</h2>
    </div>
  </div>
</div>


<div class="col-lg-3 col-md-3 col-sm-12">
   <div class="row color-coffe">  
 
      <div>
        <h2 class="title">Entregado</h2>
      </div>
    </div>
</div>

</section>

<?php

require 'footer.php';

?>

<script>

  let array= [];

  $(document).ready(function () {

    getOrders();

  });

  function getOrders(){

      $.ajax({
          url: "../controllers/ordenes.php?op=getOrders",
          type: "GET",          
                  
          success: function(datos)
              {                                                         
                  //console.log(datos); 
                  listarOrdenes(datos);              
              }
      });

          
  }



  function listarOrdenes(arrayAPI){

    //console.log(arrayAPI);
        
    array = JSON.parse(arrayAPI)['items'];
    console.log(array);




  }






</script>