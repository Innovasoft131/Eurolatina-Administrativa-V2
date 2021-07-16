  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modelos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Modelos</li>
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

        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarModelo" style="background: rgb(255 136 2); border: 0px solid ;"> <i class="fas fa-plus"></i> Agregar Modelo </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php

$item = null;
$valor = null;

$clientes = ControladorModelos::ctrMostrarModelos($item, $valor);

foreach ($clientes as $key => $value){

  echo '<tr>
          <td>'.$value["id"].'</td>
          <td>'.$value["nombre"].'</td>
          <td>'.$value["descripcion"].'</td>
          <td>

            <div class="btn-group">

              <button class="btn btn-dark btnEditarModelo"  style="background: rgb(255 136 2); border: 0px solid ;" idModelo="'.$value["id"].'" data-toggle="modal" data-target="#editarModelo"><i class="fas fa-pen"></i></button>

              <button class="btn btn-secondary btnEliminarModelo" idModelo="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
<div class="modal fade" id="agregarModelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header"  style="background: rgb(255 136 2); color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Modelo</h5>
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
                      <span class="fas fa-socks"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre" require>
                </div>
              </div>
            <!-- Entrada de Usuario -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-sticky-note"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoDescripcion" placeholder="Descripcion" require>
                </div>
              </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
          <?php
            $crearModelo = new ControladorModelos();
            $crearModelo -> ctrCrearModelo();
          ?>
        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editarModelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background:#3c8dbc; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Modificar Modelo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="id" id="id" placeholder="ID" readonly>
                </div>
              </div>
            <!-- Entrada de Nombre -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" id="editarNombre" name="editarNombre" placeholder="Nombre" require>
                </div>
              </div>
            <!-- Entrada de Usuario -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-key"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" id="editarDescripcion" name="editarDescripcion" placeholder="Descripcion" require>
                </div>
              </div>
          </div>
</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background:#3c8dbc; color:white; border: 0px solid">Guardar</button>
          </div>
          <?php
  $editarModelo = new ControladorModelos();
  $editarModelo -> ctrEditarModelo();
?>
        </form>
    </div>
  </div>
</div>

<?php

  $borrarModelo = new ControladorModelos();
  $borrarModelo -> ctrBorrarModelo();

?>