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

    // Funcion o metodo para actualizar datos de categoria
    public function actualizaCategoria($datos)
    {
        $c = new Conectar();
        $conexion = $c->conexion();

        // Sentencia sql para poder actualizar los datos 
        $sql = "UPDATE tb_categorias set nombreCategoria='$datos[1]'
                    WHERE id_categoria='$datos[0]'";

        echo mysqli_query($conexion, $sql);
    }

    // Funcion o metodo para eliminar categoria
    public function eliminaCategoria($idcategoria)
    {
        $c = new Conectar();
        $conexion = $c->conexion();

        // Sentencia sql para poder actualizar los datos 
        $sql = "DELETE FROM tb_categorias WHERE id_categoria='$idcategoria'";

        return mysqli_query($conexion, $sql);
    }
}
