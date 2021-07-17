  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ESTADO DE OPORTUNIDAD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Estado</li>
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
          
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarEstado"> <i class="fas fa-plus"></i> Agregar Estado </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Estado</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                    <?php   
                        $item = null;
                        $valor = null;
                        
                        $estado = EstadoControlador::ctrMostrarEstados($item, $valor);

                        foreach ($estado as $key => $value) {
                            echo '<tr>
                                    <td>'.$key.'</td>
                                    <td>'.$value['estado'].'</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btnEditaridEstado" idEstado='.$value['id'].'  data-toggle="modal" data-target="#modalEditaridEstado"><i class="fas fa-pen"></i></button>
                                            <button class="btn btn-danger btnEliminaridEstado" idEstado='.$value['id'].'><i class="fa fa-times"></i></button>
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
<div class="modal fade" id="agregarEstado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background: #3c8dbc; color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Estado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
                <!-- Entrada de Nombre de estado -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-ruler-horizontal"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoEstado" id="nuevoEstado" placeholder="Estado" require>
                </div>
              </div>


            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: #3c8dbc; color: white">Guardar</button>
          </div>
          <?php
                $crearEstado = new EstadoControlador();
                $crearEstado -> ctrInsertEstado();
          ?>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditaridEstado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background:#343a40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar Estado</h5>
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
                  <input type="text" class="form-control" name="editarEstado" id="editarEstado" placeholder="Estado" require>
                  <input type="hidden" class="form-control" name="idEstado" id="idEstado" >
                </div>
              </div>


           
      
              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-dark">Guardar</button>
          </div>
          <?php
                $editarEstado = new EstadoControlador();
                $editarEstado -> ctrUpdateEstado();
          ?>
        </form>
    </div>
  </div>
</div>

<?php

  $borrarEstado = new EstadoControlador();
  $borrarEstado -> ctrEliminarEstado();

?> 

