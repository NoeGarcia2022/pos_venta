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
        <div class="container py-3">
            <div class="row">
                <div class="col-12">
                    <!-- Boton Modal Nueva Categoria -->
                    <button type="button" class="btn btn-dark btn-md" data-bs-toggle="modal" data-bs-target="#nuevaCategoria">
                        Nueva categoria
                    </button>
                </div>
                <div class="col-12 py-3">
                    <!-- Espacio para mostrar la tabla de categorías cargada dinámicamente -->
                    <div id="tablaCategoriaLoad">
                    </div>
                </div>
            </div>
        </div>

    </body>

    <!-- Modal Nueva Categoria -->
    <div class="modal fade" id="nuevaCategoria" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitleId"><strong>Nueva Categoria</strong></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmCategorias" action="" method="post">
                        <div class="mb-3">
                            <label for="categoria" class="form-label"><strong>Categoria</strong></label>
                            <input type="text" class="form-control input-group-sm" id="categoria" name="categoria" placeholder="Categoria">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnAgregarCategoria" class="btn btn-primary" data-bs-dismiss="modal">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Actualizar Categoria -->
    <div class="modal fade" id="actualizarCategoria" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitleId"><strong>Actualizar Categoria</strong></h4>
                    <br>
                    <?php
                    // echo print_r($_GET);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmCategoriasU" action="" method="post">
                        <input type="text" hidden name="idcategoriaU" id="idcategoriaU">
                        <div class="mb-3">
                            <label for="categoriaU" class="form-label"><strong>Categoria</strong></label>
                            <input type="text" class="form-control input-group-sm" id="categoriaU" name="categoriaU">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnActualizarCategoria" class="btn btn-outline-primary" data-bs-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

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
                            // limpiar formulario al insertar un registro
                            $('#frmCategorias')[0].reset();
                            // Mostrar una alerta de éxito si la categoría se agregó correctamente
                            $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
                            alertify.success("Categoría agregada con éxito");
                        } else {
                            // limpiar formulario al no registrar categoria
                            $('#frmCategorias')[0].reset();
                            // Mostrar una alerta de error si no se pudo registrar la categoría
                            alertify.error("No se registró la categoría");
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            //script para evento click y ajax 
            $('#btnActualizarCategoria').click(function() {

                datos = $('#frmCategoriasU').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/categorias/actualizaCategoria.php",
                    success: function(r) {
                        if (r == 1) {
                            // Mostrar una alerta y recargar tabla si la categoría se agregó correctamente
                            $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
                            alertify.success("Actualizado con exito")
                        } else {
                            // Mostrar una alerta de error si no se pudo registrar la categoría
                            alertify.error("No se actualizo la categoría");
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        function agregaDato(idCategoria, categoria) {
            $('#idcategoriaU').val(idCategoria);
            $('#categoriaU').val(categoria);
        }

        // funcion para eliminar una categoria
        function eliminaCategoria(idcategoriaU) {
            alertify.confirm('¿Desea eliminar esta categoria?',
                function() {
                    $.ajax({
                        type: "POST",
                        data: "idcategoriaU=" + idcategoriaU,
                        url: "../procesos/categorias/eliminarCategoria.php",
                        success: function(r) {
                            if (r == 1) {
                                // Mostrar una alerta y recargar tabla si se elimino categoría correctamente
                                $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
                                alertify.success("Categoria Eliminada")
                            } else {
                                // Mostrar una alerta de error si no se pudo aliminar la categoría
                                alertify.error("No se alimino la categoría");
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