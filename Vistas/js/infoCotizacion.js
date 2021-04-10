/*======================================================
SUBMIT
=======================================================*/
$('#envio').submit(function(e){

    e.preventDefault();
    var envio = true;
    inputs = $('input[name]');
    $('#btnVenta').attr('disabled','');
    $('#btnBorrar').attr('disabled','');

    $.each(inputs,function(key,valor){

        if($(valor).val()==""){

            //console.log(valor);
            envio=false;

        }

    });

    if(envio==true && inputs.length>0){

        var vendedor = $('input[name="vendedor"]').val();
        var cliente = $('input[name="cliente"]').val();
        var direccion = $('textarea[name="direccion"]').val();
        var tel = $('input[name="tel"]').val();
        var cantidad = $("input[name='cantidad[]']").map(function(){return $(this).val();}).get();
        var sku = $("input[name='SKU[]']").map(function(){return $(this).val();}).get();

        var datos = new FormData();

        datos.append('vendedor', vendedor);
        datos.append('cliente', cliente);
        datos.append('direccion', direccion);
        datos.append('tel', tel);
        datos.append('cantidad', cantidad);
        datos.append('SKU', sku);

        $.ajax({

            url: $rutaOculta+"ajax/cotizacion.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

                //console.log(respuesta);
                if(respuesta != "false"){

                    var error = "";
                    try{

                        respuesta = JSON.parse(respuesta);

                        if(respuesta['id']){

                            $('#folio').val(respuesta['id']);
                            var d = new Date(respuesta['fecha']);
                            
                            var month = d.getMonth()+1;
                            var day = d.getDate();
                
                            var output = d.getFullYear() + '-' +
                                (month<10 ? '0' : '') + month + '-' +
                                (day<10 ? '0' : '') + day;

                            $('#fechaVenta').val(output);
                            $('#btnPDF').removeAttr('disabled');

                        }
                        else{;

                            error = respuesta;

                        }

                    }catch(e){

                        error = respuesta;

                    }

                    if(error!=""){

                        //console.log(error);
                        $('#btnVenta').removeAttr('disabled');
                        $('#btnBorrar').removeAttr('disabled','');
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
                else{

                    $('#btnVenta').removeAttr('disabled');
                    $('#btnBorrar').removeAttr('disabled','');
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

        $('#btnVenta').removeAttr('disabled');
        $('#btnBorrar').removeAttr('disabled','');
        swal(

            {

                title: "Error",
                text: "Verifique que todos los campos esten completos",
                type: "error",
                confirmButtonText: "Cerrar",
                closeOnConfirm: true,

            },

        );

    }

    return false;

});

/*======================================================
VERPDF
=======================================================*/
$('#btnPDF').click(function(e){

    e.preventDefault();
    var folio = parseInt($('#folio').val());

    if(folio!='' && Number.isInteger(folio)){

        var src = 'data:application/pdf;base64,';

        var datos = new FormData();
        datos.append('folio', folio);

        $.ajax({

            url: $rutaOculta+"ajax/cotizacionFlayer.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

                //console.log(respuesta);
                if(respuesta != "false"){

                    var error = "";
                    try{

                        //console.log(respuesta);
                        respuesta = JSON.parse(respuesta);
                        if(respuesta['resultado'] && 
                            respuesta['resultado']!='error'){

                            var pdf = src+respuesta['resultado'];
                            $('#pdf .modal-body object').attr('data',pdf);
                            $('#pdf .modal-body embed').attr('src',pdf);
                            
                            $('#modalPdf').click();

                        }
                        else{;

                            error = respuesta;

                    }
                    }catch(e){

                        error = respuesta;

                    }
                    if(error!=""){

                        //console.log(error);
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

        swal(

            {

                title: "Error",
                text: "Verifique que todos los campos esten completos",
                type: "error",
                confirmButtonText: "Cerrar",
                closeOnConfirm: true,

            },

        );

    }

    return false;

});

/*======================================================
IMPRIMIR PDF
=======================================================*/
/*
$('#btnImprimir').click(function(e){

    e.preventDefault();
    var folio = parseInt($('#folio').val());
    var url = $rutaOculta+"ajax/cotizacionFlayer.ajax.php"

    if(folio!='' && Number.isInteger(folio)){

        var datos = new FormData();
        datos.append('imprimir', folio);

        

    }

});
*/