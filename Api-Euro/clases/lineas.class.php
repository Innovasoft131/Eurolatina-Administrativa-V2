<?php

require_once 'conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class Linea extends Conexion{
    public function mostrarLinea($idLinea){
        $respuestas = new Respuestas();
        $query = 'SELECT distinct l.id AS idLinea, l.nombre AS linea, m.id AS idMaquina, m.nombre AS maquina FROM lineas l JOIN maquina m ON l.id = m.idLinea JOIN maquinasProceso mp on m.id = mp.idMaquina WHERE l.id='.$idLinea.' AND (mp.estado = 0 or mp.estado = 1) ';
    //    $query = 'SELECT distinct l.id AS idLinea, l.nombre AS linea, m.id AS idMaquina, m.nombre AS maquina FROM lineas l JOIN maquina m ON l.id = m.idLinea JOIN maquinasProceso mp on m.id = mp.idMaquina join segundoModulo sm on sm.idMaquinaProceso = mp.id WHERE l.id='.$idLinea.' AND (mp.estado = 0 or mp.estado = 1) AND (sm.estado = 0 or sm.estado = 1)';
        $datos = parent::obtenerDatos($query);

        if($datos == null || $datos == ""){
            return $respuestas->error_400("Datos no encontrados");
        }else{
            return $datos;
        }
    }
    
    public function mostrarLineaTercerModulo($idLinea){
        $respuestas = new Respuestas();
    //    $query = 'SELECT distinct l.id AS idLinea, l.nombre AS linea, m.id AS idMaquina, m.nombre AS maquina FROM lineas l JOIN maquina m ON l.id = m.idLinea JOIN maquinasProceso mp on m.id = mp.idMaquina WHERE l.id='.$idLinea.' AND (mp.estado = 0 or mp.estado = 1) ';
        $query = 'SELECT distinct l.id AS idLinea, l.nombre AS linea, m.id AS idMaquina, m.nombre AS maquina FROM lineas l JOIN maquina m ON l.id = m.idLinea JOIN maquinasProceso mp on m.id = mp.idMaquina join tercerModulo tm on tm.idMaquinaProceso = mp.id WHERE l.id='.$idLinea.' AND (mp.estado = 0 or mp.estado = 1) AND (tm.estado = 0 or tm.estado = 1)';
        $datos = parent::obtenerDatos($query);

        if($datos == null || $datos == ""){
            return $respuestas->error_400("Datos no encontrados");
        }else{
            return $datos;
        }
    }

    public function mostrarLineas($tabla){
        $respuestas = new Respuestas();
        $query = 'SELECT * FROM '.$tabla.' ';
        $datos = parent::obtenerDatos($query);

        if($datos == null || $datos == ""){
            return $respuestas->error_400("Datos no encontrados");
        }else{
            return $datos;
        }
    }
}