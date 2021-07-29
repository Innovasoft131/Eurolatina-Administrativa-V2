<?php

require_once "conexion.php";

class ModeloPresupuesto{
    /*=============================================
	REGISTRO DE UNIDADES
	=============================================*/

	static public function mdlInsertUnidades($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, unidad) VALUES (null, :unidad)");
	
		
		$stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

    /*=============================================
	Mostrar Presupuetos Pendientes
	=============================================*/

	static public function mdlMostrarPresupuestos($tabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado='Pendiente'");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	   /*=============================================
	Mostrar Estados
	=============================================*/

	static public function mdlMostrarEstados($tabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT etapa FROM $tabla WHERE $item = :$item");

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

	static public function mdlBorrarUnidad($tabla, $datos){

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
	Mostrar Presupuetos Pendientes
	=============================================*/

	static public function mdlMostrarAcciones($tabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :idaccion");

			$stmt -> bindParam(":idaccion", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado='Pendiente'");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}
}