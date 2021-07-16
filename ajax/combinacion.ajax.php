<?php
require_once "../controladores/combinacion.controlador.php";
require_once "../modelos/combinacion.modelo.php";
class AjaxCombinacion{
    public $nombreColor;
    public $nombreCombinacion;
    public $idCombinacion;

    function insert($datos){
        
        $respuesta = ControladorCombinacion::cntinsert($datos, $this->nombreCombinacion);

        echo json_encode($respuesta);
    }

    function obtenerColores(){
        
        $respuesta = ControladorCombinacion::ctrObtenerColoresCombinacion($this->idCombinacion);

        echo json_encode($respuesta);
    }

    function insertCombinacion(){
        
        $respuesta = ControladorCombinacion::cntinsertCombinacion($this->idCombinacion, $this->nombreColor);

        echo json_encode($respuesta);
    }

    function eliminarColorCombinacion(){
        $respuesta = ControladorCombinacion::cntEliminarColorCombinacion($this->idCombinacion);

        echo json_encode($respuesta);
    }

    function eliminarColorCombinacionCrud(){
        $respuesta = ControladorCombinacion::cntEliminarColorCombinacionCrud($this->idCombinacion);

        echo json_encode($respuesta); 
    }

}

if(isset($_POST["guardarConbinacion"])){
    $datos = json_decode($_POST["nombreColorC"], true);
    $ajaxCombinacion = new AjaxCombinacion();
    $ajaxCombinacion -> nombreCombinacion = $_POST["nombreConbinacion"];
    $ajaxCombinacion -> insert($datos);
}

if(isset($_POST["obtenerColores"])){
    $ajaxCombinacion = new AjaxCombinacion();
    $ajaxCombinacion -> idCombinacion = $_POST["idCombinacion"];
    $ajaxCombinacion -> obtenerColores();
}

if(isset($_POST["guardarConbinacionEditar"])){
    $ajaxCombinacion = new AjaxCombinacion();
    $ajaxCombinacion -> idCombinacion = $_POST["idColor"];
    $ajaxCombinacion -> nombreColor = $_POST["nombreColor"];
    $ajaxCombinacion -> insertCombinacion();
}


if(isset($_POST["EliminarColorCombinacion"])){
    $ajaxCombinacion = new AjaxCombinacion();
    $ajaxCombinacion -> idCombinacion = $_POST["idcombinacion"];
    $ajaxCombinacion -> eliminarColorCombinacion();
}

if(isset($_POST["EliminarColorCombinacionCrud"])){
    $ajaxCombinacion = new AjaxCombinacion();
    $ajaxCombinacion -> idCombinacion = $_POST["idColor"];
    $ajaxCombinacion -> eliminarColorCombinacionCrud();
}