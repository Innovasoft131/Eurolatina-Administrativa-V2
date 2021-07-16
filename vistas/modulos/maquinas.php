  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Maquinas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Maquinas</li>
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
          
        <button class="btn btn-primary" id="agregarMaquinas" style="background: rgb(255 136 2); border: 0px solid ;" data-toggle="modal" data-target="#agregarMaquina"> <i class="fas fa-plus"></i> Agregar Maquina </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Linea</th>
                  <th>Maquinas</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $item = null;
                  $valor = null;
                  
                  $lineas = ControladorMaquina::ctrMostrarMaquinas();
                  

                  foreach ($lineas as $key => $value) {
                    echo '<tr>
                        <td>'.$key.'</td>
                        <td>'.$value["nombre"].'</td>';
                        $maquinas = ControladorMaquina::ctrMostrarMaquinasSegundo($value["id"]);
                        echo '<td>';
                        echo '<div class="btn-group">';
                        foreach($maquinas as $key => $values){
                          echo ''.$values["nombre"].' <br>';
                        }
                        echo '</div>';
                        echo '</td>';
                        echo '<td>
                        <div class="btn-group">
                            
                          <button class="btn btn-dark btnEditarMaquinas" style="background: rgb(255 136 2); border: 0px solid ;"   idLinea="'.$value["idLinea"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fas fa-pen"></i></button>

                          <button class="btn btn-secondary btnEliminarMaquina" idUsuario="'.$value["id"].'"  usuario="'.$value["nombre"].'"><i class="fa fa-times"></i></button>

                          <button type="button" class="btn btn-info btnCodigoQR"   hidden data-toggle="modal" data-target="#codigoQR"><i class="fas fa-qrcode"></i></button>

                        </div>  
                        </td>';
                    echo '</tr>';
                        /*
                        <td>'.$value["nombre"].'</td>
                        <td>'.$value["nombre"].'</td>
                        <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-dark btnEditarMaquinas" style="background: rgb(255 136 2); border: 0px solid ;" idMaquina="'.$value["idMaquina"].'"  idLinea="'.$value["idLinea"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fas fa-pen"></i></button>

                          <button class="btn btn-secondary btnEliminarMaquina" idUsuario="'.$value["id"].'" idMaquina="'.$value["idMaquina"].'" usuario="'.$value["nombre"].'"><i class="fa fa-times"></i></button>

                          <button type="button" class="btn btn-info btnCodigoQR"  idMaquina="'.$value["idMaquina"].'" nombreMaquina="'.$value["nombreMaquina"].'" data-toggle="modal" data-target="#codigoQR"><i class="fas fa-qrcode"></i></button>

                        </div>  

                      </td>
                    </tr>';
                    */
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
<div class="modal fade" id="agregarMaquina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background: rgb(255 136 2); color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Maquina</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">

            <!-- Entrada de linea -->
            <div class="form-group ">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-grip-lines"></span>
                    </div>
                  </div>
                
                    <select class="form-control"  name="slcLinea" id="slcLinea" >
                    
                    </select>
                  
                </div>
              </div>

            <!-- Entrada de encargado -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-key"></span>
                    </div>
                  </div>
                
                    <input type="text" class="form-control" name="encargado" id="encargado" placeholder="Encargado de maquina" require>
                    <input type="text" class="form-control" name="nuevaTurno" id="nuevaTurno" placeholder="Turno" readonly>
                    <input type="text" class="form-control" name="idEncargado" id="idEncargado" placeholder="" hidden>
                    
                  
                </div>
              </div>

              
            <!-- Entrada de Nombre de maquina -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevaMaquina" id="nuevaMaquina" placeholder="Nombre de maquina" require>
                  <input type="button" class="btn btn-info btnAgregarListas" value="Agregar">
                </div>
              </div>

            <!-- Entrada de MAQUINAS -->
            <div class="form-group">
                <div class="input-group ">

                
                  <div class="form-group">
                  <!-- pedido -->
                  <div class="table-responsive">
                    <table class="table  table-bordered table-striped" id="tbCrearLinea">
                      <thead>
                        <tr>
                          <th>Linea</th>
                          <th>Maquina</th>
                          <th>Encargado</th>
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

            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary btnguardarMaquina" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
          <?php
          /*
            $crearMaquina = new ControladorMaquina();
            $crearMaquina -> ctrMaquina();
            */
          ?>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background:#3c8dbc; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar Maquina</h5>
            <button type="button" class="close cerrarMaquinas" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">

            <!-- Entrada de linea -->
            <div class="form-group ">
              <div class="input-group">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-grip-lines"></span>
                  </div>
                </div>

                  <select class="form-control"  name="slcLineaEditar" id="slcLineaEditar" >
                    
                  </select>
                  
              </div>
            </div>

            <!-- Entrada de Usuario -->
            <div class="form-group">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-key"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="editarEncargado" id="editarEncargado" placeholder="Encargado de maquina" require>
                  <input type="text" class="form-control" name="editarTurnoEditar" id="editarTurnoEditar" placeholder="Turno" readonly>
                  <input type="text" class="form-control" name="idEncargadoEditar" id="idEncargadoEditar" placeholder="" hidden>
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
                  <input type="text" class="form-control" name="editarNombre" id="editarNombre" placeholder="Nombre de maquina" require>
                  <input type="hidden" class="form-control" name="idMaquina" id="idMaquina" >
                  <button type="button" class="btn btn-info btnAgregarListasEditar" ><i class="fas fa-plus"></i></button>
                  <button type="button" class="btn btn-secondary  btnEditarLineaMaquinaUpdate" ><i class="fas fa-save"></i></button>
                </div>
              </div>


            <!-- Entrada de MAQUINAS -->
            <div class="form-group">
                <div class="input-group ">

                
                  <div class="form-group">
                  <!-- pedido -->
                  <div class="table-responsive">
                    <table class="table  table-bordered table-striped" id="tbCrearLineaEditar">
                      <thead>
                        <tr>

                          <th>Linea</th>
                          <th>Maquina</th>
                          <th>Encargado</th>
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
           
      
              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary cerrarMaquinas" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" style="background:#3c8dbc;  border: 0px solid">Guardar</button>
          </div>
          <?php
          /*
            $editarMaquina = new ControladorMaquina();
            $editarMaquina -> ctrEditarMaquina();
            */
          
          ?>
        </form>
    </div>
  </div>
</div>


<!-- Modal de QR -->
<div class="modal fade" id="codigoQR" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Codigo QR</h5>
        <button type="button" class="close cerrarQR" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                
        <object class="PDFdoc" id="codigosQr" name="codigosQr"  width="100%" height="500px" type="application/pdf" data="#"></object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cerrarQR" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php

  $borrarMaquina = new ControladorMaquina();
  $borrarMaquina -> ctrBorrarMaquina();

?> 