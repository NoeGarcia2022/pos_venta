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

    public function crearVenta()
    {
        // Crear una instancia de la clase Conectar y obtener la conexión
        $c = new Conectar();
        $conexion = $c->conexion();

        $fecha = date('Y-m-d');
        $idventa = self::creaFolio();
        $datos = $_SESSION['tablaComprasTemp'];
        $idUsuario = $_SESSION['id_usuario'];
        $r = 0;

        for ($i = 0; $i < count($datos); $i++) {
            $d = explode("||", $datos[$i]);

            $sql = "INSERT INTO tb_ventas 
                            (id_venta, id_cliente, id_producto, id_usuario, precio, fechaCompra)
                    VALUES ('$idventa','$d[5]','$d[0]','$idUsuario','$d[3]','$fecha')";

            $r = $r + $result = mysqli_query($conexion, $sql);
        }

        return $r;
    }

    public function creaFolio()
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT id_venta from tb_ventas group by id_venta desc";

        $resul = mysqli_query($conexion, $sql);
        $id = mysqli_fetch_row($resul)[0];

        if ($id == "" or $id == null or $id == 0) {
            return 1;
        } else {
            return $id + 1;
        }
    }
}
