<?php 

    $urlVendedor = Ruta::ctrRuta();
    $urlServidor = Ruta::ctrRutaServidor();

    $tope = 12;

    $cotizacion = null;
    $listaCotizacion = null;
    $ordenar = "id";
    $orden = "recientes";
    $modo = "DESC";

    if(isset($rutas[1])){

        $base = (($rutas[1])-1)*$tope;

        if(isset($rutas[2])){

            $orden = $rutas[2];
            if($rutas[2] == 'antiguos'){

                $modo = "ASC";

            }
            else{

                $orden = "recientes";
                $modo = "DESC";

            }

        }

    }
    else{

        $rutas[1] = 1;
        $base = 0;

    }

    $cotizacion = null;
    $listaCotizacion = null;
    $ordenar = "id";

    $busqueda = $rutas[3] = (isset($rutas[3])? $rutas[3]:'');

    $cotizacion = ControladorCotizacion::ctrBuscarCotizacion($busqueda,$base,$tope,$ordenar, $modo);
    $listaCotizacion = ControladorCotizacion::ctrListarCotizacionBusqueda($busqueda);

?>

<div class="col-12">

    <div class="card">
        <div class="card-header">
            <div class="btn-group">

                <button type="button" 
                    class="btn btn-outline-secondary dropdown-toggle"
                    data-toggle="dropdown">

                    Ordenar Productos <span class="caret"></span>

                </button>

                <ul class="dropdown-menu" role="menu">

                    <li><a href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/1/recientes/<?php echo htmlspecialchars($rutas[3]); ?>">Más Reciente</a></li>
                    <li><a href="<?php echo htmlspecialchars($urlVendedor.$rutas[0]); ?>/1/antiguos/<?php echo htmlspecialchars($rutas[3]); ?>">Más Antiguo</a></li>

                </ul>

            </div>
            <div class="card-tools" id="buscador">
                <div class="input-group input-group-sm" style="width: 150px;">

                    <input type="text" name="buscar" class="form-control float-right" placeholder="Buscar">

                    <a class="input-group-append" href="<?php echo $urlVendedor; ?>ventas/1/recientes">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </a>

                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Cliente</th>
                        <th>Telefono</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Fecha y hora</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!$cotizacion): ?>

                        <tr>

                            <td colspan="7">Aún no hay ventas</td>

                        </tr>

                    <?php else: ?>

                        <?php foreach($cotizacion as $key => $value): ?>

                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($value['id']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($value['nombre_cliente']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($value['telefono']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($value['subtotal']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($value['estado']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($value['fecha']); ?>
                                </td>
                                <td>

                                    <a href="<?php echo htmlspecialchars($urlVendedor); ?>detalle_folio/<?php echo htmlspecialchars($value['id']); ?>" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer ">

            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">

                        <?php 
                            $basePag = $base+1; 
                            $numregistros = count($listaCotizacion);
                            $topePag = $base+(($numregistros<$tope)? $numregistros: $tope);
                        ?>
                        <?php echo 'Mostrando '.$basePag.' a '.$topePag.' de '.$numregistros.' registros'; ?>

                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="float-right">
                        <?php include 'paginacionVentasBusqueda.php'; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- /.card -->
</div>