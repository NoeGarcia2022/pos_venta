<?php
    // Incluimos la conexion y la clase Clientes
    require_once("../../clases/Conexion.php");
    require_once("../../clases/Clientes.php");

    // Instanciamos la clase Clientes
    $obj = new Clientes();

    $datos = array(
        $_POST['idClienteU'],
        $_POST['nombreU'],
        $_POST['apellidosU'],
        $_POST['direccionU'],
        $_POST['correoU'],
        $_POST['telefonoU'],
        $_POST['duiU']
    );

    echo $obj->actualizarClientes($datos);
?>