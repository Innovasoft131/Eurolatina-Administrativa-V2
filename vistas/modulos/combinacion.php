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
              <li class="breadcrumb-item active"><a href="colores">Colores</a></li>
              <li class="breadcrumb-item active">Combinación</li>
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
          
        <button class="btn btn-primary btnAgregarCombinacionColor" data-toggle="modal" data-target="#agregarColor" style="background: rgb(255 136 2); border: 0px solid ;"> <i class="fas fa-plus"></i> Agregar Color </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Combinación</th>
                  <th>Codigo del Color</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                <?php

                    $combinacion = ControladorCombinacion::ctrObtenerColores();
                    

                    

                    foreach ($combinacion as $key => $value) {
                        $colores = ControladorCombinacion::ctrObtenerColoresCombinacion($value["id"]);
                        echo '<tr>
                                <td>'.$key.'</td>
                                <td>'.$value["nombreCombinacion"].'</td>';
                        echo '<td>';
                                foreach ($colores as $key => $values) {
                                    echo '<ul><li>'.$values["nombre"].'</li></ul>';
                                }
                        echo '</td>';


                        echo '<td>
                                <div class="btn-group">
                                    <button class="btn btn-dark btnEditarColorCombinar"  style="background: rgb(255 136 2); border: 0px solid ;" idCombinacion="'.$value["id"].'" Combinacion="'.$value["nombreCombinacion"].'" data-toggle="modal" data-target="#modalEditarColor"><i class="fas fa-pen"></i></button>
                                    <button class="btn btn-secondary btnEliminarColorCombinar" idColor='.$value["id"].'><i class="fa fa-times"></i></button>
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
            <!-- Entrada de Nombre de Conbinacion -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-palette"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoConbinacion" id="nuevoConbinacion" placeholder="Nombre" require>
                </div>
              </div>
            <!-- Entrada de codigo -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tint"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control conbinacionColor" name="nombreColorC" id="nombreColorC" placeholder="Color" >
                  <button type="button" class="btn btn-info btnAgregarConbinacion"><i class="fas fa-plus"></i></button>
                  
                </div>
              </div>

                <!-- Entrada de Colores -->
                <div class="form-group ">
                <div class="input-group autocompletar">

                  <!-- pedido -->
                  <div class="table-responsive">
                    <table class="table  table-bordered table-striped  " id="tbConbinacionColor">
                      <thead>
                        <tr>
                          <th>Color</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                  

                  
                </div>
              </div>

            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary btnGuardarConbinacion" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
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
                  <input type="text" class="form-control editarColorCombinacion" name="editarColorCombinacion" id="editarColorCombinacion" readonly placeholder="Nombre" require>
                  <input type="hidden" class="form-control" name="idCombinacion" id="idCombinacion" >
                </div>
              </div>
            <!-- Entrada de Usuario -->
              <div class="form-group">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tint"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="EditarnombreColorC" id="EditarnombreColorC" placeholder="Color" >
                  <button type="button" class="btn btn-info btnAgregarConbinacionEditar"><i class="fas fa-plus"></i></button>
                  
                </div>
              </div>

                <!-- Entrada de Colores -->
                <div class="form-group ">
                <div class="input-group autocompletar">

                  <!-- pedido -->
                  <div class="table-responsive">
                    <table class="table  table-bordered table-striped  " id="tbConbinacionColorEditar">
                      <thead>
                        <tr>
                          <th>Color</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                  

                  
                </div>
              </div>


           
      
              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  data-dismiss="modal"  style="background: rgb(255 136 2); border: 0px solid ;">Cerrar</button>
            <button type="submit" class="btn btn-secondary">Guardar</button>
          </div>

        </form>
    </div>
  </div>
</div>


