<?php
require_once 'conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class Pausa extends Conexion{


    public function update($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);

        if(!isset($datos["accion"]) ){
                return $respuestas->error_400();
        }else{

            if($datos["accion"] == "pausa"){
                $res = $this->editar();

            
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
    }

    private function editar(){
        $query = "UPDATE segundoModulo SET fechaPausa = NOW(), estadoPausa = 1 WHERE estado = 0";
        $res = parent::nonQueryId($query);


        return $res;
    }

    public function updateInicio($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);

        if(!isset($datos["accion"]) ){
                return $respuestas->error_400();
        }else{

            if($datos["accion"] == "inicia"){
                $res = $this->editarInicio();

            
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
    }

    private function editarInicio(){
        $query = "UPDATE segundoModulo SET  estadoPausa = 0 WHERE estado = 0";
        $res = parent::nonQueryId($query);


        return $res;
    }

}