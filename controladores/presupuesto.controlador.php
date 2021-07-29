<?php

class ControladorPresupuesto{
    /*=============================================
	INGRESO DE UNIDAD
	=============================================*/
    static public function ctrInsertPresupuesto(){
        if(isset($_POST["idoportunidad"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaUnidad"])){
                $tabla = "unidad";
                $datos = array(
                    "unidad" => $_POST["nuevaUnidad"]
                );

                $respuestas = ModeloUnidad::mdlInsertUnidades($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡la unidad ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "unidad";

						}

					});

					</script>';
                }

            }else{
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡La unidad no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "unidad";

						}

					});

				</script>';
            }

        }
    }

    /*=============================================
	MOSTRAR OPORTUNIDADES PENDIENTES
	=============================================*/

	static public function ctrMostrarPresupuestos($item, $valor){

		$tabla = "oportunidad";
        
		$respuesta = ModeloPresupuesto::mdlMostrarPresupuestos($tabla, $item, $valor);
        
		return $respuesta;
	}

	/*=============================================
	MOSTRAR ESTADOS
	=============================================*/

	static public function ctrMostrarEstados($item, $valor){

		$tabla = "porcentajeexito";
        
		$respuesta = ModeloPresupuesto::mdlMostrarEstados($tabla, $item, $valor);
        
		return $respuesta;
	}

    /*=============================================
	EDITAR PRESUPUESTOS
	=============================================*/
    static public function ctrUpdateUnidad(){
        if(isset($_POST["editarUnidad"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarUnidad"])){
                $tabla = "unidad";
                $datos = array(
                    "id" => $_POST["idUnidad"],
                    "unidad" => $_POST["editarUnidad"]
                );

                $respuestas = ModeloUnidad::mdlUpdateUnidad($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡La unidad ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "unidad";

						}

					});

					</script>';
                }

            }else{
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡La unidad no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "unidad";

						}

					});

				</script>';
            }

        }
    }

    /*=============================================
	ELIMINAR PRESUPUESTO
	=============================================*/

    static public function ctrEliminarUnidad(){
		if(isset($_GET["idUnidad"])){

			$tabla ="unidad";
			$datos = $_GET["idUnidad"];

			$respuesta = ModeloUnidad::mdlBorrarUnidad($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					icon: "success",
					title: "La unidad ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "unidad";
								}
							})

				</script>';

			}

		}
    }
    /*=============================================
	MOSTRAR ACCION EN TABLA DE OPORTUNIDADES
	=============================================*/

	static public function ctrMostrarAccion($item, $valor){

		$tabla = "tipoaccion";
        
		$respuesta = ModeloPresupuesto::mdlMostrarPresupuestos($tabla, $item, $valor);
        
		return $respuesta;
	}
}