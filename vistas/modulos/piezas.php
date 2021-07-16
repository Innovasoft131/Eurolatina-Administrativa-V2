  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modelo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Modelo</li>
              <li class="breadcrumb-item"><a href="colores">Color</a></li>
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
          
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarPieza" style="background: rgb(255 136 2); border: 0px solid ;"> <i class="fas fa-plus"></i> Agregar Modelo </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <!-- th>Precio</th -->
                  <th>Foto</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                <?php

                $respuesta = ControladorPiezas::obtenerPiezas();
                foreach ($respuesta as $key => $value) {
                  echo '<tr>
                          <td>'.$key.'</td>
                          <td>'.$value["nombre"].'</td>
                          <!-- td>$value["precio"]</td-->
                          <td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-dark btnEditarPieza" style="background: rgb(255 136 2); border: 0px solid ;" idPieza="'.$value["id"].'"  data-toggle="modal" data-target="#modalEditarPieza"><i class="fa fa-pen"></i></button>
                              <button class="btn btn-secondary btnEliminarPieza" idPieza="'.$value["id"].'"  fotoPieza="'.$value["foto"].'" nombre="'.$value["nombre"].'" ><i class="fa fa-times"></i></button>
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
<div class="modal fade" id="agregarPieza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <input type="text" class="form-control" name="nuevoNombre" id="nuevoNombre" placeholder="Modelo" require>
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
                  <input type="text" class="form-control color col-7" placeholder="Color" name="color" id="color">
                  <input type="button" class="btn btn-info col-4" id="agregarColorp" value="Agregar Color" style="background:#3c8dbc; color:white; border: 0px solid">
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
                  <input type="number" class="form-control col-7" name="nuevotalla" id="nuevotalla" placeholder="Talla" require>
                  <input type="button" class="btn btn-info col-4" id="agregarTalla" value="Agregar Talla" style="background:#3c8dbc; color:white; border: 0px solid">
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

              <!-- Entrada de descripción -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-file-alt"></span>
                    </div>
                  </div>
                    <textarea class="form-control" name="nuevodescripcion" id="nuevodescripcion" placeholder="Descripción" rows="2"></textarea>
                  
                </div>
              </div>

              <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto</div>
                <input type="file" name="nuevaFoto" class="foto" id="nuevaFoto">
                <p class="help-block">Peso máximo de la foto 6 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" width="100px">
              </div>
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>

          <?php
          
            $insertPieza = new ControladorPiezas();
            $insertPieza -> ctrInsert();
            
          ?>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditarPieza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="modal-header" style="background:#6c757d; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar Modelo</h5>
            <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
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
                  <input type="hidden" class="form-control" name="idPieza" id="idPieza" placeholder="idPieza">
                  <input type="text" class="form-control" name="editarNombre" id="editarNombre" placeholder="Modelo" require>
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
                  <input type="text" class="form-control" name="editarModelo" id="editarModelo" placeholder="Modelo" require>
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
                  <input type="text" class="form-control color col-7" placeholder="Color" name="coloresEditar" id="coloresEditar">
                  <input type="button" class="btn btn-success col-4" id="editarColor" value="Agregar Color" style="background:#3c8dbc; color:white; border: 0px solid">
                </div>
              </div>
            <!-- Mostrar color -->

            <div class="form-group">
              <div class="input-group">
              
              
                <table class="table table-bordered table-hover" id="tbColorEditar">
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
                  <input type="number" class="form-control col-7" name="editartalla" id="editartalla" placeholder="Talla" require>
                  <input type="button" class="btn btn-success col-4" id="btnEditarTalla" value="Agregar Talla" style="background:#3c8dbc; color:white; border: 0px solid">
                </div>
              </div>

                          <!-- Mostrar talla -->

            <div class="form-group">
              <div class="input-group">
              
              
                <table class="table table-bordered table-hover" id="tbTallaEditar">
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
                <input type="number" class="form-control" name="editarPorMinuto" id="editarPorMinuto" placeholder="Minutos por pieza" require>
                
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
                  <input type="number" class="form-control" name="editarPrecio" id="editarPrecio" placeholder="Precio" >
                </div>
              </div>

              <!-- Entrada de descripción -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-file-alt"></span>
                    </div>
                  </div>
                    <textarea class="form-control" name="editarDescripcion" id="editarDescripcion" placeholder="Descripción" rows="2"></textarea>
                  
                </div>
              </div>

              <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto</div>
                <input type="file" name="editarFoto" class="foto" id="editarFoto" class="foto">
                <p class="help-block">Peso máximo de la foto 6 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" id="imagen" width="100px">
                <input type="hidden" name="fotoActual" id="fotoActual">
              </div>
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary cerrar" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
          <?php
            $insertPieza = new ControladorPiezas();
            $insertPieza -> ctrUpdate();
          ?>

        </form>
    </div>
  </div>
</div>

<?php
$Pieza = new ControladorPiezas();
$Pieza -> ctrBorrar();
?>