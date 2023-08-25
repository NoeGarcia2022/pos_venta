<?php
class ConexionException extends Exception {
    // Esta clase de excepción personalizada nos permitirá manejar los errores de conexión de manera más específica.
}

class Conectar
{
    private $servidor = "localhost";
    private $usuario = "root";
    private $password = "";
    private $bd = "bd_ventas";

    public function conexion()
    {
        // Intentamos establecer la conexión
        try {
            $conexion = mysqli_connect(
                $this->servidor,
                $this->usuario,
                $this->password,
                $this->bd
            );

            // Verificamos si la conexión se estableció exitosamente
            if (!$conexion) {
                throw new ConexionException("No se pudo conectar a la base de datos: " . mysqli_connect_error());
            }

            return $conexion;
        } catch (ConexionException $e) {
            // En caso de error, lanzamos la excepción personalizada
            throw $e;
        }
    }
}

$obj = new Conectar();
try {
    $conexion = $obj->conexion();
    echo "Conexion exitosa con nuestra bd";
} catch (ConexionException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
