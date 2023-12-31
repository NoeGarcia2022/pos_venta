<?php
class Ventas
{
    public function obtenDatosProducto($idproducto)
    {
        // Crear una instancia de la clase Conectar para obtener una conexión a la base de datos
        $c = new Conectar();
        $conexion = $c->conexion();

        // Crear la consulta SQL para obtener los datos del producto correspondiente al $idproducto
        $sql = "SELECT art.nombre,
                    art.descripcion,
                    art.cantidad,
                    img.ruta,
                    art.precio
                FROM tb_articulos AS art
                INNER JOIN tb_imagenes AS img
                ON art.id_imagen = img.id_imagen
                AND art.id_producto = '$idproducto'";

        // Ejecutar la consulta SQL en la conexión a la base de datos
        $result = mysqli_query($conexion, $sql);

        // Obtener la primera fila de resultados
        $ver = mysqli_fetch_row($result);

        // Extraer la ruta de la imagen de la base de datos y formatearla
        $d = explode('/', $ver[3]);
        $img = $d[1] . '/' . $d[2] . '/' . $d[3];

        // Crear un arreglo asociativo con los datos del producto y retornarlo
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
        // Crear una instancia de la clase Conectar para obtener una conexión a la base de datos
        $conexion = (new Conectar())->conexion();

        $fecha = date('Y-m-d');
        $idventa = self::creaFolio();
        $datos = $_SESSION['tablaComprasTemp'];
        $idusuario = $_SESSION['id_usuario'];
        $r = 0;

        for ($i = 0; $i < count($datos); $i++) {
            $d = explode("||", $datos[$i]);

            $sql = "INSERT INTO tb_ventas (id_venta,
                                            id_cliente,
                                            id_producto,
                                            id_usuario,
                                            precio,
                                            fechaCompra)
                            VALUES ('$idventa',
                                    '$d[6]',
                                    '$d[0]',
                                    '$idusuario',
                                    '$d[4]',
                                    '$fecha')";
            $r = $r + $result = mysqli_query($conexion, $sql);
        }
        return $r;
    }

    public function creaFolio()
    {
        // Crear una instancia de la clase Conectar para obtener una conexión a la base de datos
        $c = new Conectar();
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
