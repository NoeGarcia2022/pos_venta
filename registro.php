<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Enlaces a Bootstrap y CSS personalizado -->
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Incluir jQuery -->
    <script src="librerias/jquery.min.js"></script>
    <!-- Incluir el archivo funciones.js -->
    <script src="js/funciones.js"></script>
</head>

<body class="bg-dark">

    <!-- Contenedor principal centrado -->
    <div class="centered">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Registro de Administrador</h4>
                    <div id="alertMessage" class="alert" style="display: none;"></div>
                    <hr>
                    <!-- Centrar la imagen -->
                    <div class="center-image text-center">
                        <img src="img/perfil-del-usuario.png" width="100" class="img-fluid" alt="imagen-registro-usuario">
                    </div>
                    <hr>
                    <!-- Formulario de registro -->
                    <form id="frmRegistro" action="" method="post">
                        <div class="mb-2">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="mb-2">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido">
                        </div>
                        <div class="mb-2">
                            <label for="usuario" class="form-label">Correo (Usuario)</label>
                            <input type="text" class="form-control" id="usuario" name="usuario">
                        </div>
                        <div class="mb-2">
                            <label for="clave" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="clave" name="clave">
                        </div>
                        <!-- Enlace de regreso al login y botón de registro -->
                        <a href="index.php" class="btn btn-outline-success">Login</a>
                        <button type="button" class="btn btn-outline-primary" id="registro">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        // Asociamos el evento click al botón de registro
        $('#registro').click(function() {
            // Validamos si hay campos vacíos
            vacios = validarFormVacio('frmRegistro');
            if (vacios > 0) {
                // Mostrar alerta roja en caso de campos vacíos
                mostrarAlerta('Debes llenar todos los campos', 'danger');
                return false;
            }

            // Serializamos los datos del formulario
            datos = $('#frmRegistro').serialize();

            // Enviar una solicitud AJAX al servidor para registrar al usuario
            $.ajax({
                type: "POST",
                data: datos,
                url: "procesos/registroLogin/registrarUsuario.php",
                success: function(r) {
                    if (r.trim() === "1") {
                        // Mostrar alerta verde en caso de éxito y limpiar el formulario
                        mostrarAlerta('Agregado con éxito', 'success');
                        $('#frmRegistro')[0].reset(); // Limpia los campos del formulario
                    } else {
                        // Mostrar alerta roja en caso de falla
                        mostrarAlerta('Fallo al agregar', 'danger');
                    }
                }
            });
        });
    });

    // Función para mostrar una alerta con un tipo de fondo específico
    function mostrarAlerta(mensaje, tipo) {
        $('#alertMessage').removeClass('alert-success alert-danger').addClass('alert-' + tipo).text(mensaje).show();
        setTimeout(function() {
            $('#alertMessage').hide();
        }, 1000); // Oculta la alerta después de 1 segundos (1000 milisegundos)
    }
</script>