<?php 

    require_once "conexion.php";

    class ModeloPlantilla{

        /* Se crea un metodo estatico cuando 
        el metodo recibe parametros en su 
        parentesis */
        static public function mdlEstiloPlantilla($tabla){

            $stmt = Conexion::conectar()
                ->prepare("SELECT * FROM $tabla");

            try{
                $stmt -> execute();
                return $stmt -> fetch();

            }
            catch(PDOException $e){

                return false;

            }
            $stmt -> close();

            /* Anular objeto */
            $stmt = null;

        }

    }