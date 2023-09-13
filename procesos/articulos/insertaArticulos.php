<?php

// Inicia una sesión PHP para manejar datos de sesión.
session_start();

// Obtiene el ID de usuario de la sesión actual.
$idUser = $_SESSION['id_usuario'];

// Incluye las clases necesarias para la funcionalidad.
require_once("../../clases/Conexion.php");
require_once("../../clases/Articulos.php");

// Crea una instancia de la clase Articulos.
$obj = new Articulos();

// Crea un array vacío para almacenar datos.
$datos = array();

// Obtiene información sobre la imagen que se está subiendo.
$nombreImg = $_FILES['imagen']['name']; // Nombre de la imagen.
$rutaAlmacenamiento = $_FILES['imagen']['tmp_name']; // Ruta temporal de la imagen.
$carpeta = '../../archivos/'; // Carpeta de destino para almacenar la imagen.
$rutaFinal = $carpeta . $nombreImg; // Ruta final de almacenamiento de la imagen.

// Prepara un array con información sobre la imagen.
$datosImg = array(
    $_POST['categoriaSelect'], // Categoría de la imagen.
    $nombreImg, // Nombre de la imagen.
    $rutaFinal // Ruta final de almacenamiento de la imagen.
);

// Mueve la imagen desde su ubicación temporal a la carpeta de destino.
if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
    // Si la subida de la imagen tiene éxito, procede.
    
    // Inserta la información de la imagen en la base de datos y obtiene el ID de la imagen.
    $idImg = $obj->agregaImg($datosImg);

    if ($idImg > 0) {
        // Si la inserción de la imagen en la base de datos es exitosa, procede.
        
        // Prepara un array con información relacionada con el artículo.
        $datos[0] = $_POST['categoriaSelect']; // Categoría del artículo.
        $datos[1] = $idImg; // ID de la imagen asociada al artículo.
        $datos[2] = $idUser; // ID del usuario que está realizando la acción.
        $datos[3] = $_POST['nombre']; // Nombre del artículo.
        $datos[4] = $_POST['descripcion']; // Descripción del artículo.
        $datos[5] = $_POST['cantidad']; // Cantidad del artículo.
        $datos[6] = $_POST['precio']; // Precio del artículo.

        // Inserta la información del artículo en la base de datos y muestra el resultado.
        echo $obj->insertaArticulo($datos);
    } else {
        // Si la inserción de la imagen en la base de datos falla, muestra 0.
        echo 0;
    }
}
