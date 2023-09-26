<div class="table-responsive">

    <!-- Tabla con estilo de Bootstrap -->
    <table class="table table-striped table-hover table-sm text-center table-bordered">
        <!-- Encabezado de la tabla -->
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Usuario</th>
                <th scope="col">Categoría</th>
                <th scope="col">FechaRegistro</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ejemplo de una fila de categoría (puedes repetir esta estructura dinámicamente) -->
            <?php
            // incluimos nuestra conexion
            require_once("../../clases/Conexion.php");

            // Crear una instancia de la clase Conectar y obtener la conexión
            $c = new Conectar();
            $conexion = $c->conexion();

            // $sql = $conexion->query("SELECT * FROM tb_categorias
            // INNER JOIN tb_usuarios ON tb_categorias.id_usuario = tb_categorias.id_usuario");

            $sql = $conexion->query("SELECT c.id_categoria, u.nombre AS nombreUsuario, c.nombreCategoria, c.fechaCaptura 
                                        FROM tb_categorias c
                                        INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario");

            while ($resultado = $sql->fetch_assoc()) {
            ?>
                <tr>
                    <td scope="row"><?php echo $resultado['id_categoria'] ?></td>
                    <td scope="row"><?php echo $resultado['nombreUsuario'] ?></td>
                    <td scope="row"><?php echo $resultado['nombreCategoria'] ?></td>
                    <td scope="row"><?php echo $resultado['fechaCaptura'] ?></td>
                    <td scope="row">
                        <!-- Botones de edición y eliminación con iconos -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#actualizarCategoria" onclick="agregaDato('<?php echo $resultado['id_categoria'] ?>', '<?php echo $resultado['nombreCategoria'] ?>' )"><i class="fas fa-pencil-alt"></i></button>
                        <button type="button" onclick="eliminaCategoria('<?php echo $resultado['id_categoria'] ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                <!-- Fin del ejemplo de fila -->
            <?php
            }
            ?>
        </tbody>
    </table>
</div>