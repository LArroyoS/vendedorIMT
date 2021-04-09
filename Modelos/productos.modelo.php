<?php

    require_once "conexion.php";

    class ModeloProductos{

        /*=========================================
        MOSTRAR MARCAS
        ==========================================*/
        static public function mdlMostrarMarcas($tabla,$item,$valor){

            if($item != null){

                $stmt = Conexion::conectar()
                    ->prepare("SELECT * FROM $tabla WHERE $item = :$item");

                $stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

                $stmt->execute();

                return $stmt->fetch();

            }else{

                $stmt = Conexion::conectar()
                    ->prepare("SELECT * FROM $tabla");

                $stmt->execute();

                return $stmt->fetchAll();

            }

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        MOSTRAR INFO MARCA
        ==========================================*/
        static public function mdlMostrarInfoMarca($tabla, $item, $valor){

            $stmt = Conexion::conectar()
            ->prepare("SELECT * FROM $tabla WHERE $item = :$item LIMIT 1");

            $stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

            try{

                if($stmt->execute()){

                    return $stmt->fetch();

                }else{

                    return false;

                }

            }
            catch(Exception $e){

                return false;

            }

            return $stmt->fetch();

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        ACTUALIZAR MARCA
        ==========================================*/
        static public function mdlActualizarVistaMarca($tabla,$datos,$item){

            $stmt = Conexion::conectar()
            ->prepare("UPDATE $tabla 
                SET $item = :$item 
                WHERE ruta = :ruta");

            $stmt -> bindParam(":ruta", $datos['ruta'], PDO::PARAM_STR);
            $stmt -> bindParam(":".$item , $datos['valor'], PDO::PARAM_STR);

            if($stmt->execute()){

                return "ok";

            }
            else{

                return "error";

            }

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        MOSTRAR CATEGORIAS
        ==========================================*/
        static public function mdlMostrarCategorias($tabla,$item,$valor){

            if($item != null){

                $stmt = Conexion::conectar()
                    ->prepare("SELECT * FROM $tabla WHERE $item = :$item");

                $stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

                $stmt->execute();

                return $stmt->fetch();

            }else{

                $stmt = Conexion::conectar()
                    ->prepare("SELECT * FROM $tabla");

                $stmt->execute();

                return $stmt->fetchAll();

            }

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        MOSTRAR SUB-CATEGORIAS
        ==========================================*/
        static public function mdlMostrarSubCategorias($tabla,$item,$valor){

            $stmt = Conexion::conectar()
                ->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        MOSTRAR PRODUCTOS
        ==========================================*/
        static public function mdlMostrarProductos($tabla,$ordenar,$item,$valor,$base,$tope,$modo){

            if($item != null){

                $stmt = Conexion::conectar()
                ->prepare("SELECT * FROM $tabla WHERE $item = :$item 
                ORDER BY $ordenar $modo 
                LIMIT $base, $tope");

                $stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

                $stmt->execute();

                return $stmt->fetchAll();

            }
            else{

                $stmt = Conexion::conectar()
                ->prepare("SELECT * FROM $tabla 
                ORDER BY $ordenar $modo
                LIMIT $base, $tope");

                $stmt->execute();

                return $stmt->fetchAll();

            }

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        MOSTRAR INFO PRODUCTOS
        ==========================================*/
        static public function mdlMostrarInfoProducto($tabla, $item, $valor){

            $stmt = Conexion::conectar()
            ->prepare("SELECT * FROM $tabla WHERE $item = :$item LIMIT 1");

            $stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

            try{

                if($stmt->execute()){

                    return $stmt->fetch();

                }else{

                    return false;

                }

            }
            catch(Exception $e){

                return false;

            }

            return $stmt->fetch();

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        LISTAR PRODUCTOS
        ==========================================*/
        static public function mdlListarProductos($tabla,$ordenar,$item,$valor){

            if($item != null){

                $stmt = Conexion::conectar()
                ->prepare("SELECT * FROM $tabla WHERE $item = :$item 
                ORDER BY $ordenar DESC");

                $stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

                $stmt->execute();

                return $stmt->fetchAll();

            }
            else{

                $stmt = Conexion::conectar()
                ->prepare("SELECT * FROM $tabla ORDER BY $ordenar ASC");

                $stmt->execute();

                return $stmt->fetchAll();

            }

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        MOSTRAR BANNER
        ==========================================*/
        static public function mdlMostrarBanner($tabla,$ruta){

            $stmt = Conexion::conectar()
            ->prepare("SELECT * FROM $tabla 
            WHERE ruta = :ruta");

            $stmt -> bindParam(":ruta",$ruta, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        BUSCADOR
        ==========================================*/
        static public function mdlBuscarProductos($tabla,$busqueda,$base,$tope,$ordenar, $modo){
                
            $stmt = Conexion::conectar()
            ->prepare("SELECT * FROM $tabla 
                WHERE ruta like '%$busqueda%' OR
                titular like '%$busqueda%' OR
                descripcion like '%$busqueda%'
                ORDER BY $ordenar $modo 
                LIMIT $base, $tope");

            $stmt->execute();

            return $stmt->fetchAll();

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        LISTAR PRODUCTOS BUSCADOR
        ==========================================*/
        static public function mdlListarProductosBusqueda($tabla,$busqueda){
                
            $stmt = Conexion::conectar()
            ->prepare("SELECT * FROM $tabla 
                WHERE ruta like '%$busqueda%' OR
                titular like '%$busqueda%' OR
                descripcion like '%$busqueda%'");

            $stmt->execute();

            return $stmt->fetchAll();

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        ACTUALIZAR PRODUCTO
        ==========================================*/
        static public function mdlActualizarVistaProducto($tabla,$datos,$item){

            $stmt = Conexion::conectar()
            ->prepare("UPDATE $tabla 
                SET $item = :$item 
                WHERE ruta = :ruta");

            $stmt -> bindParam(":ruta", $datos['ruta'], PDO::PARAM_STR);
            $stmt -> bindParam(":".$item , $datos['valor'], PDO::PARAM_STR);

            if($stmt->execute()){

                return "ok";

            }
            else{

                return "error";

            }

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        SUGERENCIA PRODUCTOS
        ==========================================*/
        static public function mdlSugerenciaProducto($tabla,$valor){

            if($valor!=null || $valor!=""){

                $stmt = Conexion::conectar()
                ->prepare("SELECT SKU,titulo FROM $tabla 
                WHERE 
                (SKU!=null OR SKU!='') AND
                (SKU like '$valor%' OR
                titulo like '$valor%')
                ORDER BY SKU ASC LIMIT 10");

                try{

                    if($stmt->execute()){

                        return $stmt->fetchAll();

                    }
                    else{

                        return false;

                    }

                }
                catch(Exception $e){

                    return false;

                }

                $stmt->close();

                /* Anular objeto */
                $stmt = null;

            }
            else{

                return false;

            }

        }

    }