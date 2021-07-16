<?php

require_once 'clases/respuestas.class.php';
require_once 'clases/lineas.class.php';

$respuestas = new Respuestas();
$linea = new Linea();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['idLinea'])){
        $idLinea = $_GET['idLinea'];

        $datos = $linea->mostrarLinea($idLinea);

        header('Content-Type: application/json');
        http_response_code(200);


      
        echo json_encode($datos);

    }elseif(isset($_GET["id"])){
        
        $idLinea = $_GET['id'];

        $datos = $linea->mostrarLineaTercerModulo($idLinea);

        header('Content-Type: application/json');
        http_response_code(200);


      
        echo json_encode($datos);
        
    }elseif(isset($_GET["tabla"])){
        $tabla = $_GET['tabla'];

        $datos = $linea->mostrarLineas($tabla);

        header('Content-Type: application/json');
        http_response_code(200);


      
        echo json_encode($datos);
    }
}else{
    header('Content-Type: application/json');
    $datosArr = $respuestas->error_405();
    echo json_encode($datosArr);
    
}