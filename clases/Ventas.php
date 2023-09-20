<?php
class Ventas
{
    // Funcion y metodo para obtener productos
    public function obtenDatosProductos($idProducto)
    {
        // Crear una instancia de la clase Conectar y obtener la conexión
        $c = new Conectar();
        $conexion = $c->conexion();

        $sql = "SELECT art.nombre, art.descripcion, art.cantidad, img.ruta, art.precio
                    FROM tb_articulos AS art
                    INNER JOIN tb_imagenes AS img
                    ON art.id_imagen = img.id_imagen
                    AND art.id_producto = '$idProducto'";
        $result = mysqli_query($conexion, $sql);

        $ver = mysqli_fetch_row($result);

        $d = explode('/', $ver[3]);

        $img = $d[1] . '/' . $d[2] . '/' . $d[3];

        $datos = array(
            'nombre' => $ver[0],
            'descripcion' => $ver[1],
            'cantidad' => $ver[2],
            'ruta' => $img,
            'precio' => $ver[4]
        );

        return $datos;
    }
}
