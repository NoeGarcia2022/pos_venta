<?php
// Incluye los archivos de conexión y la clase Articulos
require_once("../../clases/Conexion.php");
require_once("../../clases/Articulos.php");

// Crea un array llamado $datos que contiene los valores enviados por POST
$datos = array(
    $_POST['idArticulo'],
    $_POST['categoriaSelectU'],
    $_POST['nombreU'],
    $_POST['descripcionU'],
    $_POST['cantidadU'],
    $_POST['precioU']
);

// Crea una instancia de la clase Articulos
$obj = new Articulos();

// Llama al método actualizaArticulo de la instancia $obj y pasa el array $datos como argumento
$resultado = $obj->actualizaArticulo($datos);

// Imprime el resultado de la actualización, que podría ser un mensaje de éxito o un código de error
echo $resultado;
