<?php 

    /*====================================================
    PLANTILLA
    =====================================================*/
    require_once "Controladores/plantilla.controlador.php";
    require_once "Modelos/plantilla.modelo.php";

    /*====================================================
    RUTA
    =====================================================*/
    require_once "Modelos/ruta.php";

    $plantilla = new ControladorPlantilla();
    $plantilla->plantilla();

?>