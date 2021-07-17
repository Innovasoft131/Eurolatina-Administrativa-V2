<?php

class EstadoControlador{
    /*=============================================
	INGRESO DE ESTADO
	=============================================*/
    static public function ctrInsertEstado(){
        if(isset($_POST["nuevoEstado"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoEstado"])){
                $tabla = "estado";
                $datos = array(
                    "estado" => $_POST["nuevoEstado"]
                );

                $respuestas = ModeloEstado::mdlInsertEstado($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El estado ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "estado";

						}

					});

					</script>';
                }

            }else{
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El estado no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "estado";

						}

					});

				</script>';
            }

        }
    }

    /*=============================================
	MOSTRAR ESTADOS
	=============================================*/

	static public function ctrMostrarEstados($item, $valor){

		$tabla = "estado";
        
		$respuesta = ModeloEstado::mdlMostrarEstados($tabla, $item, $valor);
        
		return $respuesta;
	}

    /*=============================================
	EDITAR ESTADOS
	=============================================*/
    static public function ctrUpdateEstado(){
        if(isset($_POST["editarEstado"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarEstado"])){
                $tabla = "estado";
                $datos = array(
                    "id" => $_POST["idEstado"],
                    "estado" => $_POST["editarEstado"]
                );

                $respuestas = ModeloEstado::mdlUpdateEstado($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El estado ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "estado";

						}

					});

					</script>';
                }

            }else{
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El estado no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "estado";

						}

					});

				</script>';
            }

        }
    }

    /*=============================================
	ELIMINAR ESTADO
	=============================================*/

    static public function ctrEliminarEstado(){
		if(isset($_GET["idEstado"])){

			$tabla ="estado";
			$datos = $_GET["idEstado"];

			$respuesta = ModeloEstado::mdlEliminarEstado($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					icon: "success",
					title: "El estado ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "estado";
								}
							})

				</script>';

			}

		}
    }

}