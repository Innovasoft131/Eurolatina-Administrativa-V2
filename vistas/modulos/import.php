<?php
require './Classes/PHPExcel/IOFactory.php';
require './Classes/PHPExcel/Shared/Date.php';
require './Classes/PHPExcel.php';
require './modelos/conexionImport.php';
echo '<div class="container text-center">';
if (isset($_FILES["archivo"])){
        $targetPath = 'vistas/uploads/' . $_FILES['archivo']['name'];
		echo "<div>";
if (move_uploaded_file($_FILES['archivo']['tmp_name'], $targetPath)) {
	echo '<script>

	Swal.fire({

		icon: "success",
		title: "¡El Archivo Se Importo Correctamente!",
		showConfirmButton: true,
		confirmButtonText: "Cerrar"

	}).then(function(result){
	});

	</script>';
    } else {
		echo '<script>

		Swal.fire({

				icon: "error",
				title: "¡Hubo Un Error Al Importar!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"

			}).then(function(result){
			});

		</script>';
    }
    echo "</div>";
}
echo '</div>';
$archivo = 'vistas/uploads/import.xlsm';
$objPHPExcel = PHPExcel_IOFactory::load($archivo);
$hojas = $objPHPExcel->getSheetCount();
for ($i = 0; $i <= $hojas - 1; $i++) {
	$objPHPExcel->setActiveSheetIndex($i);
	$numRows = $objPHPExcel->setActiveSheetIndex($i)->getHighestRow();
echo '<div class="container">
		<table class="table">
		<tr>
			<td>Modelo</td>
			<td>Talla</td>
			<td>Color Primario</td>
            <td>Color Secundario</td>
            <td>Color Terciario</td>
            <td>Cantidad</td>
			<td>Descripcion</td>
		</tr>';
        $cliente = $objPHPExcel->getActiveSheet()->getCell('B1');
        $date = $objPHPExcel->getActiveSheet()->getCell('B2');
        $InvDate= $date->getValue();
        if(PHPExcel_Shared_Date::isDateTime($date)) {
            $InvDate = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate));
        }
        $fechaa = $objPHPExcel->getActiveSheet()->getCell('B19');
for ($j=4; $j <= $numRows ; $j++) {
	$modelo = $objPHPExcel->getActiveSheet()->getCell('A'.$j);
	$talla = $objPHPExcel->getActiveSheet()->getCell('B'.$j);
	$color1 = $objPHPExcel->getActiveSheet()->getCell('C'.$j);
    $color2 = $objPHPExcel->getActiveSheet()->getCell('D'.$j);
	$color3 = $objPHPExcel->getActiveSheet()->getCell('E'.$j);
	$cantidad = $objPHPExcel->getActiveSheet()->getCell('F'.$j);
	$descripcion = $objPHPExcel->getActiveSheet()->getCell('G'.$j);
	echo "<tr>";
	echo "<td>".$modelo."</td>";
	echo "<td>".$talla."</td>";
	echo "<td>".$color1."</td>";
    echo "<td>".$color2."</td>";
	echo "<td>".$color3."</td>";
	echo "<td>".$cantidad."</td>";
	echo "<td>".$descripcion."</td>";
	echo "</tr>";
	echo "</div>";
	// Validar si existe o no el usuario, Si existe continuar con la importacion, si no, llevar a pantalla registro de cliente
	$insertModelo = "INSERT into modelo (nombre) SELECT * FROM (SELECT '$modelo') AS tmp WHERE NOT EXISTS (SELECT nombre FROM modelo WHERE nombre = '$modelo') LIMIT 1;";
	$resultModelo = mysqli_query($conn, $insertModelo);
	$nombrePieza = $modelo.$talla;
	$insertPieza = "INSERT into pieza (idModelo, nombre, talla, precio, descripcion) value ((select id from modelo where nombre = '$modelo'), '$nombrePieza', '$talla', 56, '$descripcion')";
	$resultPieza = mysqli_query($conn, $insertPieza);
	//$insertPedido ="INSERT into pedidos (idcliente, idPieza, nombrePieza, cantidad, precio, colorPrimario, colorSecundario, colorTerciario, estado, talla) value ((select id from clientes where nombre = '$cliente'),(select id from pieza where nombre = '$nombrePieza'),'$modelo', '$cantidad', 56, '$color1','$color2','$color3', 0, '$talla')";
	//$resultPedido = mysqli_query($conn, $insertPedido);
	/* $sql = "SELECT id from pedidos";
	$insertPrimerModulo = ""
	if($resultado = mysqli_query($conn, $sql)){
		while ($fila = $resultado->fetch_row()){
		}
	}*/
}
echo "</table>";
echo "Cliente: ".$cliente;
echo "<br>";
echo "Fecha: ". $InvDate;
echo "<br>";
echo $i+1;
echo '<hr style="border-color:red;">';
}

?>