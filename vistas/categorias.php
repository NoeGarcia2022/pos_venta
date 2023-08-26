<?php
// Iniciamos la sesión para trabajar con variables de sesión
session_start();

// Verificamos si existe una variable de sesión llamada 'usuario'
if (isset($_SESSION['usuario'])) {
    // Si la variable de sesión 'usuario' existe, la mostramos
    //echo $_SESSION['usuario'];
    $currentPage = "categorias";


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Categorias</title>
    </head>

    <header>
        <?php
        require_once("menu.php");
        ?>
    </header>

    <body>
        <div class="container-fluid mt-3">
            <h1 class="text-center bg-warning">CATEGORIAS</h1>
        </div>
        <!-- Contenedor principal -->
        <div class="container mt-2">
            <div class="row">
                <div class="col-sm-4 mt-4">
                    <!-- Formulario para agregar categorías -->
                    <form id="frmCategorias" action="" method="post" class="form-control">
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <input type="text" class="form-control input-group-sm" id="categoria" name="categoria">
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-primary" id="btnAgregarCategoria">Agregar</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <!-- Espacio para mostrar la tabla de categorías cargada dinámicamente -->
                    <div id="tablaCategoriaLoad">
                    </div>
                </div>
            </div>
        </div>
    </body>


    </html>

    <script type="text/javascript">
        $(document).ready(function() {
            // Cargar la tabla de categorías al cargar la página
            $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");

            // Acción al hacer clic en el botón "Agregar"
            $('#btnAgregarCategoria').click(function() {
                // Validar si hay campos vacíos en el formulario
                vacios = validarFormVacio('frmCategorias');
                if (vacios > 0) {
                    // Mostrar una alerta de error si hay campos vacíos
                    alertify.alert('Debes llenar todos los campos', function() {
                        alertify.error('Campos vacíos');
                    });
                    return false;
                }

                // Serializar los datos del formulario y enviarlos mediante AJAX
                datos = $('#frmCategorias').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/categorias/agregaCategoria.php",
                    success: function(r) {
                        if (r == 1) {
                            // Mostrar una alerta de éxito si la categoría se agregó correctamente
                            $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
                            alertify.success("Categoría agregada con éxito");
                        } else {
                            // Mostrar una alerta de error si no se pudo registrar la categoría
                            alertify.error("No se registró la categoría");
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