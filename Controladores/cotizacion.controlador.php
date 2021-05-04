<?php


    class ControladorCotizacion{

        /*====================================================
        REGISTRO Cotizacion
        ====================================================*/
        static public function ctrRegistroCotizacion($datos,&$conexion=null){

            $tabla = 'cotizacion';

            $respuesta = ModeloCotizacion::mdlRegistroCotizacion($tabla,$datos,$conexion);

            return $respuesta;

        }

        /*====================================================
        REGISTRO Cotizacion
        ====================================================*/
        static public function ctrInfoCotizacion($item,$valor,&$conexion=null){

            $tabla = 'cotizacion';

            $respuesta = ModeloCotizacion::mdlInfoCotizacion($tabla,$item,$valor,$conexion);

            return $respuesta;

        }

        /*====================================================
        REGISTRO Actualizar
        ====================================================*/
        static public function ctrActualizarCotizacion($datos,$item,&$conexion=null){

            $tabla = 'cotizacion';

            $respuesta = ModeloCotizacion::mdlActualizarCotizacion($tabla,$datos,$item,$conexion);

            return $respuesta;

        }

        /*====================================================
        REGISTRO detalle_cotizacion
        ====================================================*/
        static public function ctrRegistroDetalleCotizacion($datos,&$conexion=null){

            $tabla = 'detalle_cotizacion';

            $respuesta = ModeloCotizacion::mdlRegistroDetalleCotizacion($tabla,$datos,$conexion);

            return $respuesta;

        }

        /*====================================================
        Actualizar detalle_cotizacion
        ====================================================*/
        static public function ctrActualizarDetalleCotizacion($datos,$item,&$conexion=null){

            $tabla = 'detalle_cotizacion';

            $respuesta = ModeloCotizacion::mdlActualizarDetalleCotizacion($tabla,$datos,$item,$conexion);

            return $respuesta;

        }

        /*====================================================
        Buscar Cotizacion
        ====================================================*/
        static public function ctrBuscarCotizacion($busqueda,$base,$tope,$ordenar,$modo){

            $tabla = 'cotizacion';

            $respuesta = ModeloCotizacion::mdlBuscarCotizacion($tabla,$busqueda,$base,$tope,$ordenar,$modo);

            return $respuesta;

        }

        /*=========================================
        LISTAR cotizacion BUSCADOR
        ==========================================*/
        static public function ctrListarCotizacionBusqueda($busqueda){

            $tabla = "cotizacion";

            $respuesta = ModeloCotizacion::mdlListarCotizacionBusqueda($tabla,$busqueda);

            return $respuesta;

        }

        /*====================================================
        REGISTRO lista detalle_cotizacion
        ====================================================*/
        static public function ctrListarDetalleCotizacion($ordenar,$item,$valor){

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