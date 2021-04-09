<?php

    class ControladorClientes{

        /*=========================================
        MOSTRAR INSERTAR CLIENTE
        ==========================================*/
        static public function ctrInsertarCliente($datos){

            $tabla = "clientes";

            $respuesta = ModeloClientes::mdlMostrarInfoClientes($tabla,$datos);

            return $respuesta;

        }

        /*=========================================
        MOSTRAR INFO CLIENTES
        ==========================================*/
        static public function ctrMostrarInfoCliente($item,$valor){

            $tabla = "clientes";

            $respuesta = ModeloClientes::mdlMostrarInfoCliente($tabla,$item,$valor);

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