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
</head>

<body class="bg-dark">

    <!-- Contenedor principal centrado -->
    <div class="centered">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Registro de Administrador</h4>
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
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-2">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="mb-2">
                            <label for="usuario" class="form-label">Correo (Usuario)</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        <div class="mb-2">
                            <label for="clave" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="clave" name="clave" required>
                        </div>
                        <!-- Enlace de regreso al login y botón de registro -->
                        <a href="index.php" class="btn btn-outline-success">Login</a>
                        <button type="submit" class="btn btn-outline-primary">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>