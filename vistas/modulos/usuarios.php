  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
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
          
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarUsuario" style="background: rgb(255 136 2); border: 0px solid ;"> <i class="fas fa-plus"></i> Agregar Usuario </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <th>Usuario</th>
                  <th>Foto</th>
                  <th>Perfil</th>
                  <th>Estado</th>
                  <th>Último login</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                <?php

$item = null;
$valor = null;

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

foreach ($usuarios as $key => $value){
 
  echo ' <tr>
          <td>'.$key.'</td>
          <td>'.$value["nombre"].'</td>
          <td>'.$value["usuario"].'</td>';

          if($value["foto"] != ""){

            echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

          }else{

            echo '<td><img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail" width="40px"></td>';

          }

          echo '<td>'.$value["perfil"].'</td>';

          if($value["estado"] != 0){

            echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';

          }else{

            echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';

          }             

          echo '<td>'.$value["ultimo_login"].'</td>
          <td>

            <div class="btn-group">
                
              <button class="btn btn-dark btnEditarUsuario" style="background: rgb(255 136 2); border: 0px solid ;" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarMaquinas"><i class="fas fa-pen"></i></button>

              <button class="btn btn-secondary btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>

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
<div class="modal fade" id="agregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background: rgb(255 136 2); color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
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
                  <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre" require>
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
                  <input type="text" class="form-control" name="nuevoUsuario" placeholder="Usuario" require>
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
                  <input type="password" class="form-control" name="nuevoPassword" placeholder="Contraseña" require>
                </div>
              </div>

              <!-- Entrada de  Perfil -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-users"></span>
                    </div>
                  </div>
                  <select class="form-control input-lg" name="nuevoPerfil" id="nuevoPerfil">
                    <option value="">Seleccionar perfil</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Especial">Especial</option>
                    <option value="Tejedor">Tejedor</option>
                    <option value="Control_de_calidad">Control de Calidad</option>
                  </select>
                </div>
              </div>
              <!-- Entrada de  Turno -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-users"></span>
                    </div>
                  </div>
                  <select class="form-control input-lg" name="nuevoTurno" id="nuevoTurno">
                    <option value="">Seleccionar Turno</option>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                    <option value="Nocturno">Nocturno</option>>
                  </select>
                </div>
              </div>

              <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto</div>
                <input type="file" name="nuevaFoto" id="nuevaFoto" class="foto">
                <p class="help-block">Peso máximo de la foto 200 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" width="100px">
              </div>
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: rgb(255 136 2); border: 0px solid ;" >Guardar</button>
          </div>
          <?php

            $crearUsuario = new ControladorUsuarios();
            $crearUsuario -> ctrCrearUsuario();

          ?>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditarMaquinas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background:#3c8dbc; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar Maquinas</h5>
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
                  <input type="text" class="form-control" name="editarNombre" id="editarNombre" placeholder="Nombre" require>
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
                  <input type="text" class="form-control" name="editarUsuario" id="editarUsuario" placeholder="Usuario" readonly>
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
                  <input type="password" class="form-control" name="editarPassword" placeholder="Contraseña" require>
                  <input type="hidden" id="passwordActual" name="passwordActual">
                </div>
              </div>

            <!-- Entrada de  Perfil -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-users"></span>
                    </div>
                  </div>
                  <select class="form-control input-lg" name="editarPerfil">
                    <option value="" id="editarPerfil"></option>
                    <option value="Administrador">Administrador</option>
                    <option value="Especial">Especial</option>
                    <option value="Tejedor">Tejedor</option>
                    <option value="Control_de_calidad">Control de Calidad</option>
                  </select>
                </div>
              </div>

              <!-- Entrada de  Turno -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-users"></span>
                    </div>
                  </div>
                  <select class="form-control input-lg" name="editarTurno">
                  <option value="" id="editarTurno"></option>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                    <option value="Nocturno">Nocturno</option>>
                  </select>
                </div>
              </div>

            <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto</div>
                <input type="file" name="editarFoto" id="editarFoto" class="foto">
                <p class="help-block">Peso máximo de la foto 200 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" width="100px">
                <input type="hidden" name="fotoActual" id="fotoActual">
              </div>
              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background:#3c8dbc; color:white; border: 0px solid">Guardar</button>
          </div>
          <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();

        ?> 

        </form>
    </div>
  </div>
</div>

<?php

  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();

?> 