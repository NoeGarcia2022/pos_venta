<?php
// Incluimos la conexion 
require_once("../../clases/Conexion.php");
session_start();

// Crear una instancia de la clase Conectar y obtener la conexión
$c = new Conectar();
$conexion = $c->conexion();

// Consulta SQL para seleccionar datos de varias tablas utilizando INNER JOINs
$sql = "SELECT clien.id_cliente, user.nombre, clien.nombre, clien.apellido, clien.direccion, clien.correo, clien.telefono, clien.dui, clien.fechaCaptura
            FROM tb_clientes AS clien
            INNER JOIN tb_usuarios AS user
            ON clien.id_usuario = user.id_usuario";

// Ejecutamos la consulta SQL en la base de datos
$result = mysqli_query($conexion, $sql);

?>

<div class="table-responsive mt-4">

    <!-- Tabla con estilo de Bootstrap -->
    <table class="table table-hover text-center table-bordered">
        <!-- Encabezado de la tabla -->
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <!-- <th scope="col">Usuario</th> -->
                <?php if ($_SESSION['usuario'] == "admin") : ?>
                    <!-- Mostrar la columna "Usuario" solo si el usuario es un administrador -->
                    <th scope="col">Usuario</th>
                <?php endif; ?>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Direccion</th>
                <th scope="col">Correo Electronico</th>
                <th scope="col">Telefono</th>
                <th scope="col">Dui</th>
                <th scope="col">FechaRegistro</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ejemplo de una fila de categoría (puedes repetir esta estructura dinámicamente) -->
            <?php while ($ver = mysqli_fetch_row($result)) : ?>
                <tr>
                    <td scope="row"><?php echo $ver[0] ?></td>
                    <?php if ($_SESSION['usuario'] == "admin") : ?>
                        <td scope="row"><?php echo $ver[1] ?></td>
                    <?php endif; ?>
                    <td scope="row"><?php echo $ver[2] ?></td>
                    <td scope="row"><?php echo $ver[3] ?></td>
                    <td scope="row"><?php echo $ver[4] ?></td>
                    <td scope="row"><?php echo $ver[5] ?></td>
                    <td scope="row"><?php echo $ver[6] ?></td>
                    <td scope="row"><?php echo $ver[7] ?></td>
                    <td scope="row"><?php echo $ver[8] ?></td>
                    <td scope="row">
                        <!-- Botones de edición y eliminación con iconos -->
                        <button type="button" class="btn btn-outline-success btn-sm"><i class="fas fa-pencil-alt" data-bs-toggle="modal" data-bs-target="#actualizaCliente" onclick="agregaDatosCliente('<?php echo $ver[0] ?>')" ></i></button>
                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                <!-- Fin del ejemplo de fila -->
            <?php endwhile; ?>
        </tbody>
    </table>
</div>