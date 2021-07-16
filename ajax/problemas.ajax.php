<?php
require_once "../controladores/problemas.controlador.php";
require_once "../modelos/problemas.modelo.php";
class AjaxProblemas{
    public $idProblema;

    public function obtenerProblema(){
        $item = "id";
		$valor = $this->idProblema;

		$respuesta = problemasControlador::ctrMostrarProblemas($item, $valor);

		echo json_encode($respuesta);
    }


}

if(isset($_POST['idProblema'])){
    $problema = new AjaxProblemas();
    $problema -> idProblema = $_POST['idProblema'];
    $problema -> obtenerProblema();
}
