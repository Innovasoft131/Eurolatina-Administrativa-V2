<?php
require_once 'conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class Defectuosas extends Conexion{
    private $idUsuario;
    private $idsegundoModulo;
    private $idtercerModulo;

    public function insert($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);

        if(!isset($datos["idUsuario"]) ||
            !isset($datos["idsegundoModulo"]) ||
            !isset($datos["idtercerModulo"]) ){
                return $respuestas->error_400();
        }else{
            $this->idUsuario = $datos["idUsuario"];
            $this->idsegundoModulo = $datos["idsegundoModulo"];
            $this->idtercerModulo = $datos["idtercerModulo"];

            $res = $this->insertar();

            
            if($res > 0){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "idDefectuosas" => $res,
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }
    }

    private function insertar(){
        if($this->idsegundoModulo == ""){
            $query = "INSERT INTO defectuosas(id, idUsuario, idsegundoModulo, idtercerModulo) VALUES".
            "(null, ".$this->idUsuario.", null, ".$this->idtercerModulo.")";
        }else if($this->idtercerModulo == ""){
            $query = "INSERT INTO defectuosas(id, idUsuario, idsegundoModulo, idtercerModulo) VALUES".
            "(null, ".$this->idUsuario.", ".$this->idsegundoModulo.", null)";
        }

       
        $res = parent::nonQueryIds($query);


        return $res;
    }

}