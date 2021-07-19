<?php

class PorcentajeExitoControlador{
    /*=============================================
	INGRESO DE UNIDAD
	=============================================*/
    static public function ctrInsertPorcentaje(){
        if((isset($_POST["exito"]) && (isset($_POST["etapa"])))){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["exito"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["etapa"])){
                $tabla = "porcentajeexito";
                $datos = array(
                    "exito" => $_POST["exito"],
					"etapa" => $_POST["etapa"]
                );

                $respuestas = ModeloPorcentajeExito::mdlInsertPorcentaje($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El porcentaje de exito ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "porcentajeExito";

						}

					});

					</script>';
                }

            }else{
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡Exito o Etapa no pueden ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){
						if(result.value){
							window.location = "porcentajeExito";
						}
					});

				</script>';
            }

        }
    }

    /*=============================================
	MOSTRAR PORCENTAJES
	=============================================*/

	static public function ctrMostrarPorcentajes($item, $valor){

		$tabla = "porcentajeexito";
        
		$respuesta = ModeloPorcentajeExito::mdlMostrarPorcentajesExito($tabla, $item, $valor);
        
		return $respuesta;
	}

    /*=============================================
	EDITAR UNIDAD
	=============================================*/
    static public function ctrUpdatePorcentaje(){
	
        if((isset($_POST["editaretapa"])) || (isset($_POST["editarexito"]))){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editaretapa"])){
                $tabla = "porcentajeexito";
                $datos = array(
                    "id" => $_POST["idporcentaje"],
                    "etapa" => $_POST["editaretapa"],
					"exito" => $_POST["editarexito"]
                );
               var_dump($datos);
                $respuestas = ModeloPorcentajeExito::mdlUpdatePorcentaje($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({
						icon: "success",
						title: "¡El ;orcentaje de exito ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "porcentajeExito";
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
							window.location = "porcentajeExito";
						}

					});

				</script>';
            }

        }
    }

    /*=============================================
	ELIMINAR UNIDAD
	=============================================*/

    static public function ctrEliminarPorcentaje(){
		if(isset($_GET["idporcentaje"])){

			$tabla ="porcentajeexito";
			$datos = $_GET["idporcentaje"];

			$respuesta = ModeloPorcentajeExito::mdlBorrarPorcentaje($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					icon: "success",
					title: "El porcentaje de exito ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "porcentajeExito";
								}
							})

				</script>';

			}

		}
    }

}