/*=============================================================
CAPTURA DE RUTA
=============================================================*/
var rutaActual = location.href;
$("#Ingresar").submit('form',function(){

    localStorage.setItem("rutaActual",rutaActual);
    var email = $("#ingEmail").val();
    var password = $("#ingPassword").val();

    var alertas = $('div[alerta]');
    alertas.remove();

    console.log(alertas);

    var error = true;

    /*========================================================
    VALIDAR EMAIL
    =========================================================*/
    if(email != ""){

        var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w)*(\.\w{2,4})+$/;
        if(!expresion.test(email)){

            $("#ingEmail").parent().after(
                '<div alerta="ingEmail" class="alert alert-danger" alert-dismissible fade show" role="alert"><strong>ERROR: </strong> Escriba correctamente el correo electrónico<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            error = false;

        }

    }
    else{

        $("#ingEmail").parent().after(
            '<div alerta="ingEmail" class="alert alert-warning" alert-dismissible fade show" role="alert"><strong>ATENCIÓN: </strong> Este campo es obligatorio<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        error = false;

    }

    /*========================================================
    VALIDAR PASSWORD
    =========================================================*/
    if(password != ""){

        var expresion = /^[a-z-A-Z0-9]*$/;
        if(!expresion.test(password)){

            $("#ingPassword").parent().after(
                '<div alerta="ingPassword" class="alert alert-danger" alert-dismissible fade show" role="alert"><strong>ERROR: </strong> No se caracteres especiales<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            error = false;

        }

    }
    else{

        $("#ingPassword").parent().after(
            '<div alerta="ingPassword" class="alert alert-warning" alert-dismissible fade show" role="alert"><strong>ATENCIÓN: </strong> Este campo es obligatorio<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        error = false;

    }

    return error;

});

/*=============================================================
VALIDAR EL REGISTRO DE USUARIO
=============================================================*/
/*
    $("input").focus(function(){

    var id = $(this).attr('id');
    var alertas = $('div[alerta="'+id+'"]');
    alertas.remove();

});
*/

/*=============================================================
VALIDAR EL REGISTRO DE USUARIO
=============================================================*/
$("#Registro").submit('form', function /*validar*/(e){

    var nombre = $("#regUsuario").val();
    var email = $("#regEmail").val();
    var password = $("#regPassword").val();
    var politicas = $("#regTerminos:checked").val();

    var alertas = $('div[alerta]');
    alertas.remove();

    console.log(alertas);

    var error = true;

    /*========================================================
    VALIDAR NOMBRE
    =========================================================*/
    if(nombre != ""){

        var expresion = /^[a-z-A-ZñÑáéíóúÁÉÍÓÚ ]*$/;
        if(!expresion.test(nombre)){

            $("#regUsuario").parent().after(
                '<div alerta=regUsuario class="alert alert-danger" alert-dismissible fade show" role="alert"><strong>ERROR: </strong> No se aceptan números ni caracteres especiales<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            error = false;

        }

    }
    else{

        $("#regUsuario").parent().after(
            '<div alerta="regUsuario" class="alert alert-warning" alert-dismissible fade show" role="alert"><strong>ATENCIÓN: </strong> Este campo es obligatorio<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        error = false;

    }
    
    /*========================================================
    VALIDAR EMAIL
    =========================================================*/
    if(email != ""){

        var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w)*(\.\w{2,4})+$/;
        if(!expresion.test(email)){

            $("#regEmail").parent().after(
                '<div alerta="regEmail" class="alert alert-danger" alert-dismissible fade show" role="alert"><strong>ERROR: </strong> Escriba correctamente el correo electrónico<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            error = false;

        }
        if(!validarEmailRepetido){

            console.log("repetido");
            $("#regEmail").parent().after(
                '<div alerta="regEmail" class="alert alert-danger" alert-dismissible fade show" role="alert"><strong>ERROR: </strong> El correo electronico ya existe en la base de datos, por favor ingrese otro diferente <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            error = false;

        }

    }
    else{

        $("#regEmail").parent().after(
            '<div alerta="regEmail" class="alert alert-warning" alert-dismissible fade show" role="alert"><strong>ATENCIÓN: </strong> Este campo es obligatorio<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        error = false;

    }

    /*========================================================
    VALIDAR PASSWORD
    =========================================================*/
    if(password != ""){

        var expresion = /^[a-z-A-Z0-9]*$/;
        if(!expresion.test(password)){

            $("#regPassword").parent().after(
                '<div alerta="regPassword" class="alert alert-danger" alert-dismissible fade show" role="alert"><strong>ERROR: </strong> No se caracteres especiales<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            error = false;

        }

    }
    else{

        $("#regPassword").parent().after(
            '<div alerta="regPassword" class="alert alert-warning" alert-dismissible fade show" role="alert"><strong>ATENCIÓN: </strong> Este campo es obligatorio<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        error = false;

    }

    /*========================================================
    VALIDAR CONDICIONES Y PRIVACIDAD
    =========================================================*/
    if(politicas != "on"){

        $("#regTerminos").parent().after(
            '<div alerta="regTerminos" class="alert alert-warning" alert-dismissible fade show" role="alert"><strong>ATENCIÓN: </strong> Debe aceptar nuestras condiciones de uso y politicas de privacidad<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        error = false;

    }

    return error;

});

/*=============================================================
VALIDAR EMAIL REPETIDO
=============================================================*/
var validarEmailRepetido = false;

$("#regEmail").change(function(){

    var email = $("#regEmail").val();
    var datos = new FormData();
    datos.append("validarEmail",email);
    //console.log($rutaOculta+'ajax/usuarios.ajax.php')

    $.ajax({

        url: $rutaOculta+'ajax/usuarios.ajax.php',
        method: "POST",
        data: datos,
        cahce: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            if(respuesta=='false'){

                var alertas = $('div[dinamico="1"]');
                alertas.remove();
                validarEmailRepetido = true;

            }
            else{

                var modo = JSON.parse(respuesta).modo;
                console.log(modo);

                modo = "esta página";

                $("#regEmail").parent().after(
                    '<div alerta="regEmail" dinamico="1" class="alert alert-danger" alert-dismissible fade show" role="alert"><strong>ERROR: </strong> El correo electronico ya existe en la base de datos, fue registrado a través de '+modo+', por favor ingrese otro diferente <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                validarEmailRepetido = false;

            }

            console.log(validarEmailRepetido);

        }

    });

});