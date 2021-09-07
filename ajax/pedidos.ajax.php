<?php
require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

class AjaxPedidos{

    public $idModeloPedido;
    public $idPiezaPedido;
    public $nombreCliente;
    public $idCliente;
    public $excel;

    public function mostrarPiezas(){
        $respuesta = ControladorPedidos::ctrMostrarPiezas();

        echo json_encode($respuesta);
    }

    public function mostrarModelo(){
        $valor = $this -> idModeloPedido;
        $respuesta = ControladorPedidos::ctrMostrarModelo($valor);

        echo json_encode($respuesta);
    }

    public function mostrarColores(){
        $valor = $this -> idPiezaPedido;
        $respuesta = ControladorPedidos::ctrMostrarColores($valor);

        echo json_encode($respuesta);
    }

    public function mostrarTallas(){
        $valor = $this -> idPiezaPedido;
        $respuesta = ControladorPedidos::ctrMostrarTallas($valor);

        echo json_encode($respuesta);
    }

    public function insertar($datos){
        $cliente = $this -> nombreCliente;
        $idCliente = $this -> idCliente;
        $respuesta = ControladorPedidos::ctrInsertar($idCliente, $cliente, $datos);
        
        echo json_encode($respuesta);
    }

    public function mostrarClientes(){

        $respuesta = ControladorPedidos::ctrMostrarClientes();

        echo json_encode($respuesta);
    }



}



if(isset($_POST["mostarClinetes"])){  
    $ajaxPedidos = new AjaxPedidos();
    $ajaxPedidos -> mostrarClientes();
}

if(isset($_POST["guardarPedido"])){
    
    $datos = json_decode($_POST["datosPedido"], true);
    $ajaxPedidos = new AjaxPedidos();
    $ajaxPedidos -> nombreCliente = $_POST["cliente"];
    $ajaxPedidos -> idCliente = $_POST["idCliente"];
    $ajaxPedidos -> insertar($datos);

}

if(isset($_POST["mostrarTalla"])){
    $ajaxPedidos = new AjaxPedidos();
    $ajaxPedidos -> idPiezaPedido = $_POST["idPiezaPedido"];
    $ajaxPedidos -> mostrarTallas();
}
if(isset($_POST["mostrarColores"])){
    $ajaxPedidos = new AjaxPedidos();
    $ajaxPedidos -> idPiezaPedido = $_POST["idPiezaPedido"];
    $ajaxPedidos -> mostrarColores();
}

if(isset($_POST["mostarPiezas"])){
    $ajaxPedidos = new AjaxPedidos();
    $ajaxPedidos -> mostrarPiezas();
}

if(isset($_POST["idModeloPedido"])){
    $ajaxPedidos = new AjaxPedidos();
    $ajaxPedidos -> idModeloPedido = $_POST["idModeloPedido"];
    $ajaxPedidos -> mostrarModelo();
}




?>