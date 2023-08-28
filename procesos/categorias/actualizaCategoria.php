<?php
require_once("../../clases/Conexion.php");
require_once("../../clases/Categorias.php");

$datos = array(
    $_POST['idcategoriaU'],
    $_POST['categoriaU']
);

$obj = new Categorias();

echo $obj->actualizaCategoria($datos);
