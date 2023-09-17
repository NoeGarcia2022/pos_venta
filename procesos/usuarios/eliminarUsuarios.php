<?php
require_once("../../clases/Conexion.php");
require_once("../../clases/Usuarios.php");

$obj = new Usuarios();

$id = $_POST['idUsuarioU'];

echo $obj->eliminarUsuario($id);
