  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modelos terminados</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Modelos terminados</li>
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
                  <label for="fechaInicialTerminados">Fecha Inicial:</label>
                  <input type="date" class="form-control"  name="fechaInicialTerminados" id="fechaInicialTerminados">
                  
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-floating">
                  <label for="fechaFinalTerminados">Fecha Final:</label>
                  <input type="date" class="form-control"  name="fechaFinalTerminados" id="fechaFinalTerminados">
                  
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-floating">
                  <input type="button" class="btn btn-info" style="margin-top: 33px;" id="btngenerarReporteGeneral" value="Generar Reporte">
                  <!-- button type="button" class="btn btn-success" style="margin-top: 33px;"><i class="fas fa-file-excel"></i></button -->
                </div>
              </div>



            </div>


            


          </div>


          
        </div>
        <div class="card-body">
          <div class="row">

                <?php
                    include "reportes/cajas_terminados.php";
                ?>

          </div>
          <div class="row">

            <?php
              include "reportes/tabla_terminados.php";
            ?>

          </div>
        </div>

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>





