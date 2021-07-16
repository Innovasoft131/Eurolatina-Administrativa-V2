<?php

if(isset($_GET["fechaInicial"])){
    error_reporting(0);
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
}else{
    $fechaInicial = null;
    $fechaFinal = null;
}

$reportePiezas = ControladorPiezas::reportePiezasGrafica($fechaInicial, $fechaFinal);

//var_dump($reportePiezas);

$arrayFechas = array();
$arrayVentas = array();
$sumaPiezas = array();
$noRepetirFechas = array();

foreach ($reportePiezas as $key => $value) {

	#Capturamos sólo el año y el mes
	$fecha = substr($value["fecha"],0,10);


	#Introducir las fechas en arrayFechas
	array_push($arrayFechas, $fecha);

	#Capturamos las Pieza
	$arrayPiezas = array($fecha => $value["cantidad"]);
    
    
	#Sumamos los pagos que ocurrieron el mismo mes
	foreach ($arrayPiezas as $key => $value) {
		
		$sumaPiezas[$key] += $value;
	}
    
    
   
}


$noRepetirFechas = array_unique($sumaPiezas);




?>

<!-- grafica -->


<div class="card bg-gradient-info">
    <div class="card-header border-0" style="background-color: #6c757d; border-color:  #6c757d;">
        <h3 class="card-title">
            <i class="fas fa-th mr-1"></i> Gráfica de Piezas
        </h3>
    </div>
    <div class="card-body" style="background-color: #6c757d; border-color:  #6c757d;">
        <div class="chart" id="line-chart-pieza" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; background-color: #6c757d; border-color:  #6c757d;"></div>
    </div>
</div>

<script>
// Sales graph chart

var line = new Morris.Line({
    element          : 'line-chart-pieza',
    resize           : true,
    data             : [
        <?php

    if( count($arrayPiezas)  != 0){
        
	    foreach($sumaPiezas as $key => $value){

	    	echo '{ y: "'.$key.'" , pieza: "'.$value.'" },';


	    }
        echo '{ y: "'.$key.'" , pieza: "'.$value.'" }';

    }
    
    else{

       echo "{ y: '0', pieza: '0' }";

    }
    
            
        ?>

    ],
    xkey             : 'y',
    ykeys            : ['pieza'],
    labels           : ['pieza'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });


</script>