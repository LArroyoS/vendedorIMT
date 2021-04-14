<?php

    class ModeloCotizacion{

        /*=====================================================
        RESGISTRO DE Cotizacion
        =====================================================*/
        static public function mdlRegistroCotizacion($tabla,$datos,&$conexion=null){

            $pdo = ($conexion!=null)? $conexion : Conexion::conectar();

            $stmt = $pdo->prepare("INSERT INTO $tabla(vendedor_id,nombre_cliente,direccion_cliente,telefono,envio,subtotal)
            VALUE (:vendedor_id,:nombre_cliente, :direccion_cliente, :telefono, :envio, :subtotal)");

            $stmt->bindParam(":vendedor_id", $datos["vendedor_id"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion_cliente", $datos["direccion_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            
            $stmt->bindParam(":envio", $datos["envio"], PDO::PARAM_STR);
            $stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);

            try{

                if($stmt->execute()){

                    return $pdo->lastInsertId();

                }
                else{

                    return $stmt->errorInfo()[2];

                }

            }
            catch(Exception $e){

                return $e->getMessage();

            }

            $stmt->close();
            $stmt = null;

        }

        /*=========================================
        ACTUALIZAR Cotizacion
        ==========================================*/
        static public function mdlActualizarCotizacion($tabla,$datos,$item,&$conexion=null){

            $pdo = ($conexion!=null)? $conexion : Conexion::conectar();
            $stmt = $pdo->prepare("UPDATE $tabla 
                SET $item = :$item 
                WHERE id = :id");

            $stmt -> bindParam(":id", $datos['id'], PDO::PARAM_STR);
            $stmt -> bindParam(":".$item , $datos['valor'], PDO::PARAM_STR);

            if($stmt->execute()){

                return true;

            }
            else{

                return false;

            }

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        MOSTRAR INFO Cotizacion
        ==========================================*/
        static public function mdlInfoCotizacion($tabla, $item, $valor,&$conexion=null){

            $pdo = ($conexion!=null)? $conexion : Conexion::conectar();
            $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE $item = :$item LIMIT 1");

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

        /*=====================================================
        RESGISTRO DE detalle_Cotizacion
        =====================================================*/
        static public function mdlRegistroDetalleCotizacion($tabla,$datos,&$conexion=null){

            $pdo = ($conexion!=null)? $conexion : Conexion::conectar();
            $stmt = $pdo->prepare("INSERT INTO $tabla(id,cotizacion_id,producto_id,cantidad,precio_unitario,descuentoOferta,precioDescuento)
            VALUE (:id,:cotizacion_id, :producto_id, :cantidad, :precio_unitario, :descuentoOferta, :precioDescuento)");

            $stmt->bindParam(":cotizacion_id", $datos["cotizacion_id"], PDO::PARAM_STR);
            $stmt->bindParam(":producto_id", $datos["producto_id"], PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
            $stmt->bindParam(":precio_unitario", $datos["precio_unitario"], PDO::PARAM_STR);
            $stmt->bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
            $stmt->bindParam(":precioDescuento", $datos["precioDescuento"], PDO::PARAM_STR);

            try{

                if($stmt->execute()){

                    return 'ok';

                }
                else{

                    return "error";

                }

            }
            catch(Exception $e){

                return $e->getMessage();

            }

            $stmt->close();
            $stmt = null;

        }

        /*=========================================
        LISTAR DETALLES COTIZACION
        ==========================================*/
        static public function mdlListarDetalleCotizacion($tabla,$ordenar,$item,$valor){

            if($item != null){

                $stmt = Conexion::conectar()
                ->prepare("SELECT * FROM $tabla WHERE $item = :$item 
                ORDER BY $ordenar ASC");

                $stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

                if($stmt->execute()){

                    return $stmt->fetchAll();

                }
                else{

                    return $stmt->errorInfo()[2];

                }

            }
            else{

                return false;

            }

            $stmt->close();

            /* Anular objeto */
            $stmt = null;

        }

        /*=========================================
        SUGERENCIA FOLIO
        ==========================================*/
        static public function mdlSugerenciaFolios($tabla,$valor){

            if($valor!=null || $valor!=""){

                $stmt = Conexion::conectar()
                ->prepare("SELECT id,nombre_cliente,telefono FROM $tabla 
                WHERE 
                (id!=null OR id!='') AND
                (id like '$valor%')
                ORDER BY id ASC LIMIT 10");

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