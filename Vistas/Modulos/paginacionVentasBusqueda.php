<?php 

    /*==============================================
    LLAMADO A CATEGORIAS, SUBCATEGORIAS Y DESTACADOS
    ===============================================-*/

    //var_dump(count($listaCotizacion));
    if( $listaCotizacion!=null && count($listaCotizacion)!=0):

?>

    <?php 

        $pagCotizacion = ceil(count($listaCotizacion)/$tope);
        //var_dump($pagCotizacion);
        //var_dump($rutas);

    ?>

    <?php if($pagCotizacion>4): ?>

        <?php 

            /*==============================================
            Primera pagina
            ===============================================-*/
            if($rutas[1]==1):

        ?>

            <ul class="pagination mx-auto">

                <?php for($i=1; $i<= 4; $i++): ?>

                    <li id="item<?php echo htmlspecialchars($i); ?>" 
                        class="page-item">

                        <a class="page-link" 
                            href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($i); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                            <?php echo htmlspecialchars($i); ?>

                        </a>

                    </li>

                <?php endfor; ?>

                <li class="page-item disabled">

                    <a class="page-link">...</a>

                </li>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($pagCotizacion); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <?php echo htmlspecialchars($pagCotizacion); ?>

                    </a>

                </li>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/2/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <i class="fa fa-angle-right" aria-hidden="true"></i>

                    </a>

                </li>

            </ul>

        <?php 

            /*==============================================
            Ultima pagina
            ===============================================-*/
            elseif($rutas[1]==$pagCotizacion):

        ?>

            <ul class="pagination">

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($pagCotizacion-1); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <i class="fa fa-angle-left" aria-hidden="true"></i>

                    </a>

                </li>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/1/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        1

                    </a>

                </li>

                <li class="page-item disabled">

                    <a class="page-link">...</a>

                </li>

                <?php for($i = ($pagCotizacion-3); $i<= $pagCotizacion; $i++): ?>

                    <li id="item<?php echo htmlspecialchars($i); ?>" 
                        class="page-item">

                        <a class="page-link" 
                            href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($i); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                            <?php echo htmlspecialchars($i); ?>

                        </a>

                    </li>

                <?php endfor; ?>

            </ul>

        <?php 

            /*==============================================
            Mitad hacia abajo
            ===============================================-*/
            elseif($rutas[1] != $pagCotizacion &&
                $rutas[1] != 1 &&
                $rutas[1] < $pagCotizacion/2 &&
                $rutas[1] < $pagCotizacion-3):

        ?>

            <?php $numPagActual = $rutas[1] ?>

            <ul class="pagination mx-auto">

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($numPagActual-1); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <i class="fa fa-angle-left" aria-hidden="true"></i>

                    </a>

                </li>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/1/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        1

                    </a>

                </li>

                <li class="page-item disabled">

                    <a class="page-link">...</a>

                </li>

                <?php for($i = ($numPagActual); $i <= ($numPagActual+3); $i++): ?>

                    <li id="item<?php echo htmlspecialchars($i); ?>" 
                        class="page-item">

                        <a class="page-link" 
                            href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($i); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                            <?php echo htmlspecialchars($i); ?>

                    </a>

                    </li>

                <?php endfor; ?>

                <li class="page-item disabled"><a class="page-link">...</a></li>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($pagCotizacion); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <?php echo htmlspecialchars($pagCotizacion); ?>

                    </a>

                </li>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($numPagActual+1); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <i class="fa fa-angle-right" aria-hidden="true"></i>

                    </a>

                </li>

            </ul>

        <?php

            /*==============================================
            Mitad hacia arriba
            ===============================================-*/
            elseif($rutas[1] != $pagCotizacion &&
                $rutas[1] != 1 &&
                $rutas[1] >= $pagCotizacion/2 &&
                $rutas[1] < $pagCotizacion-3):

        ?>

            <?php $numPagActual = $rutas[1]; ?>

            <ul class="pagination mx-auto">

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($numPagActual-1); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <i class="fa fa-angle-left" aria-hidden="true"></i>

                    </a>

                </li>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/1/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        1

                    </a>

                </li>

                <li class="page-item disabled">

                    <a class="page-link">...</a>

                </li>

                <?php for($i = ($numPagActual); $i <= ($numPagActual+3); $i++): ?>

                    <li id="item<?php echo htmlspecialchars($i); ?>" 
                        class="page-item">

                        <a class="page-link" 
                            href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($i); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                            <?php echo htmlspecialchars($i); ?>

                        </a>

                    </li>

                <?php endfor; ?> 

                <li class="page-item disabled">

                    <a class="page-link">...</a>

                </li>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($pagCotizacion); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <?php echo htmlspecialchars($pagCotizacion); ?>

                    </a>

                </li>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($numPagActual+1); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <i class="fa fa-angle-right" aria-hidden="true"></i>

                    </a>

                </li>

            </ul>

        <?php 

            /*==============================================
            ultimas 4 paginas
            ===============================================-*/
            else:

        ?>

            <?php $numPagActual = $rutas[1]; ?>

            <ul class="pagination mx-auto">

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($numPagActual-1); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <i class="fa fa-angle-left" aria-hidden="true"></i>

                    </a>

                </li>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/1/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        1

                    </a>

                </li>

                <li class="page-item disabled">

                    <a class="page-link">...</a>

                </li> 

                <?php for($i = ($pagCotizacion-3); $i <= ($pagCotizacion); $i++): ?>

                    <li id="item<?php echo htmlspecialchars($i); ?>" 
                        class="page-item">

                        <a class="page-link" 
                            href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($i); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                            <?php echo htmlspecialchars($i); ?>

                        </a>

                    </li> 

                <?php endfor; ?>

                <li class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($numPagActual+1); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <i class="fa fa-angle-right" aria-hidden="true"></i>

                    </a>

                </li> 

            </ul>

        <?php endif; ?>

    <?php else: ?>

        <ul class="pagination mx-auto"> 

            <?php for($i=1; $i<= $pagCotizacion; $i++): ?>

                <li id="item<?php echo htmlspecialchars($i); ?>" 
                    class="page-item">

                    <a class="page-link" 
                        href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/<?php echo htmlspecialchars($i); ?>/<?php echo $orden; ?>/<?php echo htmlspecialchars($rutas[3]); ?>">

                        <?php echo htmlspecialchars($i); ?>

                    </a>

                </li>

            <?php endfor; ?>

        </ul>

    <?php endif; ?>

<?php endif; ?>