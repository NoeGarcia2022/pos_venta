<?php
class Clientes
{
    // funcion para registrar un cliente
    public function agregaCliente($datos)
    {
        // Crear una instancia de la clase Conectar y obtener la conexión
        $c = new Conectar();
        $conexion = $c->conexion();

        // Sentencia SQL para poder insertar los datos
        $sql = "INSERT INTO tb_clientes (id_usuario, nombre, apellido, direccion, correo, telefono, dui, fechaCaptura)
                        VALUES  ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]')";

        // Retornamos nustras varibles de $conexion, $sql
        return mysqli_query($conexion, $sql);
    }
}
