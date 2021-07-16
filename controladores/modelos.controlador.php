<?php

class ControladorModelos{

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

    static public function ctrCrearModelo(){
		if(isset($_POST["nuevoNombre"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripcion"])){


				$tabla = "modelo";

				$datos = array("nombre" => $_POST["nuevoNombre"],
				                "descripcion" => $_POST["nuevoDescripcion"]);
				
				$respuesta = Modelomodelo::mdlIngresarModelo($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El modelo ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "modelo";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El modelo no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "modelo";

						}

					});
				

				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarModelos($item, $valor){

		$tabla = "modelo";

		$respuesta = Modelomodelo::MdlMostrarModelos($tabla, $item, $valor);
	
		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarModelo(){
	
		if(isset($_POST["editarNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"])){

				$tabla = "modelo";
                $datos = array(
				"id"=> $_POST["id"],
				"nombre" => $_POST["editarNombre"],
				"descripcion" => $_POST["editarDescripcion"]);

				$respuesta = Modelomodelo::mdlEditarModelo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  icon: "success",
						  title: "El modelo ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "modelo";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

				Swal.fire({
						  icon: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "modelo";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarModelo(){
		if(isset($_GET["idModelo"])){
			$tabla =$_GET["ruta"];
			$datos = $_GET["idModelo"];
			$respuesta = Modelomodelo::mdlBorrarModelo($tabla, $datos);
			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					icon: "success",
					title: "El modelo ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function(result){
								if (result.value) {

								window.location = "modelo";

								}
							})

				</script>';

			}

		}

	}




}
