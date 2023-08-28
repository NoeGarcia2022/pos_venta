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
            <h1 class="text-center bg-warning">CLIENTES</h1>
        </div>
        <div class="container mt-2">
            <div class="row">
                <div class="col-sm-4 mt-4">
                    <!-- Formulario para agregar clientes -->
                    <form id="frmClientes" action="" method="post" class="form-control" enctype="multipart/form-data">
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
                    <!-- Espacio para mostrar la tabla de clientes cargada dinámicamente -->
                    <div id="tablaClientesLoad">
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>

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
                        if (r == 1) {
                            // Mostrar una alerta de éxito si el cliente se agregó correctamente
                            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
                            alertify.success("Cliente agregado con éxito");
                        } else {
                            // Mostrar una alerta de error si no se pudo registrar el cliente
                            alertify.error("No se registró el cliente");
                        }
                    }
                });
            });
        });
    </script>

<?php
} else {
    // Si la variable de sesión 'usuario' no existe, redireccionamos al usuario a la página de inicio de sesión (index.php)
    header("Location:../index.php");
}
?>