<?php

require_once "conexion.php";

class ModeloTipoAccion{
    /*=============================================
	REGISTRO DE TIPO ACCION
	=============================================*/

	static public function mdlInsertTipoAccion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, accion) VALUES (null, :accion)");
	
		
		$stmt->bindParam(":accion", $datos["accion"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

    /*=============================================
	MOSTRAR UNIDADES
	=============================================*/

	static public function mdlMostrarTipoAccion($tabla, $item, $valor){
	
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
	EDITAR DE UNIDADES
	=============================================*/

	static public function mdlUpdateUnidad($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET unidad = :unidad WHERE id = :id");

		
		$stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);
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
	BORRAR UNIDAD
	=============================================*/

	static public function mdlBorrarAccion($tabla, $datos){

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
}