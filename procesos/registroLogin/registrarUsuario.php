<?php
// Requerir los archivos necesarios
require_once("../../clases/Conexion.php");
require_once("../../clases/Usuarios.php");

// Crear una instancia de la clase Usuarios
$obj = new Usuarios();

// Encriptar la clave utilizando el algoritmo SHA-1
$clave = sha1($_POST['clave']);

// Almacenar los datos del formulario en un array
$datos = array(
    $_POST['nombre'],
    $_POST['apellido'],
    $_POST['usuario'],
    $clave
);

// Llamar al método registroUsuario y mostrar la respuesta
echo $obj->registroUsuario($datos);
