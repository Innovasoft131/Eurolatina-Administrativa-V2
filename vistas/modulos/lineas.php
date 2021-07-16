  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Líneas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Líneas</li>
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
          
        <button class="btn btn-primary" style="background: rgb(255 136 2); border: 0px solid ;" data-toggle="modal" data-target="#agregarLineas"> <i class="fas fa-plus"></i> Agregar Líneas </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th>Nombre</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $item = null;
                  $valor = null;
                  
                  $Maquinas = Controladorlineas::ctrMostrarLineas($item, $valor);
                  foreach ($Maquinas as $key => $value) {
                    echo '<tr>
                        <td>'.$value["nombre"].'</td>
                        <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-dark btnEditarLinea" style="background: rgb(255 136 2); border: 0px solid ;" id="'.$value["id"].'" nombre="'.$value["nombre"].'" data-toggle="modal" data-target="#modalEditarLinea"><i class="fas fa-pen"></i></button>

                          <button class="btn btn-secondary btnEliminarLinea" id="'.$value["id"].'" nombre="'.$value["nombre"].'"><i class="fa fa-times"></i></button>

                          <button type="button" class="btn btn-info btnCodigoQRLinea"  id="'.$value["id"].'" nombreLinea="'.$value["nombre"].'" data-toggle="modal" data-target="#codigoQRLinea"><i class="fas fa-qrcode"></i></button>

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
<div class="modal fade" id="agregarLineas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background: rgb(255 136 2); color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Líneas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Nombre de linea -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevaLinea" id="nuevaLinea" placeholder="Nombre de Líneas" require>
                </div>
              </div>


            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary guardarLinea" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
<div class="modal fade" id="modalEditarLinea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background:#3c8dbc; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar Línea</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Línea -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="editarLinea" id="editarLinea" placeholder="Nombre" require>
                  <input type="hidden" class="form-control" name="idLinea" id="idLinea" >
                </div>
              </div>



           
      
              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary editarLinea" style="background:#3c8dbc;  border: 0px solid">Guardar</button>
          </div>

        </form>
    </div>
  </div>
</div>


<!-- Modal de QR -->
<div class="modal fade" id="codigoQRLinea" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Codigo QR</h5>
        <button type="button" class="close cerrarQRLinea" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                
        <object class="PDFdoc" id="codigosQrLinea" name="codigosQrLinea"  width="100%" height="500px" type="application/pdf" data="#"></object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cerrarQRLinea" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php

  $borrarMaquina = new ControladorMaquina();
  $borrarMaquina -> ctrBorrarMaquina();

?> 