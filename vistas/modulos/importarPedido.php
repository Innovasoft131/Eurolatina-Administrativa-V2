  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modelos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Importar Pedido</li>
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
        <div class="form-group">
          <div class="row">
            <input type="file" class="form-control col-6" id="flImportPedido" name="flImportPedido">
            <button class="btn btn-info btnimportaPedidoExc"> <i class="fas fa-plus"></i> Guardar Pedido </button>
  
          </div>
        </div>
        
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Primavera</td>
                        <td><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum deleniti sunt doloremque, adipisci reiciendis necessitatibus, quibusdam cum sit quo dolorum aperiam illo mollitia reprehenderit et tempore repudiandae nesciunt omnis quod!</p></td>
                        <td>
                        <div class="btn-group">
                            
                            <button class="btn btn-warning btnEditarModelo"  data-toggle="modal" data-target="#modalEditarUsuario"><i class="fas fa-pen"></i></button>
  
                            <button class="btn btn-danger btnEliminarModelo"><i class="fa fa-times"></i></button>
  
                          </div>  
                        </td>
                    </tr>
                </tbody>
              </table>
            </div>
        </div>

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

