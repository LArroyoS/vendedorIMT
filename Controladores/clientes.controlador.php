<?php

    class ControladorCliente{

        /*=========================================
        MOSTRAR INFO CLIENTES
        ==========================================*/
        static public function ctrMostrarInfoClientes($item,$valor){

            $tabla = "clientes";

            $respuesta = ModeloClientes::mdlMostrarInfoClientes($tabla,$item,$valor);

            return $respuesta;

        }

        /*=========================================
        ACTUALIZAR CLIENTES
        ==========================================*/
        static public function ctrActualizarVistaClientes($datos,$item){

            $tabla = "clientes";

            $respuesta = ModeloClientes::mdlActualizarVistaClientes($tabla,$datos,$item);

            return $respuesta;

        }

        /*=========================================
        SUGERENCIA CLIENTES
        ==========================================*/
        static public function ctrSugerenciaClientes($valor){

            $tabla = "clientes";

            $respuesta = ModeloClientes::mdlSugerenciaClientes($tabla,$valor);

            return $respuesta;

        }

    }