<?php
class ControladorPlanchado{

    /*=============================================
	MOSTRAR PLANCHADO
	=============================================*/

	static public function ctrMostrarPlanchado(){


		$respuesta = ModeloPlanchado::mdlMostrarPlanchado();

		return $respuesta;
	}
}