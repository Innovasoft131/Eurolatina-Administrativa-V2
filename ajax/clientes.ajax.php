<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarclientes($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarUsuario;

	public function ajaxValidarCliente(){

		$item = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorClientes::ctrMostrarclientes($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idCliente"])){

	$editar = new AjaxClientes();
	$editar -> idCliente = $_POST["idCliente"];
	$editar -> ajaxEditarCliente();

}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarCliente"])){

	$valCliente = new AjaxClientes();
	$valCliente -> validarCliente = $_POST["validarCliente"];
	$valCliente -> ajaxValidarCliente();

}