<?php

require_once "conexion.php";

class ModeloPedido{
	static public function mdlMostrarPedido(){

		$stmt = Conexion::conectar()->prepare("SELECT ph.*, c.nombre as cliente, c.correo FROM pedidosHechos ph JOIN clientes c WHERE ph.idCliente = c.id order by ph.id desc");
			
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarPedidoDesglosado($id){

		$stmt = Conexion::conectar()->prepare("select p.*, c.nombre as color, pt.talla, ph.idCliente from pedidos p join pedidosHechos ph on ph.id = p.idpedidosHechos join pieza pz on p.idPieza = pz.id  join colorPieza co on co.id = p.idColor join color c on c.id = co.idColor join piezaTalla pt on pt.id = p.idTalla where ph.id = $id");
			
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarCliente($id){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE id =  $id");
			
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlMostrar($tabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarPiezas(){
	
		$stmt = Conexion::conectar()->prepare("SELECT p.* FROM pieza p");
			
		$stmt -> execute();

		return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarModelo($valor){
	
		$stmt = Conexion::conectar()->prepare("select m.id AS idModelo, m.nombre AS modelo FROM modelo m JOIN pieza p ON m.id = p.idModelo WHERE p.id = $valor");
			
		$stmt -> execute();

		return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarColores($valor){
	
		$stmt = Conexion::conectar()->prepare("SELECT cp.id AS idColorPieza, c.nombre AS color, c.id AS idColor, c.hexadecimal FROM colorPieza cp JOIN color c ON cp.idColor = c.id WHERE cp.idPieza = $valor");
			
		$stmt -> execute();

		return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarTallas($valor){
	
		$stmt = Conexion::conectar()->prepare("SELECT pt.id as idPiezaTalla, pt.talla FROM piezaTalla pt JOIN pieza p ON pt.idPieza = p.id WHERE pt.idPieza = $valor");
			
		$stmt -> execute();

		return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlInsertar($idCliente){
		$cn = new Conexion();
		$cn = $cn->conectar();

		$stmt = $cn->prepare("INSERT INTO pedidosHechos(id, idcliente, total, fecha, estado)VALUES(NULL, :idcliente, 0, NOW(), 0)");
		
		$stmt->bindParam(":idcliente", $idCliente, PDO::PARAM_STR);


		if($stmt->execute()){

			return $cn->lastInsertId();

		}else{
			return "error";	
		}
			


			


		
		$stmt = null;
	
		

	}
	static public function mdlInsertaPedidos($datos, $idpedidosHechos){
		$res = "";
		for ($i=0; $i < count($datos) ; $i++) { 
			$stmt = Conexion::conectar()->prepare("INSERT INTO pedidos(id, idPieza, idColor, idpedidosHechos, nombrePieza, cantidad, idTalla, precio)VALUES(NULL, :idPieza, :idColor, :idpedidosHechos, :nombrePieza, :cantidad, :idTalla, 0)");
		
			$stmt->bindParam(":idPieza", $datos[$i]["idPieza"], PDO::PARAM_STR);
			$stmt->bindParam(":idColor", $datos[$i]["idColor"], PDO::PARAM_STR);
			$stmt->bindParam(":idpedidosHechos", $idpedidosHechos, PDO::PARAM_STR);
			$stmt->bindParam(":nombrePieza", $datos[$i]["pieza"], PDO::PARAM_STR);
			$stmt->bindParam(":cantidad", $datos[$i]["cantidad"], PDO::PARAM_STR);
			$stmt->bindParam(":idTalla", $datos[$i]["idTalla"], PDO::PARAM_STR);

			if($stmt->execute()){
				$res = "ok";
			}else{
				$res = "error";
			}
		}
		


		if($res == "ok"){
			return "ok";

		}else{
			return "error";	
		}
			


			


		
		$stmt = null;
	}

	static public function mdlInsertarPrimerModulo($idCliente, $idPedido){
		$cn = new Conexion();
		$cn = $cn->conectar();

		$stmt = $cn->prepare("INSERT INTO primerModulo(id, idCliente, idPedido, totalPedido, fechainicio, fechaFin, descripcion, estado)VALUES(NULL, :idCliente, :idPedido, 0, NOW(), NOW(), null, 0)");
		
		$stmt->bindParam(":idCliente", $idCliente, PDO::PARAM_STR);
		$stmt->bindParam(":idPedido", $idPedido, PDO::PARAM_STR);


		if($stmt->execute()){

			return $cn->lastInsertId();

		}else{
			return "error";	
		}
			


			


		
		$stmt = null;
	
		

	}


	static public function mdlInsertarPrimerModuloDesglose($datos, $idPrimerModulo){

		$res = "";
		for ($i=0; $i < count($datos) ; $i++) { 
			
			
			$stmt = Conexion::conectar()->prepare("INSERT INTO primerModuloDesglose(id, idPrimerModulo, idUsuario, idPieza, idColor, idTalla, precio, cantidad, colorPrimario, colorSecundario, colorTerciario)VALUES(NULL, :idPrimerModulo, NULL, :idPieza, :idColor, :idTalla, '0.0', :cantidad, null, null, null)");
		
			$stmt->bindParam(":idPrimerModulo", $idPrimerModulo, PDO::PARAM_STR);
			$stmt->bindParam(":idPieza", $datos[$i]["idPieza"], PDO::PARAM_STR);
			$stmt->bindParam(":idColor", $datos[$i]["idColor"], PDO::PARAM_STR);
			$stmt->bindParam(":idTalla", $datos[$i]["idTalla"], PDO::PARAM_STR);
			$stmt->bindParam(":cantidad", $datos[$i]["cantidad"], PDO::PARAM_STR);

			
			
			
			if($stmt->execute()){
				$res = "ok";
			}else{
				$res = "error";
			}

			
		}
		


		if($res == "ok"){
			return "ok";

		}else{
			return "error";	
		}
			


			


		
		$stmt = null;
	}


	/*=============================================
	SUMA DE PEDIDOS 
	=============================================*/

	static public function mdlSumaPedidos($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as totalPedidos FROM $tabla WHERE estado = 2");
		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlPedidosTerminados($hoy){

		$fechaInicial = date("Y-m-d 00:00:00");
		$fechaFinal = date("Y-m-d H:i:s");
	//	$stmt = Conexion::conectar()->prepare("select distinct pm.*, c.nombre as cliente, tm.fechaFin from primerModulo pm join primerModuloDesglose pmd on pmd.idPrimerModulo = pm.id join clientes c on c.id = pm.idCliente join segundoModulo sm on sm.idPrimerModulo = pm.id join tercerModulo tm on tm.idSegundoModulo = sm.id where (pm.estado = 1 and sm.estado = 2 and tm.estado = 1) and tm.fechaFin like '$hoy%' order by tm.fechaFin asc");

	//	$stmt = Conexion::conectar()->prepare("select distinct pm.*, c.nombre as cliente, tm.fechaFin from primerModulo pm join primerModuloDesglose pmd on pmd.idPrimerModulo = pm.id join clientes c on c.id = pm.idCliente join segundoModulo sm on sm.idPrimerModulo = pm.id join tercerModulo tm on tm.idSegundoModulo = sm.id where (pm.estado = 1 and sm.estado = 2 and tm.estado = 2) and tm.fechaFin between '".$fechaInicial."' and '".$fechaFinal."' order by tm.fechaFin asc");
		
		$stmt = Conexion::conectar()->prepare("select distinct pm.*, c.nombre as cliente, tm.fechaFin from primerModulo pm join primerModuloDesglose pmd on pmd.idPrimerModulo = pm.id join clientes c on c.id = pm.idCliente join segundoModulo sm on sm.idPrimerModuloD = pmd.id join tercerModulo tm on tm.idPrimerModuloD = pmd.id where (pm.estado = 1 and sm.estado = 2 and tm.estado = 2) and tm.fechaFin between '".$fechaInicial."' and '".$fechaFinal."' order by tm.fechaFin asc");
		
		
	
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

}
?>