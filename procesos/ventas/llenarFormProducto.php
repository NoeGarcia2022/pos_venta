<?php
    // incluiomos la conexion y la clase ventas
    require_once("../../clases/Conexion.php");
    require_once("../../clases/Ventas.php");

    $obj = new Ventas();

    echo json_encode($obj->obtenDatosProductos($_POST['idProducto']));
?>