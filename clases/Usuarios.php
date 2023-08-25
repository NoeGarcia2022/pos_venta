<?php
class Usuarios
{
    // Este método registra un nuevo usuario en la base de datos
    public function registroUsuario($datos)
    {
        // Crear una instancia de la clase Conectar y obtener la conexión
        $c = new Conectar();
        $conexion = $c->conexion();

        // Obtener la fecha actual
        $fecha = date('Y-m-d');

        // Consulta SQL para insertar los datos del usuario en la base de datos
        $sql = "INSERT INTO tb_usuarios (nombre,
                                apellido,
                                correo,
                                clave,
                                fechaCaptura)
                    VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$fecha')";

        // Ejecutar la consulta y retornar el resultado
        return mysqli_query($conexion, $sql);
    }
}
