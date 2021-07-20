<?php
require_once "../controladores/tipoaccion.controlador.php";
require_once "../modelos/tipoaccion.modelo.php";
class AjaxAccion{
    public $idAccion;

    public function obtenerAccion(){
        $item = "id";
		$valor = $this->idAccion;

		$respuesta = tipoaccionControlador::ctrMostrarTipoAccion($item, $valor);

		echo json_encode($respuesta);
    }


    /*=============================================
	VALIDAR NO REPETIR UNIDAD
	=============================================*/	

	public $validarAccion;

	public function ajaxValidarAccion(){

		$item = "unidad";
		$valor = $this->validarAccion;

		$respuesta = tipoaccionControlador::ctrMostrarTipoAccion($item, $valor);

		echo json_encode($respuesta);

	}


} 

if(isset($_POST['idAccion'])){
    $ajaxUnidad = new AjaxAccion();
    $ajaxUnidad -> idUnidad = $_POST['idAccion'];
    $ajaxUnidad -> obtenerAccion();
}

/*=============================================
VALIDAR NO REPETIR UNIDAD
=============================================*/

if(isset( $_POST["validarAccion"])){

	$ajaxUnidad = new AjaxUnidad();
	$ajaxUnidad -> validarUnidad = $_POST["validarAccion"];
	$ajaxUnidad -> ajaxValidarUnidad();

}