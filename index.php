<?php
// se requiere utilizar los controladores
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/maquinas.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/pedidos.controlador.php";
require_once "controladores/import.controlador.php";
require_once "controladores/estado.controlador.php";
require_once "controladores/asignar.controlador.php";
require_once "controladores/modelos.controlador.php";
require_once "controladores/colores.controlador.php";
require_once "controladores/piezas.controlador.php";
require_once "controladores/problemas.controlador.php";
require_once "controladores/planchado.controlador.php";
require_once "controladores/reporteMaquinas.controlador.php";
require_once "controladores/lineas.controlador.php";
require_once "controladores/combinacion.controlador.php";
require_once "controladores/unidad.controlador.php";
require_once "controladores/estado.controlador.php";
require_once "controladores/porcentajeExito.controlador.php";

// se requiere utilizar los modelos
require_once "modelos/usuarios.modelo.php";
require_once "modelos/maquinas.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/pedidos.modelo.php";
require_once "modelos/import.modelo.php";
require_once "modelos/estado.modelo.php";
require_once "modelos/asignar.modelo.php";
require_once "modelos/modelo.modelo.php";
require_once "modelos/colores.modelo.php";
require_once "modelos/pieza.modelo.php";
require_once "modelos/problemas.modelo.php";
require_once "modelos/planchado.modelo.php";
require_once "modelos/reporteMaquinas.modelo.php";
require_once "modelos/lineas.modelo.php";
require_once "modelos/combinacion.modelo.php";
require_once "modelos/unidad.modelo.php";
require_once "modelos/estado.modelo.php";
require_once "modelos/porcentajeexito.modelo.php";

// Librerias



$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();