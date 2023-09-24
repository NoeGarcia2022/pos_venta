<?php
    session_start();
    // Obtener el índice del producto a quitar enviado a través de POST
    $index = $_POST['ind'];
    // Eliminar el producto con el índice dado de la lista de compras temporal
    unset($_SESSION['tablaComprasTemp'][$index]);
    // Reindexar el array para evitar índices vacíos
    $datos = array_values($_SESSION['tablaComprasTemp']);
    // Limpiar la variable de sesión existente
    unset($_SESSION['tablaComprasTemp']);
    // Restablecer la variable de sesión con los datos reindexados
    $_SESSION['tablaComprasTemp'] = $datos;
?>
