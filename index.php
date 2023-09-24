<?php
// Requerir el archivo que contiene la clase de conexión
require_once("clases/Conexion.php");

// Crear una instancia de la clase Conectar para establecer la conexión
$obj = new Conectar();
$conexion = $obj->conexion();

// Consulta SQL para verificar si existe un usuario con correo "admin"
$sql = "SELECT * FROM tb_usuarios WHERE correo='admin'";

// Ejecutar la consulta en la base de datos
$result = mysqli_query($conexion, $sql);

// Inicializar una variable de validación en 0
$validar = 0;

// Verificar si existen filas en el resultado de la consulta
if (mysqli_num_rows($result) > 0) {
    $validar = 1; // Establecer la variable de validación en 1 si el usuario "admin" existe
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuario</title>
    <!-- Enlace al archivo Bootstrap CSS -->
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.css">
    <!-- Enlace a tu archivo de estilos personalizados -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Incluye jQuery -->
    <script src="librerias/jquery.min.js"></script>
    <!-- Incluir el archivo funciones.js -->
    <script src="js/funciones.js"></script>
</head>

<body class="bg-info">
    <!-- Contenedor principal que contiene el Formulario de Login -->
    <div class="container centered">
        <div class="row row-cols-1">
            <div class="">
                <form id="frmLogin" style="width: 300px;" class="form-control" action="" method="post">
                    <h4 class="text-center"><strong>Iniciar Sesión</strong></h4>
                    <hr>
                    <div id="alertMessage" class="alert text-center" style="display: none;"></div>
                    <div class="center-image text-center"> <!-- Centra la imagen y texto -->
                        <img src="img/iniciar-sesion.png" width="100px" height="125px" class="img-fluid" alt="imagen-iniciar-session">
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="usuario" class="form-label"><strong>Usuario</strong></label>
                        <input type="text" class="form-control form-control-sm" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="clave" class="form-label"><strong>Contraseña</strong></label>
                        <input type="password" class="form-control form-control-sm" id="clave" name="clave" placeholder="Ingrese su contraseña" required>
                    </div>
                    <button type="button" class="btn btn-outline-primary" id="iniciarSesion">Iniciar Sesión</button>
                    <?php
                    // Verificamos si la variable $validar no es verdadera (es decir, si es falsa o está vacía)
                    if (!$validar) {
                        // Si la validación no pasa (es decir, no existe un usuario "admin" en la base de datos),
                        // mostramos un enlace para registrar un nuevo usuario
                        echo '<a href="registro.php" class="btn btn-outline-success">Registrar</a>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        // Esta función se ejecuta cuando el documento HTML ha sido cargado completamente

        // Asociamos el evento click al botón de inicio de sesión con el ID "iniciarSesion"
        $('#iniciarSesion').click(function() {
            // Esta función se ejecuta cuando se hace clic en el botón de inicio de sesión

            // Validamos si hay campos vacíos en el formulario con ID "frmLogin"
            vacios = validarFormVacio('frmLogin');
            if (vacios > 0) {
                // Mostrar alerta roja en caso de campos vacíos
                mostrarAlerta('Debes llenar todos los campos', 'danger');
                return false; // Detener la acción del clic
            }

            // Serializamos los datos del formulario con ID "frmLogin" para enviarlos al servidor
            datos = $('#frmLogin').serialize();

            // Enviar una solicitud AJAX al servidor para verificar las credenciales de inicio de sesión
            $.ajax({
                type: "POST", // Método de la solicitud HTTP
                data: datos, // Datos serializados del formulario
                url: "procesos/registroLogin/login.php", // URL del archivo PHP que maneja la autenticación
                success: function(r) {
                    // Esta función se ejecuta cuando la solicitud AJAX es exitosa

                    if (r == 1) {
                        // Si el resultado es 1, redirigir al usuario a la página "vistas/inicio.php"
                        window.location = "vistas/inicio.php";
                    } else {
                        // Mostrar alerta roja en caso de falla de autenticación
                        mostrarAlerta('Usuario o Contraseña Incorrecta', 'danger');
                        $('#frmLogin')[0].reset(); // Limpiar el formulario
                    }
                }
            });
        });
    });

    // Función para mostrar una alerta con un tipo de fondo específico
    function mostrarAlerta(mensaje, tipo) {
        // Cambiar las clases CSS de acuerdo al tipo de alerta y mostrar el mensaje
        $('#alertMessage').removeClass('alert-success alert-danger').addClass('alert-' + tipo).text(mensaje).show();

        // Ocultar la alerta después de 1 segundo (1000 milisegundos)
        setTimeout(function() {
            $('#alertMessage').hide();
        }, 1000);
    }
</script>