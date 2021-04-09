<form id="envio" class="row" autocomplete="off">

    <div class="col-12 row no-print pb-3">

        <div class="col-12">
            <button id="btnNV" type="reset" class="btn btn-primary btn-block">
                <i class="fas fa-plus-circle"></i>
                <span>Nueva Venta</span>
            </button>

        </div>

    </div>

    <div class="col-md-8">

        <div class="card border border-dark">
            <div class="card-header">

                <!-- SEARCH FORM -->
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="text" placeholder="Buscar producto"
                        aria-label="Search" id="txtBuscarProd" list="sugerencias">
                    <!--=========================================================================
                    SUGERENCIA
                    ===========================================================================-->
                    <datalist id="sugerencias">


                    </datalist>

                    <div class="input-group-append">
                        <button type="button" class="btn btn-navbar border border-dark" id="btnBuscarProd">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 pt-3">
                <table class="table table-hover" id="cotizacion">
                    <thead>

                        <tr>
                            <th style="width: 10px"></th>
                            <th width="130">Cantidad</th>
                            <th width="150">SKU</th>
                            <th>Producto</th>
                            <th>Marca</th>
                            <th>Precio</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr id="nulo">
                            <td colspan="7" class="text-center">
                                No existen productos registrados en este momento
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>

        <div class="card border border-dark" id="datosClientes">

            <div class="card-header">

                <div class="row">

                    <h4 class="col-6">
                        Datos Cliente
                    </h4>
                    <!--
                    <div class="col-6">
                        <button id="editar" type="button" class="btn btn-success float-right" style="display:none" disabled>
                            <i class="fas fa-edit"></i>
                            Editar datos
                        </button>
                    </div>
                    -->

                </div>

            </div>

            <div class="card-body table-responsive p-0 pt-3">

                <div class="form-group col-12">
                    <label for="tel">Teléfono</label>
                    <!-- SEARCH TELEFONO -->
                    <div class="input-group">
                        <input type="tel" class="form-control" name="tel" id="tel" maxlength="10" placeholder="Telefono"
                            pattern="[0-9]{10}" title="ejemplo: 0000000000" required list="sugerenciasCliente">
                        <!--=========================================================================
                        SUGERENCIA
                        ===========================================================================-->
                        <datalist id="sugerenciasCliente">


                        </datalist>

                        <div class="input-group-append">
                            <button type="button" class="btn btn-info border border-dark" id="btnBuscarTel">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group col-12">
                    <label for="cliente">Cliente</label>
                    <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nombre Cliente"
                        minxlength="2" maxlength='40' <?php /*required data-readonly oninput="check_text(this);" */ ?> >
                </div>

                <div class="form-group col-12">
                    <label for="direccion">Dirección</label>
                    <textarea name="direccion" id="direccion" class="form-control" placeholder="Direccicon" rows="2"
                        minlength="40" maxlength="200" style="resize: none;" <?php /* required disabled */?> ></textarea>

                </div>

            </div>

        </div>

        <!-- this row will not appear when printing -->
        <div class="row no-print pb-3">
            <div class="col-12">

                <button id="btnPDF" type="button" class="btn btn-outline-dark float-right mx-2"
                    style="margin-right: 5px;" disabled>
                    <i class="fas fa-money-check-alt"></i>
                    <span>Ver PDF</span>
                </button>

                <button id="btnVenta" type="submit" class="btn btn-success margin float-right mx-2"
                    style="margin-right: 5px;" disabled>
                    <i class="fas fa-money-check-alt"></i>
                    <span>Terminar Venta</span>
                </button>

                <button id="btnBorrar" type="button" class="btn btn-danger float-right mx-2">
                    <i class="fas fa-trash-alt"></i>
                    <span>Borrar Productos</span>
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
                <h1 class="text-center">Total: $<span id="TotalCoste">0.00</span> </h1>
            </div>
            <div class="card-footer p-3 bg-gris">

                <div class="row">

                    <div class="form-group col-12">
                        <label for="folio">Folio</label>
                        <input type="text" class="form-control" id="folio" placeholder="folio" value=""
                            readonly <?php /*data-readonly oninput="check_text(this);"*/ ?> >
                    </div>

                    <div class="form-group col-12">
                        <label for="fechaVenta">Fecha de Venta </label>
                        <input type="date" class="form-control" id="fechaVenta" value=""
                            placeholder="Fecha de Venta" readonly>
                    </div>

                    <div class="form-group col-12">
                        <label for="vendedor">Vendedor</label>
                        <h3> 
                            <?php echo $_SESSION['nombre']; ?>
                        </h3>
                        <input type="hidden" class="form-control" name="vendedor" id="vendedor" value="<?php echo $_SESSION['id']; ?>"
                            placeholder="Venderor" readonly>
                    </div>

                </div>
                <hr>
                <div>

                    <div class="table-responsive">
                        <table class="table" id="coste">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <th>Envio: </th>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>$0.00</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>

</form>

<button id="modalPdf" type="button" style="display:none" class="btn btn-primary" data-toggle="modal"
    data-target="#pdf">Large
    modal
</button>

<div class="modal modal-tall fade" id="pdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Folio: <span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <object id="areaPdf" name="areaPdf" width="100%" height="100%" data="" type="application/pdf">

                    <embed width="100%" height="100%" src="" type="application/pdf"></embed>

                </object>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="btnImprimir" type="button" class="btn btn-info">Imprimir</button>
            </div>

        </div>

    </div>

</div>