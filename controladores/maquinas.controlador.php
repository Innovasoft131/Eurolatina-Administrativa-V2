<?php

class ControladorMaquina{
    /*=============================================
	INGRESO DE Maquina
	=============================================*/

	static public function ctrInsertMaquina($idUsuario, $datos){
        
    
        $tabla = "maquina";
    

        $respuesta = ModeloMaquinas::mdlIngresarMaquina($tabla, $datos, $idUsuario);
    
        return $respuesta;

     

 
    }

    static public function ctrMostrarUsuarios($tabla, $valor){
        $item = "nombre";
        $respuesta = ModeloMaquinas::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

    }

    static public function ctrMostrarEmpleados($tabla, $valor){
        $item = "nombre";
        $respuesta = ModeloMaquinas::MdlMostrarMaquinas($tabla, null, $item, $valor);

		return $respuesta;

    }

    static public function ctrMostrarLineas(){
        $tabla = "lineas";
        $item = null;
        $valor = null;
        $respuesta = ModeloMaquinas::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

    }

    static public function ctrMostrarMaquinas(){


		$respuesta = ModeloMaquinas::MdlMostrarMaquinasPrimero();
		
		return $respuesta;
    }
	static public function ctrMostrarMaquinasSegundo($id){


		$respuesta = ModeloMaquinas::MdlMostrarMaquinasSegundo($id);
		
		return $respuesta;
    }

    /*=============================================
	MOSTRAR MAQUINA SELECCIONADA
	=============================================*/
    static public function ctrMostrarMaquina($item, $valor){
        $tabla = "maquina";
		
    //    $respuesta = ModeloMaquinas::MdlMostrarMaquinas($tabla, null, $item, $valor);
		$respuesta = ModeloMaquinas::mdlMostrarMaquinaLinea($valor);
		
		return $respuesta;
    }

	static public function ctrMostrarMaquinasLineas($item, $valor){
        $tabla = "maquina";
		
    //    $respuesta = ModeloMaquinas::MdlMostrarMaquinas($tabla, null, $item, $valor);
		$respuesta = ModeloMaquinas::mdlMostrarMaquinaLineas($valor);
		
		return $respuesta;
    }

    /*=============================================
	BORRAR MAQUINA
	=============================================*/

	static public function ctrBorrarMaquina(){

		if(isset($_GET["idMaquina"])){

			$tabla ="maquina";
			$datos = $_GET["idMaquina"];


			$respuesta = ModeloMaquinas::mdlBorrarMaquina($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					icon: "success",
					title: "La maquina ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "maquinas";

								}
							})

				</script>';

			}

		}

	}

	    /*=============================================
	BORRAR MAQUINA AJAX
	=============================================*/

	static public function ctrDeletaMaquina($idMaquina){

		if(isset($idMaquina)){

			$tabla ="maquina";
			$datos = $idMaquina;


			$respuesta = ModeloMaquinas::mdlBorrarMaquina($tabla, $datos);

			if($respuesta == "ok"){

				return "ok";

			}else{
				return "error";
			}

		}

	}


    /*=============================================
	EDITAR MAQUINA
	=============================================*/

	static public function ctrEditarMaquina($dato){
        if(isset($dato["id"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $dato["nombre"])  && 
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $dato["idUsuario"])){

                $tabla = "maquina";

                $datos = array("nombreMaquina" => $dato["nombre"],
							"idUsuario" => $dato["idUsuario"],
                            "id" => $dato["id"],
							"idLinea" => $dato["idLinea"]);

                $respuesta = ModeloMaquinas::mdlEditarMaquina($tabla, $datos);

                if($respuesta == "ok"){

					return $respuesta;

				}

            }else{
				return "errorSintaxis";
			}

        }
	}


}


?>