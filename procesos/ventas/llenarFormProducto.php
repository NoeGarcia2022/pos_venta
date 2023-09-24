<?php
    // Incluimos los archivos de clases necesarios
    require_once "../../clases/Conexion.php"; // Requerimos la clase de conexión
    require_once "../../clases/Ventas.php";    // Requerimos la clase de Ventas

    // Creamos una instancia del objeto Ventas
    $obj = new Ventas();

    // Llamamos al método obtenDatosProducto de la instancia $obj y pasamos el valor de 'idproducto' recibido por POST como argumento
    echo json_encode($obj->obtenDatosProducto($_POST['idproducto']));
?>
