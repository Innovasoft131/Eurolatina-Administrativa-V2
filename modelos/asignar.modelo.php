<?php

require_once "conexion.php";

class ModeloAsignar{
    /*=============================================
	    MOSTRAR PRIMER MODULO
	=============================================*/

	static public function MdlMostraPrimerModulo($tabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT pm.*, c.nombre as nombreCliente FROM $tabla pm JOIN clientes c on pm.idCliente = c.id  ");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlobtenerPiezasPedido($valor){
		$stmt = Conexion::conectar()->prepare("select distinct p.* from primerModuloDesglose pmd join primerModulo pm on pmd.idPrimerModulo = pm.id join pieza p on pmd.idPieza = p.id
		where pm.idPedido=".$valor["idPedido"]." and pmd.idPrimerModulo =".$valor["idPrimerModulo"]);
		
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlobtenerPimerModuloDesglose($valor){
		$stmt = Conexion::conectar()->prepare("select pmd.*, pt.talla, c.nombre as color from primerModuloDesglose pmd join primerModulo pm on pm.id = pmd.idPrimerModulo
		join pieza p on p.id = pmd.idPieza join piezaTalla pt on pmd.idTalla = pt.id join colorPieza cp on cp.id = pmd.idColor
		join color c on cp.idColor = c.id 
		where pm.idPedido =".$valor["idPedido"]." and pmd.idPieza =".$valor["idPieza"]);
		
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}


	static public function mdlobtenermostrarMaquinas($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlVerificarMaquina($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("SELECT sum(cantidad) as cantidad FROM $tabla WHERE idPrimerModulo = :idPrimerModulo AND idPrimerModuloD = :idPrimerModuloDesglose");
		$stmt -> bindParam(":idPrimerModulo", $datos["idPrimerModulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":idPrimerModuloDesglose", $datos["idPrimerModuloDesglose"], PDO::PARAM_STR);
		
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlinsert($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, cantidad, idMaquina, idLinea, idPrimerModulo, idPrimerModuloD, estado) VALUES (NULL, :cantidad, :idMaquina, :idLinea, :idPrimerModulo, :idPrimerModuloD, 0)");

		
		$stmt->bindParam(":cantidad", $datos["cantidadAsignada"], PDO::PARAM_STR);
		$stmt->bindParam(":idMaquina", $datos["idMaquina"], PDO::PARAM_STR);
		$stmt->bindParam(":idLinea", $datos["idLinea"], PDO::PARAM_STR);
		$stmt->bindParam(":idPrimerModulo", $datos["idPrimerModulo"], PDO::PARAM_STR);
		$stmt->bindParam(":idPrimerModuloD", $datos["idPrimerModuloDesglose"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;
	}

	static public function mdlMostrarMaquinaAsignada($datos){

		$stmt = Conexion::conectar()->prepare("select c.nombre as color, pt.talla, mp.cantidad, ma.nombre as maquina, mp.id as idMaquinasProceso, pm.idPedido as pedido, p.nombre as pieza from maquinasProceso mp join primerModulo pm on pm.id = mp.idPrimerModulo join primerModuloDesglose pmd on pmd.id = mp.idPrimerModuloD
					join colorPieza cp on pmd.idColor = cp.id join color c on c.id = cp.idColor join piezaTalla pt on pt.id=pmd.idTalla join pieza p on p.id = pmd.idPieza 
					join maquina ma on ma.id = mp.idMaquina
					where mp.idPrimerModulo =:idPrimerModulo");
		$stmt -> bindParam(":idPrimerModulo", $datos["idPrimerModulo"], PDO::PARAM_STR);

			
			
		$stmt -> execute();
	
		return $stmt -> fetchAll();
	
		$stmt -> close();
	
		$stmt = null;
	
		
	}

	static public function mdlmostrarMaquinasLineas($idLinea){

		$stmt = Conexion::conectar()->prepare("SELECT l.id AS idLinea, l.nombre AS linea, m.id AS idMaquina, m.nombre AS maquina FROM lineas l JOIN maquina m ON l.id = m.idLinea WHERE l.id =:id");
		$stmt -> bindParam(":id", $idLinea , PDO::PARAM_STR);

			
			
		$stmt -> execute();
	
		return $stmt -> fetchAll();
	
		$stmt -> close();
	
		$stmt = null;
	
		
	}

	static public function mdleliminarMaquinasProceso($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos["idmaquinasproceso"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}


	static public function mdlCantidadPrimerModulo($datos){

		$stmt = Conexion::conectar()->prepare("select sum(pmd.cantidad) as cantidad from primerModuloDesglose pmd where pmd.idPrimerModulo = :idPrimerModulo");
		$stmt -> bindParam(":idPrimerModulo", $datos["idPrimerModulo"], PDO::PARAM_STR);

			
			
		$stmt -> execute();
	
		return $stmt -> fetchAll();
	
		$stmt -> close();
	
		$stmt = null;
	
		
	}

	static public function mdlCantidadMaquinasProceso($datos){

		$stmt = Conexion::conectar()->prepare("select sum(cantidad) as cantidad from maquinasproceso where idPrimerModulo = :idPrimerModulo");
		$stmt -> bindParam(":idPrimerModulo", $datos["idPrimerModulo"], PDO::PARAM_STR);

			
			
		$stmt -> execute();
	
		return $stmt -> fetchAll();
	
		$stmt -> close();
	
		$stmt = null;
	
		
	}


	static public function mdleditarPrimerModulo($datos){

		$stmt = Conexion::conectar()->prepare("update primerModulo set estado = 1 where id = :idPrimerModulo");
		$stmt -> bindParam(":idPrimerModulo", $datos["idPrimerModulo"], PDO::PARAM_STR);

			
			
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}
	

	
		$stmt -> close();
	
		$stmt = null;
	
		
	}

	static public function mdleditarPrimerModuloACero($datos){

		$stmt = Conexion::conectar()->prepare("update primerModulo set estado = 0 where id = :idPrimerModulo");
		$stmt -> bindParam(":idPrimerModulo", $datos["idPrimerModulo"], PDO::PARAM_STR);

			
			
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}
	

	
		$stmt -> close();
	
		$stmt = null;
	
		
	}	

}