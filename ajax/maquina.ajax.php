<?php
require_once "../controladores/maquinas.controlador.php";
require_once "../modelos/maquinas.modelo.php";

class AjaxMaquinas{
    public $encargado;
    public $idMaquina;
    public $idLinea;
    public $nombreMaquina;

    function obtenerUsuario(){
        $valor = $this->encargado;
        $tabla = "usuarios";

        $respuesta = ControladorMaquina::ctrMostrarUsuarios($tabla, $valor);

		echo json_encode($respuesta);
    }

    function ajaxEditarMaquina(){
        $item = "id";
        $valor = $this->idMaquina;

        $respuesta = ControladorMaquina::ctrMostrarMaquina($item, $valor);

		echo json_encode($respuesta);
    }

    function ajaxobtenerEmpleado(){
        $valor = $this->encargado;
        $tabla = "usuarios";

        $respuesta = ControladorMaquina::ctrMostrarEmpleados($tabla, $valor);

		echo json_encode($respuesta);
    }

    function ajaxobtenerLineas(){

        $respuesta = ControladorMaquina::ctrMostrarLineas();

		echo json_encode($respuesta);
    }

    function ajaxInsertMaquina($datos){
        $idUsuario = $this->encargado;

        $respuesta = ControladorMaquina::ctrInsertMaquina($idUsuario, $datos);

		echo json_encode($respuesta);
    }

    function ajaxBuscarDuplicados(){
        $item = "nombre";
        $valor = $this->idMaquina;

        $respuesta = ControladorMaquina::ctrMostrarMaquinasLineas($item, $valor);

		echo json_encode($respuesta);
    }

    function ajaxEditarMaquinaLinea(){
        $datos = array(
            "id" => $this->idMaquina,
            "idLinea" => $this->idLinea,
            "nombre" => $this->nombreMaquina,
            "idUsuario" => $this->encargado
        );

        $respuesta = ControladorMaquina::ctrEditarMaquina($datos);

		echo json_encode($respuesta);
    }

    function ajaxEliminarMaquina(){
        $valor = $this->idMaquina;

        $respuesta = ControladorMaquina::ctrDeletaMaquina($valor);

		echo json_encode($respuesta);
    }

}

/*=============================================
OBTENER USUARIOS
=============================================*/

if(isset($_GET["encargado"])){
    $ajaxMaquinas = new AjaxMaquinas();
    $ajaxMaquinas -> encargado = $_GET["encargado"];

    $ajaxMaquinas -> obtenerUsuario();
}

/*=============================================
EDITAR MAQUINA
=============================================*/
if(isset($_POST["idMaquina"])){

	$editar = new AjaxMaquinas();
	$editar -> idMaquina = $_POST["idMaquina"];
	$editar -> ajaxEditarMaquina();

}

if(isset($_GET["idMaquina"])){
    echo json_encode($_GET["idMaquina"]);
}

if(isset($_POST["empleado"])){

	$editar = new AjaxMaquinas();
	$editar -> encargado = $_POST["empleado"];
	$editar -> ajaxobtenerEmpleado();

}


if(isset($_POST["mostrarLineas"])){

	$editar = new AjaxMaquinas();
	$editar -> ajaxobtenerLineas();

}

if(isset($_POST["guardarMaquina"])){

    $datos = json_decode($_POST["datosMaquina"], true);
	$editar = new AjaxMaquinas();
    $editar -> encargado = $_POST["idUsuario"];
	$editar -> ajaxInsertMaquina($datos);

}

if(isset($_POST["buscarDuplicados"])){

	$editar = new AjaxMaquinas();
	$editar -> idMaquina = $_POST["maquina"];
	$editar -> ajaxBuscarDuplicados();

}

if(isset($_POST["editarMaquina"])){

	$editar = new AjaxMaquinas();
	$editar -> encargado = $_POST["idUsuario"];
    $editar -> idMaquina = $_POST["idmaquina"];
    $editar -> nombreMaquina = $_POST["nombre"];
    $editar -> idLinea = $_POST["idLinea"];
	$editar -> ajaxEditarMaquinaLinea();

}

if(isset($_POST["EliminarMaquina"])){

	$editar = new AjaxMaquinas();
	$editar -> idMaquina = $_POST["idmaquina"];
	$editar -> ajaxEliminarMaquina();

}

?>