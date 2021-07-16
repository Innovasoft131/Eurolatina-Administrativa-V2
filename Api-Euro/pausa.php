<?php

require_once 'clases/respuestas.class.php';
require_once 'clases/pausa.class.php';

$respuestas = new Respuestas();
$pausa = new Pausa();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $postBody = file_get_contents("php://input");

    $datos = json_decode($postBody, true);
    if(!isset($datos["accion"]) ){
        $res = $respuestas->error_400();
    }else{
        if($datos["accion"] == "pausa"){
            //enviamos los datos a procesar
            $res = $pausa->update($postBody);
        }elseif($datos["accion"] == "inicia"){
            //enviamos los datos a procesar
            $res = $pausa->updateInicio($postBody);
        }
    }



    // devolvemos una respuesta
    header('Content-Type: application/json');
    if(isset($res["result"]["error_id"])){   
        $responsoCode = $res["result"]["error_id"];
        http_response_code($responsoCode);
    
    }else{
        http_response_code(200);
    }
    
    echo json_encode($res);
}else{
    header('Content-Type: application/json');
    $datosArr = $respuestas->error_405();
    echo json_encode($datosArr);
    
}