<?php

    class Conexion{

        public function conectar(){

            $host = "localhost";
            $base = "tiendaimt";
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

            return $link;

        }

    }