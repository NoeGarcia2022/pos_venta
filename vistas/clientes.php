<?php
// Iniciamos la sesión para trabajar con variables de sesión
session_start();

// Verificamos si existe una variable de sesión llamada 'usuario'
if (isset($_SESSION['usuario'])) {
    // Si la variable de sesión 'usuario' existe, la mostramos
    //echo $_SESSION['usuario'];
    $currentPage = "clientes";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clientes</title>
    </head>

    <header>
        <?php
        require_once("menu.php");
        ?>
    </header>

    <body>
        <!-- Aquí puedes agregar contenido que se mostrará cuando el usuario esté autenticado -->
        <!-- Contenedor principal -->
        <div class="container-fluid mt-3">
        </div>
        <div class="container mt-2">
            <div class="row">
                <div class="col-sm-4">
                    <!-- Formulario para agregar clientes -->
                    <form id="frmClientes" action="" method="post" class="form-control mb-4" enctype="multipart/form-data">
                        <h3>Formulario Clientes</h3>
                        <hr>
                        <div class="">
                            <label for="nombre" class="form-label">Nombres</label>
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre">
                        </div>
                        <div class="">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control form-control-sm" id="apellidos" name="apellidos">
                        </div>
                        <div class="">
                            <label for="direccion" class="form-label">Direccion</label>
                            <textarea class="form-control" name="direccion" id="direccion" rows="2"></textarea>
                        </div>
                        <div class="">
                            <label for="correo" class="form-label">Correo Electronico</label>
                            <input type="email" class="form-control form-control-sm" id="correo" name="correo">
                        </div>
                        <div class="">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" class="form-control form-control-sm" id="telefono" name="telefono">
                        </div>
                        <div class="">
                            <label for="dui" class="form-label">DUI</label>
                            <input type="text" class="form-control form-control-sm" id="dui" name="dui">
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-outline-primary" id="btnAgregaCliente">Agregar</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-8">
                    <h5 class="text-center bg-info">Lista de Clientes</h5>
                    <!-- Espacio para mostrar la tabla de clientes cargada dinámicamente -->
                    <div id="tablaClientesLoad">
                    </div>
                </div>
            </div>
        </div>
    </body>

    <!-- Modal para que contiene datos para actualizar cliente -->
    <div class="modal fade" id="actualizaCliente" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Actualizar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmClientesU" action="" method="post" class="">
                        <input type="text" hidden name="idClienteU" id="idClienteU">
                        <div class="">
                            <label for="nombreU" class="form-label">Nombres</label>
                            <input type="text" class="form-control form-control-sm" id="nombreU" name="nombreU">
                        </div>
                        <div class="">
                            <label for="apellidosU" class="form-label">Apellidos</label>
                            <input type="text" class="form-control form-control-sm" id="apellidosU" name="apellidosU">
                        </div>
                        <div class="">
                            <label for="direccionU" class="form-label">Direccion</label>
                            <textarea class="form-control" name="direccionU" id="direccionU" rows="2"></textarea>
                        </div>
                        <div class="">
                            <label for="correoU" class="form-label">Correo Electronico</label>
                            <input type="email" class="form-control form-control-sm" id="correoU" name="correoU">
                        </div>
                        <div class="">
                            <label for="telefonoU" class="form-label">Telefono</label>
                            <input type="text" class="form-control form-control-sm" id="telefonoU" name="telefonoU">
                        </div>
                        <div class="">
                            <label for="duiU" class="form-label">DUI</label>
                            <input type="text" class="form-control form-control-sm" id="duiU" name="duiU">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="btnActualizaCliente" type="button" class="btn btn-primary" data-bs-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
    </script>

    </html>

    <!-- Script para Agregar Cliente -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Cargar la tabla de clientes al cargar la página
            $('#tablaClientesLoad').load("clientes/tablaClientes.php");

            // Acción al hacer clic en el botón "Agregar"
            $('#btnAgregaCliente').click(function() {
                // Validar si hay campos vacíos en el formulario
                vacios = validarFormVacio('frmClientes');
                if (vacios > 0) {
                    // Mostrar una alerta de error si hay campos vacíos
                    alertify.alert('Debes llenar todos los campos', function() {
                        alertify.error('Campos vacíos');
                    });
                    return false;
                }

                // Serializar los datos del formulario y enviarlos mediante AJAX
                datos = $('#frmClientes').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/clientes/agregaCliente.php",
                    success: function(r) {
                        console.log(r);
                        if (r == 1) {
                            // limpiamos form al registrar un cliente
                            $('#frmClientes')[0].reset();
                            // Mostrar una alerta de éxito si el cliente se agregó correctamente
                            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
                            alertify.success("Cliente agregado con éxito");
                        } else {
                            $('#frmClientes')[0].reset();
                            // Mostrar una alerta de error si no se pudo registrar el cliente
                            alertify.error("No se registró el cliente");
                        }
                    }
                });
            });
        });
    </script>

    <!-- script js para obtener los datos de la tabla usuarios hacia el form de actualizar -->
    <script type="text/javascript">
        function agregaDatosCliente(idClienteU) {
            $.ajax({
                type: "POST",
                data: "idClienteU=" + idClienteU,
                url: "../procesos/clientes/obtenDatosCliente.php",
                success: function(r) {
                    dato = jQuery.parseJSON(r);
                    $('#idClienteU').val(dato['id_cliente']);
                    $('#nombreU').val(dato['nombre']);
                    $('#apellidosU').val(dato['apellido']);
                    $('#direccionU').val(dato['direccion']);
                    $('#correoU').val(dato['correo']);
                    $('#telefonoU').val(dato['telefono']);
                    $('#duiU').val(dato['dui']);
                }
            });
        }
    </script>

    <!-- script para poder actualizar los datos del cliente -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnActualizaCliente').click(function() {
                datos = $('#frmClientesU').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/clientes/actualizaCliente.php",
                    success: function(r) {
                        // console.log(r);
                        if (r == 1) {
                            // Mostrar una alerta de éxito si el cliente se actualizo correctamente
                            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
                            alertify.success("Cliente actualizado con éxito");
                        } else {
                            // Mostrar una alerta de error si no se pudo actualizar el cliente
                            alertify.error("No se actualizo el cliente");
                        }
                    }
                });
            });
        })
    </script>

    <!-- script para eliminar datos del cliente del base de datos -->
    <script type="text/javascript">
        function eliminaCliente(idClienteU) {
            alertify.confirm('¿Desea eliminar este cliente?',
                function() {
                    $.ajax({
                        type: "POST",
                        data: "idClienteU=" + idClienteU,
                        url: "../procesos/clientes/eliminaCliente.php",
                        success: function(r) {
                            if (r == 1) {
                                // Mostrar una alerta de éxito si el cliente se elimino correctamente
                                $('#tablaClientesLoad').load("clientes/tablaClientes.php");
                                alertify.success("Cliente Eliminado")
                            } else {
                                // Mostrar una alerta de error si no se pudo aliminar la categoría
                                alertify.error("No se alimino el cliente");
                            }
                        }
                    });
                },
                function() {
                    alertify.error('Cancelo !')
                });
        }
    </script>


<?php
} else {
    // Si la variable de sesión 'usuario' no existe, redireccionamos al usuario a la página de inicio de sesión (index.php)
    header("Location:../index.php");
}
?>