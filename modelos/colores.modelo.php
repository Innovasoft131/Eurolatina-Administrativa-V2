<?php

require_once "conexion.php";

class ColoresModelo{

    // insertar colores
    static public function mdlInsert($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, nombre, hexadecimal) VALUES (NULL, :nombre, :hexadecimal)");
        $stmt->bindParam(":nombre", $datos["color"], PDO::PARAM_STR);
        $stmt->bindParam(":hexadecimal", $datos["codigo"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }


        // insertar colores ajax
        static public function mdlInsertAjax($tabla, $datos){

            $cn = new Conexion();
		    $cn = $cn->conectar();


            $stmt = $cn->prepare("INSERT INTO $tabla(id, nombre, hexadecimal) VALUES (NULL, :nombre, NULL)");
            $stmt->bindParam(":nombre", $datos["color"], PDO::PARAM_STR);
    
            if($stmt->execute()){

                return $cn->lastInsertId();
    
            }else{
                return "error";	
            }
    
            $stmt->close();
    
            $stmt = null;
        }

    // obtener colores con y sin WHERE

    static public function mdlObtenerColores($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");
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

    static public function mdlObtenerColor($tabla, $item, $valor){
        if($item != null){
            $res = array();
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $valor LIKE '$item%' ");
           
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

    static public function mdlCRUDObtenerColores($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla Where nombre not like 'Com%'");
        $stmt -> execute();

        return $stmt -> fetchAll();
        

        $stmt -> close();
        $stmt = null;
    }


    // editar color
    static public function mdlEditarColor($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, hexadecimal = :hexadecimal WHERE id = :id");

        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt -> bindParam(":nombre", $datos["color"], PDO::PARAM_STR);
        $stmt -> bindParam(":hexadecimal", $datos["hexadecimal"], PDO::PARAM_STR);

        if($stmt -> execute()){
            return "ok";
        }else {
            return "error";
        }

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlEliminarColor($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt -> bindParam(":id", $datos, PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return "ok";
        }else {
            return "error";
        }
    }
}