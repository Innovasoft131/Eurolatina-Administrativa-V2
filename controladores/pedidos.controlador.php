<?php

class ControladorPedidos{
	
	static public function ctrMostrarPedido(){
		

		$respuesta = ModeloPedido::mdlMostrarPedido();

		return $respuesta;
	}

	static public function ctrMostrarPedidoDesglosado($id){
		

		$respuesta = ModeloPedido::mdlMostrarPedidoDesglosado($id);

		return $respuesta;
	}

	static public function ctrMostrarCliente($id){
		

		$respuesta = ModeloPedido::mdlMostrarCliente($id);

		return $respuesta;
	}

	static public function ctrMostrarPiezas(){
		

		$respuesta = ModeloPedido::mdlMostrarPiezas();

		return $respuesta;
	}

	static public function ctrMostrarModelo($valor){


		$respuesta = ModeloPedido::mdlMostrarModelo($valor);

		return $respuesta;
	}

	static public function ctrMostrarColores($valor){


		$respuesta = ModeloPedido::mdlMostrarColores($valor);

		return $respuesta;
	}

	static public function ctrMostrarTallas($valor){


		$respuesta = ModeloPedido::mdlMostrarTallas($valor);

		return $respuesta;
	}

	static public function ctrMostrarClientes(){

		$tabla = "clientes";
		$item = null;
		$valor = null;
		$respuesta = ModeloPedido::mdlMostrar($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrInsertar($idCliente, $cliente, $datos){
		$respuesta = "";

		$insertPh = ModeloPedido::mdlInsertar($idCliente);

		if($insertPh >= 1){
			$insertaPedido = ModeloPedido::mdlInsertaPedidos($datos, $insertPh);
			if($insertaPedido == "ok"){
				$insertPm = ModeloPedido::mdlInsertarPrimerModulo($idCliente, $insertPh);
				
				if($insertPm >= 1 ){
					$respuesta = ModeloPedido::mdlInsertarPrimerModuloDesglose($datos, $insertPm);
				}
				
			}
		}
		
		return $respuesta;
	}

	/*=============================================
	SUMA DE PEDIDOS 
	=============================================*/

	static public function ctrSumaPedidos(){

		$tabla = "pedidosHechos";

		$respuesta = ModeloPedido::mdlSumaPedidos($tabla);

		return $respuesta;

	}

	static public function ctrPedidosTerminados($hoy){

		$respuesta = ModeloPedido::mdlPedidosTerminados($hoy);

		return $respuesta;

	}

}
