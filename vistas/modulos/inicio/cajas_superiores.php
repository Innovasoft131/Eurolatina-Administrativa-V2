<?php
    $pedidos = ControladorPedidos::ctrSumaPedidos();
    $item = null; 
    $valor = null;
    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
    $totalEmpleados = count($usuarios);

    $modelo = Controladorlineas::ctrMostrarLineas($item, $valor);
    $totalModelos = count($modelo);

    $clientes = ControladorClientes::ctrMostrarclientes($item, $valor);
    $totalClientes = count($clientes);

    $piezas = ControladorPiezas::obtenerPiezas();
    $totalPiezas = count($piezas);
?>

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?php echo number_format($totalPiezas); ?></h3>

            <p>Cantidad de Modelo</p>
        </div>
        <div class="icon">
            <i class="fas fa-shoe-prints"></i>
        </div>
        <a href="piezas" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo number_format($totalClientes); ?></h3>
            <p>Clientes</p>
        </div>
        <div class="icon">
            <i class="fas fa-user"></i>
        </div>
        <a href="clientes" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
 <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-secondary">
        <div class="inner">
            <h3><?php echo number_format($totalEmpleados); ?></h3>

            <p>Empleados Registrados</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
        <a href="usuarios" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo number_format($totalModelos); ?></h3>

            <p>Líneas</p>
        </div>
        <div class="icon">
            <i class="fas fa-socks"></i>
        </div>
        <a href="lineas" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->