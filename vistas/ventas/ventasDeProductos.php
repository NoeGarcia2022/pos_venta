<?php

// incluimos la conexion y la instanciamos
require_once("../../clases/Conexion.php");
$c = new Conectar();
$conexion = $c->conexion();

?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-5 col-xl-3 col-xxl-3 mb-3">
        <!-- Formulario para agregar ventas -->
        <form id="frmVentasProducto" method="post" class="form-control">
            <h3><strong>Vender Producto</strong></h3>
            <hr>
            <div class="mb-2">
                <label for="clienteVenta" class="form-label"><strong>Selecciona Cliente</strong></label>
                <select class="form-select" name="clienteVenta" id="clienteVenta">
                    <option value="A">Selecciona</option>
                    <option value="0">Sin cliente</option>
                    <?php
                    // Establece una consulta SQL para seleccionar las columnas 'id_cliente', 'nombre', y 'apellido' de la tabla 'tb_clientes'.
                    $sql = "SELECT id_cliente, nombre, apellido FROM tb_clientes";
                    // Ejecuta la consulta SQL en la base de datos utilizando la conexión llamada '$conexion'.
                    $result = mysqli_query($conexion, $sql);
                    // Inicia un bucle while para recorrer cada fila (cliente) obtenida de la consulta.
                    while ($cliente = mysqli_fetch_row($result)) :
                    ?>
                        <option value="<?php echo $cliente[0] ?>"><?php echo $cliente[2] . "" . $cliente[1] ?></option>
                    <?php
                    // Termina el bucle while.
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="productoVenta" class="form-label"><strong>Producto</strong></label>
                <select class="form-select" name="productoVenta" id="productoVenta">
                    <option value="A">Selecciona</option>
                    <?php
                    // Establece una consulta SQL para seleccionar las columnas 'id_producto', 'nombre', de la tabla 'tb_articulos'.
                    $sql = "SELECT id_producto, nombre FROM tb_articulos";
                    // Ejecuta la consulta SQL en la base de datos utilizando la conexión llamada '$conexion'.
                    $result = mysqli_query($conexion, $sql);
                    // Inicia un bucle while para recorrer cada fila (articulo) obtenida de la consulta.
                    while ($articulo = mysqli_fetch_row($result)) :
                    ?>
                        <option value="<?php echo $articulo[0] ?>"><?php echo $articulo[1] ?></option>
                    <?php
                    // Termina el bucle while.
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="descripcionVenta" class="form-label"><strong>Descripcion</strong></label>
                <textarea readonly class="form-control form-control-sm" id="descripcionVenta" name="descripcionVenta" rows="2"></textarea>
            </div>
            <div class="mb-2">
                <label for="cantidadVenta" class="form-label"><strong>Cantidad</strong></label>
                <input type="text" class="form-control form-control-sm" id="cantidadVenta" name="cantidadVenta" aria-describedby="textHelp">
            </div>
            <div class="mb-2">
                <label for="precioVenta" class="form-label"><strong>Precio</strong></label>
                <input readonly type="text" class="form-control form-control-sm" id="precioVenta" name="precioVenta" aria-describedby="textHelp">
            </div>
            <div class="mt-2">
                <button id="btnAgregaVenta" type="button" class="btn btn-primary">Agregar</button>
                <button id="btnVaciarVenta" type="button" class="btn btn-danger">Vaciar Venta</button>
            </div>
        </form>
    </div>
    <div class="col-12 col-md-6 col-lg-7 col-xl-3 col-xxl-3 mb-3">
        <h4 class=""><strong>Imagen de Articulo</strong></h4>
        <div id="imgProducto"></div>
    </div>
    <div class="col-12 col-xl-6 col-xxl-6">
        <h4 class="bg-dark text-white"><strong>Tabla ventas temporal</strong></h4>
        <div id="tablaVentasTempLoad"></div>
    </div>
</div>

<!-- Script js, para llenar el formulario de ventas -->
<script type="text/javascript">
    $(document).ready(function() {
        // Esta función se ejecuta cuando el documento HTML ha sido completamente cargado
        $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
        var selectedProductId = $('#productoVenta').val();

        $('#productoVenta').change(function() {
            // Esta función se ejecuta cuando el elemento con el ID 'productoVenta' cambia de valor


            // Realizamos una solicitud AJAX para obtener información sobre el producto seleccionado
            $.ajax({
                type: "POST", // Método HTTP utilizado para la solicitud
                data: "idproducto=" + $('#productoVenta').val(), // Datos enviados al servidor
                url: "../procesos/ventas/llenarFormProducto.php", // URL a la que se envía la solicitud
                success: function(r) {
                    // Esta función se ejecuta cuando la solicitud AJAX tiene éxito

                    // Convertimos la respuesta JSON en un objeto JavaScript
                    dato = jQuery.parseJSON(r);

                    // Rellenamos los campos de formulario con los datos obtenidos
                    $('#descripcionVenta').val(dato['descripcion']);
                    // $('#cantidadVenta').val(dato['cantidad']);
                    $('#precioVenta').val(dato['precio']);
                    $('#imgProducto').empty();

                    // Agrega la imagen correspondiente al producto seleccionado
                    // $('#imgProducto').append('<img src="' + dato['ruta'] + '" id="imgP" class="img-thumbnail" width="400px" height="400px" />');
                    $('#imgProducto').append('<img src="' + dato['ruta'] + '" id="imgP" alt="img-articulo" style="max-width: 75%; height: auto; border: 4px solid black;" />');
                }
            });
        });


        $('#btnAgregaVenta').click(function() {
            // Validar si hay campos vacíos en el formulario 'frmVentasProducto'
            vacios = validarFormVacio('frmVentasProducto');
            if (vacios > 0) {
                // Mostrar una alerta de error si hay campos vacíos
                alertify.alert('Debes llenar todos los campos');
                return false;
            }

            // Serializar los datos del formulario 'frmVentasProducto' para enviarlos en la solicitud AJAX
            datos = $('#frmVentasProducto').serialize();

            // Realizar una solicitud AJAX para enviar los datos del formulario al archivo 'agregaProductoTemp.php'
            $.ajax({
                type: "POST",
                data: datos,
                url: "../procesos/ventas/agregaProductoTemp.php",
                success: function(r) {
                    // La función de éxito se ejecuta cuando la solicitud AJAX es exitosa
                    // Cargar el contenido de 'tablaVentasTemp.php' en el elemento con ID 'tablaVentasTempLoad'
                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");

                    // Mostrar un mensaje de éxito utilizando la librería 'alertify'
                    alertify.success("Agregado con éxito");
                }
            });
        });


        $('#btnVaciarVenta').click(function() {
            // Cuando se hace clic en el botón con ID 'btnVaciarVenta'
            $.ajax({
                // Realiza una solicitud AJAX
                url: "../procesos/ventas/vaciarTemp.php",
                // La URL del archivo PHP que se ejecutará en el servidor
                success: function(r) {
                    $('#frmVentasProducto')[0].reset();
                    $('#imgP').hide();
                    // Restablece la imagen del producto a su estado inicial
                    alertify.success("Se vacio la venta");
                    // Cuando la solicitud AJAX sea exitosa
                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                    // Actualiza la tabla de ventas temporal en la página HTML
                }
            });
        });
    });
</script>

<script type="text/javascript">
    function quitarP(index) {
        // Esta función se llama cuando se quiere quitar un producto de la lista.
        $.ajax({
            type: "POST",
            data: "ind=" + index,
            // Envía el índice del producto que se quiere quitar al archivo PHP
            url: "../procesos/ventas/quitarproducto.php",
            // La URL del archivo PHP que se ejecutará en el servidor para quitar el producto
            success: function(r) {
                // Cuando la solicitud AJAX sea exitosa
                $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                // Actualiza la tabla de ventas temporal en la página HTML
                alertify.success("Se quitó el producto");
                // Muestra una notificación de éxito al usuario
            }
        });
    }

    function crearVenta() {
        // Realiza una solicitud AJAX para crear una venta
        $.ajax({
            url: "../procesos/ventas/crearVenta.php",
            success: function(r) {
                // Cuando la solicitud AJAX sea exitosa
                if (r > 0) {
                    // Si se crea la venta con éxito
                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                    // Actualiza la tabla de ventas temporal en la página HTML
                    $('#frmVentasProducto')[0].reset();
                    // Restablece el formulario a su estado inicial
                    alertify.alert("Venta creada con éxito");
                    // Muestra una alerta de éxito
                } else if (r == 0) {
                    // Si no hay elementos en la lista de venta
                    alertify.alert("No hay lista de venta");
                    // Muestra una alerta informando que no hay elementos en la lista de venta
                } else {
                    console.log(r);
                    // Si no se puede crear la venta por alguna razón
                    alertify.error("No se puede crear la venta");
                    // Muestra una alerta de error
                }
            }
        });
    }
</script>


<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#clienteVenta').select2();
        $('#productoVenta').select2();

    });
</script> -->