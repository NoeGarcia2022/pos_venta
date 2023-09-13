<?php
// Definición de la clase Articulos
class Articulos
{
    // Método para agregar una imagen a la base de datos
    public function agregaImg($datos)
    {
        // Crear una instancia de la clase Conectar (se asume que existe)
        $c = new Conectar();
        // Establecer una conexión a la base de datos
        $conexion = $c->conexion();

        // Obtener la fecha actual en el formato 'YYYY-MM-DD'
        $fecha = date('Y-m-d');

        // Crear la consulta SQL para insertar la información de la imagen en la tabla 'tb_imagenes'
        $sql = "INSERT INTO tb_imagenes (id_categoria, nombre, ruta, fechaSubida)
                VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$fecha')";

        // Ejecutar la consulta SQL y verificar si hay errores
        if (!mysqli_query($conexion, $sql)) {
            die('Error en la consulta: ' . mysqli_error($conexion));
        }

        // Devolver el ID de la imagen insertada en la base de datos
        return mysqli_insert_id($conexion);
    }

    // Método para insertar información de un artículo en la base de datos
    public function insertaArticulo($datos)
    {
        // Crear una instancia de la clase Conectar (se asume que existe)
        $c = new Conectar();
        // Establecer una conexión a la base de datos
        $conexion = $c->conexion();

        // Obtener la fecha actual en el formato 'YYYY-MM-DD'
        $fecha = date('Y-m-d');

        // Crear la consulta SQL para insertar la información del artículo en la tabla 'tb_articulos'
        $sql = "INSERT INTO tb_articulos (id_categoria, id_imagen, id_usuario, nombre, descripcion, cantidad, precio, fechaCaptura) 
                VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]', '$fecha')";

        // Ejecutar la consulta SQL y retornar el resultado (true/false)
        return mysqli_query($conexion, $sql);
    }
}
?>
