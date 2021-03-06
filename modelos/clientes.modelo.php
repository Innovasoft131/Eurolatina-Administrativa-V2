<?php

require_once "conexion.php";

class Modeloclientes{

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarclientes($tabla, $item, $valor){
	
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
	MOSTRAR CLIENTES AUTOCOMPLETAR
	=============================================*/

	static public function MdlMostrarCliente($tabla, $item, $valor){
		

			$res = array();
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item LIKE '$valor%'");

		//	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			if($stmt->rowCount()){
				while ($r = $stmt -> fetch()) {
					array_push($res, $r["nombre"]);
					array_push($res, $r["id"]);
					
				}
			}

			return $res;


		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE CLIENTE
	=============================================*/

	static public function mdlIngresarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO clientes(nombre, usuario, password, foto, correo, telefono, direccion, empresa, web, tipo) VALUES (:nombre, :usuario, :password, :foto, :correo, :telefono, :direccion, :empresa, :web, :tipo)");		
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR);
		$stmt->bindParam(":web", $datos["web"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}


	/*=============================================
	REGISTRO DE CLIENTE DESDE AJAX
	=============================================*/

	static public function mdlIngresarClienteAjax($tabla, $datos){
		$cn = new Conexion();
		$cn = $cn->conectar();

		$stmt = $cn->prepare("INSERT INTO clientes(nombre, usuario, password, foto, correo, telefono, direccion, empresa, web, tipo) VALUES (:nombre, :usuario, :password, :foto, :correo, :telefono, :direccion, :empresa, :web, :tipo)");		
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR);
		$stmt->bindParam(":web", $datos["web"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return $cn->lastInsertId();	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos){
	//	var_dump($datos);
	//	var_dump($tabla);

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre,usuario=:usuario,password=:password,foto=:foto,correo=:correo,telefono=:telefono,direccion=:direccion WHERE id= :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR CLIENTE
	=============================================*/

	static public function mdlBorrarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
	//	var_dump($stmt);
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;


	}
}