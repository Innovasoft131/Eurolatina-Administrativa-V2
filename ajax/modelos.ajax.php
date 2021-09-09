<?php

require_once "../controladores/modelos.controlador.php";
require_once "../modelos/modelo.modelo.php";

class AjaxModelos{

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	public $idModelo;

	public function ajaxEditarmodelo(){
		$item = "id";
		$valor = $this->idModelo;

		$respuesta = Controladormodelos::ctrMostrarModelos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/

	public $validar;

	public function ajaxValidarmodelo(){

		$item = "nombre";
		$valor = $this->validarmodelo;

		$respuesta = Controladormodelos::ctrMostrarModelos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	OBTENER MODELOS PARA AUTOCOMPLETADO
	=============================================*/	

	public $modelo;

	function obtenerModelo(){
        $valor = $this->modelo;
        $tabla = "pieza";

        $respuesta = Controladormodelos::ctrMostrarModelo($tabla, $valor);
		
		echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idModelo"])){
	$editar = new Ajaxmodelos();
	$editar -> idModelo = $_POST["idModelo"];
	$editar -> ajaxEditarmodelo();

}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarmodelo"])){

	$valmodelo = new Ajaxmodelos();
	$valmodelo -> Validarmodelo = $_POST["validarmodelo"];
	$valmodelo -> ajaxValidarmodelo();

}


/*=============================================
OBTENER MODELO
=============================================*/

if(isset($_GET["modelo"])){
    $ajaxModelo = new Ajaxmodelos();
    $ajaxModelo -> modelo = $_GET["modelo"];
    $ajaxModelo -> obtenerModelo();
}
