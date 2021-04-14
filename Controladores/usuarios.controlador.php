<?php


    class ControladorUsuarios{

        private $anterior = "history.back();";
        private $logo = "https://www.freejpg.com.ar/image-900/70/70d0/F100011941-cultivo_de_soja_en_area_rural.jpg";
        private $iconoMensaje = "https://www.freejpg.com.ar/image-900/3e/3e0c/F100006796-buzon.jpg";
        private $iconoPassword = "https://www.freejpg.com.ar/image-900/3e/3e0c/F100006796-buzon.jpg";

        /*====================================================
        ALERTA
        ====================================================*/

        static private function alerta($titulo,$mensaje,$tipo,$retorno){

            echo 

                '<script>

                    swal(

                        {

                            title: "'.$titulo.'",
                            text: "'.$mensaje.'",
                            type: "'.$tipo.'",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,

                        },
                        function(isConfirm){

                            if(isConfirm){

                                /*Permite regresar a la pagina anterior*/
                                '.$retorno.'

                            }

                        }

                    );

                </script>';

        }

        /*====================================================
        MENSAJE
        =====================================================*/
        static private function mensaje($logo,$titulo,$icono,$contenido,$urlBoton,$textoBoton,$pieDePagina){

            $mensaje = '

                <div style="width:100%; background: #eee; position: relative; font-family:sans-serif; padding-bottom: 40px;">

                    <center>

                        <img style="padding: 20px; width: 10%;" 
                            src="'.$logo.'" 
                            alt="">

                    </center>

                    <div style="position: relative; margin: auto; width: 600px;
                        background: white; padding: 20px;">

                        <center>

                            <img style="padding: 20px; width: 15%;" 
                                src="'.$icono.'" 
                                alt="">

                            <h3 style="font-weight: 100; color: #999">

                                '.$titulo.'

                            </h3>

                            <hr style="border: 1px solid #ccc; width: 80%;">

                            <h4 style="font-weight: 100; color: #999; padding: 0 20px;">

                                '.$contenido.'

                            </h4>

                            <a href="'.$urlBoton.'" target="_blank" 
                                style="text-decoration: none;">

                                <div style="line-height: 60px; background: #0aa; width: 60%; color: white;">

                                    '.$textoBoton.'

                                </div>

                            </a>

                            <br>

                            <hr style="border: 1px solid #ccc; width: 80%;">

                            <h5 style="font-weight: 100; color: #999;">

                                '.$pieDePagina.'

                            </h5>

                        </center>

                    </div>

                </div>';

            return $mensaje;

        }

        /*====================================================
        REGISTRO USUARIO
        ====================================================*/
        public function ctrRegistroUsuario(){

            if(isset($_POST["regUsuario"])){

                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){

                    $url = Ruta::ctrRuta();

                    $encriptar = crypt($_POST["regPassword"], '$*/&wy$alvn01qlaxgt44ty00a1g6qJABGfHjjYAGaev$');
                    $encriptarEmail = md5($_POST["regEmail"]);

                    $datos = array(
                                "nombre" => $_POST["regUsuario"],
                                "password" => $encriptar,
                                "email" => $_POST["regEmail"],
                                "foto" => "",
                                "verificacion" => 1,
                                "emailEncriptado" => $encriptarEmail
                            );

                    $tabla = "usuarios";

                    $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla,$datos);

                    if($respuesta == "ok"){


                        /*==========================================================
                        VERIFICACION DE CORREO ELECTRONICO
                        ===========================================================*/

                        date_default_timezone_set("America/Mexico_City");

                        $mail = new PHPMailer;
                        $mail->CharSet = 'UTF-8';
                        $mail->setFrom('lguay7522@gmail.com', 'Refaccionaria IMT');
                        $mail->addAddress($_POST['regEmail'],'Usuario');
                        $mail->Subject = "Por Favor Verifique su Correo Electronico";

                        $titulo = "VERIFIQUE SU CORREO ELECTRÓNICO";
                        $icono = $this->iconoMensaje;
                        $contenido = "Para comenzar a usar su cuenta de la Tienda Virtual, debe confirmar su correo electrónico";
                        $urlBoton = $url.'verificar/'.$encriptarEmail;
                        $textoBoton = "Verifique su correo electrónico";
                        $pie = "Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminara";

                        $mail->msgHTML(

                            $this->mensaje($this->logo,$titulo,$icono,$contenido,$urlBoton,$textoBoton,$pie)

                        );

                        $envio = $mail->send();

                        if(!$envio){

                            $titulo = "¡ERROR!";
                            $mensaje = '¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST['regEmail'].' '.$mail->ErrorInfo.'!';
                            $tipo = "error";
                            $retorno = $this->anterior;
                            $this->alerta($titulo,$mensaje,$tipo,$retorno);

                        }
                        else{

                            $titulo = "¡OK!";
                            $mensaje = 'Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electronico '.$_POST["regEmail"].'para verificar su cuenta';
                            $tipo = "success";
                            $retorno = $this->anterior;
                            $this->alerta($titulo,$mensaje,$tipo,$retorno);

                        }

                    }
                    else{

                        $titulo = "¡ERROR!";
                        $mensaje = 'Ocurrio un error, intentelo mas tarde';
                        $tipo = "error";
                        $retorno = $this->anterior;
                        $this->alerta($titulo,$mensaje,$tipo,$retorno);

                    }

                }
                else{

                    $titulo = "¡ERROR!";
                    $mensaje = 'Al registrar el usuario, no se permiten caracteres especiales';
                    $tipo = "error";
                    $retorno = $this->anterior;
                    $this->alerta($titulo,$mensaje,$tipo,$retorno);

                }

            }

        }

        /*====================================================
        MOSTRAR USUARIO
        ====================================================*/
        static public function ctrMostrarUsuario($item,$valor){

            $tabla = "usuarios";
            $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla,$item,$valor);

            return $respuesta;

        }

        /*====================================================
        ACTUALIZAR USUARIO
        ====================================================*/
        static public function ctrActualizarUsuario($id, $item,$valor){

            $tabla = "usuarios";
            $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla,$id,$item,$valor);

            return $respuesta;

        }

        /*====================================================
        INGRESO USUARIO
        ====================================================*/
        public function ctrIngresoUsuario(){

            if(isset($_POST["ingEmail"])){

                if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

                    $encriptar = crypt($_POST["ingPassword"], '$*/&wy$alvn01qlaxgt44ty00a1g6qJABGfHjjYAGaev$');

                    $tabla = "usuarios";
                    $item = "email";
                    $valor = $_POST["ingEmail"];

                    $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla,$item,$valor);

                    if($respuesta && $respuesta["email"] == $_POST['ingEmail'] &&
                        $respuesta['password'] == $encriptar ){

                        if($respuesta["verificacion"]==1){

                            $titulo = "!NO HA VERIFICADO SU CORREO ELECTRÓNICO¡";
                            $mensaje = 'Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electronico '.$respuesta['email'].'para verificar su cuenta';
                            $tipo = "error";
                            $retorno = $this->anterior;
                            $this->alerta($titulo,$mensaje,$tipo,$retorno);

                        }
                        else{

                            $_SESSION["validarSesion"] = "ok";
                            $_SESSION["id"] = $respuesta['id'];
                            $_SESSION["nombre"] = $respuesta['nombre'];
                            $_SESSION["foto"] = $respuesta['foto'];
                            $_SESSION["email"] = $respuesta['email'];
                            $_SESSION["password"] = $respuesta['password'];

                            //Redireccionar a al pagina donde se encuentra actualmente
                            echo 
                            '<script>

                                window.location = localStorage.getItem("rutaActual");

                            </script>';

                        }

                    }
                    else{

                        echo 'usuario no existe';
                        $titulo = "!ERROR AL INGRESAR¡";
                        $mensaje = '¡Por favor revise que el usuario exista y que la contraseña sea correcta!';
                        $tipo = "error";
                        $retorno = $this->anterior;
                        $this->alerta($titulo,$mensaje,$tipo,$retorno);

                    }

                }
                else{

                    $titulo = "!ERROR AL INGRESAR¡";
                    $mensaje = 'Al ingresar al sistema, no se permiten caracteres especiales';
                    $tipo = "error";
                    $retorno = $this->anterior;
                    $this->alerta($titulo,$mensaje,$tipo,$retorno);

                }

            }

        }

        /*====================================================
        OLVIDAR CONTRASEÑA USUARIO
        ====================================================*/
        public function ctrOlvidoPassword(){

            
            if(isset($_POST["passEmail"])){

                if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])){

                    $url = Ruta::ctrRuta();

                    /*====================================================
                    GENERAR CONTRASEÑA ALEATORIA
                    ====================================================*/

                    function generarPassword($longitud){

                        $key = "";
                        $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $max = strlen($pattern)-1;
                        for($i=0;$i<$longitud;$i++){

                            $key .= $pattern{mt_rand(0,$max)};

                        }

                        return $key;

                    }

                    $nuevaPassword = generarPassword(11);
                    $encriptar = crypt($nuevaPassword,'$*/&wy$alvn01qlaxgt44ty00a1g6qJABGfHjjYAGaev$');

                    $tabla = "usuarios";

                    $item1 = "email";
                    $valor1 = $_POST["passEmail"];
                    $respuesta1 = ModeloUsuarios::mdlMostrarUsuario($tabla,$item1,$valor1);

                    if($respuesta1){

                        $id = $respuesta1['id'];
                        $item2 = "password";
                        $valor2 = $encriptar;

                        $respuesta2 = ModeloUsuarios::mdlActualizarUsuario($tabla,$id,$item2,$valor2);
                        if($respuesta2 == 'ok'){

                            /*==========================================================
                            CAMBIO DE CONTRASEÑA
                            ===========================================================*/

                            date_default_timezone_set("America/Mexico_City");

                            $mail = new PHPMailer;
                            $mail->CharSet = 'UTF-8';
                            $mail->setFrom('lguay7522@gmail.com', 'Refaccionaria IMT');
                            $mail->addAddress($_POST['passEmail'],'Usuario');
                            $mail->Subject = "Solicitud de nueva contraseña";

                            $titulo = "SOLICITUD DE NUEVA CONTRASEÑA";
                            $icono = $this->iconoMensaje;
                            $contenido = "<strong>Su Nueva Contraseña: </strong>".$nuevaPassword;
                            $urlBoton = $url;
                            $textoBoton = "Ingrese nuevamente al sitio";
                            $pie = "Si no realizo esta accion, favor de comunicarse con nosotros";

                            $mail->msgHTML(

                                $this->mensaje($this->logo,$titulo,$icono,$contenido,$urlBoton,$textoBoton,$pie)

                            );

                            $envio = $mail->send();

                            if(!$envio){

                                $titulo = "!ERROR¡";
                                $mensaje = '¡Ha ocurrido un problema enviando cambio de contraseña a '.$_POST['passEmail'].' '.$mail->ErrorInfo.'!';
                                $tipo = "error";
                                $retorno = $this->anterior;
                                $this->alerta($titulo,$mensaje,$tipo,$retorno);

                            }
                            else{

                                $titulo = "!OK¡";
                                $mensaje = 'Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electronico '.$_POST["passEmail"].'su cambio de conraseña';
                                $tipo = "success";
                                $retorno = $this->anterior;
                                $this->alerta($titulo,$mensaje,$tipo,$retorno);

                            }

                        }
                        else{

                            $titulo = "!ERROR¡";
                            $mensaje = 'Ha ocurrido un problema, intentelo mas tarde'.$respuesta2;
                            $tipo = "error";
                            $retorno = $this->anterior;
                            $this->alerta($titulo,$mensaje,$tipo,$retorno);

                        }

                    }
                    else{

                        $titulo = "!ERROR¡";
                        $mensaje = 'El correo electronico no existe en el sistema';
                        $tipo = "error";
                        $retorno = $this->anterior;
                        $this->alerta($titulo,$mensaje,$tipo,$retorno);

                    }

                    //var_dump($nuevaPassword);

                }
                else{

                    $titulo = "!ERROR¡";
                    $mensaje = 'El correo electronico pudo ser enviado, puede que este mal escrito';
                    $tipo = "error";
                    $retorno = $this->anterior;
                    $this->alerta($titulo,$mensaje,$tipo,$retorno);

                }

            }

        }

    }