<?php
// incluimos nuestra conexion
require_once("../../clases/Conexion.php");


// Crear una instancia de la clase Conectar y obtener la conexión
$c = new Conectar();
$conexion = $c->conexion();

// sentencia sql para mostrar datos de categorias 
$sql = "SELECT  id_categoria, id_usuario, nombreCategoria FROM tb_categorias ";

// retornamos las variables $conexion, $sql
$result = mysqli_query($conexion, $sql);
?>

<div class="table-responsive mt-4">

    <!-- Tabla con estilo de Bootstrap -->
    <table class="table table-hover text-center table-bordered">
        <!-- Encabezado de la tabla -->
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Usuario</th>
                <th scope="col">Categoría</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ejemplo de una fila de categoría (puedes repetir esta estructura dinámicamente) -->
            <?php
            while ($ver = mysqli_fetch_row($result)) :
            ?>
                <tr>
                    <td scope="row"><?php echo $ver[0]; ?></td>
                    <td scope="row"><?php echo $ver[1]; ?></td>
                    <td scope="row"><?php echo $ver[2]; ?></td>
                    <td scope="row">
                        <!-- Botones de edición y eliminación con iconos -->
                        <button type="button" class="btn btn-outline-success btn-sm"><i class="fas fa-pencil-alt"></i></button>
                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                <!-- Fin del ejemplo de fila -->
        </tbody>
    <?php
            endwhile;
    ?>
    </table>
</div>