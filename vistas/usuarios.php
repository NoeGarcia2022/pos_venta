<?php
// Iniciamos la sesión para trabajar con variables de sesión
session_start();

// Verificamos si existe una variable de sesión llamada 'usuario'
if (isset($_SESSION['usuario'])) {
    // Si la variable de sesión 'usuario' existe, la mostramos
    //echo $_SESSION['usuario'];
    $currentPage = "usuarios";
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Usuarios</title>
    </head>
    <header>
        <?php
        require_once("menu.php");
        ?>
    </header>

    <body>
        <!-- Contenedor principal -->
        <div class="container-fluid mt-3">
            <h1 class="text-center bg-warning">USUARIOS</h1>
        </div>
        <div class="container mt-2">
            <div class="row">
                <div class="col-sm-4 mt-4">
                    <!-- Formulario para agregar usuarios -->
                    <form id="frmUsuarios" action="" method="post" class="form-control" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="nombre" class="form-label">Nombres</label>
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre">
                        </div>
                        <div class="">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control form-control-sm" id="apellidos" name="apellidos">
                        </div>
                        <div class="mb-2">
                            <label for="correo" class="form-label">Usuario</label>
                            <input type="email" class="form-control form-control-sm" id="correo" name="correo">
                        </div>
                        <div class="mb-2">
                            <label for="clave" class="form-label">Contraseña</label>
                            <input type="password" class="form-control form-control-sm" id="clave" name="clave">
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-outline-primary" id="btnAgregarUsuario">Agregar</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-8">
                    <!-- Espacio para mostrar la tabla de usuarios cargada dinámicamente -->
                    <div id="tablaUsuariosLoad">
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>

    <script type="text/javascript">
        $(document).ready(function() {
            // Cargar la tabla de usuarios al cargar la página
            $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");

            // Acción al hacer clic en el botón "Agregar"
            $('#btnAgregarUsuario').click(function() {
                // Validar si hay campos vacíos en el formulario
                vacios = validarFormVacio('frmUsuarios');
                if (vacios > 0) {
                    // Mostrar una alerta de error si hay campos vacíos
                    alertify.alert('Debes llenar todos los campos', function() {
                        alertify.error('Campos vacíos');
                    });
                    return false;
                }

                // Serializar los datos del formulario y enviarlos mediante AJAX
                datos = $('#frmUsuarios').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/usuarios/agregaUsuario.php",
                    success: function(r) {
                        if (r == 1) {
                            // Mostrar una alerta de éxito si el usuario se agregó correctamente
                            $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
                            alertify.success("Usuario agregado con éxito");
                        } else {
                            // Mostrar una alerta de error si no se pudo registrar el usuario
                            alertify.error("No se registró el usuario");
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