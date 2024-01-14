<?php
// Incluimos nuestra conexión (asumiendo que esta clase contiene la lógica para establecer una conexión a la base de datos)
require_once("../../clases/Conexion.php");

// Creamos una instancia de la clase Conectar
$c = new Conectar();

// Establecemos la conexión a la base de datos
$conexion = $c->conexion();

// Consulta SQL para seleccionar datos de varias tablas utilizando INNER JOINs
$sql = "SELECT art.id_producto, art.nombre, art.descripcion, art.cantidad, art.precio, art.fechaCaptura, img.ruta, cat.nombreCategoria, user.nombre, art.id_producto
        FROM tb_articulos AS art 
        INNER JOIN tb_imagenes AS img
        ON art.id_imagen = img.id_imagen
        INNER JOIN tb_categorias AS cat
        ON art.id_categoria = cat.id_categoria 
        INNER JOIN tb_usuarios AS user
        ON art.id_usuario = user.id_usuario";

// Ejecutamos la consulta SQL en la base de datos
$result = mysqli_query($conexion, $sql);

// En este punto, $result contendría los resultados de la consulta SQL.
// Debes procesar estos resultados según tus necesidades, por ejemplo, mostrarlos en una tabla HTML.
?>

<div class="table-responsive">
    <div class="row justify-content-end">
        <div class="col-8 col-sm-5 col-md-4 col-lg-4 mb-2">
            <form id="search-form" class="form-inline">
                <div class="input-group">
                    <label class="input-group-text bg-dark text-white" for="search-input"><strong>Buscar:</strong></label>
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="search" class="form-control" id="search-input">
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla con estilo de Bootstrap -->
    <table class="table table-striped table-hover table-sm table-bordered">
        <!-- Encabezado de la tabla -->
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Imagen</th>
                <th scope="col">Categoría</th>
                <th scope="col">Usuario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">FechaRegistro</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ejemplo de una fila de categoría (puedes repetir esta estructura dinámicamente) -->
            <?php while ($ver = mysqli_fetch_row($result)) : ?>
                <tr>
                    <td class="fs-6" scope="row"><?php echo $ver[0]; ?></td>
                    <td class="fs-6" scope="row">
                        <?php
                        // Dividir la ruta de la imagen en partes
                        $imgVer = explode("/", $ver[6]);
                        // Construir la ruta de la imagen utilizando partes
                        $imgRuta = $imgVer[1] . "/" . $imgVer[2] . "/" . $imgVer[3];
                        ?>
                        <!-- Mostrar la imagen con la ruta construida -->
                        <img src="<?php echo $imgRuta ?>" alt="img-producto" width="75" height="75" class="img-fluid">
                    </td>
                    <td class="fs-6" scope="row"><?php echo $ver[7]; ?></td>
                    <td class="fs-6" scope="row"><?php echo $ver[8]; ?></td>
                    <td class="fs-6" scope="row"><?php echo $ver[1]; ?></td>
                    <td class="fs-6" scope="row"><?php echo $ver[2]; ?></td>
                    <td class="fs-6" scope="row"><?php echo $ver[3]; ?></td>
                    <td class="fs-6" scope="row">$ <?php echo $ver[4]; ?></td>
                    <td class="fs-6" scope="row"><?php echo $ver[5]; ?></td>
                    <td class="fs-6" scope="row">
                        <!-- Botones de edición y eliminación con iconos -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#actualizaArticulo" onclick="agregaDatosArticulo('<?php echo $ver[9] ?>')">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminaArticulo('<?php echo $ver[9] ?>')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <!-- Fin del ejemplo de fila -->
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        // Manejar la búsqueda en tiempo real mientras el usuario escribe
        $("#search-input").on("input", function() {
            searchArticles();
        });

        // Función para realizar la búsqueda y filtrar los resultados
        function searchArticles() {
            var searchTerm = $("#search-input").val().toLowerCase();
            $("tbody tr").each(function() {
                var id = $(this).find("td:eq(0)").text().toLowerCase();
                var categoria = $(this).find("td:eq(2)").text().toLowerCase();
                var usuario = $(this).find("td:eq(3)").text().toLowerCase();
                var nombre = $(this).find("td:eq(4)").text().toLowerCase();
                var precio = $(this).find("td:eq(7)").text().toLowerCase();
                var fecha = $(this).find("td:eq(8)").text().toLowerCase();

                if (id.indexOf(searchTerm) === -1 && categoria.indexOf(searchTerm) === -1 && usuario.indexOf(searchTerm) === -1 && nombre.indexOf(searchTerm) === -1 && precio.indexOf(searchTerm) === -1 && fecha.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        }
    });
</script>