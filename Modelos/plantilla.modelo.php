<?php 

    require_once "conexion.php";

    class ModeloPlantilla{

        /* Se crea un metodo estatico cuando 
        el metodo recibe parametros en su 
        parentesis */
        static public function mdlEstiloPlantilla($tabla){

            $stmt = Conexion::conectar()
                ->prepare("SELECT * FROM $tabla");
            $stmt -> execute();

            return $stmt -> fetch();

            $stmt -> close();

            /* Anular objeto */
            $stmt = null;

        }

    }