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
                    <label for="rpCliente">Cliente</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control" name="rpCliente" id="rpCliente" placeholder="Cliente">
                      <button type="button" class="btn btn-info agregarClienteRp" data-toggle="modal" data-target="#agregarClienteRp" style="background: rgb(255 136 2); border: 0px solid ;"  title="Registrar Cliente">
                        <i class="fas fa-save"></i>
                      </button>
                    </div>

                </div>
                <br>
                <div class="form-row">
                    <label for="rpModelo">Modelo</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control" name="rpModelo" id="rpModelo" placeholder="Modelo">
                      <button type="button" class="btn btn-info agregarModeloRp" data-toggle="modal" data-target="#agregarPiezaRp" style="background: rgb(255 136 2); border: 0px solid ;" title="Registrar Modelo">
                        <i class="fas fa-save"></i>
                      </button>
                    </div>
                </div>
                <br>
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
                    <label for="">Cantidad</label>
                    <div class="input-group col-md-12">
                      <div class="col-11">
                        <input type="number" class="form-control" id="opoExito" placeholder="Cantidad">
                      </div>
                      <div class="col-1">
                        <button type="submit" class="btn btn-info" title="registrar modelo a pedido">
                          <i class="fas fa-save"></i>
                        </button>
                      </div>
                      <br>
                        

                        
                    </div>

                </div>
                <br>
                <br>
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
                          <td>MK</td>
                          <td>Azul</td>
                          <td>CH</td>
                          <td>20</td>
                          <td>boton</td>
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
  <div class="modal fade" id="agregarClienteRp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <input type="text" class="form-control" name="nuevoNombreRp" id="nuevoNombreRp" placeholder="Nombre" require>
                </div>
              </div>
            <!-- Entrada de Usuario -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-users"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoUsuarioRp" id="nuevoUsuarioRp" placeholder="Usuario" require>
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
                  <input type="password" class="form-control" name="nuevoPasswordRp" id="nuevoPasswordRp" placeholder="Contrase??a" autocomplete="off" require>
                </div>
              </div>

            <!-- Entrada de Empresa -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-building"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoEmpresaRp" id="nuevoEmpresaRp" placeholder="Empresa (Opcional)" require>
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
                    <select id="nuevoTipoRp" name="nuevoTipoRp" class="form-control">
                        <option selected>Selecciona un tipo</option>
                        <option>Cliente</option>
                    </select>
                </div>
            </div>

              <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto (Opcional)</div>
                <input type="file" name="nuevaFotoRp" id="nuevaFotoRp" class="foto">
                <p class="help-block">Peso m??ximo de la foto 200 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" width="100px">
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
                  <input type="text" class="form-control" name="nuevoCorreoRp" id="nuevoCorreoRp" placeholder="Correo" require>
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
                  <input type="text" class="form-control" name="nuevoTelefonoRp" id="nuevoTelefonoRp" placeholder="Telefono (Opcional)" require maxlength="10">
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
                  <input type="text" class="form-control" name="nuevoDireccionRp" id="nuevoDireccionRp" placeholder="Direccion (Opcional)" require>
                </div>
              </div>
            
              <!-- Entrada de Pagina web -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-laptop"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoWebRp" id="nuevoWebRp" placeholder="Pagina Web (Opcional)">
                
                  
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">

                <p class="help-block">Ejemplo: https://www.google.com.mx</p>

                </div>
              </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary btnGuardarClienteRp"   style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>

        </form>
    </div>
  </div>
</div>


  <!-- Modal Registro de Piezas -->
  <div class="modal fade" id="agregarPiezaRp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="modal-header" style="background: rgb(255 136 2); color: white;">
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
                  <input type="text" class="form-control" name="EditaridPieza" id="EditaridPieza" placeholder="Nombre" hidden>
                  <input type="text" class="form-control" name="nuevoNombreModeloRp" id="nuevoNombreModeloRp" placeholder="Modelo" require>
                </div>
              </div>
            <!-- Entrada de modelo -->
              <div class="form-group" hidden>
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-shoe-prints"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoModelo" id="nuevoModelo" placeholder="Modelo" require>
                </div>
              </div>


              <!-- Entrada de color -->
              <div class="form-group">
                <div class="input-group autocompletarColor">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-shoe-prints"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control color col-7" placeholder="Color" name="colorRp" id="colorRp">
                  <button type="button" class="btn btn-info col-2" id="agregarColorp" title="agregar color a tabla" value="Agregar Color" style="background:#3c8dbc; color:white; border: 0px solid">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-info col-2 btnAgregarColoresRp"  title="Registrar color">
                    <i class="fas fa-save"></i>
                  </button>
                </div>
              </div>
            <!-- Mostrar color -->

            <div class="form-group">
              <div class="input-group">
              
              
                <table class="table table-bordered table-hover" id="tbColor">
                </table>
              </div>
            </div>
            <!-- Entrada de talla -->
              <div class="form-group">
                <div class="input-group ">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-ruler-horizontal"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control col-9" name="nuevotalla" id="nuevotalla" placeholder="Talla" require>
                 
                  <button type="button" class="btn btn-info col-2" id="agregarTalla" title="Agregar Talla a tabla" style="background:#3c8dbc; color:white; border: 0px solid">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>

            <!-- Mostrar talla -->

            <div class="form-group">
              <div class="input-group">
              
              
                <table class="table table-bordered table-hover" id="tbTalla">
                </table>
              </div>
            </div>

            <!-- Entrada de cantidad por pieza -->
            <div class="form-group">
              <div class="input-group ">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-ruler-horizontal"></span>
                  </div>
                </div>
                <input type="number" class="form-control" name="agregarPorMinuto" id="agregarPorMinuto" placeholder="Minutos por pieza" require>
                
              </div>
            </div>

              <!-- Entrada de  precio -->
              <div class="form-group" hidden>
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-money-bill-wave-alt"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" name="nuevoPrecio" placeholder="Precio" >
                </div>
              </div>

              <!-- Entrada de descripci??n -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-file-alt"></span>
                    </div>
                  </div>
                    <textarea class="form-control" name="nuevodescripcion" id="nuevodescripcion" placeholder="Descripci??n" rows="2"></textarea>
                  
                </div>
              </div>

              <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto</div>
                <input type="file" name="nuevaFoto" class="foto" id="nuevaFoto">
                <p class="help-block">Peso m??ximo de la foto 6 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" width="100px">
              </div>
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>


        </form>
    </div>
  </div>
</div>




