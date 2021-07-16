<?php
require_once 'conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class CantidadDefectuosas extends Conexion{
    private $idDefectuosas;
    private $cantidad;
    private $descripcion;

    public function insert($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);

        if(!isset($datos["idDefectuosas"]) ||
            !isset($datos["cantidad"]) ||
            !isset($datos["descripcion"]) ){
                return $respuestas->error_400();
        }else{
            $this->idDefectuosas = $datos["idDefectuosas"];
            $this->cantidad = $datos["cantidad"];
            $this->descripcion = $datos["descripcion"];

            $res = $this->insertar();

            
            if($res > 0){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "id" => $res,
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }
    }

    private function insertar(){
        $query = "INSERT INTO cantidadDefectuosas(id, idDefectuosas, cantidad, descripcion, fecha) VALUES".
            "(null, ".$this->idDefectuosas.", ".$this->cantidad.", '".$this->descripcion."', now())";
   
        $res = parent::nonQueryIds($query);


        return $res;
    }

}