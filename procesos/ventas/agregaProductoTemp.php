<?php
session_start();
require_once "../../clases/Conexion.php";

// // Agrega var_dump($_POST); para mostrar los contenidos de $_POST
// var_dump($_POST);

$c = new conectar();
$conexion = $c->conexion();

$idcliente = $_POST['clienteVenta'];
$idproducto = $_POST['productoVenta'];
$descripcion = $_POST['descripcionV'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precioV'];

$sql = "SELECT nombre,apellido 
        FROM tb_clientes 
        WHERE id_cliente='$idcliente'";
$result = mysqli_query($conexion, $sql);

$c = mysqli_fetch_row($result);

$ncliente = $c[1] . " " . $c[0];

$sql = "SELECT nombre 
        FROM tb_articulos 
        WHERE id_producto='$idproducto'";
$result = mysqli_query($conexion, $sql);

$nombreproducto = mysqli_fetch_row($result)[0];

$articulo = $idproducto . "||" .
        $nombreproducto . "||" .
        $descripcion . "||" .
        $precio . "||" .
        $ncliente . "||" .
        $idcliente;

$_SESSION['tablaComprasTemp'][] = $articulo;
