  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reporte de modelos defectuosos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Reporte de modelos defectuosos</li>
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
                  <label for="fechaInicialDefectuosas">Fecha Inicial:</label>
                  <input type="date" class="form-control"  name="fechaInicialDefectuosas" id="fechaInicialDefectuosas">
                  
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-floating">
                  <label for="fechaFinalDefectuosas">Fecha Final:</label>
                  <input type="date" class="form-control"  name="fechaFinalDefectuosas" id="fechaFinalDefectuosas">
                  
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-floating">
                  <input type="button" class="btn btn-info" style="margin-top: 33px;" id="generarReporteDefectuosas" value="Generar Reporte">
                </div>
              </div>



            </div>


          </div>


          
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
                <?php
                  include "reportes/grafica_piezas.php";
                ?>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <?php 
                include "reportes/tabla_piezas.php";
              ?>
            </div>
          </div>
        </div>

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>





