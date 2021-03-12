<?php 

    $urlServidor = Ruta::ctrRutaServidor();
    $urlTienda = Ruta::ctrRuta();

?>

<!--=============================================
TOP
===============================================-->
<div class="container-fluid barraSuperior" id="top">

    <div class="row">

        <!--======================================
        SOCIAL
        =======================================-->

        <div class="col-gl-9 col-md-9 col-sm-8 col-xs-12 socal">

            <ul>

                Vendedor IMT

            </ul>

        </div>

        <!--======================================
        USUARIO
        =======================================-->

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">

            <ul>

                <li>

                    <img class="rounded-circle" src="<?php echo htmlspecialchars($urlServidor); ?>Vistas\img\usuarios\default\anonymous.png" width="10%">

                </li>

                <li>|</li>
                <li>

                    <a href="<?php echo htmlspecialchars($urlTienda); ?>perfil">Ver Perfil</a>

                </li>
                <li>|</li>
                <li>

                    <a href="<?php echo htmlspecialchars($urlTienda); ?>salir" class="salir<?php echo htmlspecialchars($_SESSION['modo']); ?>">Salir</a>

                </li>

            </ul>

        </div>

    </div>

</div>