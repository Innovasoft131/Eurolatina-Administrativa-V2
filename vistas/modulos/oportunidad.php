  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Oportunidad</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Oportunidad</li>
              <li class="breadcrumb-item"><a href="tablero">Tablero</a></li>
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
                    <div class="form-group col-md-6">
                        <label for="opofolio">Folio</label>
                        <input type="text" class="form-control" id="opofolio"  name="opofolio" placeholder="folio">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="opoEmpleado">Empleado a asignar</label>
                        <?php
                            $item = null;
                            $valor = null;
                            
                            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                        ?>
                        <select  id="opoEmpleado" name="opoEmpleado"  class="form-control">
                            <option selected>Selecciona un Empleado</option>
                            <?php foreach ($usuarios as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            } ?>
                            
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-7">
                        <?php
                            $item = null;
                            $valor = null;
                            
                            $clientes = ControladorClientes::ctrMostrarclientes($item, $valor); 
                        ?>
                        <select id="opoCliente" name="opoCliente" class="form-control">
                            <option selected>Selecciona un cliente</option>
                            <?php foreach ($clientes as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            } ?>
                            
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="nuevoEmpresa" id="nuevoEmpresa" placeholder="Empresa" id="nuevaEmpresa">
                        
                    </div>
                    <div class="col">
                        <button type="button" id="agregarClienteoport" class="btn btn-info" data-toggle="modal" data-target="#agregarClienteOpo" style="background: rgb(255 136 2); border: 0px solid ;"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="opoServicio">Servicio</label>
                    <input type="text" class="form-control" name="opoServicio" id="opoServicio" placeholder="Servicio">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="opoModelo">Modelo</label>
                        <?php 
                            $piezas = ControladorPiezas::obtenerPiezas();
                        ?>
                        <select id="opoModelo" name="opoModelo" class="form-control">
                            <option selected>Selecciona un cliente</option>
                            <?php foreach ($piezas as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                            } ?>
                            
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="opoCantidad">Cantidad </label>
                        <input type="number" class="form-control" id="opoCantidad" name="opoCantidad" placeholder="Cantidad">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Importe</label>
                        <input type="number" class="form-control" id="opoImporte" name="opoImporte" placeholder="Cantidad">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="opoEtapa">Etapa</label>
                        <?php
                            $item = null;
                            $valor = null;
                        
                            $exito = PorcentajeExitoControlador::ctrMostrarPorcentajes($item, $valor);
                        ?>
                        <select id="opoEtapa" name="opoEtapa" class="form-control">
                            <option selected>Selecciona una etapa</option>
                            <?php foreach ($exito as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["etapa"].'</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="opoExito">Porcentaje de éxito</label>

                        <input type="number" class="form-control" id="opoExito" placeholder="Exito" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="opoAccion">Acción comercial</label>
                        <?php
                        $item = null;
                        $valor = null;
                        
                        $accion = tipoaccionControlador::ctrMostrarTipoAccion($item, $valor);
                        ?>
                        <select id="opoAccion" name="opoAccion" class="form-control">
                            <option selected>Selecciona una Acción</option>
                            <?php foreach ($accion as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["accion"].'</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="opoExito">Nota</label>
                    <textarea id="opoDescripcion" name="opoDescripcion" placeholder="Nota" class="form-control"></textarea>
                    
                </div>
                <button type="submit" class="btn btn-info">Guardar</button>
                <?php
          
                  $crearOportunidad = new ControladorOportunidad();
                  $crearOportunidad -> ctrInsertOportunidad();
          

                ?>
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







