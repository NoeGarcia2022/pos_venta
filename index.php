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
</head>

<body class="bg-dark">

    <!-- Contenedor centrado para el contenido -->
    <div class="centered">
        <div class="col-12 col-md-6 col-lg-3"> <!-- Añade clases responsivas para adaptar el tamaño -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Iniciar Sesión</h4>
                    <hr>
                    <div class="center-image text-center"> <!-- Centra la imagen y texto -->
                        <img src="img/iniciar-sesion.png" width="125" class="img-fluid" alt="imagen-iniciar-session">
                    </div>
                    <hr>
                    <!-- Formulario de inicio de sesión -->
                    <form id="frmLogin" action="" method="post">
                        <div class="mb-2">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        <div class="mb-2">
                            <label for="clave" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="clave" name="clave" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Iniciar Sesión</button>
                        <a href="registro.php" class="btn btn-outline-success">Registrar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>