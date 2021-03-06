<?php
require_once "../controladores/porcentajeExito.controlador.php";
require_once "../modelos/porcentajeexito.modelo.php";
class AjaxPorcentaje{
    public $idporcentaje;

    public function obtenerPorcentaje(){
        $item = "id";
		$valor = $this->idporcentaje;
        
		$respuesta = PorcentajeExitoControlador::ctrMostrarPorcentajes($item, $valor);
        
		echo json_encode($respuesta);
    }


    /*=============================================
	VALIDAR NO REPETIR UNIDAD
	=============================================*/	

	public $validarUnidad;

	public function ajaxValidarUnidad(){

		$item = "etapa";
		$valor = $this->validarUnidad;

		$respuesta = PorcentajeExitoControlador::ctrMostrarPorcentajes($item, $valor);

		echo json_encode($respuesta);

	}
}
  
if(isset($_POST['idporcentaje'])){
    $ajaxUnidad = new AjaxPorcentaje();
    $ajaxUnidad -> idporcentaje = $_POST['idporcentaje'];
    $ajaxUnidad -> obtenerPorcentaje();
}

/*=============================================
VALIDAR NO REPETIR UNIDAD
=============================================*/

if(isset( $_POST["validarPorcentaje"])){

	$ajaxUnidad = new AjaxPorcentaje();
	$ajaxUnidad -> validarUnidad = $_POST["validarPorcentaje"];
	$ajaxUnidad -> ajaxValidarUnidad();

}