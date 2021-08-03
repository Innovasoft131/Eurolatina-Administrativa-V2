  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Información de Oportunidad</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item"><a href="presupuesto">En Proceso</a></li>
              <li class="breadcrumb-item active">Información</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Iniciar Oportunidad</h3>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <?php
              $mostrarOportunidad = ControladorPresupuesto::ctrMostrarPresupuesto();
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <!-- Mostrar codigo de Oportunidad -->
                    <div class="input-group">
                        <strong>Codigo:</strong> &nbsp;
                        <p><?php echo $mostrarOportunidad["codigo"];  ?></p>
                        <input type="hidden" name="idOportunidad" value="<?php echo $mostrarOportunidad["id"];  ?>">
                    </div>
                    <!-- Mostrar info de potencial cliente -->
                    <div class="input-group">
                        <strong>Cliente:</strong> &nbsp;
                        <p><?php echo $mostrarOportunidad["cliente"];  ?></p> &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="hidden" name="idclientePresupuesto" id="idclientePresupuesto" value="<?php echo $mostrarOportunidad["idCliente"];  ?>">
                        <strong>empresa:</strong> &nbsp;
                        <p><?php echo $mostrarOportunidad["empresa"];  ?></p> &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="hidden" name="empresaPresupuesto" value="<?php echo $mostrarOportunidad["empresa"];  ?>">
                        <strong>Etapa:</strong> &nbsp;
                        <p><?php echo $mostrarOportunidad["etapa"]; ?></p>
                    </div>


                    <!-- Mostrar Acción comercial Asignada -->
                    <div class="input-group">
                        <strong>Acción comercial:</strong> &nbsp;
                        <p><?php echo $mostrarOportunidad["accion"];  ?></p>
                    </div>
                    <!-- Mostrar Servicio asignado -->
                    <div class="input-group">
                        <strong>Servicio:</strong> &nbsp;
                        <p><?php echo $mostrarOportunidad["servicio"];  ?></p>
                    </div>
                    <!-- Mostrar Modelo asignado -->
                    <?php
                      if(isset($mostrarOportunidad["modelo"])):
                    ?>
                    <div class="input-group">
                        <strong>Modelo:</strong> &nbsp;
                        <p><?php echo $mostrarOportunidad["modelo"];  ?></p>
                    </div>
                    <?php endif;  
                    if(isset($mostrarOportunidad["cantidad"])): ?>
                    <!-- Mostrar Cantidad asignada -->
                    <div class="input-group">
                        <strong>Cantidad:</strong> &nbsp;
                        <p><?php echo $mostrarOportunidad["cantidad"]; ?></p>
                    </div>

                    <?php endif; ?>
                    <!-- Mostrar Importe de Oportunidad asignado -->
                    <div class="input-group">
                        <strong>Importe Oportunidad:</strong> &nbsp;
                        <p>$<?php echo $mostrarOportunidad["importe"]; ?></p>
                    </div>

                  

                    <!-- Mostrar Descripción -->
                    <div class="input-group">
                        <strong>Nota:</strong> &nbsp;
                        <p><?php echo $mostrarOportunidad["descripcion"]; ?></p>
                    </div>

                    <!-- Entrada de Importe del Presupuesto -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="importePresupuesto">Importe del Presupuesto:</label> &nbsp;
                            <input type="number" class="form-control" name="importePresupuesto" id="importePresupuesto" placeholder="Importe">
                            
                        </div>
                    </div>



                    <!-- Mostrar Estado del cliente -->
                    <?php
                      $itemEstado = null;
                      $valorEstado = null;
                      $respuestaEtapa = EstadoControlador::ctrMostrarEstados($itemEstado , $valorEstado);
                  ?>
                    <div class="input-group">
                        <div class="form-group col-md-12">
                            <label for="estadoCliente">Estado del cliente:</label>
                            <select name="estadoCliente" id="estadoCliente" class="form-control">
                              <?php foreach ($respuestaEtapa as $key => $value):
                              ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['estado'];  endforeach; ?></option>
                            </select>
                        </div>
                    </div>

                    <!-- Entrada de descripción de Presupuesto -->
                    <!-- div class="input-group">
                        <div class="form-group col-md-12">
                            <label for="opoExito">Descripción:</label>
                            <textarea name="" id="" class="form-control"></textarea>
                        </div>
                    </div -->
                </div>
                <button type="submit" class="btn btn-info">Guardar</button>
                <?php

                  $iniciarPresupuesto = new ControladorPresupuesto();
                  $iniciarPresupuesto -> ctrInsertPresupuesto();

                ?> 
            </form>
          </div><!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>