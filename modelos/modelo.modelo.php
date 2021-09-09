<?php

require_once "conexion.php";

class Modelomodelo{

    /*=============================================
	REGISTRO DE MAQUINAS
	=============================================*/

	static public function mdlIngresarModelo($tabla, $datos){
	//	var_dump($tabla." ".$datos);

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, descripcion) VALUES (:nombre, :descripcion)");

		
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

    /*=============================================
	MOSTRAR Modelos
	=============================================*/

	static public function mdlMostrarModelos($tabla, $item, $valor){
		
		if($item != null){
			$res = array();
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item LIKE '$valor%'");

			$stmt -> execute();

			if($stmt->rowCount()){
				while ($r = $stmt -> fetch()) {
					array_push($res, $r["nombre"]);
					array_push($res, $r["descripcion"]);
					
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


	static public function mdlMostrarModelo($tabla, $item, $valor){
		
		if($item != null){
			$res = array();
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item LIKE '$valor%'");

			$stmt -> execute();

			if($stmt->rowCount()){
				while ($r = $stmt -> fetch()) {
					array_push($res, $r["nombre"]);
					array_push($res, $r["id"]);
					
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
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarModelo($tabla, $datos){

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
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarModelo($tabla, $datos){
	//	var_dump($tabla." ".$datos);
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, descripcion = :descripcion WHERE id = :id");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

	//	var_dump($stmt->execute());
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}
?>