<?php

session_start();
require_once("../../clases/Conexion.php");
require_once("../../clases/Categorias.php");

$fecha = date("Y-m-d");
$idusuario = $_SESSION['id_usuario'];
$categoria = $_POST['categoria'];

$datos = array(
    $idusuario,
    $categoria,
    $fecha
);

$obj = new Categorias();

echo $obj->agregaCategoria($datos);
