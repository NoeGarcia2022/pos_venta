<?php

session_start();
// Incluimos la conexion y la clase clientes
require_once("../../clases/Conexion.php");
require_once("../../clases/Clientes.php");

$obj = new Clientes();

$fecha = date("Y-m-d");
$idusuario = $_SESSION['id_usuario'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$dui = $_POST['dui'];

$datos = array(
    $idusuario,
    $nombre,
    $apellidos,
    $direccion,
    $correo,
    $telefono,
    $dui,
    $fecha
);

echo $obj->agregaCliente($datos);
