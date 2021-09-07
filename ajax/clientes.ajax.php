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

	/*=============================================
	VALIDAR CARACTERES ESPECIALES
	=============================================*/
	public $validarCliente;
	public function ajaxValidarClienteOrtografia(){

		$respuesta = "";
	
		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $this->validarCliente)){
			$respuesta = "ok";
		}else{
			$respuesta = "error";
		}

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR CARACTERES ESPECIALES PASSWORD
	=============================================*/
	
	public function ajaxValidarClientePassword(){

		$respuesta = "";
	
		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ*+# ]+$/', $this->validarCliente)){
			$respuesta = "ok";
		}else{
			$respuesta = "error";
		}

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR CARACTERES ESPECIALES CORREO
	=============================================*/
	
	public function ajaxValidarClienteCorreo(){

		$respuesta = "";
	
		if(filter_var( $this->validarCliente, FILTER_VALIDATE_EMAIL)){
			$respuesta = "ok";
		}else{
			$respuesta = "error";
		}

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR CARACTERES ESPECIALES TELEFONO
	=============================================*/
	
	public function ajaxValidarClienteTelefono(){

		$respuesta = "";
	
		if(preg_match('#^\(?\d{2}\)?[\s\.-]?\d{4}[\s\.-]?\d{4}$#', $this->validarCliente)){
			$respuesta = "ok";
		}else{
			$respuesta = "error";
		}

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR CARACTERES ESPECIALES WEB
	=============================================*/
	
	public function ajaxValidarClienteWeb(){

		$respuesta = "";
	
		if(filter_var( $this->validarCliente, FILTER_VALIDATE_URL)){
			$respuesta = "ok";
		}else{
			$respuesta = "error";
		}

		echo json_encode($respuesta);

	}

	/*=============================================
	OBTENER CLIENTES
	=============================================*/	

	public $cliente;

	function obtenerCliente(){
        $valor = $this->cliente;
        $tabla = "clientes";

        $respuesta = ControladorClientes::ctrMostrarCliente($tabla, $valor);
		
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


/*=============================================
OBTENER CLIENTE
=============================================*/

if(isset($_GET["cliente"])){
    $ajaxcliente = new AjaxClientes();
    $ajaxcliente -> cliente = $_GET["cliente"];

    $ajaxcliente -> obtenerCliente();
}

/*=============================================
VALIDAR CARACTERES ESPECIALES
=============================================*/

if(isset( $_POST["validarClienteOrtografia"])){

	$valCliente = new AjaxClientes();
	$valCliente -> validarCliente = $_POST["validarClienteOrtografia"];
	$valCliente -> ajaxValidarClienteOrtografia();

}


/*=============================================
VALIDAR CARACTERES ESPECIALES PASSWORD
=============================================*/

if(isset( $_POST["validarClientePassword"])){

	$valCliente = new AjaxClientes();
	$valCliente -> validarCliente = $_POST["validarClientePassword"];
	$valCliente -> ajaxValidarClientePassword();

}

/*=============================================
VALIDAR CARACTERES ESPECIALES CORREO
=============================================*/

if(isset( $_POST["validarClienteCorreo"])){

	$valCliente = new AjaxClientes();
	$valCliente -> validarCliente = $_POST["validarClienteCorreo"];
	$valCliente -> ajaxValidarClienteCorreo();

}

/*=============================================
VALIDAR CARACTERES ESPECIALES TELEFONO
=============================================*/

if(isset( $_POST["validarClienteTelefono"])){

	$valCliente = new AjaxClientes();
	$valCliente -> validarCliente = $_POST["validarClienteTelefono"];
	$valCliente -> ajaxValidarClienteTelefono();

}

/*=============================================
VALIDAR CARACTERES ESPECIALES WEB
=============================================*/

if(isset( $_POST["validarClienteWeb"])){

	$valCliente = new AjaxClientes();
	$valCliente -> validarCliente = $_POST["validarClienteWeb"];
	$valCliente -> ajaxValidarClienteWeb();

}