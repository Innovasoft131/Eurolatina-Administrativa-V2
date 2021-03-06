  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Generar Pedido</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Generar Pedido</li>
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
          <!-- data-toggle="modal" data-target="#generarPedido" -->
        <button class="btn btn-primary btngenerarPedido"  style="background: rgb(255 136 2); border: 0px solid ;"> <i class="fas fa-plus"></i> Generar Pedido </button>
        <button class="btn btn-info btnImportPedidos" hidden> <i class="fas fa-plus"></i> Importar excel </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " id="tbGenerarPedidosM">
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>No. Pedido</th>
                  <th>Cliente</th>
                  <th>Fecha del Pedido</th>
                  <!-- th>Estado</th -->
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $pedidos = ControladorPedidos::ctrMostrarPedido();
                    foreach ($pedidos as $key => $value) {
                      echo '<tr>
                              <td>'.$key.'</td>
                              <td>'.$value["id"].'</td>
                              <td>'.$value["cliente"].'</td>
                              <td>'.$value["fecha"].'</td>';
                      /*
                      if($value["estado"] != 0){
                        echo '<td><button class="btn btn-success btn-xs">Asignado</button></td>';
                      }else{
                        echo '<td><button class="btn btn-danger btn-xs">Pendiente</button></td>';
                      }
                      */
                      echo '<td>
                              <div class="btn-group">
                                <button class="btn btn-dark btnMostrarPedido" idCliente="'.$value["idcliente"].'" idPedido="'.$value["id"].'" cliente="'.$value["cliente"].'" fechaPedido="'.$value["fecha"].'" style="background: rgb(255 136 2); border: 0px solid ;" data-toggle="modal" data-target="#mostrarPedidoDesglose"><i class="fas fa-eye"></i></button>
                                <!-- button class="btn btn-secondary btnEliminarPedido"><i class="fa fa-times"></i></button -->
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
<div class="modal fade" id="generarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background: rgb(255 136 2); color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Generar Pedido</h5>
            <button type="button" class="close cerrarPdfPedido" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <!-- Entrada de cliente-->
              <h5>Cliente</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="idClientePedido" id="idClientePedido" placeholder="Pieza" hidden>

                  <select class="form-control" name="clientePedido" id="clientePedido">
                    
                  </select>

                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregarClientePedi" style="background: rgb(255 136 2); border: 0px solid ;"><i class="fas fa-plus"></i></button>
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
                  <input type="text" class="form-control" name="idPiezaPedido" id="idPiezaPedido" placeholder="Pieza" hidden>
                  <select class="form-control" name="piezaPedido" id="piezaPedido">
                    
                  </select>
                </div>
              </div>
              <h5 hidden>Modelo</h5>
            <!-- Entrada de Modelo -->
              <div class="form-group " hidden>
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-socks"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="idModeloPedido" id="idModeloPedido" placeholder="Modelo" hidden>
                  <input type="text" class="form-control" name="modeloPedido" id="modeloPedido" placeholder="Modelo" readonly>
                  
                </div>
              </div>

              <!-- Entrada de Color-->
              <h5>Colores</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-palette"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="idColorPedido" id="idColorPedido" placeholder="Color" hidden>
                  <select class="form-control" name="ColorPedido" id="ColorPedido">
                    
                  </select>
                </div>
              </div>

              <!-- Entrada de Talla-->
              <h5>Tallas</h5>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-ruler-horizontal"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="idTallaPedido" id="idTallaPedido" placeholder="Color" hidden>
                  <select class="form-control" name="TallasPedido" id="TallasPedido">
                    
                  </select>
                </div>
              </div>

              <!-- Entrada de Cantidad -->
              <div class="form-group">
                <div class="input-group autocompletarColor">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-shoe-prints"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control col-10" placeholder="Cantidad" name="cantidadPedidos" id="cantidadPedidos">
                  <button class="btn btn-info btnagregarPedidos col-2" type="button" ><i class="fas fa-plus"></i></button>
                </div>
              </div>

              <div class="form-group">
                  <!-- pedido -->
                  <div class="table-responsive">
                    <table class="table  table-bordered table-striped  " id="tbGenerarPedido">
                      <thead>
                        <tr>
                          <th>Modelo</th>
                          <!-- th>Modelo</th -->
                          <th>Color</th>
                          <th>Talla</th>
                          <th>Cantidad</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="datos">
                        <tr>
                        </tr>
                      </tbody>
                    </table>
                  </div>
              </div>

            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary cerrarPdfPedido" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary guardarPedido" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal Mostrar Pedidos -->
<div class="modal fade" id="mostrarPedidoDesglose" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLongTitle"></h5>
        <button type="button" class="close cerrarPdfPedido" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                
        <object class="PDFdoc" id="mostrarPedidopdf" name="mostrarPedidopdf"  width="100%" height="500px" type="application/pdf" data="#"></object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cerrarPdfPedido" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


  <!-- Modal Registro del cliente -->
  <div class="modal fade" id="agregarClientePedi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="modal-header" style="background: rgb(255 136 2); color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
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
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre*" require>
                  <input type="text" class="form-control" name="modelo" id="modelo" value="oportunidad" placeholder="modulo" hidden >
                  <!-- input type="text" class="form-control" name="reFolio" id="reFolio"  placeholder="Folio" hidden >
                  <input type="text" class="form-control" name="reEmpleado" id="reEmpleado"  placeholder="Empleado" hidden -->
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
                  <input type="text" class="form-control" name="nuevoUsuario" placeholder="Usuario*" require>
                </div>
              </div>
            <!-- Entrada de Contrase??a -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  <input type="password" class="form-control" name="nuevoPassword" placeholder="Contrase??a*" autocomplete="off" require>
                </div>
              </div>

            <!-- Entrada de Empresa -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-key"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoEmpresa" placeholder="Empresa" require>
                </div>
              </div>

            <!-- Entrada de tipo de cliente -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                    <select id="nuevoTipo" name="nuevoTipo" class="form-control">
                        <option selected>Selecciona un tipo</option>
                        <option>Cliente</option>
                    </select>
                </div>
            </div>

              <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto</div>
                <input type="file" name="nuevaFoto" id="nuevaFoto">
                <p class="help-block">Peso m??ximo de la foto 200 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail" width="100px">
              </div>
            </div>

            <!-- Entrada de Correo -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoCorreo" placeholder="Correo" require>
                </div>
              </div>

              <!-- Entrada de Telefono -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoTelefono" placeholder="Telefono" require maxlength="10">
                </div>
              </div>

              <!-- Entrada de Direccion -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-map-marker-alt"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoDireccion" placeholder="Direccion" require>
                </div>
              </div>
            
              <!-- Entrada de Pagina web -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-map-marker-alt"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoWeb" placeholder="Pagina Web" require>
                </div>
              </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary"   style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
          <?php
          
            $crearCliente = new ControladorClientes();
            $crearCliente -> ctrCrearCliente();
            

          ?>
        </form>
    </div>
  </div>
</div>