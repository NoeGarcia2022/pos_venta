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


<div class="table-responsive mt-4">

    <!-- Tabla con estilo de Bootstrap -->
    <table class="table table-hover text-center table-bordered">
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
                        <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#actualizaArticulo" onclick="agregaDatosArticulo('<?php echo $ver [9] ?>')">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <!-- Fin del ejemplo de fila -->
            <?php endwhile; ?>
        </tbody>
    </table>
</div>