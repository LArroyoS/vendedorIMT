<?php

    class ModeloCotizacion{

        /*=====================================================
        RESGISTRO DE Cotizacion
        =====================================================*/
        static public function mdlRegistroCotizacion($tabla,$datos){

            $pdo = Conexion::conectar();

            $stmt = $pdo->prepare("INSERT INTO $tabla(vendedor_id ,cliente_id,envio,subtotal)
            VALUE (:vendedor_id, :cliente_id, :envio, :subtotal)");

            $stmt->bindParam(":vendedor_id", $datos["vendedor_id"], PDO::PARAM_STR);
            $stmt->bindParam(":cliente_id", $datos["cliente_id"], PDO::PARAM_STR);
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
        static public function mdlActualizarCotizacion($tabla,$datos,$item){

            $stmt = Conexion::conectar()
            ->prepare("UPDATE $tabla 
                SET $item = :$item 
                WHERE id = :id");

            $stmt -> bindParam(":id", $datos['id'], PDO::PARAM_STR);
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
        MOSTRAR INFO Cotizacion
        ==========================================*/
        static public function mdlInfoCotizacion($tabla, $item, $valor){

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

        /*=====================================================
        RESGISTRO DE detalle_Cotizacion
        =====================================================*/
        static public function mdlRegistroDetalleCotizacion($tabla,$datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cotizacion_id,producto_id,cantidad,precio_unitario,descuentoOferta,precioDescuento)
            VALUE (:cotizacion_id, :producto_id, :cantidad, :precio_unitario, :descuentoOferta, :precioDescuento)");

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

    }