  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reporte por Empleado</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Reporte por Empleado</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="form-group">
          <div class="row g-2">
              <div class="col-md-2">
                <div class="form-floating">
                  <label for="fechaInicialDeUsuario">Fecha Inicial:</label>
                  <input type="date" class="form-control"  name="fechaInicialDeUsuario" id="fechaInicialDeUsuario">
                  
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-floating">
                  <label for="fechaFinalDeUsuario">Fecha Final:</label>
                  <input type="date" class="form-control"  name="fechaFinalDeUsuario" id="fechaFinalDeUsuario">
                  
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-floating">
                  <input type="button" class="btn btn-info" style="margin-top: 33px;" id="btngenerarReporteDeUsuario" value="Generar Reporte">
                </div>
              </div>



            </div>
            <!-- div class="row">
              <div class="col-10">
                <button type="button" class="btn btn-info" id="btndaterangeusuario">
                  <span>
                      <i class="fas fa-calendar"></i> Rando de fecha
                  </span>
                  <i class="fas fa-caret-down"></i>
                </button>
              </div>
              <div class="col-1">
              <?php
              /*
                    if(isset($_GET["fechaInicial"])){
                      echo '<a href="vistas/modulos/descargar-reportes.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';
                    }else{
                      echo '<a href="vistas/modulos/descargar-reportes.php?reporte=reporte">';
                    }
                    */
                  ?>
                <button hidden type="button" class="btn btn-secondary" id="btnDescargar">

                  
                  <span>
                    <i class="fas fa-download"></i> 
                  </span>
                </button>
              </div>
            </div -->


          </div>


          
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <?php 
                include "reportes/tabla_usuarios.php";
              ?>
            </div>
          </div>
        </div>

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

<!-- Modal Mostrar Reporte Usuario -->
<div class="modal fade" id="mostrarReporteDesglose" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                
        <object class="PDFdoc" id="mostrarReporteUsuariopdf" name="mostrarReporteUsuariopdf" data="#"  width="100%" height="500px" type="application/pdf" data="#"></object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary " data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



