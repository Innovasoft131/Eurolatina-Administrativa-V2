<?php
require_once "../controladores/colores.controlador.php";
require_once "../modelos/colores.modelo.php";

class ColoresAjax{

    public $idColor;

    function obtenerColor(){

        $valor = $this->idColor;
        $item = "id";

        $respuesta = ControladorColores::ctrObtenerColores($item, $valor);

        echo json_encode($respuesta);
    }

    
    public function obtenColor(){

        $valor = $this -> color;
        $item = "nombre";


        $respuesta = ControladorColores::ctrObtenerColor($valor, $item);

        echo json_encode($respuesta);
    }

}

if(isset($_POST["idColor"])){

    $respuesta = new ColoresAjax();
    $respuesta -> idColor = $_POST["idColor"];
    $respuesta -> obtenerColor();
}


// OBTENER COLOR

if(isset($_GET["color"])){
    $ajaxColor = new ColoresAjax();
    $ajaxColor -> color = $_GET["color"];


    $ajaxColor -> obtenColor();

}