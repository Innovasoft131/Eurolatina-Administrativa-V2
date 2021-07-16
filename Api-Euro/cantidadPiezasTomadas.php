<?php

require_once 'clases/respuestas.class.php';
require_once 'clases/piezasTomadas.class.php';

$respuestas = new Respuestas();
$piezasTomadas = new PiezasTomadas();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $postBody = file_get_contents("php://input");

     //enviamos los datos a procesar
     $res = $piezasTomadas->insert($postBody);

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