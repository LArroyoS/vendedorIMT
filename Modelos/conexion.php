<?php

    class Conexion{

        public function conectar(){

            $host = "localhost";
            $base = "vendedorIMT";
            $usuario = "root";
            $clave = "";
            $script = array( 
                PDO::ATTR_PERSISTENT => true, 
                PDO::ATTR_EMULATE_PREPARES => false, 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");

            try{

                $link = new PDO(
                    /* host               nombre base de datos  */
                    "mysql:host=$host;dbname=$base;",
                    /* usuario */
                    $usuario,
                    /* contaseña */
                    $clave,
                    /* Establece que nos traiga escritura latina sin problemas */
                    $script
                );

                $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }
            catch(Exception $e){

                $link = false;

            }

            return $link;

        }

        public function iniciarTransaccion($link){

            $link->beginTransaction();

        }

        public function commit($link){

            $link->commit();

        }

        public function rollBack($link){

            $link->rollBack();

        }

    }