<?php 

    require_once '../Controladores/usuarios.controlador.php';
    require_once '../Modelos/conexion.php';
    require_once '../Modelos/usuarios.modelo.php';

    class AjaxUsuarios{

        /*===========================================================
        VALIDAR EMAIL EXISTENTE
        ============================================================*/
        public $validarEmail;

        public function ajaxValidarEmail(){

            $datos = $this->validarEmail;
            $respuesta = ControladorUsuarios::ctrMostrarUsuario("email",$datos);

            echo json_encode($respuesta);

        }

    }

    /*===========================================================
    VALIDAR EMAIL EXISTENTE
    ============================================================*/
    if(isset($_POST["email"])){

        $regFacebook = new AjaxUsuarios();
        $regFacebook->email = $_POST["email"];
        $regFacebook->nombre = $_POST["nombre"];
        $regFacebook->foto = $_POST["foto"];
        $regFacebook->ajaxRegistroFacebook();

    }