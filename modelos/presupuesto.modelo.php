<?php

require_once "conexion.php";

class ModeloPresupuesto{
    /*=============================================
	REGISTRO DE UNIDADES
	=============================================*/

	static public function mdlInsertPresupuesto($tabla, $datos){
        $cn =  Conexion::conectar();

        try {
            $cn->beginTransaction();
            $stmt = $cn->prepare("INSERT INTO $tabla(id, idOportunidad, idUsuario, fecha, idCliente, empresa, importePresupuesto, idEstado)VALUES
				(NULL,  :idOportunidad, :idUsuario,  NOW(), :idCliente, :empresa, :importe, :idEstado )");
            $stmt -> bindParam(":idOportunidad", $datos["idOportunidad"], PDO::PARAM_STR);

			$stmt -> bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
			$stmt -> bindParam(":idCliente", $datos["idCliente"], PDO::PARAM_STR);
			$stmt -> bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR);
			$stmt -> bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
			$stmt -> bindParam(":idEstado", $datos["idEstado"], PDO::PARAM_STR);
            
			$stmt->execute();
			$idPresupuesto = $cn->lastInsertId();

                $stmtOportunidad =  $cn->prepare("UPDATE oportunidad SET estado = 'Proceso' WHERE id = :id");
                $stmtOportunidad -> bindParam(":id", $datos["idOportunidad"], PDO::PARAM_STR);
                $stmtOportunidad->execute();
        



            if($cn->commit()){
				return "ok";
			}

        } catch (\Exception $ex) {
            $cn->rollBack();
        }

	}

    /*=============================================
	Mostrar Presupuetos Pendientes
	=============================================*/

	static public function mdlMostrarPresupuestos($tabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado='Pendiente'");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Mostrar Presupuetos en proceso
	=============================================*/

	static public function mdlMostrarPresupuestosProceso($tabla, $item, $valor){
	
		$stmt = Conexion::conectar()->prepare("SELECT distinct o.*, c.nombre as cliente, c.id as idCliente, c.empresa, p.etapa, p.exito, ta.accion, pz.nombre as modelo,  pre.importePresupuesto, es.estado FROM oportunidad o JOIN clientes c on o.idCliente = c.id JOIN porcentajeExito p ON p.id = o.idPorcentaje  
		JOIN tipoAccion ta on ta.id = o.idAccion JOIN pieza pz on pz.id = o.idPieza JOIN $tabla pre on pre.idOportunidad = o.id JOIN estado es ON es.id = pre.idEstado WHERE o.$item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}


	static public function mdlMostrarPresupuesto($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT o.*, c.nombre as cliente, c.id as idCliente, c.empresa, p.etapa, p.exito, ta.accion, pz.nombre as modelo FROM $tabla o JOIN clientes c on o.idCliente = c.id JOIN porcentajeExito p ON p.id = o.idPorcentaje  
		JOIN tipoAccion ta on ta.id = o.idAccion JOIN pieza pz on pz.id = o.idPieza WHERE o.$item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarPresupuestoProceso($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT o.*, c.nombre as cliente, c.id as idCliente, c.empresa, p.etapa, p.exito, ta.accion, pz.nombre as modelo, pre.importePresupuesto, es.estado FROM $tabla o JOIN clientes c on o.idCliente = c.id JOIN porcentajeExito p ON p.id = o.idPorcentaje  
		JOIN tipoAccion ta on ta.id = o.idAccion JOIN pieza pz on pz.id = o.idPieza JOIN presupuesto pre ON pre.idOportunidad = o.id JOIN estado es ON es.id = pre.idEstado WHERE o.$item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;

	}


	static public function mdlMostrarPresupuestoJoin($tabla, $item, $valor, $item2 , $valor2){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();


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

	/*=============================================
	BORRAR PRESUPUESTO
	=============================================*/

	static public function mdlBorrarPresupuesto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 'Terminado' WHERE id = :id");

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