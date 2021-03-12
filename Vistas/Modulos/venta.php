<div class="row">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Striped Full Width Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Cantidad</th>
                            <th>Producto</th>
                            <th>Marca</th>
                            <th>Precio</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Update software</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                </div>
                            </td>
                            <td>Update software</td>
                            <td>Update software</td>
                            <td><span class="badge bg-danger">55%</span></td>
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
        <div class="card card-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-info">
                <h1>Total: $ </h1>
            </div>
            <div class="card-footer p-3">
                <div class="row">

                    <div class="form-group col-12">
                        <label for="exampleInputPassword1">Folio</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <div class="form-group col-6">
                        <label for="exampleSelectBorder">Documento</label>
                        <select class="custom-select form-control-border" id="exampleSelectBorder">
                            <option>Value 1</option>
                            <option>Value 2</option>
                            <option>Value 3</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="exampleSelectBorder">Tipo de pago</label>
                        <select class="custom-select form-control-border" id="exampleSelectBorder">
                            <option>Value 1</option>
                            <option>Value 2</option>
                            <option>Value 3</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="exampleInputPassword1">Fecha de Venta</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <div class="form-group col-12">
                        <label for="exampleInputPassword1">Vendedor</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
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
                                <th>Tax (9.3%)</th>
                                <td>$10.34</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>$5.80</td>
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