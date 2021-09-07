  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registrar Pedido</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Registrar Pedido </li>
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
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
          </div>
        </div>
        <div class="card-body">
            <form role="form" method="post">
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <h3>Cliente</h3>
                      <div class="table-responsive">
                        <table class="table  table-bordered table-striped   tablas " >
                        <thead>
                          <tr>
                            <th style="width:10px">#</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Telefono</th>                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          $item = null;
                          $valor = null;

                          $clientes = ControladorClientes::ctrMostrarclientes($item, $valor);

                          foreach ($clientes as $key => $value){

                            echo ' <tr>
                                    <td><input  type="checkbox" class="seleccionadoCliente" name="'.$value["id"].'" id="'.$value["id"].'"></td>
                                    <td>'.$value["nombre"].'</td>
                                    <td>'.$value["usuario"].'</td>';
                              echo '<td>'.$value["correo"].'</td>';
                              echo '<td>'.$value["telefono"].'</td>';
                            echo '</tr>';
                            }
                          ?>
                        </tbody>
                      </table>
                      </div>

                    </div>

                </div>

                <div class="form-group">
                    <h3>Modelo</h3>
                      <div class="table-responsive">
                        <table class="table  table-bordered table-striped   tablas" id="tabla-modelo" name="tabla-modelo" >
                          <thead>
                            <tr>
                            <th style="width:10px">Seleccionar modelo</th>
                            <th>Modelo</th>
                            <th>Foto</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php

                          $respuesta = ControladorPiezas::obtenerPiezas();
                          foreach ($respuesta as $key => $value) {
                            echo '<tr>
                                    <td><input  type="checkbox" class="seleccionadoModelo" name="'.$value["id"].'" id="'.$value["id"].'"></td>
                                    <td>'.$value["nombre"].'</td>
                                    <td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>
                                  </tr>';
                          }
                
                          ?>
                          </tbody>
                        </table>
                      </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="opoModelo">Tallas</label>
                        <?php 
                            $piezas = ControladorPiezas::obtenerPiezas();
                        ?>
                        <select id="opoModelo" name="opoModelo" class="form-control">
                            <option selected>Selecciona una talla</option>
                            <?php foreach ($piezas as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            } ?>
                            
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="opoEtapa">Colores</label>
                        <?php
                            $item = null;
                            $valor = null;
                        
                            $exito = PorcentajeExitoControlador::ctrMostrarPorcentajes($item, $valor);
                        ?>
                        <select id="opoEtapa" name="opoEtapa" class="form-control">
                            <option selected>Selecciona un Color</option>
                            <?php foreach ($exito as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["etapa"].'</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="input-group col-md-12">
                      <div class="col-10">
                        <input type="number" class="form-control" id="opoExito" placeholder="Cantidad">
                      </div>
                      <div class="col-2">
                        <button type="submit" class="btn btn-info">Agregar Modelo</button>
                      </div>
                        

                        
                    </div>

                </div>
                <div class="form-group col-md-12">
                  <!-- pedido -->
                  <div class="table-responsive">
                    <table class="table  table-bordered table-striped  tablas" id="tbGenerarPedido">
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
                

            </form>
        </div>

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>



  <!-- Modal Registro -->
  <div class="modal fade" id="agregarClienteOpo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <!-- Entrada de Contraseña -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  <input type="password" class="form-control" name="nuevoPassword" placeholder="Contraseña*" autocomplete="off" require>
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
                <p class="help-block">Peso máximo de la foto 200 MB</p>
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







