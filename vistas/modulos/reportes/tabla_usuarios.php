<?php
if(isset($_GET["fechaInicial"])){
    error_reporting(0);
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
}else{
    $fechaInicial = null;
    $fechaFinal = null;
}

//$reportePiezas = ControladorPiezas::reportePiezasUsuario($fechaInicial, $fechaFinal);
$reporteUsuarios = ControladorPiezas::reporteUsuario($fechaInicial, $fechaFinal);



?>

<div class="table-responsive">
    <table class="table  table-bordered table-striped   tablas " >
        <thead>
            <tr>
                <th style="width:10px">#</th>
                <th>Empleado</th>
                <th>Perfil</th>
                <th>Turno</th>
                <th>Ultimo acceso</th>
                <th>Accion</th>
                
            </tr>
        </thead>
        <tbody>
             <?php
             foreach ($reporteUsuarios as $key => $value) {
                 echo '<tr>
                         <td>'.$key.'</td>
                         <td>'.$value["nombre"].'</td>
                         <td>'.$value["perfil"].'</td>
                         <td>'.$value["turno"].'</td>
                         <td>'.$value["ultimo_login"].'</td>
                         <td><button class="btn btn-dark btnMostrarReporteUsuario" idUsuario="'.$value["idUsuario"].'" fechaInicial="'.$fechaInicial.'" fechaFinal="'.$fechaFinal.'"><i class="fas fa-eye"></i></button></td>
                         
                    </tr>';
             }
             ?>
        </tbody>
    </table>
</div>