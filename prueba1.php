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