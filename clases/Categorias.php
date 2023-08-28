<?php
class Categorias
{
    // Funcion o metodo para agregar una categoria
    public function agregaCategoria($datos)
    {
        $c = new Conectar();
        $conexion = $c->conexion();

        // Sentencia SQL para poder insertar los datos
        // REVISAR BIEN LOS VALUES QUE NO LE FALTEN COMILLAS SIMPLES
        $sql = "INSERT into tb_categorias(id_usuario,nombreCategoria,fechaCaptura) VALUES ('$datos[0]','$datos[1]','$datos[2]')";

        // Retornamos nustras varibles de $conexion, $sql
        return mysqli_query($conexion, $sql);
    }
}
