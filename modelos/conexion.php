<?php

class Conexion{
    public static function conectar()
    {
        $link = new PDO("mysql:host=108.179.194.14;dbname=eurolati_eurolatina","eurolati_juanjo","Juan.3546+");
        $link->exec("set names utf8");

        return $link;
    }
}