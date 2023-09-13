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
        <div class="container-fluid mt-3">
        </div>
        <div class="container mt-2 ">
            <div class="row">
                <div class="col-sm-4">
                    <h5 class="text-center bg-info">Formulario Productos</h5>
                    <!-- Formulario para agregar productos -->
                    <form id="frmArticulos" action="" method="post" class="form-control mb-4" enctype="multipart/form-data">
                        <h3>Formulario Productos</h3>
                        <hr>
                        <div class="mb-2">
                            <label for="" class="form-label">Categoria</label>
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
                        <div class="">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre">
                        </div>
                        <div class="">
                            <label for="descripcion" class="form-label">Descripcion</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="2"></textarea>
                        </div>
                        <div class="">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="text" class="form-control form-control-sm" id="cantidad" name="cantidad">
                        </div>
                        <div class="">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="text" class="form-control form-control-sm" id="precio" name="precio">
                        </div>
                        <div class="mt-2">
                            <input type="file" class="form-control input-group-sm" id="imagen" name="imagen">
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-outline-primary" id="btnAgregarArticulo">Agregar</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-8">
                    <h5 class="text-center bg-info">Lista Productos</h5>
                    <!-- Espacio para mostrar la tabla de articulos cargada dinámicamente -->
                    <div id="tablaArticuloLoad">
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>

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