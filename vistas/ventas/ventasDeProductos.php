<?php

// incluimos la conexion y la instanciamos
require_once("../../clases/Conexion.php");
$c = new Conectar();
$conexion = $c->conexion();

?>

<div class="row">
    <div class="col-sm-4">
        <!-- Formulario para agregar ventas -->
        <form id="frmVentas" action="" method="post" class="form-control" enctype="multipart/form-data">
            <h3>Vender Producto</h3>
            <hr>
            <div class="form-group">
                <label for="clienteVenta" class="form-label">Selecciona Cliente</label>
                <select class="form-select" name="clienteVenta" id="clienteVenta">
                    <option selected value="A">Buscar</option>
                    <option value="0">Sin cliente</option>
                    <?php
                    $sql = "SELECT id_cliente, nombre, apellido FROM tb_clientes";
                    $result = mysqli_query($conexion, $sql);
                    while ($cliente = mysqli_fetch_row($result)) :
                    ?>
                        <option value="<?php echo $cliente[0] ?>"><?php echo $cliente[2] . " " . $cliente[1] ?></option>
                    <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="productoVenta" class="form-label">Producto</label>
                <select class="form-select" name="productoVenta" id="productoVenta">
                    <option selected value="A">Buscar</option>
                    <?php
                    $sql = "SELECT id_producto, nombre FROM tb_articulos";
                    $result = mysqli_query($conexion, $sql);
                    while ($articulo = mysqli_fetch_row($result)) :
                    ?>
                        <option value="<?php echo $articulo[0] ?>"><?php echo $articulo[1] ?></option>
                    <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea readonly disabled class="form-control" id="descripcion" name="descripcion" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input readonly disabled type="text" class="form-control input-group-sm" id="cantidad" name="cantidad">
            </div>
            <div class="form-group">
                <label for="precio" class="form-label">Precio</label>
                <input readonly disabled type="text" class="form-control input-group-sm" id="precio" name="precio">
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-outline-primary" id="btnAgregaVenta">Agregar</button>
                <button type="button" class="btn btn-outline-danger" id="btnVaciarTabla">Vaciar Tabla</button>
            </div>
        </form>

    </div>


    <div class="col-sm-3">
        <div id="imgProducto"></div>
    </div>
</div>

<!-- script js para mostrar en el fromulario de venta de producto los datos del producto con su img -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#productoVenta').change(function() {
            $.ajax({
                type: "POST",
                data: {
                    idProducto: $('#productoVenta').val()
                }, // Corrección aquí
                url: "../procesos/ventas/llenarFormProducto.php",
                success: function(r) {
                    // console.log(r);
                    // alert(r);
                    dato = jQuery.parseJSON(r);
                    $('#descripcion').val(dato['descripcion']);
                    $('#cantidad').val(dato['cantidad']);
                    $('#precio').val(dato['precio']);

                    $('#imgProducto').prepend('<img class="img-thumbnail" id="imgP" src="' + dato['ruta'] + '"/>');
                }
            });
        })
    })
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#clienteVenta').select2();
        $('#productoVenta').select2();

    })
</script>