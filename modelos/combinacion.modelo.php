<?php
require_once "conexion.php";

class ModeloCombinacion{
    static public function mdlinsert($datos, $combinacion){
        $cn =  Conexion::conectar();

        try {
            $cn->beginTransaction();
            $stmt = $cn->prepare("INSERT INTO color(id, nombre, hexadecimal)VALUES
				(NULL,  :nombre,  NULL)");
            $stmt -> bindParam(":nombre", $combinacion, PDO::PARAM_STR);
            
			$stmt->execute();
			$idColor = $cn->lastInsertId();
            for ($i=0; $i < count($datos) ; $i++) { 
                $stmtColor =  $cn->prepare("INSERT INTO combinacionColor(id, idColor, nombre)VALUES
                (NULL, :idColor, :nombre)");
    
                $stmtColor -> bindParam(":idColor", $idColor, PDO::PARAM_STR);
                $stmtColor -> bindParam(":nombre", $datos[$i]["nombreColor"], PDO::PARAM_STR);
                $stmtColor->execute();
            }



            if($cn->commit()){
				return "ok";
			}

        } catch (\Exception $ex) {
            $cn->rollBack();
        }
    }

    static public function mdlMostrarCombinacion(){
        $stmt = Conexion::conectar()->prepare("select distinct c.id, c.nombre as nombreCombinacion from combinacionColor cm join color c on cm.idColor = c.id");
        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();
        $stmt = null;
    }


    static public function mdlMostrarColorCombinacion($id){
	
		$stmt = Conexion::conectar()->prepare("select distinct cm.* from combinacionColor cm join color c on cm.idColor = c.id where cm.idColor = $id");
			
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


    static public function mdlinsertCombinacion($idColor, $color){


        $stmtColor =  Conexion::conectar()->prepare("INSERT INTO combinacionColor(id, idColor, nombre)VALUES
                (NULL, :idColor, :nombre)");
    
        $stmtColor -> bindParam(":idColor", $idColor, PDO::PARAM_STR);
        $stmtColor -> bindParam(":nombre", $color, PDO::PARAM_STR);
        
            



            if($stmtColor->execute()){
				return "ok";
			}else{
                return "error";
            }
            $stmtColor -> close();

            $stmtColor = null;

    }

    static public function mdlEliminarColorCombinacion($idCombinacion){


        $stmtColor =  Conexion::conectar()->prepare("DELETE  FROM combinacionColor WHERE id = $idCombinacion  ");
    
            if($stmtColor->execute()){
				return "ok";
			}else{
                return "error";
            }

            $stmtColor -> close();

            $stmtColor = null;

    }


    static public function mdlEliminarColorCombinacionCrud($idColor){


        $stmtColor =  Conexion::conectar()->prepare("DELETE  FROM color WHERE id = $idColor  ");
    
            if($stmtColor->execute()){
				return "ok";
			}else{
                return "error";
            }

            $stmtColor -> close();

            $stmtColor = null;

    }
}