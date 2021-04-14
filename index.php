<?php 

    /*=======================================
    LIBRERIAS
    ========================================*/
    require_once "extensiones/fpdf/draw.php";
    require_once "extensiones/PHPMailer/PHPMailerAutoload.php";

    /*====================================================
    PLANTILLA
    =====================================================*/
    require_once "Controladores/plantilla.controlador.php";
    require_once "Modelos/plantilla.modelo.php";

    /*=======================================
    PRODUCTO
    ========================================*/
    require_once "Controladores/productos.controlador.php";
    require_once "Modelos/productos.modelo.php";

    /*=======================================
    USUARIOS
    ========================================*/
    require_once "Controladores/usuarios.controlador.php";
    require_once "Modelos/usuarios.modelo.php";

    /*====================================================
    RUTA
    =====================================================*/
    require_once "Modelos/ruta.php";

    $plantilla = new ControladorPlantilla();
    $plantilla->plantilla();

?>