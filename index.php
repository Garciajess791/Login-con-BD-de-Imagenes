<?php
require('controller.php');
$datos = CargarDatos($con);
?>
<!DOCTYPE html>
<html lang="Es-es">

<head>
    <title>Login BD con Imagen</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <link rel="canonical" href="https://mdbootstrap.com/snippets/standard/mdbootstrap/2958490/">
    <link rel="canonical" href="https://mdbootstrap.com/snippets/standard/temp/4628244/">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="jquery-1.3.2.min.js" type="text/javascript"></script> 
  </head>

<body>
<style>
    html,body,.intro {
        height: 100%;
    }
        
    @media (min-width: 550px) and (max-width: 750px) {
        html,body,.intro {
        height: 750px;
        }
    }

    @media (min-width: 800px) and (max-width: 850px) {
        html,body,.intro {
            height: 750px;
        }
    }

    .mask-custom {
        backdrop-filter: blur(15px);
        background-color: rgba(255,255,255,.2);
        border-radius: 3em;
        border: 2px solid rgba(255,255,255,.1);
        background-clip: padding-box;
        box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
    }
    .table{
        width: 100%;
        padding-bottom: 3rem

    }
    img {
      height: 500px;
    }
    
    .bg-image{
        background-size: cover;
        background-position: center;
    }

</style>
<section class="intro">
  <div class="bg-image h-100" style="background-image: url('https://p4.wallpaperbetter.com/wallpaper/906/651/674/landscape-desktop-wallpaper-preview.jpg');">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="text-center">
          <div class="col-md-12" id="alert">
          </div>
        </div>
        <div class="row justify-content-center">
        <div class="col-6 col-md-10 col-lg-7 col-xl-6">
            <div class="card mask-custom">
              <div class="card-body p-5 text-white">
                <div class="my-4">
                <div class="text-center">
                  <h4 class="mt-1 mb-5 pb-1">Imagen</h4>
                </div>
                <div class="text-center pt-1 mb-5 pb-1">
                  <div id="foto"></div>
                </div>
                </div>
              </div>
            </div>
        </div>
          <div class="col-6 col-md-10 col-lg-7 col-xl-6">
            <div class="card mask-custom">
              <div class="card-body p-5 text-white">
                <div class="my-4">
                  <h2 class="text-center mb-5">Seleccione La Foto</h2> 
                      <div class="text-center pt-1 mb-5 pb-1">
                      <select class="form-select bg-white text-dark w-100" id="select" onchange="PreCargarFoto(this.value)">
                            <option></option>
                            <?php 
                                if(isset($datos)){
                                    foreach($datos as $foto){
                                        if(!empty($foto)){
                                            echo '<option value="'.$foto['rowid'].'">'.$foto['nombre'].'</option>';
                                        }   
                                    }
                                }
                            ?>
                        </select>
                            <div class="text-center pt-1 mb-5 pb-1">
                            <button class="fa-lg gradient-custom-2 mb-3" onclick="MostrarFoto()">Click!</button>
                            </div>
                        </div>
                    <div class="mt-4">
                        <h2>Añadir foto nueva</h2>
                        
                            <div class="form-outline form-white mb-2">
                                <label class="form-label mt-1">Nombre de la foto:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control"/>
                                
                            </div>
                            <div class="form-outline form-white mb-2">
                                <label class="form-label mt-1">URL:</label>
                                <input type="text" name="url" id="url" class="form-control"/>
                            </div>
                            <div class="form-outline form-white mb-2">
                                <label class="form-label mt-1">Texto Alternativo:</label>
                                <input type="text" name="alt" id="alt" class="form-control"/>
                            </div>
                            <div class="mt-3">
                                <input type="button" id="save" value="Guardar" class="btn btn-outline-light text-center enviar" onclick="GuardarFoto()"/>
                                <input type="reset" value="RESET" class="btn btn-outline-light mx-2 reset" />
                            </div>
                    </div>
                </div>
              </div>
            </div>
         </div>
        </div>
      </div>
    </div>
</section>
</body>

<script>
function MostrarFoto(){
    event.preventDefault();
    $.post("controller.php", {'id': datos}, function(response) {
        document.getElementById('foto').innerHTML = response;
    })
}

var datos ="";
  function PreCargarFoto(valor){
    datos = valor;
    console.log(valor);
        }

function GuardarFoto() {
            
  var nombre = document.getElementById('nombre').value;
  var url = document.getElementById('url').value;
  var alt = document.getElementById('alt').value;
  var accion = document.getElementById('save').value;
    if(nombre !="" || url !="" || alt !=""){
      const data ={'accion': accion, 'rowid' : null, 'nombre' : nombre, 'url' : url,'alt' : alt}
      $.post("controller.php", data, function(response){
        console.log(response);
        var result = JSON.parse(response);
        document.getElementById('foto').innerHTML = result.img;
        document.getElementById('alert').innerHTML = result.msn;
        $('#select').append(result.option);
        EliminarAlerta();
      });
    }
}

function EliminarAlerta (){
    var alerta = setInterval( 'document.getElementById("alert").style.display = "none" ', 2000);
}

</script>

</html>
