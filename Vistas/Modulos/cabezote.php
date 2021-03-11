<?php 

    $urlServidor = Ruta::ctrRutaServidor();
    $urlTienda = Ruta::ctrRuta();

?>

<!--=============================================
TOP
===============================================-->
<div class="container-fluid barraSuperior" id="top">

    <div class="container">

        <div class="row">

            <!--======================================
            SOCIAL
            =======================================-->

            <div class="col-gl-9 col-md-9 col-sm-8 col-xs-12 socal">

                <ul>

                    <?php 

                        $social = ControladorPlantilla::ctrEstiloPlantilla();
                        $jsonRedesSociales = json_decode($social['redesSociales'],true);

                    ?>

                    <?php foreach($jsonRedesSociales as $key => $value): ?>

                        <li>

                            <a href="<?php echo htmlspecialchars($value['url']); ?>" 
                            target="_blank">

                                <i class="fab
                                    <?php echo htmlspecialchars($value['red']); ?> 
                                    redSocial 
                                    <?php echo htmlspecialchars($value['estilo']); ?>" 
                                    arial-hidden="true">
                                </i>

                            </a>

                        </li>

                    <?php endforeach; ?>

                </ul>

            </div>

            <!--======================================
            REGISTRO
            =======================================-->

            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">

                <ul>

                    <?php if(isset($_SESSION['validarSesion']) && $_SESSION['validarSesion'] == 'ok'): ?>

                        <?php if($_SESSION['modo'] == 'DIRECTO'): ?>

                            <?php if($_SESSION['foto'] != ''): ?>

                                <li>

                                    <img class="rounded-circle" src="<?php echo htmlspecialchars($urlServidor.$_SESSION['foto']); ?>" width="10%">

                                </li>

                            <?php else: ?>

                                <li>

                                    <img class="rounded-circle" src="<?php echo htmlspecialchars($urlServidor); ?>Vistas\img\usuarios\default\anonymous.png" width="10%">

                                </li>

                            <?php endif; ?>

                        <?php else: ?>

                            <li>

                                <img class="rounded-circle" src="<?php echo htmlspecialchars($_SESSION['foto']); ?>" width="10%">

                            </li>

                        <?php endif; ?>

                        <li>|</li>
                        <li>

                            <a href="<?php echo htmlspecialchars($urlTienda); ?>perfil">Ver Perfil</a>

                        </li>
                        <li>|</li>
                        <li>

                            <a href="<?php echo htmlspecialchars($urlTienda); ?>salir" class="salir<?php echo htmlspecialchars($_SESSION['modo']); ?>">Salir</a>

                        </li>

                    <?php else: ?>

                        <li>

                            <a href="#modalIngreso" data-toggle="modal" data-target="#Ingresar">Ingresar</a>

                        </li>

                        <li>|</li>

                        <li>

                            <a href="#modalRegistro" data-toggle="modal" data-target="#Registro">Crear una cuenta</a>

                        </li>

                    <?php endif; ?>

                </ul>

            </div>

        </div>

    </div>

</div>