<?php

    require_once "../Controladores/clientes.controlador.php";
    require_once "../Modelos/clientes.modelo.php";

    class AjaxCliente{

        public $valor;
        public $item;

        public function ajaxVistaCliente(){

            $item = $this->item;
            $valor = $this->valor;

            if($valor=="" || $valor==null){

                $valor=null;

            }

            $respuesta = ControladorClientes::ctrMostrarInfoCliente($item,$valor);

            /* encode: convierte array en string */
            echo json_encode($respuesta);
            //echo json_encode($datos)

        }

        public function ajaxSugerenciaClientes(){

            $valor = $this->valor;

            if($valor=="" || $valor==null){

                $valor=null;

            }

            $respuesta = ControladorClientes::ctrSugerenciaClientes($valor);
            /* encode: convierte array en string */
            echo json_encode($respuesta);
            //echo json_encode($datos)

        }

    }

    if(isset($_POST['valor'])){

        $mostrar = new AjaxCliente();
        $mostrar->valor = $_POST["valor"];
        $mostrar->item = $_POST["item"];
        $mostrar->ajaxVistaCliente();

    }
    else if(isset($_POST['sugerencia'])){

        $mostrar = new AjaxCliente();
        $mostrar->valor = $_POST["sugerencia"];
        $mostrar->ajaxSugerenciaClientes();

    }