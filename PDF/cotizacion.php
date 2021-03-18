<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Verificar</title>
        <link href="http://fonts.cdnfonts.com/css/aristotelica-display-trial" rel="stylesheet">
        <style>

            .fondoNegro{

                background: #000000;

            }

            .hoja{

                background: #ffffff;
                width: 22cm;
                height: 28cm;

            }

            .fondoCabecera{

                padding: 0px;
                margin: 0px;
                width: 100%;
                height: 3.82cm;
                background-color: #0C3443;

            }

            .triangulo {

                position: relative;
                width: 0;
                height: 0;
                border-right: 1.91cm solid #FFBD3B;
                border-top: 1.91cm solid #FFBD3B;
                border-left: 1.91cm solid transparent;
                border-bottom: 1.91cm solid transparent;
                top: -3.82cm;
                left: 18.2cm;
                z-index: 2;

            }

            .contenedor{

                display: grid;
                grid-template-columns: 24% 74%;
                margin: 10%;
                grid-gap: 10px;
                padding-top: 16px;
                padding-bottom: 16px;

            }

            .contenedor > div {

                text-align: center;
                font-size: 30px;
                text-align: center;

            }

            .refaccionaria{

                font-style: normal; 
                font-variant: normal; 
                font-weight: 700; 
                line-height: 36px;
                font-size: 36px;
                color: #FFBD3B;

            }

            .cotizacion{

                font-style: normal; 
                font-variant: normal; 
                font-weight: 700; 
                line-height: 26.4px;
                color: #FFFFFF;

            }

            img.logo{

                width: 100%;
                padding: 0px;
                margin: 0px;

            }

            .centrarVerticalmente{

                padding-top: 30px;

            }

        </style>

    </head>

    <body class="fondoNegro">

        <div class="hoja">

            <div class="fondoCabecera">

                <div class="contenedor">

                    <div class="columna">

                        <img src="http://localhost/adminIMT/Vistas/img/plantilla/logo.png" alt="IMT Logo"
                            class="logo brand-image img-circle elevation-3">

                    </div>

                    <div class="columna">

                        <div class="centrarVerticalmente">
                            <span class="refaccionaria">REFACCIONARIA</span>
                            <br>
                            <span class="cotizacion">COTIZACIÓN</span>
                        </div>

                    </div>

                </div>

            </div>
            <div class="triangulo">
            </div>

        </div>

    </body>

</html>