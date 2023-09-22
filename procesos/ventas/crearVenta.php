<?php

session_start();

// Incluimos la conexión y la clase Ventas
require_once("../../clases/Conexion.php");
require_once("../../clases/Ventas.php");

// Objeto de la clase Ventas
$obj = new Ventas();

if(count($_SESSION['tablaComprasTemp'])==0){
    echo 0;
}else{
    $result=$obj->crearVenta();
    unset($_SESSION['tablaComprasTemp']);
    echo $result;
}
