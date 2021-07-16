<?php
require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";
if (isset($_POST['metodo'])) {
    if($_POST["metodo"] == "agregar"){
        $idUsuario = $_POST["idUsuario"];
        $idPieza = $_POST["idPieza"];
        $cliente = $_POST["cliente"];
        $nombre = $_POST["nombre"];
        $cantidad = $_POST["cantidad"];
        $descripcion = $_POST["descripcion"];

        $respuesta = ControladorPedidos::ctrCrearPedido($idUsuario,$idPieza,$cliente,$nombre,$cantidad,$descripcion);
    }
} else {
    
}