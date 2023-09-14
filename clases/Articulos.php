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

    public function obtenDatosArticulo($idArticulo) {
        // Crea una instancia de la clase Conectar (asumiendo que existe)
        $c = new Conectar();
        // Establece una conexión a la base de datos
        $conexion = $c->conexion();
    
        // Consulta SQL para obtener los datos del artículo
        $sql = "SELECT id_producto, id_categoria, nombre, descripcion, cantidad, precio 
                FROM tb_articulos WHERE id_producto='$idArticulo'";
        
        // Ejecuta la consulta SQL
        $result = mysqli_query($conexion, $sql);
    
        // Verifica si se encontraron resultados
        if (!$result) {
            // Maneja el error si la consulta no se ejecuta correctamente
            return array('error' => 'Error en la consulta SQL');
        }
    
        // Obtiene la primera fila de resultados
        $ver = mysqli_fetch_assoc($result);
    
        // Verifica si se encontraron resultados válidos
        if (!$ver) {
            // Maneja el caso en el que no se encontraron datos para el artículo
            return array('error' => 'No se encontraron datos para el artículo');
        }
    
        // Crea un arreglo asociativo con los datos del artículo
        $datos = array(
            "id_producto" => $ver['id_producto'],
            "id_categoria" => $ver['id_categoria'],
            "nombre" => $ver['nombre'],
            "descripcion" => $ver['descripcion'],
            "cantidad" => $ver['cantidad'],
            "precio" => $ver['precio']
        );
    
        // Devuelve los datos del artículo en un formato JSON
        return $datos;
    }
    

    public function actualizaArticulo($datos) {
        // Crea una instancia de la clase Conectar (asumiendo que existe)
        $c = new Conectar();
        // Establece una conexión a la base de datos
        $conexion = $c->conexion();
    
        // Preparar los datos para evitar SQL injection
        $idProducto = mysqli_real_escape_string($conexion, $datos[0]);
        $idCategoria = mysqli_real_escape_string($conexion, $datos[1]);
        $nombre = mysqli_real_escape_string($conexion, $datos[2]);
        $descripcion = mysqli_real_escape_string($conexion, $datos[3]);
        $cantidad = mysqli_real_escape_string($conexion, $datos[4]);
        $precio = mysqli_real_escape_string($conexion, $datos[5]);
    
        // Consulta SQL para actualizar el artículo
        $sql = "UPDATE tb_articulos
                SET id_categoria='$idCategoria', nombre='$nombre', descripcion='$descripcion', cantidad='$cantidad', precio='$precio'
                WHERE id_producto='$idProducto'";
    
        // Ejecuta la consulta SQL y verifica si se ejecutó correctamente
        if (mysqli_query($conexion, $sql)) {
            return true; // Devuelve verdadero si la actualización fue exitosa
        } else {
            return false; // Devuelve falso si hubo un error en la actualización
        }
    }
    
}
?>
