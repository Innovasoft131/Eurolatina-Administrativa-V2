<?php
if(isset($_GET["fechaInicial"])){
    error_reporting(0);
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
    $modulo = $_GET["modulo"];
}else{
    $fechaInicial = null;
    $fechaFinal = null;
    $modulo = null;
}

$reporteProblemas = problemasControlador::reporteProblemas();




?>

<div class="table-responsive">
    <table class="table  table-bordered table-striped   tablas " >
        <thead>
            <tr>
                <th>No. problema</th>
                <th>No. Pedido</th>
                <th>Fuera de Producción</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
             <?php
             foreach ($reporteProblemas as $key => $value) {
                 echo '<tr>
                         <td>'.$value["id"].'</td>';

                         if($value["idPedido"]== ""){
                            echo '<td><button class="btn btn-danger btn-xs">No asignado</button></td>';
                         }else{
                            echo '<td>'.$value["idPedido"].'</td>';
                         }

                         if($value["idPedido"]== ""){
                            echo '<td><button class="btn btn-success btn-xs">Asignado</button></td>';
                         }else{
                           echo '<td><button class="btn btn-danger btn-xs">No asignado</button></td>';
                         }

                         echo '<td><button class="btn btn-dark btnMostrarReporteProblemas" idPedido="'.$value["idPedido"].'"  id="'.$value["id"].'"  style="background: rgb(255 136 2); border: 0px solid ;" data-toggle="modal" data-target="#mostrarReporteErrorespdfp"><i class="fas fa-eye"></i></button></td>';

             }
             ?>
             </tr>
        </tbody>
    </table>
</div>


<!-- Modal Mostrar Pedidos -->
<div class="modal fade" id="mostrarReporteErrorespdfp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLongTitle"></h5>
        <button type="button" class="close cerrarPdftablaProblemas" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                
        <object class="PDFdoc" id="mostrarReporteProblemasPdf" name="mostrarReporteMaquinasPdf"  width="100%" height="500px" type="application/pdf" data="#"></object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cerrarPdftablaProblemas" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>