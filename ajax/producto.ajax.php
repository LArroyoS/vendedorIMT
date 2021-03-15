<?php

    require_once "../Controladores/productos.controlador.php";
    require_once "../Modelos/productos.modelo.php";

    class AjaxProductos{

        public $valor;
        public $item;

        public function ajaxVistaProducto(){

            $item = $this->item;
            $valor = $this->valor;

            if($valor=="" || $valor==null){

                $valor=null;

            }

            $respuesta = ControladorProductos::ctrMostrarInfoProducto($item,$valor);
            /* encode: convierte array en string */
            echo json_encode($respuesta);
            //echo json_encode($datos)

        }

    }

    if(isset($_POST['valor'])){

        $mostrar = new AjaxProductos();
        $mostrar->valor = $_POST["valor"];
        $mostrar->item = $_POST["item"];
        $mostrar->ajaxVistaProducto();

    }
