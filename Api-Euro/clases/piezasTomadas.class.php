<?php
require_once 'conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class PiezasTomadas extends Conexion{
    private $cantidad;
    private $idsegundoModulo;
    private $idUsuario;
    private $idtercerModulo;

    public function insert($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);

        if(!isset($datos["cantidad"]) ||
            !isset($datos["idsegundoModulo"]) ||
            !isset($datos["idUsuario"]) ||
            !isset($datos["idtercerModulo"]) ){
                return $respuestas->error_400();
        }else{
            $this->cantidad = $datos["cantidad"];
            $this->idsegundoModulo = $datos["idsegundoModulo"];
            $this->idtercerModulo = $datos["idtercerModulo"];
            $this->idUsuario = $datos["idUsuario"];

            $res = $this->insertar();

            
            if($res > 0){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "idsegundoModulo" => $this->idsegundoModulo,
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }
    }

    private function insertar(){
        if($this->idsegundoModulo == null || $this->idsegundoModulo == "" && $this->idtercerModulo != null || $this->idtercerModulo != ""){
            $query = "INSERT INTO CantidadPiezasTomadas(id, idUsuario, idsegundoModulo, idtercerModulo, cantidad) VALUES".
            "(null, ".$this->idUsuario.", null, ".$this->idtercerModulo.", ".$this->cantidad.")";
        }elseif($this->idsegundoModulo != null || $this->idsegundoModulo != "" && $this->idtercerModulo == null || $this->idtercerModulo == "")
        {
            $query = "INSERT INTO CantidadPiezasTomadas(id, idUsuario, idsegundoModulo, idtercerModulo, cantidad) VALUES".
            "(null, ".$this->idUsuario.", ".$this->idsegundoModulo.", null, ".$this->cantidad.")";
        }
        
       
        $res = parent::nonQueryIds($query);


        return $res;
    }

}