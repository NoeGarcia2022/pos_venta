<?php

session_start();

// Requerir los archivos necesarios
require_once("../../clases/Conexion.php");
require_once("../../clases/Usuarios.php");

// Crear una instancia de la clase Usuarios
$obj = new Usuarios();

// Obtener los datos del formulario de inicio de sesión
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

// Llamar al método loginUsuario y mostrar la respuesta
$datos = array($usuario, $clave);
echo $obj->loginUsuario($datos);
