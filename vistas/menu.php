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
    <nav class="navbar navbar-expand-lg navbar-secondary bg-secondary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="../vistas/inicio.php">
                <!-- Logo y enlace de la marca -->
                <img src="../img//logo_pos_venta.png" alt="logo-pos-venta" width="30px" height="30px">
                <strong>VENTAS Y ALMACEN</strong>
            </a>
            <!-- Botón de menu desplegable para dispositivos moviles -->
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu de navegacion -->
            <div class="collapse navbar-collapse justify-content-end" id="menu">
                <ul class="navbar-nav nav-tabs text-center">
                    <!-- Elemento de menu: Inicio -->
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'inicio') echo 'active'; ?>" href="../vistas/inicio.php"><span class="fas fa-home fa-2xs"></span> Inicio</a>
                    </li>
                    <!-- Elemento de menu: Articulos -->
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'productos') echo 'active'; ?>" href="../vistas/articulos.php"><span class="fa-solid fa-table-list fa-2xs"></span> Articulos</a>
                    </li>
                    <!-- Elemento de menu: Categorias -->
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'categorias') echo 'active'; ?>" href="../vistas/categorias.php"><span class="fa-solid fa-table-list fa-2xs"></span> Categorias</a>
                    </li>
                    <?php
                    // Verifica si el usuario en la sesión actual es 'admin'.
                    if ($_SESSION['usuario'] == "admin") :
                    ?>
                        <!-- Inicio del bloque condicional si el usuario es 'admin'. -->
                        <!-- Elemento de menu: Administrar Usuarios -->
                        <li class="nav-item">
                            <a class="nav-link <?php if ($currentPage == 'usuarios') echo 'active'; ?>" href="../vistas/usuarios.php"><span class="fa-solid fa-users-gear fa-2xs"></span> Administar Usuarios</a>
                        </li>
                    <?php
                    // Fin del bloque condicional si el usuario es 'admin'.
                    endif;
                    ?>
                    <!-- Elemento de menu: Clientes -->
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'clientes') echo 'active'; ?>" href="../vistas/clientes.php"><span class="fa-solid fa-users-between-lines fa-2xs"></span> Clientes</a>
                    </li>
                    <!-- Elemento de menu: Vender Articulo -->
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == 'ventas') echo 'active'; ?>" href="../vistas/ventas.php"><span class="fas fa-tag me-2 fa-2xs"></span>Vender Articulo</a>
                    </li>
                    <!-- Elemento menu: Usuario Logueado -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn" data-bs-toggle="dropdown"><span class="fa-solid fa-user-tie fa-2xs"></span> Usuario: <?php echo $_SESSION['usuario']; ?>
                        </a>
                        <ul class="dropdown-menu text-center">
                            <!-- Elemento de menu: Salir -->
                            <li>
                                <a class="dropdown-item" href="../procesos/salir.php"><span class="fas fa-sign-out-alt fa-2xs"></span> SALIR</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>