<?php


    class ControladorCotizacion{

        /*====================================================
        REGISTRO Cotizacion
        ====================================================*/
        public function ctrRegistroCotizacion($datos,&$conexion=null){

            $tabla = 'cotizacion';

            $respuesta = ModeloCotizacion::mdlRegistroCotizacion($tabla,$datos,$conexion);

            return $respuesta;

        }

        /*====================================================
        REGISTRO Cotizacion
        ====================================================*/
        public function ctrInfoCotizacion($item,$valor,&$conexion=null){

            $tabla = 'cotizacion';

            $respuesta = ModeloCotizacion::mdlInfoCotizacion($tabla,$item,$valor,$conexion);

            return $respuesta;

        }

        /*====================================================
        REGISTRO Actualizar
        ====================================================*/
        public function ctrActualizarCotizacion($datos,$item,&$conexion=null){

            $tabla = 'cotizacion';

            $respuesta = ModeloCotizacion::mdlActualizarCotizacion($tabla,$datos,$item,$conexion);

            return $respuesta;

        }

        /*====================================================
        REGISTRO detalle_cotizacion
        ====================================================*/
        public function ctrRegistroDetalleCotizacion($datos,&$conexion=null){

            $tabla = 'detalle_cotizacion';

            $respuesta = ModeloCotizacion::mdlRegistroDetalleCotizacion($tabla,$datos,$conexion);

            return $respuesta;

        }

        /*====================================================
        Actualizar detalle_cotizacion
        ====================================================*/
        public function ctrActualizarDetalleCotizacion($datos,$item,&$conexion=null){

            $tabla = 'detalle_cotizacion';

            $respuesta = ModeloCotizacion::mdlActualizarDetalleCotizacion($tabla,$datos,$item,$conexion);

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