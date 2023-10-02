<?php
// Iniciamos la sesión para trabajar con variables de sesión
session_start();

// Verificamos si existe una variable de sesión llamada 'usuario'
if (isset($_SESSION['usuario']) and $_SESSION['usuario'] == 'admin') {
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
        <div class="container py-3">
            <div class="row">
                <div class="col-12">
                    <!-- Boton Modal Nuevo Usuario -->
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registrarUsuario">
                        Nuevo usuario
                    </button>
                </div>
                <div class="col-12 py-3">
                    <!-- Espacio para mostrar la tabla de usuarios cargada dinámicamente -->
                    <div id="tablaUsuariosLoad">
                    </div>
                </div>
            </div>
        </div>
    </body>

    <!-- Modal Nuevo Usuario -->
    <div class="modal fade" id="registrarUsuario" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"><strong>Nuevo Usuario</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para agregar usuarios -->
                    <form id="frmUsuarios" action="" method="post">
                        <div class="mb-2">
                            <label for="nombre" class="form-label"><strong>Nombres</strong></label>
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre">
                        </div>
                        <div class="mb-2">
                            <label for="apellidos" class="form-label"><strong>Apellidos</strong></label>
                            <input type="text" class="form-control form-control-sm" id="apellidos" name="apellido">
                        </div>
                        <div class="mb-2">
                            <label for="correo" class="form-label"><strong>Usuario</strong></label>
                            <input type="email" class="form-control form-control-sm" id="correo" name="usuario">
                        </div>
                        <div class="mb-2">
                            <label for="clave" class="form-label"><strong>Contraseña</strong></label>
                            <input type="password" class="form-control form-control-sm" id="clave" name="clave">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="btnAgregarUsuario" type="button" class="btn btn-primary" data-bs-dismiss="modal">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Actualizar Usuario -->
    <div class="modal fade" id="actualizaUsuarios" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"><strong>Actualizar Usuarios</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmUsuariosU" action="" method="post">
                        <input type="text" hidden name="idUsuarioU" id="idUsuarioU">
                        <div class="mb-2">
                            <label for="nombreU" class="form-label"><strong>Nombres</strong></label>
                            <input type="text" class="form-control form-control-sm" id="nombreU" name="nombreU">
                        </div>
                        <div class="mb-2">
                            <label for="apellidosU" class="form-label"><strong>Apellidos</strong></label>
                            <input type="text" class="form-control form-control-sm" id="apellidosU" name="apellidoU">
                        </div>
                        <div class="mb-2">
                            <label for="correoU" class="form-label"><strong>Usuario</strong></label>
                            <input type="email" class="form-control form-control-sm" id="correoU" name="usuarioU">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="btnActualizaUsuario" type="button" class="btn btn-primary" data-bs-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    </html>

    <!-- script para odtener los datos de la tabla usuarios -->
    <script type="text/javascript">
        // Metodo para agregar datos usuarios
        function agregaDatosUsuario(idUsuario) {
            $.ajax({
                type: "POST",
                data: "idUsuario=" + idUsuario,
                url: "../procesos/usuarios/obtenDatosUsuario.php",
                success: function(r) {
                    dato = jQuery.parseJSON(r);
                    $('#idUsuarioU').val(dato['id_usuario']);
                    $('#nombreU').val(dato['nombre']);
                    $('#apellidosU').val(dato['apellido']);
                    $('#correoU').val(dato['correo']);
                }
            });
        }
    </script>

    <!-- script para poder actualizar los datos del usuario -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnActualizaUsuario').click(function() {
                datos = $('#frmUsuariosU').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/usuarios/actualizaUsuarios.php",
                    success: function(r) {
                        // console.log(r);
                        if (r == 1) {
                            // Mostrar una alerta de éxito si el usuario se actualizo correctamente
                            $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
                            alertify.success("Usuario actualizado con éxito");
                        } else {
                            // Mostrar una alerta de error si no se pudo actualizar el usuario
                            alertify.error("No se actualizo el usuario");
                        }
                    }
                });
            });
        })

        // funcion para eliminar un usuario
        function eliminaUsuario(idUsuarioU) {
            alertify.confirm('¿Desea eliminar este usuario?',
                function() {
                    $.ajax({
                        type: "POST",
                        data: "idUsuarioU=" + idUsuarioU,
                        url: "../procesos/usuarios/eliminarUsuarios.php",
                        success: function(r) {
                            if (r == 1) {
                                // Mostrar una alerta y recargar tabla si se elimino usuario correctamente
                                $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
                                alertify.success("Usuario Eliminado")
                            } else {
                                // Mostrar una alerta de error si no se pudo aliminar la categoría
                                alertify.error("No se alimino el usuario");
                            }
                        }
                    });
                },
                function() {
                    alertify.error('Cancelo !')
                });
        }
    </script>

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
                    url: "../procesos/registroLogin/registrarUsuario.php",
                    success: function(r) {
                        if (r == 1) {
                            // Reset a los campos del form en caso de registrar
                            $('#frmUsuarios')[0].reset();
                            // Mostrar una alerta de éxito si el usuario se agregó correctamente
                            $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
                            alertify.success("Usuario agregado con éxito");
                        } else {
                            // Reset a los campos del form en caso de no registrar
                            $('#frmUsuarios')[0].reset();
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