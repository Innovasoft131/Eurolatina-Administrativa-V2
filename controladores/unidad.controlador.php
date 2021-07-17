<?php

class UnidadControlador{
    /*=============================================
	INGRESO DE UNIDAD
	=============================================*/
    static public function ctrInsertUnidad(){
        if(isset($_POST["nuevaUnidad"])){
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
	MOSTRAR UNIDADES
	=============================================*/

	static public function ctrMostrarUnidades($item, $valor){

		$tabla = "unidad";
        
		$respuesta = ModeloUnidad::mdlMostrarUnidades($tabla, $item, $valor);
        
		return $respuesta;
	}

    /*=============================================
	EDITAR UNIDAD
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
	ELIMINAR UNIDAD
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

}