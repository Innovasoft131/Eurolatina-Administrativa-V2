<?php
require_once "../controladores/unidad.controlador.php";
require_once "../modelos/unidad.modelo.php";
class AjaxUnidad{
    public $idUnidad;

    public function obtenerUnidad(){
        $item = "id";
		$valor = $this->idUnidad;

		$respuesta = UnidadControlador::ctrMostrarUnidades($item, $valor);

		echo json_encode($respuesta);
    }


    /*=============================================
	VALIDAR NO REPETIR UNIDAD
	=============================================*/	

	public $validarUnidad;

	public function ajaxValidarUnidad(){

		$item = "unidad";
		$valor = $this->validarUnidad;

		$respuesta = UnidadControlador::ctrMostrarUnidades($item, $valor);

		echo json_encode($respuesta);

	}


}

if(isset($_POST['idUnidad'])){
    $ajaxUnidad = new AjaxUnidad();
    $ajaxUnidad -> idUnidad = $_POST['idUnidad'];
    $ajaxUnidad -> obtenerUnidad();
}

/*=============================================
VALIDAR NO REPETIR UNIDAD
=============================================*/

if(isset( $_POST["validarUnidad"])){

	$ajaxUnidad = new AjaxUnidad();
	$ajaxUnidad -> validarUnidad = $_POST["validarUnidad"];
	$ajaxUnidad -> ajaxValidarUnidad();

}