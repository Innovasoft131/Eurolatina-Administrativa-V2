<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EuroLatina</title>
  <!-- PLUGINS DE CSS -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="icon" href="vistas/img/plantilla/euroLatina.ico">
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables/datatables.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables/DataTables-1.10.23/css/dataTables.bootstrap4.css">
  
  <!-- daterangepicker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">
  <link rel="stylesheet" href="vistas/dist/css/jquery.toast.css">

  <!-- morris https://morrisjs.github.io/morris.js//-->
  <link rel="stylesheet" href="vistas/plugins/morris.js/morris.css">

  <!-- PLUGINS DE JAVASCRIPT -->
   <!-- jQuery -->
   <script src="vistas/plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="vistas/plugins/bootstrap/js/bootstrap.min.js"></script>
   
   <!-- AdminLTE App -->
   <script src="vistas/dist/js/adminlte.js"></script>
   <script src="vistas/dist/js/jquery.toast.js"></script>
   <!-- AdminLTE for demo purposes --> 
   <script src="vistas/dist/js/demo.js"></script>

   <!-- overlayScrollbars -->
   <script src="vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

   <!-- DataTables  & Plugins -->
   <script src="vistas/plugins/datatables/jquery.dataTables.js"></script>
   <script src="vistas/plugins/datatables/DataTables-1.10.23/js/dataTables.bootstrap4.js"></script>

   <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

   <!-- daterangepicker http://www.daterangepicker.com/-->
   <script type="text/javascript" src="vistas/plugins/daterangepicker/moment.min.js"></script>
   <script type="text/javascript" src="vistas/plugins/daterangepicker/daterangepicker.js"></script>

   <!-- morris https://morrisjs.github.io/morris.js//-->
   <script type="text/javascript" src="vistas/plugins/raphael/raphael.min.js"></script>
   <script type="text/javascript" src="vistas/plugins/morris.js/morris.min.js"></script>
</head>

<!-- Site wrapper -->

    <?php

        if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
            echo '<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">';
            echo '<div class="wrapper">';
            // menu secundario
            include "modulos/cabezote.php";
            // menu principal
            include "modulos/menu.php";

            // redireccionamiento a cada modulo
            if(isset($_GET["ruta"])){
                if($_GET["ruta"]=="usuarios" ||
                $_GET["ruta"]=="inicio" ||
                $_GET["ruta"]=="clientes" ||
                $_GET["ruta"]=="maquinas" ||
                $_GET["ruta"]=="pedidos" ||
                $_GET["ruta"]=="import" ||
                $_GET["ruta"]=="estado" ||
                $_GET["ruta"]=="asignar" ||
                $_GET["ruta"]=="piezas" ||
                $_GET["ruta"]=="modelo" ||
                $_GET["ruta"]=="colores" ||
                $_GET["ruta"]=="reportes" ||
                $_GET["ruta"]=="reportesUsuario" ||
                $_GET["ruta"]=="problemas" ||
                $_GET["ruta"]=="importarPedido" ||
                $_GET["ruta"]=="reporteErrores" ||
                $_GET["ruta"]=="reportePlanchado" ||
                $_GET["ruta"]=="reporteMaquinas" ||
                $_GET["ruta"]=="lineas" ||
                $_GET["ruta"]=="combinacion" ||
                $_GET["ruta"]=="presupuesto" ||
                $_GET["ruta"]=="oportunidad" ||
                $_GET["ruta"]=="porcentajeExito" ||
                $_GET["ruta"]=="tipoAccion" ||
                $_GET["ruta"]=="unidad" ||
                $_GET["ruta"]=="estado" ||
                $_GET["ruta"]=="Ppendientes" ||
                $_GET["ruta"]=="PEnProceso" ||
                $_GET["ruta"]=="presupuestoView" ||
                $_GET["ruta"]=="presupuestoInfo" ||
                $_GET["ruta"]=="reporteModelosTerminados" ||
                $_GET["ruta"]=="salir"){
                    include "modulos/".$_GET["ruta"].".php";
                }else{
                    include "modulos/404.php";
                }
            }else{
                include "modulos/inicio.php";
            }
            
            // pie de pagina
            include "modulos/footer.php";
            echo '</div>';

            echo '<script src="vistas/js/plantilla.js"></script>';
            echo '<script src="vistas/js/usuarios.js"></script>';
            echo '<script src="vistas/js/maquinas.js"></script>';
            echo '<script src="vistas/js/cliente.js"></script>';
            echo '<script src="vistas/js/pedidos.js"></script>';
            echo '<script src="vistas/js/modelo.js"></script>';
            echo '<script src="vistas/js/pieza.js"></script>';
            echo '<script src="vistas/js/colores.js"></script>';
            echo '<script src="vistas/js/reporteProduccion.js"></script>';
            echo '<script src="vistas/js/problemas.js"></script>';
            echo '<script src="vistas/js/asignar.js"></script>';
            echo '<script src="vistas/js/reporteUsuarios.js"></script>';
            echo '<script src="vistas/js/importar.js"></script>';
            echo '<script src="vistas/js/reporteMaquinas.js"></script>';
            echo '<script src="vistas/js/lineas.js"></script>';
            echo '<script src="vistas/js/combinacion.js"></script>';
            echo '<script src="vistas/js/defectuosas.js"></script>';
            echo '<script src="vistas/js/unidad.js"></script>';
            echo '<script src="vistas/js/estado.js"></script>';
            echo '<script src="vistas/js/porcentajeExito.js"></script>';


            echo '<script src="vistas/js/oportunidad.js"></script>';

            echo '<script src="vistas/js/tipoaccion.js"></script>';
            echo '<script src="vistas/js/presupuesto.js"></script>';

            echo '</body>';
        }else{
            echo '<body class="hold-transition  layout-fixed  login-page">';
            // login
            include "modulos/login.php";
            echo '</body>';
        }
    ?>
<!-- ./wrapper -->



</html>
