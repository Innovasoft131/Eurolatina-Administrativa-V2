<?php
class ControladorReporteMaquinas{

    static public function ctrreporteMaquinas($fechaInicial, $fechaFinal){

        $respuesta = ModeloReporteMaquinas::reporteMaquinas($fechaInicial, $fechaFinal);

        return $respuesta;
    }

    static public function ctrreporteMaquinaspdf($idPedido){

        $respuesta = ModeloReporteMaquinas::reporteMaquinasPdf($idPedido);

        return $respuesta;
    }

    static public function ctrreporteMinutosTranscuridos($fechaInicial, $horaConsulta){

        $respuesta = ModeloReporteMaquinas::reporteMinutosTranscuridos($fechaInicial, $horaConsulta);

        return $respuesta;
    }

}