<?php
class problemasControlador{
    /*=============================================
	INGRESO DE PROBLEMA
	=============================================*/
    static public function ctrInsertProblema(){
        if(isset($_POST["nuevoProblema"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProblema"])){
                $tabla = "problemas";
                $datos = array(
                    "nombre" => $_POST["nuevoProblema"]
                );

                $respuestas = ModeloProblemas::mdlInsertProblemas($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El problema ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "problemas";

						}

					});

					</script>';
                }

            }else{
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El problema no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "problemas";

						}

					});

				</script>';
            }

        }
    }

    /*=============================================
	MOSTRAR PROBLEMAS
	=============================================*/

	static public function ctrMostrarProblemas($item, $valor){

		$tabla = "problemas";
        
		$respuesta = ModeloProblemas::mdlMostrarProblemas($tabla, $item, $valor);
        
		return $respuesta;
	}

    /*=============================================
	EDITAR DE PROBLEMA
	=============================================*/
    static public function ctrUpdateProblema(){
        if(isset($_POST["editarProblema"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProblema"])){
                $tabla = "problemas";
                $datos = array(
                    "id" => $_POST["idProblema"],
                    "nombre" => $_POST["editarProblema"]
                );

                $respuestas = ModeloProblemas::mdlUpdateProblemas($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El problema ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "problemas";

						}

					});

					</script>';
                }

            }else{
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El problema no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "problemas";

						}

					});

				</script>';
            }

        }
    }

    /*=============================================
	ELIMINAR DE PROBLEMA
	=============================================*/

    static public function ctrEliminarProblema(){
		if(isset($_GET["idproblema"])){

			$tabla ="problemas";
			$datos = $_GET["idproblema"];

			$respuesta = ModeloProblemas::mdlBorrarProblema($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					icon: "success",
					title: "El problema ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "problemas";
								}
							})

				</script>';

			}

		}
    }


	static public function reporteProblemas(){

        
		$respuesta = ModeloProblemas::mdlreporteProblemas();
        
		return $respuesta;
        
	}

	static public function ctrreporteProblemaspdf($id){

        
		$respuesta = ModeloProblemas::mdlreporteProblemaspdf($id);
        
		return $respuesta;
        
	}

	static public function ctrreporteProblemaspdfs($id){

        
		$respuesta = ModeloProblemas::mdlreporteProblemaspdfs($id);
        
		return $respuesta;
        
	}

}