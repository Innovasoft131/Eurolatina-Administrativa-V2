  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Colores</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Colores</li>
              <li class="breadcrumb-item active"><a href="combinacion">Combinación</a></li>
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
          
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarColor" style="background: rgb(255 136 2); border: 0px solid ;"> <i class="fas fa-plus"></i> Agregar Color </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Color</th>
                  <th>Codigo del Color</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                <?php
                    $item = null;
                    $valor = null;
                    $colores = ControladorColores::ctrCRUDObtenerColores($item, $valor);

                    foreach ($colores as $key => $value) {
                        echo '<tr>
                                <td>'.$key.'</td>
                                <td>'.$value["nombre"].'</td>';
                        if($value["hexadecimal"] == null){
                            echo '<td> N/A </td>';
                        }else {
                            echo '<td>'.$value["hexadecimal"].'</td>';
                        }

                        echo '<td>
                                <div class="btn-group">
                                    <button class="btn btn-dark btnEditarColor"  style="background: rgb(255 136 2); border: 0px solid ;" idColor='.$value["id"].'  data-toggle="modal" data-target="#modalEditarColor"><i class="fas fa-pen"></i></button>
                                    <button class="btn btn-secondary btnEliminarColor" idColor='.$value["id"].'><i class="fa fa-times"></i></button>
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
<div class="modal fade" id="agregarColor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background: rgb(255 136 2); color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Color</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Nombre de Color -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-palette"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoColor" id="nuevoColor" placeholder="Color" require>
                </div>
              </div>
            <!-- Entrada de codigo -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-hashtag"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoCodigo" id="nuevoCodigo" placeholder="Color Hexadecimal" >
                  
                </div>
              </div>

            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
          <?php
            $colores = new ControladorColores();
            $colores -> ctrinsertColor();
          ?>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditarColor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background:#6c757d; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar Color</h5>
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
                      <span class="fas fa-palette"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="editarColor" id="editarColor" placeholder="Color" require>
                  <input type="hidden" class="form-control" name="idColor" id="idColor" >
                </div>
              </div>
            <!-- Entrada de Usuario -->
              <div class="form-group">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-hashtag"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="editarCodigo" id="editarCodigo" placeholder="Color Hexadecimal" >

                </div>
              </div>


           
      
              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  data-dismiss="modal"  style="background: rgb(255 136 2); border: 0px solid ;">Cerrar</button>
            <button type="submit" class="btn btn-secondary">Guardar</button>
          </div>
          <?php
            $editarColor = new ControladorColores();
            $editarColor -> ctrEditarColor();
          ?>
        </form>
    </div>
  </div>
</div>


<?php
 
 $borrarColor = new ControladorColores();
 $borrarColor -> ctrEliminarColor();