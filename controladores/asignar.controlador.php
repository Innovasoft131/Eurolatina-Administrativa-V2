<?php

class ControladorAsignar{
    /*=============================================
	    MOSTRAR PrimerModulo
	=============================================*/
    static public function cntMostrarMostrarPrimerModulo($item , $valor){
        $tabla = "primerModulo";

		$respuesta = ModeloAsignar::MdlMostraPrimerModulo($tabla, $item, $valor);

		return $respuesta;
    }

    /* obtener piezas del pedido */
    static public function cntobtenerPiezasPedido($valor){

        $respuesta = ModeloAsignar::mdlobtenerPiezasPedido($valor);

        return $respuesta;

    }
    /* obtener primer Modulo desglose por pedido y pieza */
    static public function cntobtenerPimerModuloDesglose($datos){

        $respuesta = ModeloAsignar::mdlobtenerPimerModuloDesglose($datos);

        return $respuesta;

    }

    /* obtener maquinas */
    static public function cntobtenermostrarMaquinas(){
        $tabla = "maquina";
        $respuesta = ModeloAsignar::mdlobtenermostrarMaquinas($tabla);

        return $respuesta;

    }
    /* obtener maquinas de las lineas */
    static public function cntobtenermostrarMaquinasLineas($idLinea){

        $respuesta = ModeloAsignar::mdlmostrarMaquinasLineas( $idLinea);

        return $respuesta;

    }

    /* insertar en  maquinasProceso */
    static public function cntinsert($datos){
        $tabla = "maquinasProceso";
        // validar si ya esta asignado a la maquina
        $datosVerificar = array(
            "idPrimerModulo" => $datos["idPrimerModulo"],
            "idPrimerModuloDesglose" => $datos["idPrimerModuloDesglose"]
        );
        $verificarAsignacion = ModeloAsignar::mdlVerificarMaquina($tabla, $datosVerificar);
        if($verificarAsignacion[0]["cantidad"] == "" || $verificarAsignacion[0]["cantidad"] == null){
            if($datos["cantidadAsignada"] <= $datos["cantidadPedido"] || $datos["cantidadAsignada"] == $datos["cantidadPedido"]){
                if($datos["cantidadAsignada"] != "" || $datos["cantidadAsignada"] != null){
                    if(preg_match('/^[0-9]+$/', $datos["cantidadAsignada"])){
                        if($datos["idMaquina"] != "" || $datos["idMaquina"] != null){
                            if($datos["cantidadAsignada"] > 0){
                                $respuesta = ModeloAsignar::mdlinsert($tabla, $datos);
                            //    $respuesta = "ok";
                            }else{
                                $respuesta = "cantidadcero";
                            }

                        }else{
                            $respuesta = "idMaquinaNull";
                        }

                    }else{
                        $respuesta = "cantidadAsignanaNull";
                    }
                
                }else{
                    $respuesta = "cantidadAsignanaNull";
                }

            }else{
                $respuesta = "errorCantidad";
            }  
        
        }else{
            if($datos["cantidadAsignada"] <=  $datos["cantidadPedido"] && $datos["cantidadAsignada"] >= 0 && $verificarAsignacion[0]["cantidad"] != $datos["cantidadPedido"]){

                if(( intval($verificarAsignacion[0]["cantidad"]) >= intval($datos["cantidadAsignada"]) ) || ( intval($verificarAsignacion[0]["cantidad"]) <= intval($datos["cantidadAsignada"]) ) ){
                //    $respuesta = $verificarAsignacion;
                    $respuesta = ModeloAsignar::mdlinsert($tabla, $datos);
                //    $respuesta = "ok";
                }else{
                //    $respuesta = $verificarAsignacion[0]["cantidad"];
                    
                    $respuesta = "error";
                }
                
                
            }else{
                $respuesta = "error";
            }
        //   $respuesta = "error";
        }
    

        return $respuesta;

    }

    static public function cntverificar($datos){
        $tabla = "maquinasProceso";
        // validar si ya esta asignado a la maquina
        $datosVerificar = array(
            "idPrimerModulo" => $datos["idPrimerModulo"],
            "idPrimerModuloDesglose" => $datos["idPrimerModuloDesglose"]
        );

        $verificarAsignacion = ModeloAsignar::mdlVerificarMaquina($tabla, $datosVerificar);

        if($verificarAsignacion != "" || $verificarAsignacion != null){
            return $verificarAsignacion;
        }else{
           return $respuesta = "error";
        }

        
    }


    static public function cntMostrarMaquinaAsignada($datos){
        
        $respuesta = ModeloAsignar::mdlMostrarMaquinaAsignada($datos);

        return $respuesta;
    }


    static public function cnteliminarMaquinasProceso($datos){
        
        $tabla = "maquinasProceso";
        $respuesta = ModeloAsignar::mdleliminarMaquinasProceso($tabla, $datos);

        return $respuesta;
    }

    static public function cntCantidadPrimerModulo($datos){
        
        $respuesta = ModeloAsignar::mdlCantidadPrimerModulo($datos);

        return $respuesta;
    }

    static public function cntCantidadMaquinasProceso($datos){
        
        $respuesta = ModeloAsignar::mdlCantidadMaquinasProceso($datos);

        return $respuesta;
    }

    static public function cnteditarPrimerModulo($datos){
        
        $respuesta = ModeloAsignar::mdleditarPrimerModulo($datos);

        return $respuesta;
    }

    static public function cnteditarPrimerModuloACero($datos){
        
        $respuesta = ModeloAsignar::mdleditarPrimerModuloACero($datos);

        return $respuesta;
    }



}