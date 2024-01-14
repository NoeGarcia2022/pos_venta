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
        <title>Articulos</title>
    </head>

    <header>
        <?php require_once("menu.php"); ?>
        <!-- incluimos nuestra conexion -->
        <?php require_once("../clases/Conexion.php");
        // instanciamos nuestra conexion
        $c = new Conectar();
        $conexion = $c->conexion();

        $sql = "SELECT id_categoria,nombreCategoria FROM tb_categorias";
        $result = mysqli_query($conexion, $sql);
        ?>
    </header>

    <body>
        <!-- Contenedor principal -->
        <div class="container py-3">
            <div class="col-12">
                <!-- Boton Modal Nuevo Articulo -->
                <button type="button" class="btn btn-dark btn-md" data-bs-toggle="modal" data-bs-target="#nuevoProducto">
                <i class="fa-solid fa-plus"></i> Nuevo Articulo
                </button>
            </div>
            <div class="col-12 py-3">
                <!-- Espacio para mostrar la tabla de articulos cargada dinámicamente -->
                <div id="tablaArticuloLoad"></div>
            </div>
        </div>
    </body>

    <!-- Modal Nuevo Articulo -->
    <div class="modal fade" id="nuevoProducto" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitleId"><strong>Nuevo Articulo</strong></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmArticulos" action="" method="post" enctype="multipart/form-data">
                        <div class="mb-1">
                            <label for="" class="form-label"><strong>Categoria</strong></label>
                            <select class="form-select form-select-sm" name="categoriaSelect" id="categoriaSelect">
                                <option selected value="A" disabled>Seleccione una categoria</option>
                                <?php
                                while ($ver = mysqli_fetch_row($result)) : ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?>
                                    </option>
                                <?php
                                endwhile;
                                ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="nombre" class="form-label"><strong>Nombre</strong></label>
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre de articulo">
                        </div>
                        <div class="mb-1">
                            <label for="descripcion" class="form-label"><strong>Descripcion</strong></label>
                            <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="2" placeholder="Descripcion"></textarea>
                        </div>
                        <div class="mb-1">
                            <label for="cantidad" class="form-label"><strong>Cantidad</strong></label>
                            <input type="text" class="form-control form-control-sm" id="cantidad" name="cantidad" placeholder="Cantidad">
                        </div>
                        <div class="mb-1">
                            <label for="precio" class="form-label"><strong>Precio</strong></label>
                            <input type="text" class="form-control form-control-sm" id="precio" name="precio" placeholder="Precio">
                        </div>
                        <div class="mt-3">
                            <input type="file" class="form-control input-group-sm" id="imagen" name="imagen">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="btnAgregarArticulo" type="button" class="btn btn-primary" data-bs-dismiss="modal">Registrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Actualizar Articulo -->
    <div class="modal fade" id="actualizaArticulo" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"><strong>Actualizar Articulo</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmArticulosU" action="" method="post" enctype="multipart/form-data">
                        <input type="text" hidden name="idArticulo" id="idArticulo">
                        <div class="mb-1">
                            <label for="categoriaSelectU" class="form-label"><strong>Categoria</strong></label>
                            <select class="form-select form-select-sm" name="categoriaSelectU" id="categoriaSelectU">
                                <?php
                                $sql = "SELECT id_categoria,nombreCategoria FROM tb_categorias";
                                $result = mysqli_query($conexion, $sql);
                                ?>
                                <option selected value="A" disabled>Seleccione una categoria</option>
                                <?php
                                while ($ver = mysqli_fetch_row($result)) : ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?>
                                    </option>
                                <?php
                                endwhile;
                                ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="nombreU" class="form-label"><strong>Nombre</strong></label>
                            <input type="text" class="form-control form-control-sm" id="nombreU" name="nombreU" aria-describedby="textHelp">
                        </div>
                        <div class="mb-1">
                            <label for="descripcionU" class="form-label"><strong>Descripcion</strong></label>
                            <textarea class="form-control form-control-sm" id="descripcionU" name="descripcionU" rows="2"></textarea>
                        </div>
                        <div class="mb-1">
                            <label for="cantidadU" class="form-label"><strong>Cantidad</strong></label>
                            <input type="text" class="form-control form-control-sm" id="cantidadU" name="cantidadU" aria-describedby="textHelp">
                        </div>
                        <div class="mb-1">
                            <label for="precioU" class="form-label"><strong>Precio</strong></label>
                            <input type="text" class="form-control form-control-sm" id="precioU" name="precioU" aria-describedby="textHelp">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnActualizaArticulo" class="btn btn-outline-primary" data-bs-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    </html>

    <script type="text/javascript">
        // Espera a que el documento HTML se cargue completamente
        $(document).ready(function() {
            // Agrega un manejador de eventos al botón con ID "btnActualizaArticulo"
            $('#btnActualizaArticulo').click(function() {
                // Serializa los datos del formulario con ID "frmArticulosU"
                var datos = $('#frmArticulosU').serialize();

                // Realiza una solicitud Ajax POST al servidor
                $.ajax({
                    type: "POST",
                    data: datos, // Envía los datos del formulario
                    url: "../procesos/articulos/actualizaArticulos.php", // URL del servidor
                    success: function(response) {
                        // Muestra la respuesta del servidor en la consola para depuración
                        console.log(response);

                        // Comprueba si la respuesta es igual a 1 (éxito)
                        if (parseInt(response) === 1) {
                            // Recarga la tabla de artículos después de una actualización exitosa
                            $('#tablaArticuloLoad').load("articulos/tablaArticulos.php");

                            // Muestra una alerta de éxito
                            alertify.success("Actualizado con éxito");
                        } else {
                            // Muestra una alerta de error si la respuesta no es igual a 1
                            alertify.error("Error al actualizar");
                        }
                    },
                    error: function(xhr, status, error) {
                        // Maneja errores de la solicitud Ajax
                        console.error(xhr.responseText);
                        alertify.error("Error en la solicitud");
                    }
                });
            });
        });
    </script>

    <!-- Metodo para agregar articulo para luego actualizar -->
    <script type="text/javascript">
        // Esta función se llama cuando se quiere agregar datos de un artículo para su edición
        function agregaDatosArticulo(idArticulo) {
            // Realiza una solicitud Ajax para obtener los datos del artículo con el ID proporcionado
            $.ajax({
                type: "POST", // Utiliza el método POST para la solicitud
                data: "idArt=" + idArticulo, // Envía el ID del artículo como datos
                url: "../procesos/articulos/obtenDatosArticulos.php", // URL del servidor para obtener los datos
                success: function(r) {
                    // La función se ejecuta si la solicitud Ajax es exitosa

                    // Parsea la respuesta JSON recibida del servidor
                    dato = jQuery.parseJSON(r);

                    // Rellena los campos del formulario con los datos del artículo
                    $('#idArticulo').val(dato['id_producto']); // Asigna el ID del producto al campo correspondiente
                    $('#categoriaSelectU').val(dato['id_categoria']); // Asigna la categoría al campo correspondiente
                    $('#nombreU').val(dato['nombre']); // Asigna el nombre del artículo al campo correspondiente
                    $('#descripcionU').val(dato['descripcion']); // Asigna la descripción al campo correspondiente
                    $('#cantidadU').val(dato['cantidad']); // Asigna la cantidad al campo correspondiente
                    $('#precioU').val(dato['precio']); // Asigna el precio al campo correspondiente
                }
            });
        }

        function eliminaArticulo(idArticulo) {
            // Muestra un cuadro de diálogo de confirmación utilizando la librería "alertify".
            alertify.confirm('¿Desea eliminar este producto?',
                function() {
                    // Cuando se confirma la eliminación, se realiza una solicitud AJAX para eliminar el producto.
                    $.ajax({
                        type: "POST",
                        data: "idArticulo=" + idArticulo, // Se envía el ID del artículo como datos POST.
                        url: "../procesos/articulos/eliminaArticulos.php", // URL del script PHP que manejará la eliminación.
                        success: function(r) {
                            if (r == 1) {
                                // Si el servidor devuelve 1, significa que la eliminación fue exitosa.
                                // Se recarga la tabla de artículos en la página actual.
                                $('#tablaArticuloLoad').load("articulos/tablaArticulos.php");
                                // Se muestra una notificación de éxito.
                                alertify.success("Producto eliminado")
                            } else {
                                // Si el servidor no devuelve 0, significa que la eliminación no fue exitosa.
                                // Se muestra una notificación de error.
                                console.log(r);
                                alertify.error("No se eliminó el producto");
                            }
                        }
                    });
                },
                function() {
                    // Si el usuario cancela la eliminación, se muestra una notificación de error.
                    alertify.error('Canceló la operación!')
                });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Cargar la tabla de articulo al cargar la página
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

                // Crear un objeto FormData a partir del formulario con el id "frmArticulos"
                var formData = new FormData(document.getElementById("frmArticulos"));
                // Realizar una solicitud AJAX utilizando jQuery
                $.ajax({
                    // URL a la que se enviará la solicitud
                    url: "../procesos/articulos/insertaArticulos.php",
                    // Tipo de solicitud (POST en este caso)
                    type: "post",
                    // Tipo de datos esperados en la respuesta (HTML en este caso)
                    dataType: "html",
                    // Datos que se enviarán con la solicitud (FormData con los datos del formulario)
                    data: formData,
                    // Evitar el almacenamiento en caché de la respuesta del servidor
                    cache: false,
                    // No configurar automáticamente el tipo de contenido de la solicitud
                    contentType: false,
                    // No procesar automáticamente los datos enviados
                    processData: false,
                    // Función que se ejecuta cuando la solicitud es exitosa
                    success: function(r) {
                        // alert(r);
                        // console.log(r);
                        // Comprobar si la respuesta del servidor es igual a 1
                        if (r == 1) {
                            // Restablecer el formulario con id "frm"
                            $('#frmArticulos')[0].reset();
                            // Cargar una tabla de artículos desde "articulos/tablaArticulos.php"
                            $('#tablaArticuloLoad').load("articulos/tablaArticulos.php");
                            // Mostrar un mensaje de éxito utilizando la librería "alertify"
                            alertify.success("Agregado con éxito :D");
                        } else {
                            $('#frmArticulos')[0].reset();
                            // Mostrar un mensaje de error utilizando la librería "alertify"
                            alertify.error("Fallo al subir el archivo :(");
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