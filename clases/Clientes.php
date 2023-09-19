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

    // Funcion o metodo para obtener datos de la tabla clientes hacia form de actualizar
    public function obtenDatosClientes($idClienteU) {
        // Crear una instancia de la clase Conectar y obtener la conexión
        $c = new Conectar();
        $conexion = $c->conexion();

        $sql = "SELECT id_cliente, nombre, apellido, direccion, correo, telefono, dui
                    FROM tb_clientes
                    WHERE id_cliente = '$idClienteU'";
        
        $result = mysqli_query($conexion, $sql);

        $ver = mysqli_fetch_row($result);

        $datos = array(
            'id_cliente' => $ver[0],
            'nombre' => $ver[1],
            'apellido' => $ver[2],
            'direccion' => $ver[3],
            'correo' => $ver[4],
            'telefono' => $ver[5],
            'dui' => $ver[6]
        );
        return $datos;
    }
}
