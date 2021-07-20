<?php

class tipoaccionControlador{
    /*=============================================
	INGRESO DE UNIDAD
	=============================================*/
    static public function ctrInsertAccion(){
        if(isset($_POST["nuevaAccion"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaAccion"])){
                $tabla = "tipoaccion";
                $datos = array(
                    "accion" => $_POST["nuevaAccion"]
                );

                $respuestas = ModeloTipoAccion::mdlInsertTipoAccion($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡la accion ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "tipoAccion";

						}

					});

					</script>';
                }

            }else{
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡La accion no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "tipoAccion";

						}

					});

				</script>';
            }

        }
    }

    /*=============================================
	MOSTRAR UNIDADES
	=============================================*/

	static public function ctrMostrarTipoAccion($item, $valor){

		$tabla = "tipoaccion";
        
		$respuesta = ModeloTipoAccion::mdlMostrarTipoAccion($tabla, $item, $valor);
        
		return $respuesta;
	}

    /*=============================================
	EDITAR UNIDAD
	=============================================*/
    static public function ctrUpdateUnidad(){
        if(isset($_POST["editarAccion"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarAccion"])){
                $tabla = "unidad";
                $datos = array(
                    "id" => $_POST["idaccion"],
                    "accion" => $_POST["editarAccion"]
                );

                $respuestas = ModeloUnidad::mdlUpdateUnidad($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡La accion ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "tipoAccion";

						}

					});

					</script>';
                }

            }else{
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡La accion no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "tipoaccion";

						}

					});

				</script>';
            }

        }
    }

    /*=============================================
	ELIMINAR UNIDAD
	=============================================*/

    static public function ctrEliminarUnidad(){
		if(isset($_GET["idAccion"])){

			$tabla ="unidad";
			$datos = $_GET["idAccion"];

			$respuesta = ModeloTipoAccion::mdlBorrarAccion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					icon: "success",
					title: "La accion ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "tipoAccion";
								}
							})

				</script>';

			}

		}
    }

}