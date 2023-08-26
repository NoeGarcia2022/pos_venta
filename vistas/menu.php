<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS VENTA Y ALMACEN</title>
    <?php
    require_once("dependencias.php");
    ?>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <!-- Logo y enlace de la marca -->
            <a class="navbar-brand" href="#">
                <img src="../img//logo_pos_venta.png" alt="logo_pos_venta" width="30" height="30" class="d-inline-block align-text-top">
                VENTAS Y ALMACEN
            </a>
            <!-- Botón de menú desplegable para dispositivos móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Elemento de menú: Inicio -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger btn-sm mx-1 <?php if ($currentPage == 'inicio') echo 'active'; ?>" href="../vistas/inicio.php">
                            <i class="fas fa-home fa-2xs"></i> Inicio
                        </a>
                    </li>
                    <!-- Elemento de menú: Productos -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger btn-sm mx-1 <?php if ($currentPage == 'productos') echo 'active'; ?>" href="../vistas/articulos.php">
                            <i class="fa-solid fa-table-list fa-2xs"></i> Productos
                        </a>
                    </li>
                    <!-- Elemento de menú: Categorías -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger btn-sm mx-1 <?php if ($currentPage == 'categorias') echo 'active'; ?>" href="../vistas/categorias.php">
                            <i class="fa-solid fa-table-list fa-2xs"></i> Categorias
                        </a>
                    </li>
                    <!-- Elemento de menú: Administrar Usuarios -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger btn-sm mx-1 <?php if ($currentPage == 'usuarios') echo 'active'; ?>" href="../vistas/usuarios.php">
                            <i class="fa-solid fa-users-gear fa-2xs"></i> Administrar Usuarios
                        </a>
                    </li>
                    <!-- Elemento de menú: Clientes -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger btn-sm mx-1 <?php if ($currentPage == 'clientes') echo 'active'; ?>" href="../vistas/clientes.php">
                            <i class="fa-solid fa-users-between-lines fa-2xs"></i> Clientes
                        </a>
                    </li>
                    <!-- Elemento de menú: Vender Artículo -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger btn-sm mx-1 <?php if ($currentPage == 'ventas') echo 'active'; ?>" href="../vistas/ventas.php">
                            <i class="fas fa-tag me-2 fa-2xs"></i>Vender Articulo
                        </a>
                    </li>
                    <!-- Elemento de menú: Usuario Logueado -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-outline-danger btn-sm mx-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-tie fa-2xs"></i> Usuario Logueado
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../procesos/salir.php"><i class="fas fa-sign-out-alt fa-2xs"></i> SALIR</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




</body>

</html>