<?php

    require_once "conexion.php";

    class ModeloClientes{

        /*=========================================
        MOSTRAR INFO Clientes
        ==========================================*/
        static public function mdlMostrarInfoCliente($tabla, $item, $valor){

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
        ACTUALIZAR Cliente
        ==========================================*/
        static public function mdlActualizarVistaCliente($tabla,$datos,$item){

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
        SUGERENCIA Clientes
        ==========================================*/
        static public function mdlSugerenciaCliente($tabla,$valor){

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