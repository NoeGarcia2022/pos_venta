<?php
    // incluimos la conexion
    require_once("../../clases/Conexion.php");
    require_once("../../clases/Usuarios.php");

    // instanciamos nuestra clase de usuarios
    $obj = new Usuarios();

    echo json_encode($obj->obtenDatosUsuarios($_POST['idUsuario']));
