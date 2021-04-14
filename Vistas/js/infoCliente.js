/*=======================================================
BUSCAR PRODUCTO
========================================================*/
$rutaOculta = $("#rutaOculta").val();

$("#btnBuscarTel").on('click',function(e){

    e.preventDefault();
    var valor = $("#tel").val();

    var datos = new FormData();

    datos.append('valor', valor);
    datos.append('item', 'telefono');

    $.ajax({

        url: $rutaOculta+"ajax/cliente.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            //console.log("respuesta: "+respuesta);
            if(respuesta != "false"){

                respuesta = JSON.parse(respuesta);
                $('#cliente').val(respuesta['nombre']);
                $('#direccion').val(respuesta['direccion']);

            }
            else{

                $("#cliente").removeAttr('data-readonly');
                $("#direccion").removeAttr('disabled');
                swal(

                    {

                        title: "Notificacion",
                        text: "Este numero aun no esta registrado, por lo que al finalizar la venta se almacenra la infomacion de forma automatica",
                        type: "warning",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: true,

                    },

                );

            }

        }

    });

});

/*=======================================================
SUGERENCIAS Cliente
========================================================*/
$("#tel").bind('keypress',function(e){

    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);

    if(regex.test(key)){

        var valor = $(this).val()+key;
        $("#sugerenciasCliente").empty();
        //console.log(valor);
        var datos = new FormData();

        datos.append('sugerencia', valor);

        $.ajax({

            url: $rutaOculta+"ajax/cliente.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

                if(respuesta != "false"){

                    respuesta = JSON.parse(respuesta);
                    //console.log(respuesta.length);
                    let sugerencia = "";
                    if(respuesta.length>0){

                        $.each(respuesta,function(key,valor){

                            sugerencia += '<option value="'+valor['telefono']+'">'+valor['telefono']+' '+valor['nombre']+'</option>';

                        });
                        $("#sugerenciasCliente").append(sugerencia);

                    }

                }
                else{

                    swal(

                        {
    
                            title: "Error",
                            text: "Lo sentimos, ocurrio un error, intentelo mas tarde",
                            type: "error",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: true,
    
                        },
    
                    );

                }

            }

        });

    }
    else{

        e.preventDefault();
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){

            $("#btnBuscarTel").click();

        }
        return false;

    }

});

