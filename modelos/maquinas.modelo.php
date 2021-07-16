<?php

require_once "conexion.php";

class ModeloMaquinas{

    /*=============================================
	REGISTRO DE MAQUINAS
	=============================================*/

	static public function mdlIngresarMaquina($tabla, $datos, $idUsuario){
		$res = "";
		for ($i=0; $i < count($datos) ; $i++) { 

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, idLinea, nombre, idUsuario) VALUES (NULL, :idLinea, :nombre, :idUsuario)");

		
			$stmt->bindParam(":nombre", $datos[$i]["maquina"], PDO::PARAM_STR);
			$stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
			$stmt->bindParam(":idLinea", $datos[$i]["idLinea"], PDO::PARAM_STR);
	
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

		$stmt->close();
		
		$stmt = null;

	}

    	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){
		
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

	static public function mdlobtenerId($tabla, $datos){

			$stmt = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE nombre = '$datos'");
			

			$stmt -> execute();

			return $stmt -> fetchAll();

	

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function MdlMostrarMaquinas($tabla, $segundaTabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT m.nombre as nombreMaquina, u.nombre, u.id, m.id as idMaquina, m.idLinea FROM $tabla m INNER JOIN $segundaTabla u ON m.idusuario=u.id");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarMaquinasPrimero(){
	
		$stmt = Conexion::conectar()->prepare("select distinct l.*, l.id as idLinea from lineas l join maquina m on m.idLinea = l.id");
			
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarMaquinasSegundo($id){
	
		$stmt = Conexion::conectar()->prepare("select distinct m.*, u.nombre as Empleado from maquina m join lineas l on m.idLinea = l.id join usuarios u on m.idUsuario = u.id where m.idLinea = $id");
			
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarMaquina($tabla, $datos){

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

	/*=============================================
	OBTENER MAQUINA SELECCIONADA
	=============================================*/

	static public function MdlMostrarMaquina($tabla, $item, $valor){
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT m.id AS idMaquina, u.nombre, m.nombre AS nombreMaquina FROM $tabla m INNER JOIN usuarios u ON u.id=m.idUsuario WHERE m.id = :$item");

		//	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

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
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarMaquina($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idLinea = :idLinea, nombre = :nombre, idUsuario = :idUsuario WHERE id = :id");

		$stmt -> bindParam(":idLinea", $datos["idLinea"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombreMaquina"], PDO::PARAM_STR);
		$stmt -> bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlMostrarMaquinaLinea($datos){
	
		$stmt = Conexion::conectar()->prepare("select m.id as idMaquina, m.idLinea, m.nombre as maquina, l.nombre as linea, u.nombre as empleado, u.turno, m.idUsuario from maquina m join lineas l on m.idLinea = l.id join usuarios u on m.idUsuario = u.id where m.idLinea = :idMaquina");

		$stmt -> bindParam(":idMaquina", $datos, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlMostrarMaquinaLineas($datos){
	
		$stmt = Conexion::conectar()->prepare("select * from maquina where nombre = :nombre");

		$stmt -> bindParam(":nombre", $datos, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

}
?>