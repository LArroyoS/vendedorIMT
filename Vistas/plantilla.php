<!DOCTYPE html>
<html lang=”en”>

<head>
    
    <meta charset=”UTF-8″ />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
    minimum-scale1.0, maximum-scale=1.0, user-scalable=no">
    <title>Vendedor IMT</title>

    <?php 

        //session_start();

        $urlServidor = Ruta:: ctrRutaServidor();
        $icono = ControladorPlantilla::ctrEstiloPlantilla();

        echo '<link rel="icon" href="'.$urlServidor.$icono['icono'].'">';

        /*============================================
        MANTENER LA RUTA FIJA DEL PROJECTO
        ============================================*/

        $url = Ruta::ctrRuta();

    ?>

    <meta name="title" content="Tienda IMT">
    <meta name="description" content="Refaccionaria IMT">
    <meta name="keywords" content="tortilladoras, masa, mais, refaccionaria">

    <!--============================================
    PLUGINS DE CSS
    ============================================-->
    <!--<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>-->
    <link rel="stylesheet" href="<?php echo $url; ?>Vistas/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $url; ?>Vistas/css/plugins/fontawesome.css">
    <link rel="stylesheet" href="<?php echo $url; ?>Vistas/css/plugins/sweetalert.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <!--============================================
    ESTILOS PERSONALIZADOS
    ============================================-->
    <link rel="stylesheet" href="<?php echo $url; ?>Vistas/css/plantilla.css?1.1">

    <!--============================================
    PLUGINS DE JAVASCRIPT
    ============================================-->
    <script src="<?php echo $url; ?>Vistas/js/plugins/all.js"></script>
    <script src="<?php echo $url; ?>Vistas/js/plugins/jquery.min.js"></script>
    <script src="<?php echo $url; ?>Vistas/js/plugins/popper.js"></script>
    <script src="<?php echo $url; ?>Vistas/js/plugins/bootstrap.min.js"></script>
    <!-- https://easings.net -->
    <script src="<?php echo $url; ?>Vistas/js/plugins/jquery.easing.js"></script>
    <script src="<?php echo $url; ?>Vistas/js/plugins/jquery.scrollUp.js"></script>
    <script src="<?php echo $url; ?>Vistas/js/plugins/jquery.flexslider.js"></script>
    <script src="<?php echo $url; ?>Vistas/js/plugins/sweetalert.min.js"></script>
    <script>

        var rutaActual = location.href;

    </script>

</head>

<body> 

<?php

/*=============================================  
CABEZOTE
===============================================*/

include "Modulos/cabezote.php";

?>

<input type="hidden" value="<?php echo $url; ?>" id="rutaOculta">

<!--============================================
JAVASCRIPT PERSONALIZADOS
============================================-->

</script>

</body>

</html>