<?php

if(isset($_POST['data'])){

    $data = json_decode($_POST['data']);

    if($data->metodo == "provincias"){
        $datos = Utils::listarProvincias($data->idpais);
    }else if ($data->metodo == "localidades") {
        $datos = Utils::listarLocalidades($data->idprovincia);
    }
    
    // echo $datos;
    echo json_encode($datos);
    
}

?>