<?php

    require_once "conexion.php";

    class ModeloClientes{

        /*=====================================================
        RESGISTRO DE USUARIO
        =====================================================*/
        static public function mdlRegistroUsuario($tabla,$datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,direccion,telefono)
            VALUE (:nombre, :direccion, :telefono)");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["password"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos["email"], PDO::PARAM_STR);

            try{

                if($stmt->execute()){

                    return "ok";

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
        static public function mdlSugerenciaClientes($tabla,$valor){

            if($valor!=null || $valor!=""){

                $stmt = Conexion::conectar()
                ->prepare("SELECT telefono,nombre FROM $tabla 
                WHERE 
                (telefono!=null OR telefono!='') AND
                (telefono like '$valor%')
                ORDER BY telefono ASC LIMIT 10");

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