<?php
require_once("../../clases/Conexion.php");
require_once("../../clases/Usuarios.php");

$obj = new Usuarios();

$datos = array(
    $_POST['idUsuarioU'],
    $_POST['nombreU'],
    $_POST['apellidoU'],
    $_POST['usuarioU']
);

echo $obj->actualizarUsuarios($datos);
