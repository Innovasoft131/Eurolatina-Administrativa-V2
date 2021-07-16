<?php


$host = "localhost";
$usuario = 'root';
$password = 'root';
$base = 'eurolatina';

$conn = mysqli_connect($host, $usuario, $password, $base);

if (mysqli_connect_errno()){
        echo json_encode("{'Connection Not Executed':'".mysqli_connect_error()."'}");
        exit();
}
?>