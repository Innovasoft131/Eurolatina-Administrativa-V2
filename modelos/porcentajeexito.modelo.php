<?php

require_once "conexion.php";

class ModeloPorcentajeExito{
    /*=============================================
	REGISTRO DE UNIDADES
	=============================================*/

	static public function mdlInsertPorcentaje($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, etapa, exito) VALUES (null, :etapa,:exito)");
	
		
		$stmt->bindParam(":etapa", $datos["etapa"], PDO::PARAM_STR);
		$stmt->bindParam(":exito", $datos["exito"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

    /*=============================================
	MOSTRAR PROCENTAJES EXITO
	=============================================*/

	static public function mdlMostrarPorcentajesExito($tabla, $item, $valor){
	
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

	static public function mdlUpdatePorcentaje($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET etapa = :etapa, exito= :exito WHERE id = :id");

		
		$stmt->bindParam(":etapa", $datos["etapa"], PDO::PARAM_STR);
		$stmt->bindParam(":exito", $datos["exito"], PDO::PARAM_STR);
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
	BORRAR PORCENTAJE EXITO
	=============================================*/

	static public function mdlBorrarPorcentaje($tabla, $datos){

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