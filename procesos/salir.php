<?php
    // Iniciamos la sesión para poder acceder y manipular variables de sesión
    session_start();

    // Destruimos la sesión actual y eliminamos todas las variables de sesión
    session_destroy();

    // Redirigimos al usuario a la página de inicio
    header("Location: ../index.php");
    exit(); // Se recomienda añadir exit() después de la redirección para asegurarse de que el script se detiene
?>
