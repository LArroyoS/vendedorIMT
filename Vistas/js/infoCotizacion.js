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
                if(respuesta != "error"){

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
BUSCAR FOLIO
=======================================================*/
$('#btnBuscarFolio').click(function(e){

    e.preventDefault();
    var folio = parseInt($('#folio').val());

    if(folio!='' && Number.isInteger(folio)){

        var datos = new FormData();
        datos.append('folio', folio);

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
                        //console.log(respuesta);
                        if(respuesta['id']){

                            var costes = $('#coste').find('td');
                            var elementoSubtotal = costes.eq(0);
                            var elementoEnvio = costes.eq(1);
                            var elementoTotal = costes.eq(2);

                            var estado = 'SIN PAGAR';

                            $('#folio').val(respuesta['id']);
                            var d = new Date(respuesta['fecha']);
                            
                            var month = d.getMonth()+1;
                            var day = d.getDate();

                            var output = d.getFullYear() + '-' +
                                (month<10 ? '0' : '') + month + '-' +
                                (day<10 ? '0' : '') + day;

                            $('#fechaVenta').val(output);
                            $('#cliente').val(respuesta['cliente_nombre']);

                            respuesta['subtotal'] = parseFloat(respuesta['subtotal']);
                            respuesta['envio'] = parseFloat(respuesta['envio']);

                            total = respuesta['subtotal']+respuesta['envio'];
                            
                            elementoSubtotal.text("$"+respuesta['subtotal'].toFixed(2));
                            elementoEnvio.text("$"+respuesta['envio'].toFixed(2));
                            elementoTotal.text("$"+total.toFixed(2));

                            $('#cliente').val(respuesta['nombre_cliente']);
                            $('#direccion').val(respuesta['direccion_cliente']);
                            $('#tel').val(respuesta['telefono']);
                            $('#TotalCoste').html(total.toFixed(2));
                            $('#vendedor').val(respuesta['id_vendedor']);

                            if(parseInt(respuesta['estado'])>0){

                                estado = 'PAGADO';

                            }
                            else{

                                $('#btnCompra').removeAttr('disabled');

                            }

                            $("#estado").val(estado);

                            $('#btnPDF').removeAttr('disabled');

                            GenerarDetalle(respuesta['detalle']);

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
                                text: "El folio que usted introdujo no existe",
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

function GenerarDetalle(detalle){

    $("#cotizacion tbody").empty();
    $.each(detalle,function(key,valor){

        var fila = "";

        var precio = (parseInt(valor['descuentoOferta'])>0)? parseFloat(valor['precioDescuento']) : parseFloat(valor['precio_unitario']);
        valor['cantidad'] = parseFloat(valor['cantidad']);
        var importe = precio*valor['cantidad'];

        fila += '<tr>';
        fila +=     '<td>';
        fila +=         valor['producto_id'];
        fila +=     '</td>';
        fila +=     '<td>';
        fila +=         valor['producto_nombre'];
        fila +=     '</td>';
        fila +=     '<td>';
        fila +=         '$'+parseFloat(precio).toFixed(2);
        fila +=     '</td>';
        fila +=     '<td>';
        fila +=         valor['cantidad'];
        fila +=     '</td>';
        fila +=     '<td>';
        fila +=         '$'+importe.toFixed(2);
        fila +=     '</td>';
        fila += '</tr>';

        //console.log('fila'+fila);
        $("#cotizacion tbody").append(fila);

    });

}

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
BTNCompra
=======================================================*/
$('#btnCompra').click(function(e){

    e.preventDefault();
    var folio = parseInt($('#folio').val());

    if(folio!='' && Number.isInteger(folio)){

        var datos = new FormData();
        datos.append('confirmar', folio);

        $.ajax({

            url: $rutaOculta+"ajax/cotizacion.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

                console.log(respuesta);
                if(respuesta == "true"){

                    $('#estado').val('PAGADO');

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

/*=======================================================
SUGERENCIAS Folio
========================================================*/
$("#folio").bind('keypress',function(e){

    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);

    if(regex.test(key)){

        var valor = $(this).val()+key;
        $("#sugerenciasFolios").empty();
        //console.log(valor);
        var datos = new FormData();

        datos.append('sugerencia', valor);

        $.ajax({

            url: $rutaOculta+"ajax/cotizacion.ajax.php",
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

                            sugerencia += '<option value="'+valor['id']+'">'+valor['id']+' '+valor['nombre_cliente']+' '+valor['telefono']+'</option>';

                        });
                        $("#sugerenciasFolios").append(sugerencia);

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

            $("#btnBuscarFolio").click();

        }

    }

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