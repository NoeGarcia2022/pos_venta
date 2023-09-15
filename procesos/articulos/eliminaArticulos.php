<?php

// Incluye los archivos de conexión y la clase Articulos
require_once("../../clases/Conexion.php");
require_once("../../clases/Articulos.php");

// Obtiene el ID del artículo a eliminar desde la solicitud POST
$idArt = $_POST['idArticulo'];

// Crea una instancia de la clase Articulos
$obj = new Articulos();

// Llama al método eliminaArticulo con el ID del artículo y muestra el resultado
echo $obj->eliminaArticulo($idArt);
