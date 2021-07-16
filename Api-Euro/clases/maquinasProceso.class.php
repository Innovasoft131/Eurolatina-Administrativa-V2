<?php
require_once 'conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class MaquinasProceso extends Conexion{
    private $cantidad;
    private $idMaquina;
    private $idPrimerModulo;
    private $idPrimerModuloD;
    private $estado;

    public function insert($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);

        if(!isset($datos["cantidad"]) ||
            !isset($datos["idMaquina"]) ||
            !isset($datos["idPrimerModulo"]) ||
            !isset($datos["idPrimerModuloD"]) ||
            !isset($datos["estado"]) ){
                return $respuestas->error_400();
        }else{
            $this->cantidad = $datos["cantidad"];
            $this->idMaquina = $datos["idMaquina"];
            $this->idPrimerModulo = $datos["idPrimerModulo"];
            $this->idPrimerModuloD = $datos["idPrimerModuloD"];
            $this->estado = $datos["estado"];

            $res = $this->insertar();

            
            if($res > 0){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "idPrimerModulo" => $this->idPrimerModulo,
                        "idMaquinaProceso" => $res,
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }
    }

    private function insertar(){
        $query = "INSERT INTO maquinasProceso(id, cantidad, idMaquina, idPrimerModulo, idPrimerModuloD, estado) VALUES".
            "(null, ".$this->cantidad.", ".$this->idMaquina.", ".$this->idPrimerModulo.", ".$this->idPrimerModuloD.", ".$this->estado.")";
       
      
        $res = parent::nonQueryIds($query);


        return $res;
    }

}