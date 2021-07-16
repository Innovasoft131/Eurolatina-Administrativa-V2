<?php
class ControladorPiezas{

    static public function obtenerModelo($valor, $tabla){

        $item = "nombre";

        $respuesta = ModeloPiezas::MdlObtenerModelo($tabla, $item, $valor);

        return $respuesta;
    }

    static public function obtenerNombrePieza($tabla, $valor){
        // validar nombre de pieza
        $item = "nombre";
        $nombrePieza = ModeloPiezas::ontener($tabla, $item, $valor);

        return $nombrePieza;
    }
    static public function ctrInsert(){
        $colores = array();
        $tallas = array();
       
        if(isset($_POST["nuevoNombre"]) && isset($_POST["nuevoModelo"]) && isset($_POST["nuevotalla"]) || 
            isset($_POST["nuevodescripcion"]) ||
            isset($_POST["colores"]) || isset($_POST["nuevoModelo"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])  || 
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevodescripcion"]) ||
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoModelo"]) ||
                preg_match('/^[0-9 ]+$/', $_POST["agregarPorMinuto"])){

                    $colores = $_POST["colores"];
                    $tallas = $_POST["tallas"];
                   
                    $ruta = "";
                    // validar imagen 
                    if(isset($_FILES["nuevaFoto"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                        
                        $nuevoAncho = 500;
                        $nuevoAlto = 500;

                        /*=============================================
					    Se crea el directorio para la imagen de la pieza
					    =============================================*/

                        $directorio = "vistas/img/productos/".$_POST["nuevoNombre"];
                        mkdir($directorio, 0755);

                        if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

                            /*=============================================
                            Se guarda la imagen en el directorio
                            =============================================*/
    
                            $aleatorio = mt_rand(100,999);
    
                            $ruta = "vistas/img/productos/".$_POST["nuevoNombre"]."/".$aleatorio.".jpg";
    
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
    
                            $ruta = "vistas/img/productos/".$_POST["nuevoNombre"]."/".$aleatorio.".png";
    
                            $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
    
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
    
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
    
                            imagepng($destino, $ruta);
    
                        }
                    }

                    // obtener id del mmodelo
                    $tabla = "modelo";
                    $valor = $_POST["nuevoModelo"];

                //    $idModelo = ModeloPiezas::ontenerid($tabla, $valor);


                    $tabla = "pieza";
                    $datos = array(
                        "nombre" => $_POST["nuevoNombre"],
                        "foto" => $ruta,
                        "porMinuto" => $_POST["agregarPorMinuto"],
                        "descripcion" => $_POST["nuevodescripcion"],
                        "colores" => $colores,
                        "tallas" => $tallas
                    );

                    if($colores != ""){
                        if($tallas != ""){
                            if($_POST["agregarPorMinuto"] != ""){
                                $respuesta = ModeloPiezas::mdlInsert($tabla, $datos);
                                if($respuesta == "ok"){
                                    echo '<script>
            
                                    Swal.fire({
                
                                        icon: "success",
                                        title: "¡El Modelo ha sido guarda correctamente!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                
                                    }).then(function(result){
                
                                        if(result.value){
                
                                            window.location = "piezas";
                
                                        }
                
                                    });</script>';
                                }else{
                                    echo '<script>
                
                                    Swal.fire({
                    
                                            icon: "error",
                                            title: "¡Error Interno al guardar la pieza!",
                                            showConfirmButton: true,
                                            confirmButtonText: "Cerrar"
                    
                                        }).then(function(result){
                    
                                            if(result.value){
                                                window.location = "piezas";
                    
                                            }
                    
                                        });
                    
                                    </script>';
                                }
                            }else{
                                echo '<script>
    
                                Swal.fire({
                
                                        icon: "error",
                                        title: "¡Minutos por pieza no puede ir vacío o llevar caracteres especiales!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                
                                    }).then(function(result){
                
                                        if(result.value){
                                            window.location = "piezas";
                
                                        }
                
                                    });
                
                                </script>';  
                            }
                            
                        }else{
                            echo '<script>
    
                            Swal.fire({
            
                                    icon: "error",
                                    title: "¡La talla de la pieza no puede ir vacío o llevar caracteres especiales!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
            
                                }).then(function(result){
            
                                    if(result.value){
                                        window.location = "piezas";
            
                                    }
            
                                });
            
                            </script>';    
                        }
                        
                    }else{
                        echo '<script>
    
                        Swal.fire({
        
                                icon: "error",
                                title: "¡El color de la pieza no puede ir vacío o llevar caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
        
                            }).then(function(result){
        
                                if(result.value){
                                    window.location = "piezas";
        
                                }
        
                            });
        
                        </script>';
                    }

                    
                   
                

                    


                    /*
                    $datos = array(
                        "idModelo" => $idModelo[0]["id"],
                        "nombre" => $_POST["nuevoNombre"],
                        "foto" => $ruta,
                        "porMinuto" => $_POST["agregarPorMinuto"],
                        "descripcion" => $_POST["nuevodescripcion"]
                    );

                    $respuesta = ModeloPiezas::mdlInsert($tabla, $datos);
                    

                    if($respuesta > 0 || !isset($respuesta)){

                        $tabla = "color";
                        $tablac = "colorPieza";
                        $tablat = "piezaTalla";
                        $tablam = "piezaModelo";
                        
                        foreach ($colores as $key => $value) {
                            $idColor = ModeloPiezas::ontenerid($tabla, $colores[$key]);
                            $datosc = array(
                                "idPieza" => $respuesta,
                                "idColor" => $idColor[0]["id"]
                            );
                            $insertColor = ModeloPiezas::insertColor($tablac, $datosc);

                        }

                        if($insertColor  == "ok"){
                            
                            foreach($tallas as $key => $value){
                                
                                $datosTalla = array(
                                    "idPieza" => $respuesta,
                                    "talla" => $tallas[$key]
                                );
                                
                                $insertalla = ModeloPiezas::insertTalla($tablat, $datosTalla);

                            
                            }

                            if($insertalla == "ok"){
                                echo '<script>

                                Swal.fire({
            
                                    icon: "success",
                                    title: "¡El Modelo ha sido guarda correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
            
                                }).then(function(result){
            
                                    if(result.value){
            
                                        window.location = "piezas";
            
                                    }
            
                                });
            
                                </script>';

                            }else{
                                echo '<script>
    
                                Swal.fire({
                
                                        icon: "error",
                                        title: "¡Error Interno al guardar tallas de la pieza!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                
                                    }).then(function(result){
                
                                        if(result.value){
                                            window.location = "piezas";
                
                                        }
                
                                    });
                
                                </script>';
                            }

                        }else{
                            echo '<script>
    
                            Swal.fire({
            
                                    icon: "error",
                                    title: "¡Error Interno al guardar color!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
            
                                }).then(function(result){
            
                                    if(result.value){
                                        window.location = "piezas";
            
                                    }
            
                                });
            
                            </script>';
                        }
                        
                       
                           



                        
                    }else{
                        echo '<script>
    
                        Swal.fire({
        
                                icon: "error",
                                title: "¡Error Interno al guardar la pieza!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
        
                            }).then(function(result){
        
                                if(result.value){
                                    window.location = "piezas";
        
                                }
        
                            });
        
                        </script>';
                    }
                    */
                    

                }else{
/*
                    echo '<script>
    
                    Swal.fire({
    
                            icon: "error",
                            title: "¡El nombre de la pieza no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
    
                            if(result.value){
                                window.location = "piezas";
    
                            }
    
                        });
    
                    </script>';
                    */
    
                }

        }
    }

    static public function ctrUpdate(){
        if(isset($_POST["editarNombre"]) || isset($_POST["editarModelo"]) || isset($_POST["tallasEditar"]) || 
            isset($_POST["editarDescripcion"]) ||
            isset($_POST["colores"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])  || 
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) ||
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarModelo"]) ||
                preg_match('/^[0-9 ]+$/', $_POST["editarPorMinuto"])){
                
                    $tallasEditar = $_POST["tallasEditar"];
                    $coloresEtidar = $_POST["colores"];
                    $insertColor = "";

                /*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DE LA PIEZA
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["editarNombre"];

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

						$ruta = "vistas/img/usuarios/".$_POST["editarNombre"]."/".$aleatorio.".jpg";

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

						$ruta = "vistas/img/usuarios/".$_POST["editarNombre"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}
                    // obtener id del mmodelo
                    /*
                    $tabla = "modelo";
                    $valor = $_POST["editarModelo"];

                    $idModelo = ModeloPiezas::ontenerid($tabla, $valor);

                    */
                    $tabla = "pieza";

                    
                    $insertalla = "";
                    $datos = array(
                        "id" => $_POST["idPieza"],
                        "nombre" => $_POST["editarNombre"],
                        "foto" => $ruta,
                        "porMin" => $_POST["editarPorMinuto"],
                        "descripcion" => $_POST["editarDescripcion"]
                    );

                    $respuesta = ModeloPiezas::mdlupdatePieza($tabla, $datos);

                    if($respuesta == 'ok'){
                        $tabla = "color";
                        $tablac = "colorPieza";
                        $tablat = "piezaTalla";
                        
                        foreach ($coloresEtidar as $key => $value) {
                            $idColor = ModeloPiezas::ontenerid($tabla, $coloresEtidar[$key]);

                            //verificar si existe 
                            $idPiezaColor = ModeloPiezas::ontenerIdAnd($tablac, $idColor[0]["id"], "idColor","idPieza", $_POST["idPieza"] );

                            
                            if($idPiezaColor[0]["id"] == ""){
                                $datosc = array(
                                    "idPieza" => $_POST["idPieza"],
                                    "idColor" => $idColor[0]["id"]
                                );
                                $insertColor = ModeloPiezas::insertColor($tablac, $datosc);
                            }
                            

                        }
                        
                            
                            
                       
                            if($insertColor == 'ok' || $respuesta == 'ok'){
                                
                                
                                foreach ($tallasEditar as $key => $value) {
    
        
                                    //verificar si existe 
                                    $idPiezaTalla = ModeloPiezas::ontenerIdAnd($tablat, $tallasEditar[$key], "talla", "idPieza", $_POST["idPieza"] );
                                    
                                    if(isset($idPiezaTalla[0]["id"])){
                                        
                               
                                            $datosTalla = array(
                                                "idPieza" => $_POST["idPieza"],
                                                "talla" => $tallasEditar[$key]
                                            );
                                            
                                        //    $insertalla = ModeloPiezas::insertTalla($tablat, $datosTalla);
                                            
    
                                        
                                    }

                                    
        
                                }
    
                            }

                            if( $respuesta == 'ok' || $insertColor == 'ok'){
                                
                                echo '<script>

                                Swal.fire({
            
                                    icon: "success",
                                    title: "¡El Modelo ha sido guarda correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
            
                                }).then(function(result){
            
                                    if(result.value){
            
                                        window.location = "piezas";
            
                                    }
            
                                });
            
                                </script>';
                                
                            }
                        
                       
                    }else{
                        echo '<script>
    
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Error al editar pieza!",
                            footer: ""
                          })
        
                        </script>';
                    }

                }

            }
    }

    static public function obtenerColor($valor, $tabla){

        $item = "nombre";

        $respuesta = ModeloPiezas::MdlObtenerModeloColor($tabla, $item, $valor);

        return $respuesta;
    }

    static public function obtenerPiezas($valor = null, $tabla = "pieza"){

        $item = null;

        $respuesta = ModeloPiezas::MdlObtenerModelo($tabla, $item, $valor);

        return $respuesta;
    }

    static public function obtenerPieza($valor = null, $tabla = "pieza"){

        $item = "id";

        $respuesta = ModeloPiezas::ontenerJoin($tabla, $item, $valor);

        return $respuesta;
    }

    static public function obtenerColores($tabla, $tabla2, $tabla3, $valor){

        $item = "id";

        $respuesta = ModeloPiezas::obtenerColores($tabla, $tabla2, $tabla3, $valor, $item);

        return $respuesta;
    }

    static public function obtenerTalla($tabla, $tabla2, $valor){

        $item = "id";

        $respuesta = ModeloPiezas::obtenerTalla($tabla, $tabla2, $valor, $item);

        return $respuesta;
    }

    static public function obtenerModelos($tabla, $tabla2, $valor){

        $item = "id";

        $respuesta = ModeloPiezas::obtenerModelos($tabla, $tabla2, $valor, $item);

        return $respuesta;
    }

    static public function eliminarColores($tabla, $valor){
        $item = "id";

        $respuesta = ModeloPiezas::mdlBorrarPieza($tabla, $valor, $item);

        $res = array(
            "estatus" =>  $respuesta
        );

        return $res;
    }

    static public function usuarios($valor){
        $item = "id";
        $tabla = "usuarios";

        $respuesta = ModeloPiezas::ontener($tabla, $item, $valor);


        return $respuesta;
    }

    static public function ctrBorrar(){
        if(isset($_GET["idPieza"])){
            $tabla ="pieza";
            $tablaColor ="colorPieza";
			$datos = $_GET["idPieza"];
            $idColor = "idPieza";
            $idPieza = "id";

            if($_GET["fotoPieza"] != ""){

				unlink($_GET["fotoPieza"]);
				rmdir('vistas/img/productos/'.$_GET["nombre"]);

			}
            $respuestaColor = ModeloPiezas::mdlBorrarPieza($tablaColor, $datos, $idColor);

            if($respuestaColor == "ok"){
                $respuesta = ModeloPiezas::mdlBorrarPieza($tabla, $datos, $idPieza);

                if($respuesta == "ok"){
    /*
                    echo'<script>
    
                    Swal.fire({
                        icon: "success",
                        title: "La pieza ha sido borrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                                    if (result.value) {
    
                                    window.location = "piezas";
                                    }
                                })
    
                    </script>';
                    */
    
                }
            }

        }
    }

    static public function reportePiezas($fechaInicial, $fechaFinal){

        $respuesta = ModeloPiezas::reportePiezas($fechaInicial, $fechaFinal);
    //    var_dump($respuesta);
        return $respuesta;
    }

    static public function reportePiezasDefectuosas($id){

        $respuesta = ModeloPiezas::reportePiezasDefectuosas($id);
    //    var_dump($respuesta);
        return $respuesta;
    }

    static public function reportePiezasDefectuosasUsuario($id){

        $respuesta = ModeloPiezas::reportePiezasDefectuosasUsuario($id);
    //    var_dump($respuesta);
        return $respuesta;
    }

    static public function reportePiezasGrafica($fechaInicial, $fechaFinal){

        $respuesta = ModeloPiezas::reportePiezasGrafica($fechaInicial, $fechaFinal);
    //    var_dump($respuesta);
        return $respuesta;
    }

    static public function reportePiezasUsuario($fechaInicial, $fechaFinal, $idUsuario){

        $respuesta = ModeloPiezas::reportePiezasUsuario($fechaInicial, $fechaFinal, $idUsuario);

        return $respuesta;
    }

    static public function reporteUsuario($fechaInicial, $fechaFinal){

        $respuesta = ModeloPiezas::reporteUsuario($fechaInicial, $fechaFinal);

        return $respuesta;
    }

    static public function insertTalla($tabla, $datos){

        $respuesta = ModeloPiezas::insertTalla($tabla, $datos);
        
        
        return $respuesta;
    }

    // descargar reporte 
    static public function descargarReporte(){
        $tabla = "piezas";
        $item = null;
        $valor = null;
        if(isset($_GET["reporte"])){
            if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){
                $reportePiezas = ModeloPiezas::reportePiezas($fechaInicial, $fechaFinal);
            }else{
            //    $reportePiezas = ModeloPiezas::MdlObtenerModelo($tabla, $item, $valor);
            }

            $name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'> 

            <tr> 
            <td style='font-weight:bold; border:1px solid #eee;'>#</td> 
            <td style='font-weight:bold; border:1px solid #eee;'>Pieza</td>
            <td style='font-weight:bold; border:1px solid #eee;'>Modelo</td>
            <td style='font-weight:bold; border:1px solid #eee;'>Color</td>
            <td style='font-weight:bold; border:1px solid #eee;'>Cantidad</td>	
            </tr>");
/*
            foreach ($reportePiezas as $key => $value) {
                echo '<tr>
                <td style="border:1px solid #eee;">'.$key.'</td>
                <td style="border:1px solid #eee;">'.$value["nombre_pieza"].'</td>
                <td style="border:1px solid #eee;">'.$value["nombre_modelo"].'</td>
                <td style="border:1px solid #eee;">'.$value["color"].'</td>
                <td style="border:1px solid #eee;">'.$value["cantidad_pieza"].'</td>
            </tr>';
            }
            */
            echo "</table>";
        }
    }



}
?>