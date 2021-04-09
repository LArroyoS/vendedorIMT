<?php

    class Conexion{

        public function conectar(){

            $host = "localhost";
            $base = "vendedorimt";
            $usuario = "root";
            $clave = "";
            $script = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

            $link = new PDO(
            /* host               nombre base de datos  */
            "mysql:host=$host;dbname=$base;",
            /* usuario */
            "root",
            /* contaseña */
            "",
            /* Establece que nos traiga escritura latina sin problemas */
            $script
            );

            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            return $link;

        }

    }

    class Ejemplo{

        /*=====================================================
        RESGISTRO DE Cotizacion
        =====================================================*/
        static public function mdlRegistroEjemplo($tabla,$datos){

            $pdo = Conexion::conectar();
            // begin a transaction
            $pdo->beginTransaction();
            
            $stmt = $pdo->prepare("INSERT INTO $tabla(nombre,apellido)
            VALUE (:nombre, :apellido)");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);

            try{

                if($stmt->execute()){

                    return 'kkkk'/*$pdo->lastInsertId()*/;

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

    $datos = array('nombre' => 'nom','apellido' => 'ape');
    $tabla = 'prueba';

    echo Ejemplo::mdlRegistroEjemplo($tabla,$datos);

