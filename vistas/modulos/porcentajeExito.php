  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Porcentaje de Exitó</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">PorcentajeExitó</li>
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
          
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarUnidad"> <i class="fas fa-plus"></i> Agregar Porcentaje </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Etapa</th>
                  <th>Exitó</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                    <?php   
                        $item = null;
                        $valor = null;
                        
                        $unidad = PorcentajeExitoControlador::ctrMostrarPorcentajes($item, $valor);
                        
                        foreach ($unidad as $key => $value) {
                         
                            echo '<tr>
                                    <td>'.$key.'</td>
                                    <td>'.$value['etapa'].'</td>
                                    <td>'.$value['exito'].'</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btnEditaridPorcentaje" idporcentaje='.$value['id'].'  data-toggle="modal" data-target="#modalEditaridUnidad"><i class="fas fa-pen"></i></button>
                                            <button class="btn btn-danger btnEliminarPorcentaje" idporcentaje='.$value['id'].'><i class="fa fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>';
                        }
                    ?>   
                </tbody>
              </table>
            </div>
        </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>


  <!-- modal -->

  <!-- Modal Registro -->
<div class="modal fade" id="agregarUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background: #3c8dbc; color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Porcentaje Exitó</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
                <!-- Entrada de Nombre de unidad -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-ruler-horizontal"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="exito" id="exito" placeholder="Exitó" require>
                </div>
                <div class="input-group mt-2">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-ruler-horizontal"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="etapa" id="etapa" placeholder="Etapa" require>
                </div>
              </div>
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: #3c8dbc; color: white">Guardar</button>
          </div>
          <?php
                $crearPorcentaje = new PorcentajeExitoControlador();
                $crearPorcentaje -> ctrInsertPorcentaje();
          ?>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditaridUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background:#343a40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar Unidad</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Nombre -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-file-alt"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="editarexito" id="editarexito" placeholder="Exito" require>
                  
                </div>
                <div class="input-group mt-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-file-alt"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="editaretapa" id="editaretapa" placeholder="Etapa" require>
                  <input type="hidden" class="form-control" name="idporcentaje" id="idporcentaje" >
                </div>
              </div>
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-dark">Guardar</button>
          </div>
          <?php
                $editarUnidad = new PorcentajeExitoControlador();
                $editarUnidad -> ctrUpdatePorcentaje();
          ?>
        </form>
    </div>
  </div>
</div>

<?php
  $borrarUnidad = new PorcentajeExitoControlador();
  $borrarUnidad -> ctrEliminarPorcentaje();
?> 

