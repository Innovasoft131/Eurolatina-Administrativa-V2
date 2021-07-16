<?php
class ControladorColores{

    static public function ctrinsertColor(){
        if(isset($_POST["nuevoColor"]) ||
            isset($_POST["nuevoCodigo"]) ){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoColor"] ||
                preg_match('/^[a-zA-Z9-0ñÑáéíóúÁÉÍÓÚ# ]+$/', $_POST["nuevoCodigo"]) )){
                    
                    $tabla = "color";

                    $datos = array(
                        "color" => $_POST["nuevoColor"],
                        "codigo" => $_POST["nuevoCodigo"]
                    );

                    $respuesta = ColoresModelo::mdlInsert($tabla, $datos);

                    if($respuesta == "ok"){
                        echo '<script>

                        Swal.fire({

                            icon: "success",
                            title: "¡El color ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){

                                window.location = "colores";

                            }

                        });

                        </script>';
                    }
                }else{
                    echo '<script>

                    Swal.fire({
    
                            icon: "error",
                            title: "¡El color no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
    
                            if(result.value){
                                window.location = "colores";
    
                            }
    
                        });
    
                    </script>';
                }

        }
    }

    static public function ctrCRUDObtenerColores($item, $valor){

        $tabla = "color";

        $respuesta = ColoresModelo::mdlCRUDObtenerColores($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrObtenerColores($item, $valor){

        $tabla = "color";

        $respuesta = ColoresModelo::mdlObtenerColores($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrObtenerColor($item, $valor){

        $tabla = "color";

        $respuesta = ColoresModelo::mdlObtenerColor($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrEditarColor(){
        if(isset($_POST["editarColor"]) ||
            isset($_POST["editarCodigo"]) ){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarColor"] ||
                preg_match('/^[a-zA-Z9-0ñÑáéíóúÁÉÍÓÚ# ]+$/', $_POST["editarCodigo"]) )){

                    $tabla = "color";

                    $datos = array(
                        "id" => $_POST["idColor"],
                        "color" => $_POST["editarColor"],
                        "hexadecimal" => $_POST["editarCodigo"]
                    );

                    $respuesta = ColoresModelo::mdlEditarColor($tabla, $datos);

                    if($respuesta == "ok"){
                        echo '<script>

                        Swal.fire({

                            icon: "success",
                            title: "¡El color ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){

                                window.location = "colores";

                            }

                        });

                        </script>';
                    }

                }else{
                    echo '<script>

                    Swal.fire({
    
                            icon: "error",
                            title: "¡El color no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
    
                            if(result.value){
                                window.location = "colores";
    
                            }
    
                        });
    
                    </script>';
                }
            }

    }

    // eliminar Color
    static public function ctrEliminarColor(){
        if(isset($_GET["idColor"])){

            $tabla = "color";

            $datos = $_GET["idColor"];

            $respuesta = ColoresModelo::mdlEliminarColor($tabla, $datos);

            if($respuesta == "ok"){
                echo '<script>

                Swal.fire({

                    icon: "success",
                    title: "¡El color ha sido borrado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){

                        window.location = "colores";

                    }

                });

                </script>';
            }

        }
    }
}
