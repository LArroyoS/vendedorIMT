<?php


    class ControladorCotizacion{

        /*====================================================
        REGISTRO Cotizacion
        ====================================================*/
        public function ctrRegistroCotizacion($datos){

            $tabla = 'cotizacion';

            $respuesta = ModeloCotizacion::mdlRegistroCotizacion($tabla,$datos);

            return $respuesta;

        }

        /*====================================================
        REGISTRO Cotizacion
        ====================================================*/
        public function ctrInfoCotizacion($item,$valor){

            $tabla = 'cotizacion';

            $respuesta = ModeloCotizacion::mdlInfoCotizacion($tabla,$item,$valor);

            return $respuesta;

        }

        /*====================================================
        REGISTRO Actualizar
        ====================================================*/
        public function ctrActualizarCotizacion($datos,$item){

            $tabla = 'cotizacion';

            $respuesta = ModeloCotizacion::mdlActualizarCotizacion($tabla,$datos,$item);

            return $respuesta;

        }

        /*====================================================
        REGISTRO detalle_cotizacion
        ====================================================*/
        public function ctrRegistroDetalleCotizacion($datos){

            $tabla = 'detalle_cotizacion';

            $respuesta = ModeloCotizacion::mdlRegistroDetalleCotizacion($tabla,$datos);

            return $respuesta;

        }

        /*====================================================
        REGISTRO lista detalle_cotizacion
        ====================================================*/
        public function ctrListarDetalleCotizacion($ordenar,$item,$valor){

            $tabla = 'detalle_cotizacion';

            $respuesta = ModeloCotizacion::mdlListarDetalleCotizacion($tabla,$ordenar,$item,$valor);

            return $respuesta;

        }

        /*=========================================
        SUGERENCIA FOLIOS
        ==========================================*/
        static public function ctrSugerenciaFolios($valor){

            $tabla = "cotizacion";

            $respuesta = ModeloCotizacion::mdlSugerenciaFolios($tabla,$valor);

            return $respuesta;

        }

    }