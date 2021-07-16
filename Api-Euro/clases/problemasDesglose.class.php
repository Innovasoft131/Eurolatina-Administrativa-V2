<?php

require_once 'conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class ProblemasDesglose extends Conexion{
    private $id = "";
    private $idProblemaProce = "";
    private $idProblema = "";
    private $problema = "";
    private $maquina = "";
    private $idLinea = "";

    public function insert($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);
        
        if(!isset($datos['id']) ||
            !isset($datos['idProblemaProce']) ||
            !isset($datos['idProblema']) ||
            !isset($datos['idLinea']) ||
            !isset($datos['problema'])){
                
                return $respuestas->error_400();
        }else {
            $this->id = $datos['id'];
            $this->idProblemaProce = $datos['idProblemaProce'];
            $this->idProblema = $datos['idProblema'];
            $this->maquina = $datos['maquina'];
            $this->idLinea = $datos['idLinea'];
            $this->problema = $datos['problema'];

            
            $res = $this->insertar();

            if($res == "ok"){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }
    }

    private function insertar(){
        if($this->idProblemaProce != "" && $this->idProblema != "" && $this->problema != ""){
            $query = "INSERT INTO problemasDesglose(id, idProblemaProce, idLinea, idMaquina, idProblema, problema) VALUES
            (NULL, ".$this->idProblemaProce.", ".$this->idLinea.", ".$this->maquina.", ".$this->idProblema.", '".$this->problema."')";
        }elseif($this->idProblema == null || $this->idProblema == ""){
            $query = "INSERT INTO problemasDesglose(id, idProblemaProce, idLinea, idMaquina, idProblema, problema) VALUES
            (NULL, ".$this->idProblemaProce.", ".$this->idLinea.", ".$this->maquina.", NULL, '".$this->problema."')";
        }elseif($this->problema != null || $this->problema == ""){
            $query = "INSERT INTO problemasDesglose(id, idProblemaProce, idLinea, idMaquina, idProblema, problema) VALUES
            (NULL, ".$this->idProblemaProce.", ".$this->idLinea.", ".$this->maquina.", ".$this->idProblema.", NULL)";
        }elseif($this->problema != null || $this->problema == "" && $this->idProblema == null || $this->idProblema == ""){
            $query = "INSERT INTO problemasDesglose(id, idProblemaProce, idLinea, idMaquina, idProblema, problema) VALUES
            (NULL, ".$this->idProblemaProce.", ".$this->idLinea.", ".$this->maquina.", NULL, NULL)";
        }elseif($this->id != null || $this->id == ""){
            $query = "INSERT INTO problemasDesglose(id, idProblemaProce, idLinea, idMaquina, idProblema, problema) VALUES
            (NULL, ".$this->idProblemaProce.", ".$this->idLinea.", ".$this->maquina.", ".$this->idProblema.", NULL)";
        }
        



        
        $res = parent::nonQueryId($query);

        if($res == "ok"){
        return "ok";
        }else{
            return "error";
        }
    }

    public function problemas($tabla){
        $respuestas = new Respuestas();
        $query = "SELECT * FROM $tabla";

        $res = parent::obtenerDatos($query);

        if($res == null || $res == ""){
            return $respuestas->error_400("Datos no encontrados o con formato incorrecto");
        }else{
            return $res;
        }
        

    }
}