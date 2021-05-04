<?php

    $urlVendedor = Ruta::ctrRuta();
    $urlServidor = Ruta::ctrRutaServidor();

    $folio = $rutas[1];
    if($folio!=""){

        $item = 'id';
        $valor = $folio;
        $resultado = ControladorCotizacion::ctrInfoCotizacion($item,$valor);
        if($resultado){

            $itemVendedor = 'id';
            $valorVendedor = $resultado['vendedor_id'];
            $vendedor = ControladorUsuarios::ctrMostrarUsuario($itemVendedor,$valorVendedor);

            $ordenarDC = "id";
            $itemDC = 'cotizacion_id';
            $valorDC = $folio;
            $detallesCotizacion = ControladorCotizacion::ctrListarDetalleCotizacion($ordenarDC,$itemDC,$valorDC);

            if($vendedor && $detallesCotizacion){

                $resultado['id_vendedor'] = $vendedor['nombre'];
                $detalle = array();
                foreach($detallesCotizacion as $key => $productos){

                    $itemProducto = "id";
                    $valorProducto = $productos['producto_id'];
                    $producto = ControladorProductos::ctrMostrarInfoProducto($itemProducto,$valorProducto);

                    $itemMarca = "id";
                    $valorMarca = isset($producto['id_marca'])? $producto['id_marca']:null;
                    $marca = ControladorProductos::ctrMostrarInfoMarca($itemMarca,$valorMarca);

                    $productos['producto_id'] = isset($producto['SKU'])? $producto['SKU']: 'Desconocido';
                    $productos['producto_nombre'] = $producto['titulo'];
                    $productos['id_marca'] = isset($marca['marca'])? $marca['marca']: 'Desconocida';

                    $detalle[] = $productos;

                }

                $resultado['detalle'] = $detalle;

            }

        }

    }

?>

<?php if($resultado && isset($resultado['id'])): ?>

    <div id="envio" class="row">

        <div class="col-md-8">
            <div class="card border border-dark">

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0 pt-3">
                    <table class="table table-hover" id="cotizacion">
                        <thead>

                            <tr>
                                <th>SKU</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(!empty($resultado['detalle'])): ?>

                                <?php foreach($resultado['detalle'] as $key => $value): ?>

                                    <?php 

                                        $precio = ($value['descuentoOferta']>0)? $value['precioDescuento'] : $value['precio_unitario'];
                                        $importe = $precio*$value['cantidad'];

                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo htmlspecialchars($value['producto_id']); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($value['producto_nombre']); ?>
                                        </td>
                                        <td>
                                            $ <?php echo htmlspecialchars(number_format($precio, 2)); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($value['cantidad']); ?>
                                        </td>
                                        <td>
                                            $ <?php echo htmlspecialchars(number_format($importe, 2)); ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>
                                <tr id="nulo">
                                    <td colspan="7" class="text-center">
                                        No existen productos registrados en este momento
                                    </td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>

            <div class="card border border-dark">

                <div class="card-header">

                    <h4>Datos Cliente</h4>

                </div>

                <div class="card-body table-responsive p-0 pt-3">

                    <div class="form-group col-12">
                        <label for="cliente">Cliente</label>
                        <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nombre Cliente"
                            value="<?php echo htmlspecialchars($resultado['nombre_cliente']); ?>" minxlength="2" maxlength='40' readonly>
                    </div>

                    <div class="form-group col-12">
                        <label for="direccion">Dirección</label>
                        <textarea name="direccion" id="direccion" class="form-control" placeholder="Direccicon" rows="2"
                            minlength="40" maxlength="200" style="resize: none;" readonly><?php echo htmlspecialchars($resultado['direccion_cliente']); ?>

                        </textarea>

                    </div>

                    <div class="form-group col-12">
                        <label for="tel">Teléfono</label>
                        <input type="tel" class="form-control" name="tel" id="tel" maxlength="10" placeholder="Telefono"
                        value="<?php echo htmlspecialchars($resultado['telefono']); ?>" pattern="[0-9]{10}" title="ejemplo: 0000000000" readonly>
                    </div>

                </div>

            </div>

            <!-- this row will not appear when printing -->
            <div class="row no-print pb-3">
                <div class="col-12">
                    <button id="btnCompra" type="button" class="btn btn-success float-right mx-2"
                        style="margin-right: 5px;" <?php echo ($resultado['estado']>0)? 'disabled':''; ?> >
                        <i class="fas fa-check"></i>
                        <span>Confirmar Compra</span>
                    </button>
                    <button id="btnPDF" type="button" class="btn btn-outline-dark float-right mx-2"
                        style="margin-right: 5px;" <?php echo (empty($resultado['detalle']))? 'disabled':''; ?> >
                        <i class="fas fa-money-check-alt"></i>
                        <span>Ver PDF</span>
                    </button>
                </div>
            </div>

        </div>

        <!-- /.col -->
        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user shadow border border-success">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="card-header bg-success">
                    <?php 
                        $total = $resultado['subtotal']+$resultado['envio'];
                    ?>
                    <h1 class="text-center">Total: $<span id="TotalCoste"><?php echo htmlspecialchars(number_format($total, 2)); ?></span> </h1>
                </div>
                <div class="card-footer p-3 bg-gris">

                    <div class="row">

                        <div class="form-group col-12">

                            <label for="folio">Folio</label>
                            <!-- SEARCH TELEFONO -->
                            <div class="input-group">
                                <input type="text" class="form-control" name="folio" id="folio" placeholder="folio"
                                value="<?php echo htmlspecialchars($resultado['id']); ?>" readonly>
                            </div>

                        </div>

                        <?php 

                            $fecha = strtotime($resultado['fecha']);

                        ?>
                        <div class="form-group col-12">
                            <label for="fechaVenta">Fecha de Venta </label>
                            <input type="date" class="form-control" name="fechaVenta" id="fechaVenta"
                            value="<?php echo htmlspecialchars(date('Y-m-d',$fecha)); ?>" placeholder="Fecha de Venta" readonly>
                        </div>

                        <div class="form-group col-12">
                            <label for="vendedor">Vendedor</label>
                            <input type="text" class="form-control" name="vendedor" id="vendedor"
                            value="<?php echo htmlspecialchars($resultado['vendedor_id']); ?>" placeholder="Vendedor" readonly>
                        </div>

                        <div class="form-group col-12">
                            <label for="estado">Estado</label>
                            <input type="text" class="form-control" name="estado" id="estado"
                            value="<?php echo ($resultado['estado']>0)? 'PAGADO':'SIN PAGAR'; ?>"placeholder="Estado" readonly>
                        </div>

                    </div>
                    <hr>
                    <div>

                        <div class="table-responsive">
                            <table class="table" id="coste">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>$ <?php echo htmlspecialchars(number_format($resultado['subtotal'], 2)); ?></td>
                                </tr>
                                <tr>
                                    <th>Envio: </th>
                                    <td>$ <?php echo htmlspecialchars(number_format($resultado['envio'], 2)); ?></td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>$ 
                                        <?php
                                            echo htmlspecialchars(number_format($total, 2)); 
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>

    </div>
    <button id="modalPdf" type="button" style="display:none" class="btn btn-primary" data-toggle="modal" data-target="#pdf">Large
        modal
    </button>

    <div class="modal modal-tall fade" id="pdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-xl">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Folio: <?php echo htmlspecialchars($resultado['id']); ?> <span></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <object id="areaPdf" name="areaPdf" width="100%" height="100%" data="" type="application/pdf">

                        <embed width="100%" height="100%"  src="" type="application/pdf"></embed>

                    </object>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>

            </div>

        </div>

    </div>

<?php else: ?>

    <?php 
        echo 
            '<script>

                window.location = "'.$urlVendedor.'error";

            </script>';
    ?>

<?php endif; ?>