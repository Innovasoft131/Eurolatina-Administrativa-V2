<?php

class Controladorlineas{

    // REGISTRO DE LINEA
    static public function ctrInsertLinea($valor){
        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $valor)){
            $tabla = "lineas";
            $item = "nombre";
            $respuesta = ModeloLineas::MdlMostrarLineas($tabla, $item, $valor);

            if($respuesta == null){
                $datos = array(
                    "nombre" => $valor
                );
                $respuestaInsert = ModeloLineas::MdlInsertLineas($tabla, $datos);

                if($respuestaInsert == "ok"){
                    
                    return "ok";
                }
            }else{
                return "encontrada";
            }

        }else{
            return "datosIncorrectos";
        }

    }

    static public function ctrMostrarLineas($item, $valor){

		$tabla = "lineas";

		$respuesta = ModeloLineas::MdlMostrarLineas($tabla, $item, $valor);
	
		return $respuesta;
	}

    static public function ctrDeleteLinea($datos){

		$tabla = "lineas";

		$respuesta = ModeloLineas::MdlDeleteLineas($tabla, $datos);
	
		return $respuesta;
	}




        // EDITAR DE LINEA
        static public function ctrUpdateLinea($valor){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $valor["linea"])){
                
                $tabla = "lineas";
                $item = "nombre";
                $respuesta = ModeloLineas::MdlMostrarLineas($tabla, $item, $valor["linea"]);
    
                if($respuesta == null){
                    
                    $respuestaUpdate = ModeloLineas::MdlUpdateLineas($tabla, $valor);
    
                    if($respuestaUpdate == "ok"){
                        
                        return "ok";
                    }
                }else{
                    return "encontrada";
                }
    
            }else{
                return "datosIncorrectos";
            }
    
        }
}