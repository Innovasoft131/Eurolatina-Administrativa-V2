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
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="opofolio">Folio</label>
                        <input type="text" class="form-control" id="opofolio" placeholder="folio">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="opoEmpleado">Empleado a asignar</label>
                        <input type="password" class="form-control" id="opoEmpleado" placeholder="Empleado">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-7">
                        <input type="text" class="form-control" placeholder="Cliente">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Empresa">
                        
                    </div>
                    <div class="col">
                        <button class="btn btn-info"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="opoServicio">Servicio</label>
                    <input type="text" class="form-control" id="opoServicio" placeholder="Servicio">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="opoModelo">Modelo</label>
                        <input type="text" class="form-control" id="opoModelo" placeholder="Modelo">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="opoCantidad">Cantidad </label>
                        <input type="number" class="form-control" id="opoCantidad" placeholder="Cantidad">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Importe</label>
                        <input type="number" class="form-control" id="opoImporte" placeholder="Cantidad">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="opoEtapa">Etapa</label>
                        <select id="opoEtapa" class="form-control">
                            <option selected>Selecciona una etapa</option>
                            <option>Nuevo</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="opoExito">Porcentaje de éxito</label>
                        <input type="number" class="form-control" id="opoExito" placeholder="Exito" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="opoAccion">Acción comercial</label>
                        <select id="opoAccion" class="form-control">
                            <option selected>Selecciona una Acción</option>
                            <option>Nuevo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="opoExito">Descripción</label>
                    <textarea id="opoDescripcion" placeholder="Descripción" class="form-control"></textarea>
                    
                </div>
                <button type="submit" class="btn btn-info">Guardar</button>
            </form>
        </div>

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>







