<?php

require_once "conexion.php";

class ModeloGeneral{

    public static function mdlModelosTerminados($tabla, $fechaInicial, $fechaFinal){
        $fechaInicial = date("$fechaInicial 00:00:00");
		$fechaFinal = date("$fechaFinal H:i:s");
        $stmt = Conexion::conectar()->prepare("SELECT SUM(tm.cantidadFinal) as cantidadTerminada FROM tercerModulo tm JOIN segundoModulo sm on sm.id = tm.idsegundoModulo join primerModulo pm on pm.id = sm.idPrimerModulo JOIN clientes c on c.id = pm.idCliente WHERE (tm.estado = 2 and sm.estado = 2) and tm.fechainicio BETWEEN '$fechaInicial' and '$fechaFinal'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

		$stmt = null;
    }

    public static function mdlModelosTerminadosMaquina($fechaInicial, $fechaFinal){
        $fechaInicial = date("$fechaInicial 00:00:00");
		$fechaFinal = date("$fechaFinal H:i:s");
        $stmt = Conexion::conectar()->prepare("SELECT sum(sm.cantidadFinal) as cantidadTerminadaMaquina  from segundoModulo sm join primerModulo pm on pm.id = sm.idPrimerModulo join clientes c on c.id = pm.idCliente
        where sm.estado = 2 and sm.fechainicio BETWEEN'$fechaInicial' and '$fechaFinal'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

		$stmt = null;
    }

    public static function mdlModelosTerminadosPlanchado($fechaInicial, $fechaFinal){
        $fechaInicial = date("$fechaInicial 00:00:00");
		$fechaFinal = date("$fechaFinal H:i:s");
        $stmt = Conexion::conectar()->prepare("SELECT SUM(tm.cantidadFinal) as cantidadTerminadaPlanchado FROM tercerModulo tm JOIN segundoModulo sm on sm.id = tm.idsegundoModulo join primerModulo pm on pm.id = sm.idPrimerModulo JOIN clientes c on c.id = pm.idCliente WHERE tm.estado = 2 and tm.fechainicio BETWEEN '$fechaInicial' and '$fechaFinal'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

		$stmt = null;
    }

    static public function mdlModelosTerminadosTabla($fechaInicial, $fechaFinal){


		$fechaInicial = date("$fechaInicial 00:00:00");
		$fechaFinal = date("$fechaFinal H:i:s");

		$stmt = Conexion::conectar()->prepare("select distinct pm.*, c.nombre as cliente from primerModulo pm join primerModuloDesglose pmd on pmd.idPrimerModulo = pm.id join segundoModulo sm on sm.idPrimerModulo = pm.id join tercerModulo tm on sm.id = tm.idsegundoModulo join clientes c on c.id = pm.idCliente WHERE (tm.estado = 2 and sm.estado = 2)
        and pm.fechainicio between '".$fechaInicial."' and '".$fechaFinal."'");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

    static public function reporteTerminadosPdf($idPedido){
		$stmt = Conexion::conectar()->prepare("select distinct p.nombre as pieza, c.nombre as color, pt.talla, mp.idMaquina, m.nombre as maquina, sm.cantidadInicio, mp.cantidad as cantidadAsignada, sm.fechainicio, p.porMin, sm.estadoPausa, sm.fechaPausa, pmd.cantidad as cantidadSolicitada from primerModulo pm join primerModuloDesglose pmd on pmd.idPrimerModulo = pm.id join segundoModulo sm on sm.idPrimerModulo = pm.id join tercerModulo tm on sm.id = tm.idsegundoModulo  join pieza p on sm.idPieza = p.id join colorPieza cp on sm.idColor = cp.id join color c on c.id = cp.idColor
        join piezaTalla pt on pt.id = sm.idTalla join maquinasProceso mp on mp.id = sm.idMaquinaProceso join maquina m on m.id = mp.idMaquina 
        where sm.idPedido = ".$idPedido." and (sm.estado = 2 and tm.estado = 2)");
        

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
}