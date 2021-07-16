<?php
require_once "../controladores/lineas.controlador.php";
require_once "../modelos/lineas.modelo.php";

class AjaxLineas{
    public $linea;
    public $id;

    public function insertLinea(){


		$valor = $this->linea;

		$respuesta = Controladorlineas::ctrInsertLinea($valor);

		echo json_encode($respuesta);

	}
    public function deleteLinea(){


		$valor = $this->linea;

		$respuesta = Controladorlineas::ctrDeleteLinea($valor);

		echo json_encode($respuesta);

	}


    public function updateLinea(){


		$valor = array(
            "id" => $this->id,
            "linea" => $this->linea
        );

		$respuesta = Controladorlineas::ctrUpdateLinea($valor);

		echo json_encode($respuesta);

	}

}

if(isset($_POST["guardarLinea"])){
    $ajaxLinea = new AjaxLineas();
    $ajaxLinea -> linea = $_POST["linea"];
    $ajaxLinea -> insertLinea();
}

if(isset($_POST["eliminarLinea"])){
    $ajaxLinea = new AjaxLineas();
    $ajaxLinea -> linea = $_POST["idLinea"];
    $ajaxLinea -> deleteLinea();
}



if(isset($_POST["editarLinea"])){
    $ajaxLinea = new AjaxLineas();
    $ajaxLinea -> linea = $_POST["linea"];
    $ajaxLinea -> id = $_POST["id"];
    $ajaxLinea -> updateLinea();
}