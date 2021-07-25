<?php

class ControladorOportunidad{
    /*=============================================
	INGRESO DE Oportunidad
	=============================================*/
    static public function ctrInsertOportunidad(){

        if(isset($_POST["opoEmpleado"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["opofolio"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ., ]+$/', $_POST["nuevoEmpresa"]) &&   
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ., ]+$/', $_POST["opoServicio"]) &&
            preg_match('/^[0-9., ]+$/', $_POST["opoCantidad"]) &&
            preg_match('/^[0-9., ]+$/', $_POST["opoImporte"])){
                $tabla = "oportunidad";
                $datos = array(
                    "codigo" => $_POST["opofolio"],
                    "idUsuario" => $_POST["opoEmpleado"],
                    "idCliente" => $_POST["opoCliente"],
                    "empresa" => $_POST["nuevoEmpresa"],
                    "servicio" => $_POST["opoServicio"],
                    "idPieza" => $_POST["opoModelo"],
                    "cantidad" => $_POST["opoCantidad"],
                    "importe" => $_POST["opoImporte"],
                    "idPorcentaje" => $_POST["opoEtapa"],
                    "idAccion" => $_POST["opoAccion"],
                    "descripcion" => $_POST["opoDescripcion"],
                );

                $respuestas = ModeloOportunidad::mdlInsertOportunidad($tabla,$datos);

                
                if($respuestas == "ok"){
                    
                    echo '<script>
                    localStorage.removeItem("folio");
                    localStorage.removeItem("Idempleado");
                    localStorage.removeItem("empleado");
					Swal.fire({

						icon: "success",
						title: "¡la oportunidad ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "oportunidad";

						}

					});

					</script>';
                    
                }

            }else{
                
                echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡Los datos ingresados no pueden ir vacíos o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
							window.location = "oportunidad";

						}

					});

				</script>';
              
            }

        }
    }

    /*=============================================
	MOSTRAR OPORTUNIDAD
	=============================================*/

	static public function ctrMostrarOportunidad($item, $valor){

		$tabla = "oportunidad";
        
		$respuesta = ModeloOportunidad::mdlMostrarOportunidad($tabla, $item, $valor);
        
		return $respuesta;
	}
}