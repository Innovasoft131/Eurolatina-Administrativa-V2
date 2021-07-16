<?php

if(isset($_GET["fechaInicial"])){
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
}else{
    $fechaInicial = null;
    $fechaFinal = null;
}

$reportePiezas = ControladorPiezas::reportePiezas($fechaInicial, $fechaFinal);


$arrayFechas = array();
$arrayVentas = array();
$sumaPiezas = array();

foreach ($reportePiezas as $key => $value) {

	#Capturamos sólo el año y el mes
	$fecha = substr($value["fecha"],0,7);

	#Introducir las fechas en arrayFechas
	array_push($arrayFechas, $fecha);

	#Capturamos las Pieza
	$arrayPiezas = array($fecha => $value["cantidad_pieza"]);
    
    
	#Sumamos los pagos que ocurrieron el mismo mes
	foreach ($arrayPiezas as $key => $value) {
		
		$sumaPiezas[$key] += $value;
	}
    

}


$noRepetirFechas = array_unique($arrayFechas);

$estacion = "";

?>


<div class="table-responsive">
    <table class="table  table-bordered table-striped   tablas " >
        <thead>
            <tr>
                <th style="width:10px">#</th>
                <th>Empleado</th>
                <th>Estación  </th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($reportePiezas as $key => $value) {
            $fecha = substr($value["fecha"],0,7);
            echo '<tr>
                    <td>'.$key.'</td>
                    <td>'.$value["empleado"].'</td>';
            if($value["idsegundoModulo"] != NULL ){

                echo '<td>Maquinas</td>
                <td><button class="btn btn-dark btnMostrarDefectuosasPdf" estacion="segundoModulo" idsegundoModulo="'.$value["idsegundoModulo"].'" empleado="'.$value["empleado"].'" idDefectuosas="'.$value["id"].'" style="background: rgb(255 136 2); border: 0px solid ;" data-toggle="modal" data-target="#mostrarDefectuosasPdf"><i class="fas fa-eye"></i></button></td>';
            }else if($value["idtercerModulo"] != NULL ){
                echo '<td>Planchado</td>
                <td><button class="btn btn-dark btnMostrarDefectuosasPdf" estacion="tercerModulo" idtercerModulo="'.$value["idtercerModulo"].'" empleado="'.$value["empleado"].'" idDefectuosas="'.$value["id"].'" style="background: rgb(255 136 2); border: 0px solid ;" data-toggle="modal" data-target="#mostrarDefectuosasPdf"><i class="fas fa-eye"></i></button></td>';
            }
            echo '</tr>';
        }
        ?>
             
        </tbody>
    </table>
</div>


<!-- Modal Mostrar piezas Defectuosas -->
<div class="modal fade" id="mostrarDefectuosasPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLongTitle"></h5>
        <button type="button" class="close cerrarPdfDefectuosas" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                
        <object class="PDFdoc" id="mostrarPiezasDefectuosaspdf" name="mostrarPiezasDefectuosaspdf"  width="100%" height="500px" type="application/pdf" data="#"></object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cerrarPdfDefectuosas" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>