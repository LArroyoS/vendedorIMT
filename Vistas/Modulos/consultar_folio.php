<form id="envio" class="row" autocomplete="off">

    <div class="col-12 row no-print pb-3">

        <div class="col-12">
            <button id="btnNV" type="reset" class="btn btn-primary btn-block">
                <i class="fas fa-redo"></i>
                <span>Limpiar Cotización</span>
            </button>

        </div>

    </div>

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

        <div class="card border border-dark">

            <div class="card-header">

                <h4>Datos Cliente</h4>

            </div>

            <div class="card-body table-responsive p-0 pt-3">

                <div class="form-group col-12">
                    <label for="cliente">Cliente</label>
                    <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nombre Cliente"
                        minxlength="2" maxlength='40' readonly>
                </div>

                <div class="form-group col-12">
                    <label for="direccion">Dirección</label>
                    <textarea name="direccion" id="direccion" class="form-control" placeholder="Direccicon" rows="2"
                        minlength="40" maxlength="200" style="resize: none;" readonly></textarea>

                </div>

                <div class="form-group col-12">
                    <label for="tel">Teléfono</label>
                    <input type="tel" class="form-control" name="tel" id="tel" maxlength="10" placeholder="Telefono"
                        pattern="[0-9]{10}" title="ejemplo: 0000000000" readonly>
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
            </div>
        </div>

    </div>

    <!-- /.col -->
    <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user shadow border border-success">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="card-header bg-success">
                <h1 class="text-center">Total: $0.00<span id="TotalCoste"></span> </h1>
            </div>
            <div class="card-footer p-3 bg-gris">

                <div class="row">

                    <div class="form-group col-12">

                        <label for="folio">Folio</label>
                        <!-- SEARCH TELEFONO -->
                        <div class="input-group">
                            <input type="text" class="form-control" name="folio" id="folio" placeholder="folio"
                            list="sugerenciasFolios">
                            <!--=========================================================================
                            SUGERENCIA
                            ===========================================================================-->
                            <datalist id="sugerenciasFolios">


                            </datalist>

                            <div class="input-group-append">
                                <button type="button" class="btn btn-info border border-dark" id="btnBuscarFolio">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="form-group col-12">
                        <label for="fechaVenta">Fecha de Venta </label>
                        <input type="date" class="form-control" name="fechaVenta" id="fechaVenta" value=""
                            placeholder="Fecha de Venta" readonly>
                    </div>

                    <div class="form-group col-12">
                        <label for="vendedor">Vendedor</label>
                        <input type="text" class="form-control" name="vendedor" id="vendedor" value="Vendedor1"
                            placeholder="Venderor" readonly>
                    </div>

                </div>
                <hr>
                <div>

                    <div class="table-responsive">
                        <table class="table" id="coste">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>$00.00</td>
                            </tr>
                            <tr>
                                <th>Envio: </th>
                                <td>$00.00</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>$00.00</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>

</form>

<button id="modalPdf" type="button" style="display:none" class="btn btn-primary" data-toggle="modal" data-target="#pdf">Large
    modal
</button>

<div class="modal modal-tall fade" id="pdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

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

                    <embed width="100%" height="100%"  src="" type="application/pdf"></embed>

                </object>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>

    </div>

</div>