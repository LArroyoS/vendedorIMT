<div class="row">

    <div class="col-md-8">
        <div class="card border border-dark">
            <div class="card-header">
                <!-- SEARCH FORM -->
                <form>
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar border border-dark" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0 pt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th width="150">Cantidad</th>
                            <th>Producto</th>
                            <th>Marca</th>
                            <th>Precio</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="number" min="1" pattern="^[0-9]+" class="form-control" name="cantidad[]"
                                    placeholder="Cantidad">
                            </td>
                            <td>
                                Producto 1
                            </td>
                            <td>Marca 1</td>
                            <td>$00.00</td>
                            <td>
                                $00.00
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="number" min="1" pattern="^[0-9]+" class="form-control " name="cantidad[]"
                                    placeholder="Cantidad">
                            </td>
                            <td>
                                Producto 1
                            </td>
                            <td>Marca 1</td>
                            <td>$00.00</td>
                            <td>
                                $00.00
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="number" min="1" pattern="^[0-9]+" class="form-control " name="cantidad[]"
                                    placeholder="Cantidad">
                            </td>
                            <td>
                                Producto 1
                            </td>
                            <td>Marca 1</td>
                            <td>$00.00</td>
                            <td>
                                $00.00
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="number" min="1" pattern="^[0-9]+" class="form-control" name="cantidad[]"
                                    placeholder="Cantidad">
                            </td>
                            <td>
                                Producto 1
                            </td>
                            <td>Marca 1</td>
                            <td>$00.00</td>
                            <td>
                                $00.00
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-12">
                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i>
                    Vaciar Venta
                </button>
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generar Venta
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
                <h1 class="text-center">Total: $ </h1>
            </div>
            <div class="card-footer p-3 bg-gris">

                <div class="row">

                    <div class="form-group col-12">
                        <label for="folio">Folio</label>
                        <input type="text" class="form-control" id="folio" placeholder="folio">
                    </div>

                    <div class="form-group col-6">
                        <label for="documento">Documento</label>
                        <select class="custom-select form-control-border" id="documento">
                            <option>Seleccione uno</option>
                            <option>Value 1</option>
                            <option>Value 2</option>
                            <option>Value 3</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="pago">Tipo de pago</label>
                        <select class="custom-select form-control-border" id="pago">
                            <option>Seleccione uno</option>
                            <option>Value 1</option>
                            <option>Value 2</option>
                            <option>Value 3</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="fechaVenta">Fecha de Venta</label>
                        <input type="text" class="form-control" id="fechaVenta" placeholder="Fecha de Venta">
                    </div>

                    <div class="form-group col-12">
                        <label for="vendedor">Vendedor</label>
                        <input type="text" class="form-control" id="vendedor" placeholder="Venderor">
                    </div>

                </div>
                <hr>
                <div>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>$250.30</td>
                            </tr>
                            <tr>
                                <th>Envio: </th>
                                <td>$99.00</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>$265.24</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>

</div>