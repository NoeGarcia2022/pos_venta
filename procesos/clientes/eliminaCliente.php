<?php
    // incluimos la clase de conexion y cliente
    require_once("../../clases/Conexion.php");
    require_once("../../clases/Clientes.php");

    // instanciamos el objeto de la clase cliente
    $obj = new  Clientes();

    echo $obj->eliminarCliente($_POST['idClienteU']);
?>