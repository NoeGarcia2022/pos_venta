<?php
// Incluimos la conexion
require_once("../../clases/Conexion.php");
// Imstanciamos la conexion
$c = new Conectar();
$conexion = $c->conexion();

// Sentencia sql para mostrar los datos de la tabla usuarios 
$sql = "SELECT  id_usuario, nombre, apellido, correo, fechaCaptura
            FROM tb_usuarios";

// Corremos nuestro query
$result = mysqli_query($conexion, $sql);
?>

<div class="table-responsive mt-4">

    <!-- Tabla con estilo de Bootstrap -->
    <table class="table table-hover text-center table-bordered">
        <!-- Encabezado de la tabla -->
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Usuario</th>
                <th scope="col">FechaRegistro</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ejemplo de una fila de categoría (puedes repetir esta estructura dinámicamente) -->
            <?php while ($ver = mysqli_fetch_row($result)) : ?>
                <tr>
                    <td scope="row"><?php echo $ver[0] ?></td>
                    <td scope="row"><?php echo $ver[1] ?></td>
                    <td scope="row"><?php echo $ver[2] ?></td>
                    <td scope="row"><?php echo $ver[3] ?></td>
                    <td scope="row"><?php echo $ver[4] ?></td>
                    <td scope="row">
                        <!-- Botones de edición y eliminación con iconos -->
                        <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#actualizaUsuarios" onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="eliminaUsuario('<?php echo $ver[0]; ?>')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <!-- Fin del ejemplo de fila -->
            <?php
            endwhile;
            ?>
        </tbody>
    </table>
</div>