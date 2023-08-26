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

    public function loginUsuario($datos)
    {
        // Crear una instancia de la clase Conectar y obtener la conexión
        $c = new Conectar();
        $conexion = $c->conexion();

        // Hash de la clave proporcionada
        $clave = sha1($datos[1]);

        // Establecer variables de sesión con el usuario y el ID del usuario
        $_SESSION['usuario'] = $datos[0];
        $_SESSION['id_usuario'] = self::traeID($datos);

        // Consulta SQL para verificar las credenciales en la base de datos
        $sql = "SELECT * FROM tb_usuarios WHERE correo = '$datos[0]'
                            AND clave = '$clave'";

        $result = mysqli_query($conexion, $sql);

        // Verificar si las credenciales son correctas
        if (mysqli_num_rows($result) > 0) {
            return 1; // Credenciales correctas
        } else {
            return 0; // Credenciales incorrectas
        }
    }

    public function traeID($datos)
    {
        // Crear una instancia de la clase Conectar y obtener la conexión
        $c = new Conectar();
        $conexion = $c->conexion();

        // Hash de la clave proporcionada
        $clave = sha1($datos[1]);

        // Consulta SQL para obtener el ID del usuario
        $sql = "SELECT id_usuario FROM tb_usuarios
                            WHERE correo='$datos[0]'
                            AND clave='$clave'";
        $result = mysqli_query($conexion, $sql);

        // Obtener el ID del usuario y retornarlo
        return mysqli_fetch_row($result)[0];
    }
}
