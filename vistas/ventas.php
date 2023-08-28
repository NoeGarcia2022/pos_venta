<?php
// Iniciamos la sesión para trabajar con variables de sesión
session_start();

// Verificamos si existe una variable de sesión llamada 'usuario'
if (isset($_SESSION['usuario'])) {
    // Si la variable de sesión 'usuario' existe, la mostramos
    //echo $_SESSION['usuario'];
    $currentPage = "ventas";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ventas</title>
    </head>

    <header>
        <?php
        require_once("menu.php");
        ?>
    </header>

    <body>
        <!-- Aquí puedes agregar contenido que se mostrará cuando el usuario esté autenticado -->
        <div class="container mt-3">
            <h1 class="text-center bg-warning">VENTA DE PRODUCTOS</h1>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" id="ventaProductosBtn" class="btn btn-outline-primary">Vender producto</button>
                    <button type="button" id="ventasHechasBtn" class="btn btn-outline-success">Ventas hechas</button>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <div class="row">
                <div class="col-sm-12">
                    <div id="ventaProductos"></div>
                    <div id="ventasHechas"></div>
                </div>
            </div>
        </div>
    </body>

    </html>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#ventaProductosBtn').click(function() {
                esconderSeccionVentas();
                $('#ventaProductos').load('ventas/ventasDeProductos.php');
                $('#ventaProductos').show();
            });
            $('#ventasHechasBtn').click(function() {
                esconderSeccionVentas();
                $('#ventasHechas').load('ventas/VentasyReportes.php');
                $('#ventasHechas').show();
            });
        });

        function esconderSeccionVentas() {
            $('#ventaProductos').hide();
            $('#ventasHechas').hide();
        }
    </script>

<?php
} else {
    // Si la variable de sesión 'usuario' no existe, redireccionamos al usuario a la página de inicio de sesión (index.php)
    header("Location:../index.php");
}
?>