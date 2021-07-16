<?php
require_once "../controladores/asignar.controlador.php";
require_once "../modelos/asignar.modelo.php";
class AjaxAsignar{
    public $idPedido;
    public $idLinea;
    public $idPieza;
    public $idModelo;
    public $idColor;
    public $idPrimerModulo;
    public $idMaquina;
    public $cantidadAsignada;
    public $cantidadPedido;
    public $idPrimerModuloDesglose;

    public function obtenerPiezasPedido(){
        $valor = $this-> idPedido;
        $datos = array(
            "idPedido" => $this-> idPedido,
            "idPrimerModulo" => $this -> idPrimerModulo
        );
        $respuesta = ControladorAsignar::cntobtenerPiezasPedido($datos);

        echo json_encode($respuesta);
    }

    public function obtenerPimerModuloDesglose(){
        $datos = array(
            "idPedido" => $this-> idPedido,
            "idPieza" => $this -> idPieza
        );
        $respuesta = ControladorAsignar::cntobtenerPimerModuloDesglose($datos);

        echo json_encode($respuesta);
    }

    public function mostrarMaquinas(){

        $respuesta = ControladorAsignar::cntobtenermostrarMaquinas();

        echo json_encode($respuesta);
    }

    public function insert(){

        $datos = array(
            "idMaquina" => $this->idMaquina,
            "idLinea" => $this->idLinea,
            "cantidadAsignada" => $this->cantidadAsignada,
            "cantidadPedido" => $this->cantidadPedido,
            "idPrimerModulo" => $this->idPrimerModulo,
            "idPrimerModuloDesglose" => $this->idPrimerModuloDesglose,
        );
        $respuesta = ControladorAsignar::cntinsert($datos);

        echo json_encode($respuesta);
    }

    public function verificar(){
        $datos = array(
            "cantidadAsignada" => $this->cantidadAsignada,
            "cantidadPedido" => $this->cantidadPedido,
            "idPrimerModulo" => $this->idPrimerModulo,
            "idPrimerModuloDesglose" => $this->idPrimerModuloDesglose,
        );
        $respuesta = ControladorAsignar::cntverificar($datos);

        echo json_encode($respuesta);
    }


    public function mostrarMaquinaAsignada(){
        $datos = array(
            "idPedido" => $this->idPedido,
            "idPrimerModulo" => $this->idPrimerModulo
        );
        $respuesta = ControladorAsignar::cntMostrarMaquinaAsignada($datos);

        echo json_encode($respuesta);
    }

    public function eliminarMaquinasProceso(){
        $datos = array(
            "idmaquinasproceso" => $this->idMaquina
        );
        $respuesta = ControladorAsignar::cnteliminarMaquinasProceso($datos);

        echo json_encode($respuesta);
    }

    public function cantidadPrimerModulo(){
        $datos = array(
            "idPrimerModulo" => $this->idPrimerModulo
        );
        $respuesta = ControladorAsignar::cntCantidadPrimerModulo($datos);

        echo json_encode($respuesta);
    }

    public function cantidadMaquinasProceso(){
        $datos = array(
            "idPrimerModulo" => $this->idPrimerModulo
        );
        $respuesta = ControladorAsignar::cntCantidadMaquinasProceso($datos);

        echo json_encode($respuesta);
    }

    public function editarPrimerModulo(){
        $datos = array(
            "idPrimerModulo" => $this->idPrimerModulo
        );
        $respuesta = ControladorAsignar::cnteditarPrimerModulo($datos);

        echo json_encode($respuesta);
    }

    public function editarPrimerModuloACero(){
        $datos = array(
            "idPrimerModulo" => $this->idPrimerModulo
        );
        $respuesta = ControladorAsignar::cnteditarPrimerModuloACero($datos);

        echo json_encode($respuesta);
    }


    public function mostrarLineas(){
        $idLinea =  $this -> idMaquina;
        $respuesta = ControladorAsignar::cntobtenermostrarMaquinasLineas($idLinea);

        echo json_encode($respuesta);
    }




}

if(isset($_POST["editarPrimerModuloAcero"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> idPrimerModulo = $_POST["idPrimerModulo"];
    $ajaxAsignar -> editarPrimerModuloACero();
}

if(isset($_POST["editarPrimerModulo"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> idPrimerModulo = $_POST["idPrimerModulo"];
    $ajaxAsignar -> editarPrimerModulo();
}

if(isset($_POST["cantidadPrimerModulo"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> idPrimerModulo = $_POST["idPrimerModulo"];
    $ajaxAsignar -> cantidadPrimerModulo();
}

if(isset($_POST["cantidadMaquinasProceso"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> idPrimerModulo = $_POST["idPrimerModulo"];
    $ajaxAsignar -> cantidadMaquinasProceso();
}

if(isset($_POST["idmaquinasproceso"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> idMaquina = $_POST["idmaquinasproceso"];
    $ajaxAsignar -> eliminarMaquinasProceso();
}

if(isset($_POST["mostrarMaquina"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> idPrimerModulo = $_POST["idPrimerModulo"];
    $ajaxAsignar -> idPedido = $_POST["idPedido"];
    $ajaxAsignar -> mostrarMaquinaAsignada();
}

if(isset($_POST["verificar"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> cantidadAsignada = $_POST["cantidadAsignada"];
    $ajaxAsignar -> cantidadPedido = $_POST["cantidadPedido"];
    $ajaxAsignar -> idPrimerModulo = $_POST["idPrimerModulo"];
    $ajaxAsignar -> idPrimerModuloDesglose = $_POST["idPrimerModuloDesglose"];
    $ajaxAsignar -> verificar();
}

if(isset($_POST["accion"])){
    if($_POST["accion"] == "insertar"){
        $ajaxAsignar = new AjaxAsignar();
        $ajaxAsignar -> idMaquina = $_POST["idMaquina"];
        $ajaxAsignar -> idLinea = $_POST["idLinea"];
        $ajaxAsignar -> cantidadAsignada = $_POST["cantidadAsignada"];
        $ajaxAsignar -> cantidadPedido = $_POST["cantidadPedido"];
        $ajaxAsignar -> idPrimerModulo = $_POST["idPrimerModulo"];
        $ajaxAsignar -> idPrimerModuloDesglose = $_POST["idPrimerModuloDesglose"];
        $ajaxAsignar -> insert();

    }
}

if(isset($_POST["idPedidoSeleccion"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> idPedido = $_POST["idPedidoSeleccion"];
    $ajaxAsignar -> idPrimerModulo = $_POST["idPrimerModulo"];
    $ajaxAsignar -> obtenerPiezasPedido();
}

if(isset($_POST["idPiezaSeleccionada"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> idPedido = $_POST["idPedido"];
    $ajaxAsignar -> idPieza = $_POST["idPiezaSeleccionada"];
    $ajaxAsignar -> obtenerPimerModuloDesglose();
}

if(isset($_POST["maquinas"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> mostrarMaquinas();
}

if(isset($_POST["mostrarMaquinas"])){
    $ajaxAsignar = new AjaxAsignar();
    $ajaxAsignar -> idMaquina = $_POST["idlinea"];
    $ajaxAsignar -> mostrarLineas();
}
