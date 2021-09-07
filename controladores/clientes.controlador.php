<?php

class ControladorClientes{

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoUsuario"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
               preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) ){

			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/clientes/".$_POST["nuevoUsuario"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/clientes/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/clientes/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "clientes";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombre" => $_POST["nuevoNombre"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar,
					           "foto"=>$ruta,
							   "correo" => $_POST["nuevoCorreo"],
                               "telefono" => $_POST["nuevoTelefono"],
                               "direccion" => $_POST["nuevoDireccion"],
							   "empresa" => $_POST["nuevoEmpresa"],
							   "web" => $_POST["nuevoWeb"],
							   "tipo" => $_POST["nuevoTipo"]);
				
				$respuesta = Modeloclientes::mdlIngresarCliente($tabla, $datos);

				
			
				if($respuesta == "ok"){
					if($_POST["modelo"] == "oportunidad"){
					
						echo '<script>
						Swal.fire({
	
							icon: "success",
							title: "¡El Cliente ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
	
						}).then(function(result){
	
							if(result.value){
							
								window.location = "oportunidad";
								$("#opofolio").val("'.$_POST["reFolio"].'");
								$("#opoEmpleado").val("'.$_POST["reEmpleado"].'");
	
							}
	
						});
					
	
						</script>';
						

					}else{
						
						echo '<script>

						Swal.fire({
	
							icon: "success",
							title: "¡El Cliente ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
	
						}).then(function(result){
	
							if(result.value){
							
								window.location = "clientes";
	
							}
	
						});
					
	
						</script>';
						
					}



				}	


			}else{
				
				echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

				</script>';
				

			}


		}


	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarclientes($item, $valor){

		$tabla = "clientes";

		$respuesta = Modeloclientes::MdlMostrarclientes($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarCliente($tabla, $valor){
        $item = "nombre";
        $respuesta = Modeloclientes::MdlMostrarCliente($tabla, $item, $valor);

		return $respuesta;

    }

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarCliente(){
	
		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"]) ){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/clientes/".$_POST["editarUsuario"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/clientes/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/clientes/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "clientes";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

							Swal.fire({
									  icon: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										//window.location = "clientes";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

                $datos = array(
				"id"=> $_POST["id"],
				"nombre" => $_POST["editarNombre"],
				"usuario" => $_POST["editarUsuario"],
				"password" => $encriptar,
				"correo" => $_POST["editarCorreo"],
                "telefono" => $_POST["editarTelefono"],
                "direccion" => $_POST["editarDireccion"],
				"foto"=>$ruta);

				$respuesta = Modeloclientes::mdlEditarCliente($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  icon: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

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

							window.location = "clientes";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			if($_GET["fotoCliente"] != ""){

				unlink($_GET["fotoCliente"]);
				rmdir('vistas/img/clientes/'.$_GET["usuario"]);

			}

			$respuesta = Modeloclientes::mdlBorrarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					icon: "success",
					title: "El cliente ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}

		}

	}



}
