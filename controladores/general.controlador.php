<?php
class ControladorGeneral{

    public static function cntModelosTerminados($fechaInicial, $fechaFinal){
      
        $tabla = "tercerModulo";

        $resultado = ModeloGeneral::mdlModelosTerminados($tabla, $fechaInicial, $fechaFinal);

        return $resultado;
    }

    public static function cntModelosTerminadosMaquinas($fechaInicial, $fechaFinal){
      

        $resultado = ModeloGeneral::mdlModelosTerminadosMaquina($fechaInicial, $fechaFinal);

        return $resultado;
    }

    public static function cntModelosTerminadosPlanchado($fechaInicial, $fechaFinal){
      

        $resultado = ModeloGeneral::mdlModelosTerminadosPlanchado($fechaInicial, $fechaFinal);


        return $resultado;
    }

    public static function cntModelosTerminadosTabla($fechaInicial, $fechaFinal){
      

        $resultado = ModeloGeneral::mdlModelosTerminadosTabla($fechaInicial, $fechaFinal);


        return $resultado;
    }

    static public function ctrreporteTerminadospdf($idPedido){

        $respuesta = ModeloGeneral::reporteTerminadosPdf($idPedido);

        return $respuesta;
    }

}