<?php
require_once "../../controladores/piezas.controlador.php";
require_once "../../modelos/pieza.modelo.php";

$descargarPiezas = new ControladorPiezas();
$descargarPiezas -> descargarReporte();
