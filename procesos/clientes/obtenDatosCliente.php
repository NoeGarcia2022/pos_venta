<?php
    // Incluimos la conexion y la clase Clientes
    require_once("../../clases/Conexion.php");
    require_once("../../clases/Clientes.php");

    // Instanciamos la clase Clientes
    $obj = new Clientes();

    echo json_encode($obj->obtenDatosClientes($_POST['idClienteU']));
?>