<?php

require_once "conexion.php";

class ModeloPiezas{

    static public function MdlObtenerModelo($tabla, $item, $valor){
        if($item != null){
			$res = array();
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item LIKE '$valor%'");

		//	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			if($stmt->rowCount()){
				while ($r = $stmt -> fetch()) {
					array_push($res, $r["nombre"]);
					
				}
			}

			return $res;

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

    }

	static public function MdlObtenerModeloColor($tabla, $item, $valor){
        if($item != null){
			$res = array();
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item LIKE '$valor%' AND nombre not like 'Com%'");

		//	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			if($stmt->rowCount()){
				while ($r = $stmt -> fetch()) {
					array_push($res, $r["nombre"]);
					
				}
			}

			return $res;

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

    }

	static public function ontener($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function ontenerJoin($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT p.* FROM $tabla p   WHERE p.id= :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function obtenerColores($tabla, $tabla2, $tabla3, $valor, $item){

		$stmt = Conexion::conectar()->prepare("SELECT c.id, cp.id as idColorPieza, c.nombre FROM $tabla cp JOIN $tabla2 c ON cp.idColor=c.id JOIN $tabla3 p ON cp.idPieza=p.$item WHERE p.id = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt->fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function obtenerTalla($tabla, $tabla2, $valor, $item){

		$stmt = Conexion::conectar()->prepare("SELECT pt.id as idTalla, pt.talla from $tabla pt JOIN $tabla2 p ON p.id = pt.idPieza WHERE pt.idPieza = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt->fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function obtenerModelos($tabla, $tabla2, $valor, $item){

		$stmt = Conexion::conectar()->prepare("SELECT m.id, pm.id as idpiezaModelo, m.nombre FROM modelo m JOIN $tabla pm ON m.id = pm.idModelo JOIN $tabla2 p ON pm.idPieza = p.id WHERE pm.idPieza = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt->fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function ontenerid($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE nombre = '$valor'");

	//	var_dump("SELECT id FROM $tabla WHERE nombre = '$valor'");
	//	$stmt -> bindParam(":nombre", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function ontenerids($tabla, $valor, $atributo){

		$stmt = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE $atributo = '$valor'");

	//	var_dump("SELECT id FROM $tabla WHERE nombre = '$valor'");
	//	$stmt -> bindParam(":nombre", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function ontenerIdAnd($tabla, $valor, $atributo, $atributo2, $valor2){

		$stmt = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE $atributo = '$valor' and $atributo2 = '$valor2' ");


	//	var_dump("SELECT id FROM $tabla WHERE nombre = '$valor'");
	//	$stmt -> bindParam(":nombre", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}
/*
	static public function mdlInsert($tabla, $datos){

		$cn = new Conexion();

		$cn = $cn->conectar();
		$stmt = $cn->prepare("INSERT INTO $tabla(id, idModelo, nombre, foto, porMin, descripcion)VALUES
				(NULL, :idModelo, :nombre,  :foto, :porMin, :descripcion)");
		
		$stmt -> bindParam(":idModelo", $datos["idModelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":porMin", $datos["porMinuto"], PDO::PARAM_STR);
		
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		$stmt -> execute();

		$id = $cn->lastInsertId();


		return $id;


	}
	*/

	static public function mdlInsert($tabla, $datos){
		$cn =  Conexion::conectar();
		$colores = $datos["colores"];
		$tallas = $datos["tallas"];

		$idColores = array();;

		for ($i=0; $i < count($colores); $i++) { 
			$idColor = ModeloPiezas::ontenerid("color", $colores[$i]);
			array_push($idColores, $idColor[0]["id"]);

		}

	
		try {
			
			$cn->beginTransaction();
			$stmt = $cn->prepare("INSERT INTO $tabla(id, nombre, foto, porMin, descripcion)VALUES
				(NULL,  :nombre,  :foto, :porMin, :descripcion)");

			$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":porMin", $datos["porMinuto"], PDO::PARAM_STR);		
			$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

			$stmt->execute();
			$idPieza = $cn->lastInsertId();
	
			$stmtColor =  $cn->prepare("INSERT INTO colorPieza(id, idPieza, idColor)VALUES
			(NULL,  :idPieza,  :idColor)");

			$stmtColor -> bindParam(":idPieza", $idPieza, PDO::PARAM_STR);	
			for ($y=0; $y < count($idColores) ; $y++) { 
				$stmtColor -> bindParam(":idColor", $idColores[$y] , PDO::PARAM_STR);
				$stmtColor->execute();
			}

			$stmtTalla =  $cn->prepare("INSERT INTO piezaTalla(id, idPieza, talla)VALUES
			(NULL,  :idPieza,  :talla)");
			$stmtTalla -> bindParam(":idPieza", $idPieza, PDO::PARAM_STR);	
			for ($x=0; $x < count($tallas) ; $x++) { 
				$stmtTalla -> bindParam(":talla", $tallas[$x], PDO::PARAM_STR);	
				$stmtTalla->execute();
			}

			if($cn->commit()){
				return "ok";
			}
			

			
			
			
		} catch (Exception  $ex) {
			$cn->rollBack();

		}
		
	}

	static public function mdlupdatePieza($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idModelo = :idModelo, nombre = :nombre, porMin = :porMin,  foto = :foto, descripcion = :descripcion WHERE id = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt -> bindParam(":idModelo", $datos["idModelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);		
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":porMin", $datos["porMin"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function insertColor($tablac, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tablac(id, idPieza, idColor)VALUES
												(NULL, :idPieza, :idColor)");

		$stmt -> bindParam(":idPieza", $datos["idPieza"], PDO::PARAM_STR);
		$stmt -> bindParam(":idColor", $datos["idColor"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else {
			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	static public function insertTalla($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, idPieza, talla)VALUES(NULL, :idPieza, :talla)");
	
	
		$stmt -> bindParam(":idPieza", $datos["idPieza"],PDO::PARAM_STR);
		$stmt -> bindParam(":talla", $datos["talla"],PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	static public function insertModelo($tabla , $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, idPieza, idModelo)VALUES(NULL, :idPieza, :idModelo)");

		$stmt -> bindParam(":idPieza", $datos["idPieza"], PDO::PARAM_STR);
		$stmt -> bindParam(":idModelo", $datos["idModelo"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR PIEZA
	=============================================*/

	static public function mdlBorrarPieza($tabla, $datos, $id){
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

	static public function reportePiezas($fechaInicial, $fechaFinal){
		/*
		$stmt = Conexion::conectar()->prepare("select mp.cantidad as cantidad_pieza, pm.idPedido, mp.id as maquinaProceso, p.nombre as nombre_pieza,  pt.talla, c.nombre as color, pm.fechainicio as fecha from maquinasProceso mp join primerModulo pm on pm.id=mp.idPrimerModulo join primerModuloDesglose pmd on pmd.id=mp.idPrimerModuloD
		join pieza p on p.id=pmd.idPieza join segundoModulo sm on sm.idPrimerModuloD = pmd.id join tercerModulo tr on tr.idPrimerModuloD=pmd.id  join piezaTalla pt on pt.idPieza = p.id join colorPieza cp on cp.id = pmd.idColor
		join color c on c.id=cp.idColor
		where ((pm.estado=1  and sm.estado=2 and tr.estado=1) and (sm.idMaquinaProceso=mp.id and tr.idMaquinaProceso = mp.id) and (sm.idTalla=pt.id and tr.idTalla = pt.id and pmd.idTalla = pt.id)) and pm.fechainicio between '".$fechaInicial."' and '".$fechaFinal."'");
		*/
	//	date_default_timezone_set('America/Monterrey');

		$fechaInicial = date("$fechaInicial 00:00:00");
		$fechaFinal = date("$fechaFinal H:i:s");

		$stmt = Conexion::conectar()->prepare('SELECT distinct  d.*, u.nombre as empleado FROM defectuosas d JOIN cantidadDefectuosas cd on d.id = cd.idDefectuosas JOIN usuarios u on u.id=d.idUsuario WHERE cd.fecha between "'.$fechaInicial.'" and "'.$fechaFinal.'" ');
		
	//	var_dump($stmt);
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function reportePiezasDefectuosas($id){


		$stmt = Conexion::conectar()->prepare('select cd.* from cantidadDefectuosas cd join defectuosas d on d.id = cd.idDefectuosas where cd.idDefectuosas = '.$id.'');
		

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function reportePiezasDefectuosasUsuario($id){


		$stmt = Conexion::conectar()->prepare('select distinct d.*, u.nombre as empleados, u.turno, u.perfil from cantidadDefectuosas cd join defectuosas d on d.id = cd.idDefectuosas join usuarios u on u.id = d.idUsuario where cd.idDefectuosas = '.$id.'');
		

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}


	static public function reportePiezasGrafica($fechaInicial, $fechaFinal){


		$fechaInicial = date("$fechaInicial 00:00:00");
		$fechaFinal = date("$fechaFinal H:i:s");

		$stmt = Conexion::conectar()->prepare('SELECT distinct cd.*FROM defectuosas d JOIN cantidadDefectuosas cd on d.id = cd.idDefectuosas WHERE cd.fecha between "'.$fechaInicial.'" and "'.$fechaFinal.'" ');
		
	//	var_dump($stmt);
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function reportePiezasUsuario($fechaInicial, $fechaFinal, $idUsuario){
		$fechaInicial = date("$fechaInicial 00:00:00");
		$fechaFinal = date("$fechaFinal H:i:s");
		$stmt = Conexion::conectar()->prepare("select sm.idPedido, sm.cantidadFinal as cantidadDePiezas, p.nombre as pieza, pt.talla, c.nombre as color, mp.idMaquina, ma.nombre as maquina, u.nombre, u.turno, u.id as idUsuario from segundoModulo sm join usuarios u on u.id = sm.idUsuario
		join pieza p on p.id = sm.idPieza join maquinasProceso mp on mp.id = sm.idMaquinaProceso join maquina ma on ma.id = mp.idMaquina
		join piezaTalla pt on pt.id = sm.idTalla join colorPieza cp on sm.idColor = cp.id join color c on c.id = cp.idColor
		where u.id=$idUsuario and sm.estado= 1 and sm.fechainicio between '".$fechaInicial."' and '".$fechaFinal."'");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function reporteUsuario($fechaInicial, $fechaFinal){
		$fechaInicial = date("$fechaInicial 00:00:00");
		$fechaFinal = date("$fechaFinal H:i:s");
		$stmt = Conexion::conectar()->prepare("select distinct u.nombre, u.perfil, u.turno, u.ultimo_login, u.id as idUsuario from segundoModulo sm join usuarios u on u.id = sm.idUsuario
		where  sm.estado= 2 and sm.fechainicio between '".$fechaInicial."' and '".$fechaFinal."'");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

}

?>