<?php
require_once("../../clases/Conexion.php");
require_once("../../clases/Categorias.php");

$id = $_POST['idcategoriaU'];

$obj = new Categorias();

echo $obj->eliminaCategoria($id);
