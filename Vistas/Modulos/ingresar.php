<?php 

    $ingreso = new ControladorUsuarios();
    $ingreso->ctrIngresoUsuario();

?>
<div class="login-page">

    <div class="login-box" id="Ingresar">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>IMT Vendedor</b></h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Iniciar Sesión</p>

                <form method="post">

                    <div class="form-group">

                        <div class="input-group mb-2">

                            <div class="input-group-prepend">

                                <div class="input-group-text">

                                    <i class="fas fa-envelope"></i>

                                </div>

                            </div>

                            <input type="email" class="form-control" id="ingEmail" name="ingEmail"
                                placeholder="CORREO ELECTRONICO">

                        </div>

                        <div class="input-group mb-2">

                            <div class="input-group-prepend">

                                <div class="input-group-text">

                                    <i class="fas fa-lock"></i>

                                </div>

                            </div>

                            <input type="password" class="form-control" id="ingPassword" name="ingPassword"
                                placeholder="CONTRASEÑA">

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Recuerdame
                                </label>
                            </div>
                        </div>

                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1">
                    <a href="l">¿Olvidaste tu contraseña?</a>
                </p>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</div>