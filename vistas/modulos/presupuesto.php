 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Presupuestos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item "><a href="presupuesto">Pendientes</a></li>
              <li class="breadcrumb-item"><a href="PEnProceso">En Proceso</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <!-- div class="card-header">
    
        </div -->
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Codigo</th>
                    <th>Empresa</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Tarea</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $item = null;
                $valor = null;
                $respuesta = ControladorPresupuesto::ctrMostrarPresupuestos($item , $valor);
                var_dump( $respuesta);
                foreach ($respuesta as $key => $value) {
                    echo '<tr>
                            <td>'.$key.'</td>
                            <td>'.$value["codigo"].'</td>
                            <td>'.$value["empresa"].'</td>
                            <td>'.$value["importe"].'</td>
                            <td>'.$value["fecha"].'</td>
                            <td>'.$value["accion"].'</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-info btnAsignar" idPedido="'.$value["idPedido"].'" idCliente="'.$value["idCliente"].'" nombreCliente="'.$value["nombreCliente"].'" idPrimerModulo="'.$value["id"].'"   data-toggle="modal" data-target="#asignarMaquina"><i class="fas fa-project-diagram"></i></button>
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
<div class="modal fade" id="asignarMaquina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="modal-header" style="background: #4682B4; color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Asignar</h5>
            <button type="button" class="close cerrarAsignar" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <!-- Entrada de Nombre cliente -->
              <h5>Cliente</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="idPedidoAsignar" id="idPedidoAsignar" placeholder="Cliente">
                  <input type="hidden" class="form-control" name="idprimermodulodesglose" id="idprimermodulodesglose" placeholder="idprimermodulodesglose">
                  <input type="hidden" class="form-control" name="idPrimerModulo" id="idPrimerModulo" placeholder="idPrimerModulo">

                  <input type="text" class="form-control" name="NombreClienteAsignar" id="NombreClienteAsignar" placeholder="Cliente" readonly  >
                </div>
              </div>
              <!-- Entrada de Nombre Pieza-->
              <h5>Modelo</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-socks"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="idPiezaAsignar" id="idPiezaAsignar" placeholder="Pieza" hidden>
                  <select class="form-control" name="piezaAsignar" id="piezaAsignar">
                    
                  </select>
                </div>
              </div>
              
              <!-- pedido desglosado -->
              <div class="table-responsive">
                <table class="table  table-bordered table-striped  " id="tbAsignar">
                  <thead>
                    <tr>
                      <th style="width:10px">#</th>
                      <th><input type="radio" name="" id=""></th>
                      <th>Color</th>
                      <th>Talla</th>
                      <!-- th>Modelo</th -->
                      <th>Cantidad</th>
                    </tr>
                  </thead>
                  <tbody id="datos">
                  </tbody>
                </table>
              </div>

              <!-- Entrada de Linea-->
              <h5>Línea</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-socks"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="idLineaAsignar" id="idLineaAsignar" placeholder="Linea" hidden>
                  <select class="form-control" name="LineaAsignar" id="LineaAsignar">
                    
                  </select>
                </div>
              </div>
              

              

              <!-- Entrada de Maquina -->
              <h5>Maquina</h5>
              <div class="form-group">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-dumpster"></span>
                    </div>
                  </div>
                  <select class="form-control" name="slMaquinaAsignar" id="slMaquinaAsignar">
                    
                  </select>
                </div>
              </div>

              <!-- Entrada de Cantidad a maquina -->
              <h5>Cantidad a maquina</h5>
              <div class="form-group">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-hashtag"></span>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="cantidadPedido" id="cantidadPedido" placeholder="Cantidad a maquina">
                  <input type="hidden" class="form-control" name="cantidadPrimerModulo" id="cantidadPrimerModulo" placeholder="Cantidad a maquina">
                  <input type="hidden" class="form-control" name="cantidadMaquinasProceso" id="cantidadMaquinasProceso" placeholder="Cantidad a maquina">
                  <input type="number" class="form-control" name="cantidadAsignarMaquina" id="cantidadAsignarMaquina" placeholder="Cantidad a maquina" require>
                </div>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success" id="btnAsignarMaquina"> <i class="fas fa-plus"></i> Asignar</button>
                <br>
                <br>
                <div class="row">
                  <!-- pedido desglosado -->
                  <div class="table-responsive">
                    <table class="table  table-bordered table-striped  " id="tbAsignarMaquina">
                      <thead>
                        <tr>
                          <th style="width:10px">#</th>
                          <th>No. Pedido</th>
                          <th>Modelo</th>
                          <th>Color</th>
                          <th>Talla</th>
                          <!-- th>Modelo</th -->
                          <th>Cantidad</th>
                          <th>Maquina Asignada</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="datos">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary cerrarAsignar" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
    </div>
  </div>
</div>



