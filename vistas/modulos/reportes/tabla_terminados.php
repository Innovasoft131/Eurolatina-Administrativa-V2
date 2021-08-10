<?php

if(isset($_GET["fechaInicial"])){
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
}else{
    $fechaInicial = null;
    $fechaFinal = null;
}

$reporteTerminados = ControladorGeneral::cntModelosTerminadosTabla($fechaInicial, $fechaFinal);



$hoy = date("Y-m-d H:i:s");;

?>


<div class="table-responsive">
    <table class="table  table-bordered table-striped   tablas " >
        <thead>
            <tr>
                <th>No. Pedido</th>
                <th>Cliente</th>
                <th>Fecha del inicio</th>
                <th>Fecha Actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($reporteTerminados as $key => $value) {
                echo '<tr>
                        <td>'.$value["idPedido"].'</td>
                        <td>'.$value["cliente"].'</td>
                        <td>'.$value["fechainicio"].'</td>
                        <td>'.$hoy.'</td>
                        <td><button class="btn btn-dark btnMostrarReporteTerminados" idPedido="'.$value["idPedido"].'" hoy="'.$hoy.'"  style="background: rgb(255 136 2); border: 0px solid ;" data-toggle="modal" data-target="#mostrarReporteTerminadospdf"><i class="fas fa-eye"></i></button></td>
                    </tr>';
            }
        ?>
                

                
                
               
                         
        </tbody>
    </table>
</div>


<!-- Modal Mostrar Pedidos -->
<div class="modal fade" id="mostrarReporteTerminadospdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLongTitle"></h5>
        <button type="button" class="close cerrarPdftablaTerminados" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                
        <object class="PDFdoc" id="mostrarReporteTerminadoPdf" name="mostrarReporteTerminadoPdf"  width="100%" height="500px" type="application/pdf" data="#"></object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cerrarPdftablaTerminados" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>