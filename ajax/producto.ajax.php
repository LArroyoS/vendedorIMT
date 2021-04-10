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

            if($respuesta!=false){

                $respuesta['precio'] = (($respuesta['descuentoOferta']>0)? $respuesta['precioOferta']:$respuesta['precio']);

                $itemMarca = "id";
                $valorMarca = isset($respuesta['id_marca'])? $respuesta['id_marca']:null;
                $marca = ControladorProductos::ctrMostrarInfoMarca($itemMarca,$valorMarca);

                $respuesta['id_marca'] = isset($marca['marca'])? $marca['marca']: 'Desconocida';

            }

            /* encode: convierte array en string */
            echo json_encode($respuesta);
            //echo json_encode($datos)

        }

        public function ajaxSugerenciaProducto(){

            $valor = $this->valor;

            if($valor=="" || $valor==null){

                $valor=null;

            }

            $respuesta = ControladorProductos::ctrSugerenciaProducto($valor);
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
    else if(isset($_POST['sugerencia'])){

        $mostrar = new AjaxProductos();
        $mostrar->valor = $_POST["sugerencia"];
        $mostrar->ajaxSugerenciaProducto();

    }
