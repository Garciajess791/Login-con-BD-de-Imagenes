<?php

$con = ConectarBD();
function ConectarBD(){
    $host = "localhost";
    $db = "FOTOS_WEB";
    $user = "root"; 
    $pass = "root";
    $con = mysqli_connect($host,$user,$pass,$db);
    return $con;
}

if(isset($_POST) and !empty($_POST)){
    if(isset($_POST['id']) and !empty($_POST['id'])){
        $id = $_POST['id'];
        CargarDatosId($con, $id);
    }
    
    if(isset($_POST['accion']) and !empty($_POST['accion'])){
        if($_POST['accion'] == 'Guardar'){
            $datos = $_POST;
            GuardarDatos($con, $datos);
        }
    }
    
}

function CargarDatos($con){
    $sql = "SELECT * FROM `fotos`"; 
    $datos = $con->query($sql) or die ('Error al conectar a la Base de datos');

    return $datos;
}

function CargarDatosId($con, $id){
    $sql = "SELECT * FROM `fotos` WHERE `rowid`=".$id; 
    $datos = $con->query($sql) or die ('Error en la consulta por rowid');
    $total = mysqli_num_rows($datos);
    if($total !=0){
        foreach($datos as $dato){
            echo '<img src="'.$dato['url'].'" alt="'.$dato['alt'].'"><h4 class="mt-2">'.$dato['nombre'].'</h4>';
        }
    }
    return $datos;
}

function GuardarDatos($con, $datos){
    $sql = "INSERT INTO `fotos` (`rowid`, `nombre`, `url`, `alt`) VALUES (NULL, '".$datos['nombre']."', '".$datos['url']."', '".$datos['alt']."');";
    $res = $con->query($sql) or die($msn = "Error guardando Foto");
    
    if($res !=0){
        $sql = "SELECT `rowid` FROM `fotos` ORDER BY `rowid` DESC LIMIT 1";
        $rowid = $con->query($sql) or die($msn = "Error buscando ultimo rowid insertado");
        $total = mysqli_num_rows($rowid);
        foreach($rowid as $datoRowid);
        if($total !=0){
            $msn = '¡Foto guardada correctamente!';
            $arr = array('img'=>'<img class="img-fluid" src="'.$datos['url'].'" alt="'.$datos['alt'].'"><p class="mt-2">'.$datos['nombre'].'</p>',
                    'msn'=>'<div class="alert alert-primary text-center" role="alert">'.$msn.'.</div>',
                    'option' => '<option value="'.$datoRowid['rowid'].'">'.$datos['nombre'].'</option>');
            echo json_encode($arr);
        }
    }else{
        $msn = '¡Error al guardar la foto!';
        $arr = array('msn'=>'<div class="alert alert-danger text-center" role="alert">'.$msn.'.</div>');
        echo json_encode($arr);
    }
}
?>
