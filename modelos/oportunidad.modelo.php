<?php

require_once "conexion.php";

class ModeloOportunidad{
    /*=============================================
	REGISTRO DE OPORTUNIDAD
	=============================================*/

	static public function mdlInsertOportunidad($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, codigo, idUsuario, idCliente, empresa, servicio, idPieza, cantidad, importe, idPorcentaje, idAccion, descripcion) VALUES (null, :codigo, :idUsuario, :idCliente, :empresa, :servicio, :idPieza, :cantidad, :importe, :idPorcentaje, :idAccion, :descripcion)");
	
		
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":idCliente", $datos["idCliente"], PDO::PARAM_STR);
        $stmt->bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR);
        $stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
        $stmt->bindParam(":idPieza", $datos["idPieza"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
        $stmt->bindParam(":idPorcentaje", $datos["idPorcentaje"], PDO::PARAM_STR);
        $stmt->bindParam(":idAccion", $datos["idAccion"], PDO::PARAM_STR);
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
	MOSTRAR OPORTUNIDADES
	=============================================*/

	static public function mdlMostrarOportunidad($tabla, $item, $valor){
	
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

}