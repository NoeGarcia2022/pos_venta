<div class="row">
    <div class="col-sm-4">
        <!-- Formulario para agregar ventas -->
        <form id="frmVentas" action="" method="post" class="form-control" enctype="multipart/form-data">
            <h3>Vender Producto</h3>
            <hr>
            <div class="form-group">
                <label for="clienteVenta" class="form-label">Selecciona Cliente</label>
                <select class="form-select form-select-sm" name="clienteVenta" id="clienteVenta">
                    <option selected value="A">Buscar</option>
                    <option value="0">Sin cliente</option>
                    <?php
                    $sql = "SELECT id_cliente, nombre, apellido FROM tb_clientes";
                    $result = mysqli_query($conexion, $sql);
                    while ($cliente = mysqli_fetch_row($result)) :
                    ?>
                        <option value="<?php echo $cliente[0] ?>"><?php echo $cliente[2] . " " . $cliente[1] ?></option>
                    <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="productoVenta" class="form-label">Producto</label>
                <select class="form-select form-select-sm" name="productoVenta" id="productoVenta">
                    <option selected value="A">Buscar</option>
                    <?php
                    $sql = "SELECT id_producto, nombre FROM tb_articulos";
                    $result = mysqli_query($conexion, $sql);
                    while ($articulo = mysqli_fetch_row($result)) :
                    ?>
                        <option value="<?php echo $articulo[0] ?>"><?php echo $articulo[1] ?></option>
                    <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea readonly disabled class="form-control" id="descripcion" name="descripcion" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input readonly disabled type="text" class="form-control input-group-sm" id="cantidad" name="cantidad">
            </div>
            <div class="form-group">
                <label for="precio" class="form-label">Precio</label>
                <input readonly disabled type="text" class="form-control input-group-sm" id="precio" name="precio">
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-outline-primary" id="btnAgregaVenta">Agregar</button>
                <button type="button" class="btn btn-outline-danger" id="btnVaciarTabla">Vaciar Tabla</button>
            </div>
        </form>

    </div>


    <div class="col-sm-3">
        <div id="imgProducto"></div>
    </div>
</div>