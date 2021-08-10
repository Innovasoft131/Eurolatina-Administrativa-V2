<?php

if(isset($_GET["fechaInicial"])){
    error_reporting(0);
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
}else{
    $fechaInicial = null;
    $fechaFinal = null;
}
    
    $modelos = ControladorGeneral::cntModelosTerminados($fechaInicial, $fechaFinal);
    $modelosMaquinas = ControladorGeneral::cntModelosTerminadosMaquinas($fechaInicial, $fechaFinal);
    $modelosPlanchado = ControladorGeneral::cntModelosTerminadosPlanchado($fechaInicial, $fechaFinal);
    $totalModelo = 0;
    $totalModeloMaquinas = 0;
    $totalModeloPlanchado = 0;


    if(isset($modelos)){
        if($modelos[0]["cantidadTerminada"] == null){
            $totalModelo = 0;
        }else{
            $totalModelo = $modelos[0]["cantidadTerminada"] ;
        }
    
    }

    if(isset($modelosMaquinas)){
        if($modelosMaquinas[0]["cantidadTerminadaMaquina"] == null){
            $totalModeloMaquinas = 0;
        }else{
            $totalModeloMaquinas = $modelosMaquinas[0]["cantidadTerminadaMaquina"] ;
        }
    }
    if(isset($modelosPlanchado)){
        
        if($modelosPlanchado[0]["cantidadTerminadaPlanchado"] == null){
            $totalModeloPlanchado = 0;
            
        }else{
            $totalModeloPlanchado = $modelosPlanchado[0]["cantidadTerminadaPlanchado"] ;
            
        }
    }

    


?>

<div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-socks"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Modelos terminados</span>
            <span class="info-box-number">
                <?php echo number_format($totalModelo); ?>
            </span>
        </div>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="info-box">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dumpster"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Cantidad en Maquinas</span>
            <span class="info-box-number">
                <?php echo number_format($totalModeloMaquinas); ?>
            </span>
        </div>
    </div>
</div>
<!-- ./col -->
 <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="info-box">
        <span class="info-box-icon bg-success  elevation-1"><i class="fab fa-steam-symbol"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Cantidad en Planchado</span>
            <span class="info-box-number">
                <?php echo number_format($totalModeloPlanchado); ?>
            </span>
        </div>
    </div>
</div>
<!-- ./col -->
