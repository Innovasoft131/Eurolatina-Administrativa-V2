<?php
require_once "conexion.php";

class ModeloReporteMaquinas{


    static public function reporteMaquinas($fechaInicial, $fechaFinal){


		$fechaInicial = date("$fechaInicial 00:00:00");
		$fechaFinal = date("$fechaFinal H:i:s");
		$stmt = Conexion::conectar()->prepare("select distinct pm.*, c.nombre as cliente from primerModulo pm join segundoModulo sm on sm.idPrimerModulo = pm.id join clientes c on c.id = pm.idCliente WHERE sm.estado = 1
        and pm.fechainicio between '".$fechaInicial."' and '".$fechaFinal."'");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

    static public function reporteMaquinasPdf($idPedido){
		$stmt = Conexion::conectar()->prepare("select distinct p.nombre as pieza, c.nombre as color, pt.talla, mp.idMaquina, m.nombre as maquina, sm.cantidadInicio, mp.cantidad as cantidadAsignada, sm.fechainicio, p.porMin, sm.estadoPausa, sm.fechaPausa from segundoModulo sm join pieza p on sm.idPieza = p.id join colorPieza cp on sm.idColor = cp.id join color c on c.id = cp.idColor
        join piezaTalla pt on pt.id = sm.idTalla join maquinasProceso mp on mp.id = sm.idMaquinaProceso join maquina m on m.id = mp.idMaquina 
        where sm.idPedido = ".$idPedido."");
        


		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function reporteMinutosTranscuridos($fechaInicial, $horaConsulta){


		$stmt = Conexion::conectar()->prepare("select timestampdiff(MINUTE, '".$fechaInicial."', '".$horaConsulta."') as tiempoTrascurrido");
		

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
}