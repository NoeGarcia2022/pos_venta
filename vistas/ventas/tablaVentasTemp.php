<?php
session_start();
?>

<h2 class="text-center bg-info">Hacer venta</h2>
<h5>
    <strong><div id="nombreClienteVenta"></div></strong>
</h5>
<!-- Agregar botón de generar venta aquí si es necesario -->
<caption>
    <span class="btn btn-outline-success" onclick="crearVenta()"> Generar venta
        <span class="fa-solid fa-dollar-sign"></span>
    </span>
</caption>

<div class="table-responsive">
    <table class="table table-hover text-center table-bordered mt-2">
        <thead class="table-dark">
            <tr>
                <!-- <th scope="col">IdProducto</th> -->
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <!-- <th scope="col">NombreCliente</th> -->
                <!-- <th scope="col">IdCliente</th> -->
                <!-- Dejar la columna "Quitar" visible en todas las pantallas -->
                <th scope="col">Quitar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0; // Variable para el total de la compra en dinero
            $cliente = ""; // Variable que guarda el nombre del cliente
            if (isset($_SESSION['tablaComprasTemp'])) :
                $i = 0;
                foreach ($_SESSION['tablaComprasTemp'] as $key) {
                    $d = explode("||", $key)
            ?>
                    <tr>
                        <!-- <td><?php echo $d[0] ?></td> -->
                        <td><?php echo $d[1] ?></td>
                        <td><?php echo $d[2] ?></td>
                        <td><?php echo $d[3] ?></td>
                        <td><?php echo 1; ?></td>
                        <!-- <td><?php echo $d[4] ?></td> -->
                        <!-- <td><?php echo $d[5] ?></td> -->
                        <td>
                            <span class="btn btn-outline-danger">
                                <span class="fa-solid fa-trash" onclick="quitarP('<?php echo $i; ?>')"></span>
                            </span>
                        </td>
                    </tr>
            <?php
                    $total = $total + $d[3];
                    $i++;
                    $cliente = $d[4];
                }
            endif;
            ?>
        </tbody>
        <td><strong>Total de venta:</strong> <?php echo "$".$total; ?> </td>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        nombre = "<?php echo @$cliente; ?>";
        $('#nombreClienteVenta').text("Nombre de cliente: " + nombre);
    })
</script>