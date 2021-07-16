<?php

require_once "../controladores/piezas.controlador.php";
require_once "../modelos/pieza.modelo.php";

class AjaxPiezas{

    public $modelo;

    public $color;

    public $idPieza;

    public $talla;



    public function obtenModelo(){
        $valor = $this->modelo;
        $tabla = "modelo";

        $respuesta = ControladorPiezas::obtenerModelo($valor, $tabla);

     
        echo json_encode($respuesta);
    }

    public function obtenColor(){

        $valor = $this -> color;
        $tabla = "color";


        $respuesta = ControladorPiezas::obtenerColor($valor, $tabla);

        echo json_encode($respuesta);
    }

    public function obtenerPieza(){

        $valor = $this -> idPieza;
        $tabla = "pieza";

        $respuesta = ControladorPiezas::obtenerPieza($valor, $tabla);

        echo json_encode($respuesta);
    }

    public function obtenerColores(){

        $valor = $this -> idPieza;
        $tabla = "colorPieza";
        $tabla2 = "color";
        $tabla3 = "pieza";

        $respuesta = ControladorPiezas::obtenerColores($tabla, $tabla2, $tabla3, $valor);

        echo json_encode($respuesta);
    }

    public function obtenerTallas(){

        $valor = $this -> idPieza;
        $tabla = "piezaTalla";
        $tabla2 = "pieza";

        $respuesta = ControladorPiezas::obtenerTalla($tabla, $tabla2, $valor);

        echo json_encode($respuesta);
        
    }

    public function obtenerModelos(){

        $valor = $this -> idPieza;
        $tabla = "piezaModelo";
        $tabla2 = "pieza";

        $respuesta = ControladorPiezas::obtenerModelos($tabla, $tabla2, $valor);

        echo json_encode($respuesta);
        
    }

    public function eliminarColor(){

        $valor = $this -> idPieza;
        $tabla = "colorPieza";

        $respuesta = ControladorPiezas::eliminarColores($tabla, $valor);

        echo json_encode($respuesta);
        
    }

    
    public function eliminarTalla(){

        $valor = $this -> idPieza;
        $tabla = "piezaTalla";

        $respuesta = ControladorPiezas::eliminarColores($tabla, $valor);

        echo json_encode($respuesta);
        
    }

    public function obtenPieza(){

        $valor = $this -> modelo;
        $tabla = "pieza";

        $respuesta = ControladorPiezas::obtenerNombrePieza($tabla, $valor);

        echo json_encode($respuesta);
        
    }

    public function obtenColores(){
        $valor = $this -> modelo;
        $tabla = "color";

        $respuesta = ControladorPiezas::obtenerNombrePieza($tabla, $valor);

        echo json_encode($respuesta);
    }

    public function insertTalla(){
        $talla = $this -> talla;
        $idPieza = $this -> idPieza;

        $datos = array(
            "idPieza" => $idPieza,
            "talla" => $talla
        );

        $tabla = "piezaTalla";

        $respuesta = ControladorPiezas::insertTalla($tabla, $datos);
        echo json_encode($respuesta);
    }

}


// insert talla
if(isset($_POST["insertTalla"])){
    $ajaxModelo = new AjaxPiezas();
    $ajaxModelo -> idPieza = $_POST["idPiezaEditar"];
    $ajaxModelo -> talla = $_POST["talla"];
    $ajaxModelo -> insertTalla();
}


/*=============================================
OBTENER pieza
=============================================*/

if(isset($_POST["verificarColor"])){
    
    $ajaxModelo = new AjaxPiezas();
    $ajaxModelo -> modelo = $_POST["color"];

    $ajaxModelo -> obtenColores();
}

/*=============================================
OBTENER pieza
=============================================*/

if(isset($_POST["obtenerPieza"])){
    
    $ajaxModelo = new AjaxPiezas();
    $ajaxModelo -> modelo = $_POST["pieza"];

    $ajaxModelo -> obtenPieza();
}

/*=============================================
OBTENER MODELO
=============================================*/

if(isset($_GET["modelo"])){
    
    $ajaxModelo = new AjaxPiezas();
    $ajaxModelo -> modelo = $_GET["modelo"];

    $ajaxModelo -> obtenModelo();
}

// OBTENER COLOR

if(isset($_GET["color"])){
    
    $ajaxColor = new AjaxPiezas();
    $ajaxColor -> color = $_GET["color"];


    $ajaxColor -> obtenColor();

}

// OBTENER PIEZA
if(isset($_POST["idPieza"])){

    $ajaxModelo = new AjaxPiezas();
    $ajaxModelo -> idPieza = $_POST["idPieza"];
    $ajaxModelo -> obtenerPieza();

}

// OBTENER COLORES PARA EDITAR
if (isset($_POST["idPiezaC"])) {
    $ajaxModelo = new AjaxPiezas();
    $ajaxModelo -> idPieza = $_POST["idPiezaC"];
    $ajaxModelo -> obtenerColores();
}

// OBTENER Tallas PARA EDITAR
if(isset($_POST["idPiezaT"])){
    $ajaxModelo = new AjaxPiezas();
    $ajaxModelo -> idPieza = $_POST["idPiezaT"];
    $ajaxModelo -> obtenerTallas();
}

// OBTENER Modelos PARA EDITAR
if(isset($_POST["idPiezaM"])){
    $ajaxModelo = new AjaxPiezas();
    $ajaxModelo -> idPieza = $_POST["idPiezaM"];
    $ajaxModelo -> obtenerModelos();
}

// Eliminar Modelo
if(isset($_POST["idColorPieza"])){
    $ajaxModelo = new AjaxPiezas();
    $ajaxModelo -> idPieza = $_POST["idColorPieza"];
    $ajaxModelo -> eliminarColor();
}

// Eliminar talla
if(isset($_POST["idTallaPieza"])){
    $ajaxModelo = new AjaxPiezas();
    $ajaxModelo -> idPieza = $_POST["idTallaPieza"];
    $ajaxModelo -> eliminarTalla();
}


?>