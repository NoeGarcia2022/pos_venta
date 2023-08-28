<div class="col-sm-4">
    <!-- Formulario para agregar ventas -->
    <form id="frmVentas" action="" method="post" class="form-control" enctype="multipart/form-data">
        <h3>Vender Producto</h3>
        <hr>
        <div class="">
            <label for="clienteVenta" class="form-label">Selecciona Cliente</label>
            <select class="form-select form-select-sm" name="clienteVenta" id="clienteVenta">
                <option selected value="A">Buscar</option>
            </select>
        </div>
        <div class="">
            <label for="productoVenta" class="form-label">Producto</label>
            <select class="form-select form-select-sm" name="productoVenta" id="productoVenta">
                <option selected value="A">Buscar</option>
            </select>
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
            <button type="button" class="btn btn-outline-primary" id="btnAgregaVenta">Agregar</button>
            <button type="button" class="btn btn-outline-danger" id="btnVaciarTabla">Vaciar Tabla</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#clienteVenta').select2();
        $('#productoVenta').select2();

    })
</script>