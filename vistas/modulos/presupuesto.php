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
                    <th>Codigo Oportunidad</th>
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
                foreach ($respuesta as $key => $value) {
                  $accion = ControladorPresupuesto::ctrMostrarAccion("id",$value['idAccion']);
                    echo '<tr>
                            <td>'.$key.'</td>
                            <td>'.$value["codigo"].'</td>
                            <td>'.$value["empresa"].'</td>
                            <td>'.$value["importe"].'</td>
                            <td>'.$value["fecha"].'</td>
                            <td>'.$accion["accion"].'</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-success btnAsignar" idoportunidad="'.$value["id"].'" idcliente="'.$value["idCliente"].'" idusuario="'.$value["idUsuario"].'" data-toggle="modal" data-target="#asignarMaquina"><i class="fas fa-play"></i></button>
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
            <h5 class="modal-title" id="exampleModalLabel">Iniciar Presupuesto</h5>
            <button type="button" class="close cerrarAsignar" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <!-- Entrada Codigo Presupuesto-->
              <h5>Codigo Presupuesto</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-barcode"></span>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="idcliente" id="idcliente">
                  <input type="text" class="form-control" name="NombreClienteOportunidad" id="NombreClienteOportunidad" placeholder="Codigo Presupuesto">
                </div>
              </div>
              <!-- Entrada Cliente -->
              <h5>Cliente</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="idcliente" id="idcliente">
                  <input type="text" class="form-control" name="NombreClienteOportunidad" id="NombreClienteOportunidad" placeholder="Usuario" readonly  >
                </div>
              </div>
              <!-- Entrada de Empresa-->
              <h5>Empresa</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-building"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Empresa" readonly>
                </div>
              </div>
              <!-- Entrada servicio-->
              <h5>Servicio</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fab fa-servicestack"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="servicio" id="servicio" placeholder="Servicio">
                </div>
              </div>
            
              <!-- Entrada de Modelo -->
              <h5>Modelo</h5>
              <div class="form-group">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tshirt"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Modelo">
                </div>
              </div>

              <!-- Entrada de Cantidad  -->
              <h5>Cantidad</h5>
              <div class="form-group">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-hashtag"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad">
                </div>
              </div>
              <!-- Entrada de Importe  Oportunidad-->
              <h5>Importe Oportunidad</h5>
              <div class="form-group">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-money-bill"></span>
                      
                    </div>
                  </div>
                  <input type="text" class="form-control" name="importe" id="importe" placeholder="Importe">
                </div>
              </div>
              <h5>Importe Presupuesto</h5>
              <div class="form-group">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-money-bill"></span>
                      
                    </div>
                  </div>
                  <input type="text" class="form-control" name="importepresupuesto" id="importepresupuesto" placeholder="Importe">
                </div>
              </div>
              <h5>Estado</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-battery-empty"></span>
                    </div>
                  </div>
                  <?php
                  $item = null;
                  $valor = null;
                  $respuesta = ControladorPresupuesto::ctrMostrarEstados($item , $valor);
                  ?>
                  <select name="estado" class="form-control" id="estado" placeholder="Selecciona una opcion">
                    
                  <?php
                    foreach ($respuesta as $key => $value) {
                      
                      echo '<option value="">'.$value['etapa'].'</option>';
                }
                ?>
                  </select>
                  <input type="hidden" class="form-control" name="empresa" id="idestado" placeholder="idestado" readonly>
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



