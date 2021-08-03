<?php

require_once "../controladores/presupuesto.controlador.php";
require_once "../modelos/presupuesto.modelo.php";

class AjaxPresupuesto{
    public $idOportunidad;

    public function mostrarOportunidad(){
        $item = "id";
		$valor = $this->idOportunidad;

		$respuesta = ControladorPresupuesto::ctrMostrarPresupuesto($item, $valor);

		echo json_encode($respuesta);
    }
}

if(isset($_POST["idOportunidad"])){

    $ajaxPresupuesto = new AjaxPresupuesto();
    $ajaxPresupuesto -> idOportunidad = $_POST["idOportunidad"];
    $ajaxPresupuesto -> mostrarOportunidad();
}