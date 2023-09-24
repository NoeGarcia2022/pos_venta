<?php
    // Iniciar una sesión o reanudar la sesión actual
    session_start();
    
    // Requerir el archivo de conexión a la base de datos
    require_once "../../clases/Conexion.php";

    // Crear una instancia de la clase Conectar para obtener una conexión a la base de datos
    $c = new Conectar();
    $conexion = $c->conexion();

    // Obtener los datos enviados por POST desde el formulario
    $idcliente = $_POST['clienteVenta'];
    $idproducto = $_POST['productoVenta'];
    $descripcion = $_POST['descripcionVenta'];
    $cantidad = $_POST['cantidadVenta'];
    $precio = $_POST['precioVenta'];

    // Consulta SQL para obtener el nombre y apellido del cliente
    $sql = "SELECT nombre,
                    apellido
                FROM tb_clientes
                WHERE id_cliente='$idcliente'";
    $result = mysqli_query($conexion, $sql);

    // Obtener el resultado de la consulta y construir el nombre completo del cliente
    $c = mysqli_fetch_row($result);
    $ncliente = $c[1] . "" . $c[0];

    // Consulta SQL para obtener el nombre del producto
    $sql = "SELECT nombre 
                FROM tb_articulos
                WHERE id_producto='$idproducto'";
    $result = mysqli_query($conexion, $sql);

    // Obtener el nombre del producto
    $nombreproducto = mysqli_fetch_row($result)[0];

    // Construir una cadena que contiene los datos del artículo
    $articulo = $idproducto . "||" .
                $nombreproducto . "||" .
                $descripcion . "||" .
                $cantidad . "||" .
                $precio . "||" .
                $ncliente . "||" .
                $idcliente;

    // Agregar la cadena al arreglo 'tablaComprasTemp' en la variable de sesión
    $_SESSION['tablaComprasTemp'][] = $articulo;            
?>
