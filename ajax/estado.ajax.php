<?php
require_once "../controladores/estado.controlador.php";
require_once "../modelos/estado.modelo.php";
class AjaxEstado{
    public $idEstado;

    public function obtenerEstado(){
        $item = "id";
		$valor = $this->idEstado;

		$respuesta = EstadoControlador::ctrMostrarEstados($item, $valor);

		echo json_encode($respuesta);
    }


    /*=============================================
	VALIDAR NO REPETIR ESTADO
	=============================================*/	

	public $validarEstado;

	public function ajaxValidarEstado(){

		$item = "estado";
		$valor = $this->validarEstado;

		$respuesta = EstadoControlador::ctrMostrarEstados($item, $valor);

		echo json_encode($respuesta);

	}


}

if(isset($_POST['idEstado'])){
    $ajaxEstado = new AjaxEstado();
    $ajaxEstado -> idEstado = $_POST['idEstado'];
    $ajaxEstado -> obtenerEstado();
}

/*=============================================
VALIDAR NO REPETIR ESTADO
=============================================*/

if(isset( $_POST["validarEstado"])){

	$ajaxEstado = new AjaxEstado();
	$ajaxEstado -> validarEstado = $_POST["validarEstado"];
	$ajaxEstado -> ajaxValidarEstado();

}