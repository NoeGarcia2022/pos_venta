<?php
// Iniciamos la sesión para trabajar con variables de sesión
session_start();

// Verificamos si existe una variable de sesión llamada 'usuario'
if (isset($_SESSION['usuario'])) {
    // Si la variable de sesión 'usuario' existe, la mostramos
    //echo $_SESSION['usuario'];
    $currentPage = "productos";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Productos</title>
    </head>

    <header>
        <?php
        require_once("menu.php");
        ?>
    </header>

    <body>
        <!-- Contenedor principal -->
        <div class="container-fluid mt-3">
            <h1 class="text-center bg-warning">PRODUCTOS</h1>
        </div>
        <div class="container mt-2">
            <div class="row">
                <div class="col-sm-4 mt-4">
                    <!-- Formulario para agregar productos -->
                    <form id="frmArticulos" action="" method="post" class="form-control" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="" class="form-label">Categoria</label>
                            <select class="form-select form-select-sm" name="categoriaSelect" id="categoriaSelect">
                                <option selected value="A" disabled>Seleccione una categoria</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre">
                        </div>
                        <div class="">
                            <label for="descripcion" class="form-label">Descripcion</label>
                            <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion">
                        </div>
                        <div class="mb-2">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="text" class="form-control form-control-sm" id="cantidad" name="cantidad">
                        </div>
                        <div class="mb-2">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="text" class="form-control form-control-sm" id="precio" name="precio">
                        </div>
                        <div class="mb-2">
                            <input type="file" class="form-control input-group-sm" id="imagen" name="imagen">
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-outline-primary" id="btnAgregarArticulo">Agregar</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-8">
                    <!-- Espacio para mostrar la tabla de categorías cargada dinámicamente -->
                    <div id="tablaArticuloLoad">
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>

    <script type="text/javascript">
        $(document).ready(function() {
            // Cargar la tabla de categorías al cargar la página
            $('#tablaArticuloLoad').load("articulos/tablaArticulos.php");

            // Acción al hacer clic en el botón "Agregar"
            $('#btnAgregarArticulo').click(function() {
                // Validar si hay campos vacíos en el formulario
                vacios = validarFormVacio('frmArticulos');
                if (vacios > 0) {
                    // Mostrar una alerta de error si hay campos vacíos
                    alertify.alert('Debes llenar todos los campos', function() {
                        alertify.error('Campos vacíos');
                    });
                    return false;
                }

                // Serializar los datos del formulario y enviarlos mediante AJAX
                datos = $('#frmArticulos').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/articulos/agregaArticulo.php",
                    success: function(r) {
                        if (r == 1) {
                            // Mostrar una alerta de éxito si la categoría se agregó correctamente
                            alertify.success("Producto agregado con éxito");
                        } else {
                            // Mostrar una alerta de error si no se pudo registrar la categoría
                            alertify.error("No se registró el producto");
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