<?php
session_start();

// print_r($_SESSION['tablaComprasTemp']);

?>

<!-- <h4>Hacer Venta</h4> -->
<h4>
    <strong>
        <div id="nombreclienteVenta"></div>
    </strong>
</h4>
<caption>
    <span class="btn btn-success" onclick="crearVenta()" >Generar Venta
        <span class=""><i class="fa-solid fa-dollar-sign"></i></span>
    </span>
</caption>
<table class="table table-responsive table-hover table-bordered text-center mt-2">
    <thead class="table bg-dark text-light">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Quitar</th>
        </tr>
    </thead>
    <?php
    $total = 0; //variable que guarda el total de la compra en dinero
    $cliente = ""; //variable que guarda el nombre del cliente

    $i = 0;

    if (isset($_SESSION['tablaComprasTemp'])) :
        foreach (@$_SESSION['tablaComprasTemp'] as $key) {
            $d = explode("||", @$key);
            $subtotal = $d[4] * $d[3]; // Calcular el subtotal para cada producto
            $total += $subtotal; // Sumar el subtotal al total
    ?>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $d[1] ?></th>
                    <th scope="row"><?php echo $d[2] ?></th>
                    <th scope="row"><?php echo "$ " . $d[4] ?></th>
                    <th scope="row"><?php echo $d[3] ?></th>
                    <th scope="row">
                        <span class="btn btn-danger btn-sm" onclick="quitarP('<?php echo $i; ?>')">
                            <span class=""><i class="fa-solid fa-delete-left"></i></span>
                        </span>
                    </th>
                </tr>
            </tbody>
    <?php
            // $total = $total + $d[4] * $d[3];
            $i++;
            $cliente = $d[5];
            // Si $cliente está vacío, establece "Sin cliente" como valor
            if (empty($cliente)) {
                $cliente = "Sin cliente";
            }
        }
    endif;
    ?>
    <tr>
        <th scope="row"><strong>Total de venta: <?php echo "$" . $total ?></strong></th>
    </tr>
</table>

<script type="text/javascript">
    $(document).ready(function () {
        var nombre = "<?php echo htmlspecialchars($cliente, ENT_QUOTES, 'UTF-8') ?>";
        $('#nombreclienteVenta').text("Nombre de cliente: " + nombre);
    });
</script>