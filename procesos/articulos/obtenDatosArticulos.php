<?php
require_once("../../clases/Conexion.php");
require_once("../../clases/Articulos.php");

// Comprueba si se ha recibido un ID de artículo válido
if (isset($_POST['idArt'])) {
    // Crea una instancia de la clase Articulos
    $obj = new Articulos();

    // Obtén el ID del artículo desde POST
    $idArt = $_POST['idArt'];

    // Obtiene los datos del artículo
    $datosArticulo = $obj->obtenDatosArticulo($idArt);

    // Verifica si se obtuvieron datos
    if ($datosArticulo !== null) {
        // Devuelve los datos como respuesta JSON
        echo json_encode($datosArticulo);
    } else {
        // Si no se encontraron datos, devuelve una respuesta de error
        echo json_encode(array('error' => 'No se encontraron datos para el artículo'));
    }
} else {
    // Si no se proporcionó un ID de artículo válido, devuelve una respuesta de error
    echo json_encode(array('error' => 'ID de artículo no válido'));
}
?>
