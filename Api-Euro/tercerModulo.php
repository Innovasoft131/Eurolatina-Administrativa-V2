<?php


require_once 'clases/respuestas.class.php';
require_once 'clases/tercerModulo.class.php';

$respuestas = new Respuestas();
$tercerModulo = new TercerModulo();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $datosTercerModulo = $tercerModulo->mostrar($id);
        header('Content-Type: application/json');
        http_response_code(200);
      
        echo json_encode($datosTercerModulo);
      
    }elseif(isset($_GET['idMaquina'])){
        $id = $_GET['idMaquina'];
        $datosTercerModulo = $tercerModulo->mostrarEnProceso($id);
        header('Content-Type: application/json');
        http_response_code(200);
      
        echo json_encode($datosTercerModulo);
    }elseif(isset($_GET["idTercerModulo"])){

        $idTercerModulo = $_GET["idTercerModulo"];
                
        
        $respuesta = $tercerModulo ->obtenercantidadRecibida($idTercerModulo);

        header('Content-Type: application/json');
        http_response_code(200);
      
        echo json_encode($respuesta);
    }elseif(isset($_GET["idColor"])){
        
        $idColor = $_GET["idColor"];
                
        
        $respuesta = $tercerModulo ->obtenerCombinacion($idColor);

        header('Content-Type: application/json');
        http_response_code(200);
      
        echo json_encode($respuesta);
        
    } else {
        header('Content-Type: application/json');
        $datosArr = $respuestas->error_405();   
        echo json_encode($datosArr);
    }

}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // recibimos datos
    $postBody = file_get_contents("php://input");

      $datos = json_decode($postBody, true);

    if(!isset($datos["accion"])){
        $respuestas->error_400();   
    }else{
        if($datos["accion"] == "insert"){
            //enviamos los datos a procesar
            $res = $tercerModulo->insert($postBody);
            
        }elseif($datos["accion"] == "modificarCantidad"){
            $res = $tercerModulo->editarCantidad($postBody);
        }elseif($datos["accion"] == "modificarCantidadTercerModulo"){
           
            $res = $tercerModulo->editarCantidadTercerModulo($postBody);
        }elseif($datos["accion"] == "modificarCantidadRecibida"){
            $res = $tercerModulo->editarCantidadRecibida($postBody);
        }
    //enviamos los datos a procesar
   // $res = $tercerModulo->insert($postBody);
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
}elseif ($_SERVER['REQUEST_METHOD'] == 'PUT'){
    // recibimos datos
    $postBody = file_get_contents("php://input");

    $res = $tercerModulo->edit($postBody);

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