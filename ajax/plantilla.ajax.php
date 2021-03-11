<?php

    require_once "../Controladores/plantilla.controlador.php";
    require_once "../Modelos/plantilla.modelo.php";

    class AjaxPlantilla{

        public function ajaxEstiloPlantilla(){

            $respuesta = ControladorPlantilla::ctrEstiloPlantilla();
            /* encode: convierte array en string */
            echo json_encode($respuesta);

        }

    }

    $objeto = new AjaxPlantilla();
    $objeto->ajaxEstiloPlantilla();