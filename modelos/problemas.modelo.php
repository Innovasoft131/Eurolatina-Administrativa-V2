<?php
require_once "conexion.php";

class ModeloProblemas{
    /*=============================================
	REGISTRO DE PROBLEMAS
	=============================================*/

	static public function mdlInsertProblemas($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, nombre) VALUES (null, :nombre)");
	
		
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

    /*=============================================
	MOSTRAR PROBLEMAS
	=============================================*/

	static public function mdlMostrarProblemas($tabla, $item, $valor){
	
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

    /*=============================================
	EDITAR DE PROBLEMAS
	=============================================*/

	static public function mdlUpdateProblemas($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id = :id");
	//	var_dump($datos);
		
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

    /*=============================================
	BORRAR PROBLEMA
	=============================================*/

	static public function mdlBorrarProblema($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

	static public function mdlreporteProblemas(){
		$fechaInicial =  date("Y-m-d 00:00:00");
		$fechaFinal = date("Y-m-d H:i:s");
		$stmt = Conexion::conectar()->prepare("select pp.* from problemasProceso pp join problemasDesglose pd on pp.id=pd.idProblemaProce where pd.fecha between '".$fechaInicial."' and '".$fechaFinal."' order by id asc");
		
	//	var_dump($stmt);
		

	//	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();
		$stmt->close();
		
		$stmt = null;

	}

	static public function mdlreporteProblemaspdf($id){

		$stmt = Conexion::conectar()->prepare("select pd.*, p.nombre, u.nombre as empleado, u.turno, u.perfil, l.nombre as linea, m.nombre as maquina from problemasDesglose pd join problemas p on p.id = pd.idProblema  join problemasProceso pp on pp.id = pd.idProblemaProce 
		join usuarios u on pp.idUsuario = u.id join lineas l on l.id = pd.idLinea join maquina m on m.id=pd.idMaquina
		where pp.id = '".$id."'");

	//	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();
		$stmt->close();
		
		$stmt = null;

	}

	static public function mdlreporteProblemaspdfs($id){

		$stmt = Conexion::conectar()->prepare("select pd.*, u.nombre as empleado, u.turno, u.perfil, l.nombre as linea, m.nombre as maquina from problemasDesglose pd   join problemasProceso pp on pp.id = pd.idProblemaProce 
		join usuarios u on pp.idUsuario = u.id join lineas l on l.id = pd.idLinea join maquina m on m.id=pd.idMaquina
		where pp.id = '".$id."'");

	//	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();
		$stmt->close();
		
		$stmt = null;

	}

}