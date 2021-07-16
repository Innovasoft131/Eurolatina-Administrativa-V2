<?php
class ControladorCombinacion{

    static public function cntinsert($datos, $combinacion){
        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $combinacion)){
            $respuesta = ModeloCombinacion::mdlinsert($datos, $combinacion);

            
            if($respuesta == "ok"){
                return "ok";
            }else{
                return "error";
            }

        }else{
            return "errorSintaxis";
        }

    }

    static public function ctrObtenerColores(){
        
        $respuesta = ModeloCombinacion::mdlMostrarCombinacion();

        return $respuesta;
    }

    static public function ctrObtenerColoresCombinacion($id){
        
        $respuesta = ModeloCombinacion::mdlMostrarColorCombinacion($id);

        return $respuesta;
    }

    static public function cntinsertCombinacion($idColor, $color){
        $respuesta = ModeloCombinacion::mdlinsertCombinacion($idColor, $color);

            
        if($respuesta == "ok"){
             return "ok";
        }else{
             return "error";
        }
    }

    static public function cntEliminarColorCombinacion($idCombinacion){
        $respuesta = ModeloCombinacion::mdlEliminarColorCombinacion($idCombinacion);
      
            
        if($respuesta == "ok"){
             return "ok";
        }else{
             return "error";
        }
    }

    static public function cntEliminarColorCombinacionCrud($idColor){
        $respuesta = ModeloCombinacion::mdlEliminarColorCombinacionCrud($idColor);
      
            
        if($respuesta == "ok"){
             return "ok";
        }else{
             return "error";
        }
    }
}