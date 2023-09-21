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
                <label for="descripcionV" class="form-label">Descripción</label>
                <textarea readonly  class="form-control" id="descripcionV" name="descripcionV" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input  readonly type="text" class="form-control input-group-sm" id="cantidad" name="cantidad">
            </div>
            <div class="form-group">
                <label for="precioV" class="form-label">Precio</label>
                <input readonly type="text" class="form-control input-group-sm" id="precioV" name="precioV">
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-outline-primary" id="btnAgregaVenta">Agregar</button>
                <button type="button" class="btn btn-outline-danger" id="btnVaciarTabla">Vaciar Ventas</button>
            </div>
        </form>

    </div>

    <div class="col-sm-3">
        <div id="imgProducto"></div>
    </div>

    <div class="col-sm-5">
        <div id="tablaVentasTempLoad"></div>
    </div>
</div>

<!-- script js para mostrar en el fromulario de venta de producto los datos del producto con su img -->
<script type="text/javascript">
    $(document).ready(function() {

        $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");

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
                    $('#descripcionV').val(dato['descripcion']);
                    $('#cantidad').val(dato['cantidad']);
                    $('#precioV').val(dato['precio']);

                    $('#imgProducto').prepend('<img class="img-thumbnail" id="imgP" src="' + dato['ruta'] + '"/>');
                }
            });
        });

        //script para evento click y ajax 
        $('#btnAgregaVenta').click(function() {
            vacios = validarFormVacio('frmVentas');
            if (vacios > 0) {
                // Mostrar una alerta de error si hay campos vacíos
                alertify.alert('Debes llenar todos los campos', function() {
                    alertify.error('Campos vacíos');
                });
                return false;
            }

            datos = $('#frmVentas').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "../procesos/ventas/agregaProductoTemp.php",
                success: function(r) {
                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                }
            });
        });

        //script para evento click y ajax 
        $('#btnVaciarTabla').click(function() {
            $.ajax({
                url: "../procesos/ventas/vaciarTemp.php",
                success: function(r) {
                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                }
            });
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('#clienteVenta').select2();
        $('#productoVenta').select2();

    })
</script>