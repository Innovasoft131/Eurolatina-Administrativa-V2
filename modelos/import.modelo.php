
<?php

/* require_once "conexion.php";

class ModeloImport{
    static private function mdlTraerIdPieza($dato){
        $stmt = Conexion::conectar()->prepare("SELECT id FROM pieza WHERE nombre = :nombre");
        $stmt->bindParam(":nombre", $dato, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
    }

    static private function mdlTraerIdCliente($dato){
        $stmt = Conexion::conectar()->prepare("SELECT id FROM clientes WHERE nombre = $dato");
        $stmt->bindParam(":nombre", $dato, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
    }
     */
/*=============================================
	REGISTRO DE Pedido
	=============================================*/

	/* static public function mdlIngresarImport($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT into pedidos (idcliente, idPieza, nombrePieza, cantidad, precio, color, estado) value (".mdlTraerIdCliente($dato).", ".mdlTraerIdPieza($dato).",:nombrePieza, :cantidad, :precio, :color, :estado)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}
} */