<?php 

    $urlVendedor = Ruta::ctrRuta();
    $urlServidor = Ruta::ctrRutaServidor();

    $password = new ControladorUsuarios();
    $password->ctrOlvidoPassword();

?>
<div class="login-page" style="background: #18171c;">

    <div class="login-box" id="OlvidoPassword">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>IMT Vendedor</b></h1>
            </div>
            <div class="card-body">
            <p class="login-box-msg">Escribe el correo electrónico con el que estás regirtrado y te enviaremos una nueva contraseña.</p>

                <form method="post">

                    <div class="form-group">

                        <div class="input-group mb-2">

                            <div class="input-group-prepend">

                                <div class="input-group-text">

                                    <i class="fas fa-envelope"></i>

                                </div>

                            </div>

                            <input type="email" class="form-control" id="passEmail" name="passEmail"
                                placeholder="CORREO ELECTRONICO">

                        </div>

                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">

                            <input type="submit" class="btn btn-block btn-primary" value="ENVIAR">

                        </div>
                        <!-- /.col -->
                    </div>

                </form>

                <p class="mt-3 mb-1">
                    <a href="<?php echo htmlspecialchars($urlVendedor); ?>ingresar">Ingresar</a>
                </p>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</div>