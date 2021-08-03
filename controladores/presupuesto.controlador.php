<?php

class ControladorPresupuesto{
    /*=============================================
	INGRESO DE UNIDAD
	=============================================*/
    static public function ctrInsertPresupuesto(){
        if(isset($_POST["idOportunidad"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["importePresupuesto"])){
                $tabla = "presupuesto";
                $datos = array(
                    "idOportunidad" => $_POST["idOportunidad"],
					"idUsuario" => $_SESSION["id"],
					"idCliente" => $_POST["idclientePresupuesto"],
					"empresa" => $_POST["empresaPresupuesto"],
					"importe" => $_POST["importePresupuesto"],
					"idEstado" => $_POST["estadoCliente"],
                );

                $respuestas = ModeloPresupuesto::mdlInsertPresupuesto($tabla,$datos);

                if($respuestas == "ok"){
                    echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡Se ha inició el proceso!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "presupuesto";

						}

					});

					</script>';
                }

            }else{
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El codigo no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "presupuesto";

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



	static public function ctrMostrarPresupuestoJoin($item, $valor, $item2 , $valor2){

		$tabla = "oportunidad";
        
		$respuesta = ModeloPresupuesto::mdlMostrarPresupuestoJoin($tabla, $item, $valor, $item2 , $valor2);
        
		return $respuesta;
	}

	static public function ctrMostrarPresupuesto($item = "", $valor = ""){
		if($_GET["oportunidad"]){

			$tabla = "oportunidad";
			$item = "id";
			$valor = $_GET["oportunidad"];

			
        
			$respuesta = ModeloPresupuesto::mdlMostrarPresupuesto($tabla, $item, $valor);
		}else{
			$tabla = "oportunidad";
        
			$respuesta = ModeloPresupuesto::mdlMostrarPresupuesto($tabla, $item, $valor);
		}


        
		return $respuesta;
	}

	static public function ctrMostrarPresupuestoEnProceso($item = "", $valor = ""){
		if($_GET["oportunidad"]){

			$tabla = "oportunidad";
			$item = "id";
			$valor = $_GET["oportunidad"];

			
        
			$respuesta = ModeloPresupuesto::mdlMostrarPresupuestoProceso($tabla, $item, $valor);
		}else{
			$tabla = "oportunidad";
        
			$respuesta = ModeloPresupuesto::mdlMostrarPresupuestoProceso($tabla, $item, $valor);
		}


        
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


	/*=============================================
	MOSTRAR PRESUPUESTO EN PROCESO
	=============================================*/

	static public function ctrMostrarPresupuestosProceso($item, $valor){

		$tabla = "presupuesto";
        
		$respuesta = ModeloPresupuesto::mdlMostrarPresupuestosProceso($tabla, $item, $valor);
		
		return $respuesta;
	}

	/*=============================================
	Borrar PRESUPUESTO EN PROCESO
	=============================================*/

	static public function ctrBorrarPresupuesto(){

		if(isset($_GET["idOportunidad"])){

			$tabla ="oportunidad";
			$datos = $_GET["idOportunidad"];


			$respuesta = ModeloPresupuesto::mdlBorrarPresupuesto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					icon: "success",
					title: "El presupuesto ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "Ppendientes";
								}
							})

				</script>';

			}

		}
	}
}