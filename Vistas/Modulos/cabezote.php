<?php 

    $urlVendedor = Ruta::ctrRuta();
    $urlServidor = Ruta::ctrRutaServidor();

?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo htmlspecialchars($urlVendedor); ?>" class="brand-link">
        <img src="<?php echo htmlspecialchars($urlServidor); ?>/Vistas/img/plantilla/logo.png" alt="IMT Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Vendedor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if($_SESSION['foto'] != ''): ?>

                    <img src="<?php echo htmlspecialchars($urlServidor.$_SESSION['foto']); ?>"
                        class="img-circle elevation-2" alt="User Image">

                <?php else: ?>

                    <img src="<?php echo htmlspecialchars($urlServidor); ?>Vistas\img\usuarios\default\anonymous.png"
                            class="img-circle elevation-2" alt="User Image">

                <?php endif; ?>

            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo htmlspecialchars($_SESSION['nombre'])?></a>
            </div>
        </div>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <a href="<?php echo htmlspecialchars($urlVendedor); ?>salir" class="salir">Salir</a>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo htmlspecialchars($urlVendedor); ?>" 
                        class="nav-link <?php echo (($valor=="inicio")?'active':''); ?>">

                        <i class="fas fa-home"></i>
                        <p>
                            Inicio
                        </p>

                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo htmlspecialchars($urlVendedor); ?>panel_vendedor" 
                        class="nav-link <?php echo (($valor=="panel_vendedor")?'active':''); ?>">

                        <i class="fas fa-cash-register"></i>
                        <p>
                            Panel vendedor
                        </p>

                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo htmlspecialchars($urlVendedor); ?>consultar_folio" 
                        class="nav-link <?php echo (($valor=="consultar_folio")?'active':''); ?>">

                        <i class="fas fa-ticket-alt"></i>
                        <p>
                            Consultar folio
                        </p>

                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>