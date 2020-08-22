<?php

require 'header.php';

?>
<div class="container">
              
            <div class="row">
                <div class="col-md-9">
                    <div class="color-table">
                      <h5 class="title"> Registrar Productos <h5>
                       <div class="panel-body table-responsive" id="listadoregistros">
                           <table id="tblProducts" class="table table-bordered table-condensed" style="width:100%">
                                    <thead>
                                        <tr>
                                                                                                
                                            <th hidden>id</th>
                                            <th>price</th>                                                   
                                            <th>name:</th>
                                       <!-- <th>image</th> -->  
                                            <th>Created</th>  
                                            <th>Optiosns</th>                                                          

                                        </tr>
                                    </thead>
                                    <tbody>                                   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                                                                                   
                                            <th hidden>id</th>
                                            <th>price</th>                                                   
                                            <th>name:</th>
                                            <!-- <th>image</th> --> 
                                            <th>Created</th>
                                            <th>Options</th>      
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>                         
                </div>

                <div class="col-md-3">
                   <div class="color-table">
                      
                             <h5 class="title"> Registrar Productos <h5>
                        
                      
                        <form name="form_Producto" id="form_Producto" method="POST" > 
                           
                            <div class="form-group">                                       
                                <input type="hidden" name="id" id="id" class="form-control" placeholder="id"  maxlength="200">    
                            </div>
                            <div class="form-group">                                       
                                <input type="text" id="name" name="name" class="form-control" placeholder="nombre" maxlength="50" >
                            </div>
                            <div class="form-group">   
                                <input type="number" id="price" name="price" class="form-control" placeholder="Precio" maxlength="50">    
                            </div>
                            <div class="form-group">          
                                <input type="text" id="image" name="image" class="form-control" placeholder="Imagen" maxlength="50" >    
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                     <button class="form-control btn-block button verde" type="submit" id="btnGuardar" >Guardar</button> 
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                     <button type="button" onclick="cancelarform()" class="form-control btn-block button red">Cancelar</button>
                                </div>
                            </div>




                        </form>


                    </div>
                </div>
            </div>
</div>             
<?php

require 'footer.php';

?>
 
<script>


var tblProducts;
let array= [];

$(document).ready(function() {
  //  $('#tblProducts').DataTable();
    cargarProducts();

} );

  function cancelarform()
  {
      limpiar();
  }



function cargarProducts(){
    
    $.ajax({
        url: "../controllers/productos.php?op=getProducts",
        type: "GET",          
                
        success: function(datos)
            {                                                         
                listarProducts(datos);                
            }
    });
}


function listarProducts(arrayAPI){

    //console.log(arrayAPI);
    
    array = JSON.parse(arrayAPI)['items'];
    //console.log(array);

         var contadorFila = 0;
       
        $("#tblProducts > tbody").remove();
        $('#tblProducts').append('<tbody></tbody>');

         for (var i = 0; i < array.length; i++) {

                var body = '<tr class="fila' + contadorFila + ' filas">'
                    + '<td hidden><p style="padding-top:1rem">' + array[i].id + '</p></td>'
                    + '<td><p style="padding-top:1rem">' + array[i].price + '</p></td>'
                    + '<td><p style="padding-top:1rem">' + array[i].name + '</p></td>'
                   // + '<td><p style="padding-top:1rem">' + array[i].image + '</p></td>'
                    + '<td><p style="padding-top:1rem">' +  array[i].createdAt + '</p></td>'
                    + '<td>  <button value="' + array[i].id + '" onclick="editarProducto(value)" class="btn btn-link btnEditar"><i class="fas fa-edit"></i></button><button value="' + array[i].id + '" onclick="eliminarProducto(value)" class="btn btn-link btnEditar"><i class="fas fa-trash"></i></button>';
                $('#tblProducts > tbody').append(body);
                contadorFila++;

        }

      inicializarTabla();


}

function inicializarTabla() {

    $('#tblProducts').DataTable().destroy();


    tblProducts = $('#tblProducts').DataTable({
        "info": false,
        "order": [[0, "desc"]],
    // dom: 'Bfrtip',
        language: {
            "decimal": "",
            "emptyTable": "NoDatos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "<i class='fas fa-search'></i>",
            "zeroRecords": "sinResultados",
            "bDestroy": true,
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Sguiente",
                "previous": "Anterior"
            }
        },
    });

}



function eliminarProducto(id){
    //console.log("eliminar con el id:"+id);
    //bootbox.alert("entro:"+id);	  
    bootbox.confirm({
    message: "¿Está Seguro de eliminar este registro?",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
    },
        callback: function (result) {
            if(result){

                var request = new XMLHttpRequest();
                request.open('DELETE', 'https://iitd7euw75.execute-api.us-east-1.amazonaws.com/services/products/deleteProduct');
                request.setRequestHeader('Content-Type', 'application/json');
                var body = {
                    'id': id,
                };     
                request.send(JSON.stringify(body));
                setInterval("actualizarTabla()",1000);
                //bootbox.alert("Producto eliminado");         
            }
        }
   });
}

function actualizarTabla(){
    location.reload(true);
 }


 $("#form_Producto").on('submit',function(e) 
  {
    e.preventDefault();
   
    if (validarCampos() == false || validarImagen() == false){


    }else{
        //bootbox.alert("entro a guardar");	
        var formData = new FormData($("#form_Producto")[0]);

        $.ajax({
            url: "../controllers/productos.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function(datos)
            {        
                setInterval("actualizarTabla()",1500);            
                bootbox.alert("Producto guardado con exito: ");	   
                //console.log('respuesta:'+ datos);                
            }
        });
        limpiar();
    }
})



//Función limpiar
function limpiar()
  {
    $("#id").val("");
    $("#name").val("");
    $("#image").val("");
    $("#price").val("");
  }


function validarCampos() {

    var expresion, expresion2, expresion3, expresion4, expresionEmail;
    expresion = /[a-z]+[0-9]/; //numero + letra + numero
    expresion2 = /[$%&|<>+?#!@=*(){}"":''//]/;
    expresion3 = /[0-9]+[a-z]/;
    expresion4 = /[0-9]/;
    expresion5 =  /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/; // obligatoriamente valla con numeros letras y mayusculas
	
    name = $("#name").val();
    price =  $("#price").val();

    if (name == ""){

    bootbox.alert("El campo nombre es requerido");
    return false;

    }else if (name.length > 50){

    bootbox.alert("El campo nombre supera la cantidad de caracteres permitidos, maximo son 50");
    return false;

    }else if (expresion.test(name) ){

    bootbox.alert("El campo nombre solo debe contener letras"); 
        return false;
    }else if (expresion2.test(name) ){

    bootbox.alert("El campo nombre prohibe caracteres especiales"); 
        return false;
    }else if (expresion3.test(name) ){

    bootbox.alert("El campo nombre solo debe contener letras"); 
        return false;
    }else if (expresion4.test(name) ){

    bootbox.alert("El campo nombre solo debe contener letras"); 
        return false;
    }if (price == ""){

    bootbox.alert("El campo precio es requerido");
    return false;

    }else if (price.length > 50){

    bootbox.alert("El campo precio, supera la cantidad de caracteres permitidos, maximo son 50");
    return false;

    }

}

function validarImagen(){
    image = $("#image").val();
    if (image == ""){
        bootbox.alert("El campo imagen es requerido");
        return false;
    }
}


function editarProducto(id){

   // bootbox.alert("id: "+ id);
    console.log(array);

    for (var i = 0; i < array.length; i++) {
        if (array[i].id == id) {
            $("#id").val(array[i].id);
            $("#name").val(array[i].name);
            $("#image").val(array[i].image);
            $("#price").val(array[i].price);
        }     
    }

}


</script>









