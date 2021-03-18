<?php 

    //print_r($_POST);

?>
<form method="post" class="row">

    <div class="col-md-8">
        <div class="card border border-dark">
            <div class="card-header">

                <!-- SEARCH FORM -->
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Buscar producto"
                        aria-label="Search" id="txtBuscarProd">
                    <div class="input-group-append">
                        <button class="btn btn-navbar border border-dark" id="btnBuscarProd">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <!--=========================================================================
                SUGERENCIA
                ===========================================================================-->
                <div class="sugerencia">

                    <ul>



                    </ul>

                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 pt-3">
                <table class="table table-hover" id="cotizacion">
                    <thead>

                        <tr>
                            <th style="width: 10px"></th>
                            <th width="150" class="cantidad">Cantidad</th>
                            <th>SKU</th>
                            <th>Producto</th>
                            <th>Marca</th>
                            <th>Precio</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr id="nulo">
                            <td colspan="7" class="text-center">
                                No existen productoa registrados en este momento
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
                <button id="btnVenta" type="submit" class="btn btn-success float-right" style="margin-right: 5px;">
                    <i class="fas fa-money-check-alt"></i>
                    Generar Venta
                </button>
                <button id="btnBorrar" type="button" class="btn btn-danger float-right">
                    <i class="fas fa-trash-alt"></i>
                    Borrar
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
                <h1 class="text-center">Total: $<span id="TotalCoste"></span> </h1>
            </div>
            <div class="card-footer p-3 bg-gris">

                <div class="row">

                    <div class="form-group col-12">
                        <label for="folio">Folio</label>
                        <input type="number" class="form-control" 
                            id="folio" name="folio" placeholder="folio" 
                            value="" readonly>
                    </div>

                    <div class="form-group col-6">
                        <label for="documento">Documento</label>
                        <select class="custom-select form-control-border" name="documento" id="documento">
                            <option>Seleccione uno</option>
                            <option selected>PDF</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="pago">Tipo de pago</label>
                        <select class="custom-select form-control-border" name="pago" id="pago">
                            <option>Seleccione uno</option>
                            <option>OXXO</option>
                            <option>7 ELEVEN</option>
                            <option>CLABE interbancaria</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="fechaVenta">Fecha de Venta </label>
                        <input type="date" class="form-control" name="fechaVenta" id="fechaVenta" 
                            value="" 
                            placeholder="Fecha de Venta" readonly>
                    </div>

                    <div class="form-group col-12">
                        <label for="vendedor">Vendedor</label>
                        <input type="text" class="form-control" name="vendedor"  id="vendedor" 
                            value="Vendedor1" placeholder="Venderor" readonly>
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