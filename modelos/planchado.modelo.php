<?php

require_once "conexion.php";

class ModeloPlanchado{

    /*=============================================
	MOSTRAR PLANCHADO
	=============================================*/

	static public function mdlMostrarPlanchado(){

		$fechaInicial = date("Y-m-d 00:00:00");
		$fechaFinal = date("Y-m-d H:i:s");
		/*
		$stmt = Conexion::conectar()->prepare("select  tm.idPedido, c.nombre as cliente, p.nombre as pieza, co.nombre as color, pt.talla, tm.cantidadInicio from tercerModulo tm join primerModuloDesglose pmd on pmd.id = tm.idPrimerModuloD join primerModulo pm on pm.id = pmd.idPrimerModulo
        join clientes c on c.id = pm.idCliente join pieza p on p.id = tm.idPieza join colorPieza cp on cp.id = tm.idColor join color co on co.id = cp.idColor
        join piezaTalla pt on pt.id = tm.idTalla
        where tm.estado=0 order by tm.idPedido asc");
		*/

		$stmt = Conexion::conectar()->prepare("select  tm.idPedido, c.nombre as cliente, p.nombre as pieza, co.nombre as color, pt.talla, tm.cantidadInicio from tercerModulo tm join primerModuloDesglose pmd on pmd.id = tm.idPrimerModuloD join primerModulo pm on pm.id = pmd.idPrimerModulo
        join clientes c on c.id = pm.idCliente join pieza p on p.id = tm.idPieza join colorPieza cp on cp.id = tm.idColor join color co on co.id = cp.idColor
        join piezaTalla pt on pt.id = tm.idTalla
        where tm.estado=1 and (tm.fechainicio between '".$fechaInicial ."' and '".$fechaFinal."') order by tm.idPedido asc");
		

		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}
}