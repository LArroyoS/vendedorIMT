<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>

    <?php 

        session_start();

        $urlVendedor = Ruta::ctrRuta();
        $urlServidor = Ruta::ctrRutaServidor();
        $icono = ControladorPlantilla::ctrEstiloPlantilla();

        /*=============================================  
        CONTENIDO DINAMICO
        ===============================================*/
        $valor = "";

        if(isset($_GET['ruta'])){

            $rutas = explode("/",$_GET['ruta']);

            $item = "ruta";

            if($rutas[0] == "panel_vendedor" ||
                $rutas[0] == "consultar_folio" ||
                $rutas[0] == "salir"){

                $valor = $rutas[0];

            }
            else{

                $valor = "error";

            }

        }

        echo '<link rel="icon" href="'.$urlServidor.$icono['icono'].'">';

    ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vendedor IMT</title>

    <base href="Vistas/">

    <!--=======================================================
    CSS
    =========================================================-->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo $urlVendedor; ?>Vistas/css/plugins/sweetalert.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo $urlVendedor; ?>Vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!--=======================================================
    JS
    =========================================================-->
    <script src="<?php echo $urlVendedor; ?>Vistas/js/plugins/sweetalert.min.js"></script>

    <!--=======================================================
    MIS ESTILOS
    =========================================================-->
    <link rel="stylesheet" href="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/css/plantilla.css?1.3">

</head>

<body class="hold-transition sidebar-mini">

    <?php 

        if(
            (isset($_SESSION['validarSesion']) && $_SESSION['validarSesion'] == 'ok')
        ): 

            $valor = (($valor!="")? $valor:'inicio');

    ?>

            <div class="wrapper">

                <?php include "Modulos/cabezote.php"; ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-uppercase"><?php echo htmlspecialchars(str_replace("_", " ", $valor)); ?></h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right text-uppercase">
                                        <li class="breadcrumb-item">
                                            <a href="<?php echo htmlspecialchars($urlVendedor); ?>">Inicio</a>
                                        </li>
                                        <?php if($valor!='inicio'): ?>
                                            <li class="breadcrumb-item active">
                                                <?php echo htmlspecialchars(str_replace("_", " ", $valor)); ?>
                                            </li>
                                        <?php endif; ?>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">

                            <?php 

                                include 'Modulos/'.$valor.'.php'; 

                            ?>

                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

                <input type="hidden" value="<?php echo $urlVendedor; ?>" id="rutaOculta">

                <!-- Main Footer -->
                <footer class="main-footer">
                    <!-- To the right -->
                    <div class="float-right d-none d-sm-inline">
                        Anything you want
                    </div>
                    <!-- Default to the left -->
                    <strong>Copyright &copy; 
                        <?php echo '2020-'.date('Y'); ?> 
                        <a href="<?php echo htmlspecialchars($urlVendedor); ?>">Refaccionaria IMT</a>.</strong> Todos los derechos reservados.
                </footer>

            </div>
            <!-- ./wrapper -->

    <?php 

        else:

            if($valor==''){

                include 'Modulos/ingresar.php';  

            }
            else{

                header('Location: '.$urlVendedor); 

            }   

        endif; 

    ?>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/dist/js/adminlte.min.js"></script>

    <!--=======================================================
    MIS JS
    =========================================================-->
    <script src="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/js/infoproducto.js?1.0"></script>
    <script src="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/js/infoCliente.js?1.0"></script>
    <script src="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/js/infoCotizacion.js?1.2"></script>
    <script src="<?php echo htmlspecialchars($urlVendedor); ?>Vistas/js/usuarios.js?1.2"></script>

</body>

</html>