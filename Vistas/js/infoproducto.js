var venta = false;
var folio = "0000000000";

/*======================================================
SUBMIT
=======================================================*/
$('#envio').submit(function(e){

    e.preventDefault();
    var envio = true;
    inputs = $('input[name]');
    $.each(inputs,function(key,valor){

        if($(valor).val()==""){

            envio=false;

        }

    });

    if(envio==true && inputs.length>0){

        var src = 'data:application/pdf;base64,';
        
        var folio = $('input[name="folio"]').val();
        var vendedor = $('input[name="vendedor"]').val();
        var cliente = $('input[name="cliente"]').val();
        var direccion = $('textarea[name="direccion"]').val();
        var tel = $('input[name="tel"]').val();
        var cantidad = $("input[name='cantidad[]']").map(function(){return $(this).val();}).get();
        var sku = $("input[name='SKU[]']").map(function(){return $(this).val();}).get();
        $('#pdf .modal-title span').text(folio);
        
        var datos = new FormData();

        datos.append('folio', folio);
        datos.append('vendedor', vendedor);
        datos.append('cliente', cliente);
        datos.append('direccion', direccion);
        datos.append('tel', tel);
        datos.append('cantidad', cantidad);
        datos.append('SKU', sku);

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

/*=======================================================
Validacion
========================================================*/
$('#cotizacion tbody').on('change','input[type="number"]',function(e){

    e.preventDefault();
    var valor = $(this).val();

});

$('#cotizacion tbody').on('change','input:checkbox',function(e){

    e.preventDefault();
    var seleccion = $('input:checkbox:checked').length;
    if(seleccion>0){

        $("#btnBorrar span").text("Borrar Seleccionados");
        $('#btnBorrar').attr('seleccion','');

    }
    else{

        $('#btnBorrar').removeAttr('seleccion');
        $('#btnBorrar span').text('Borrar Productos');

    }

});

/*=======================================================
SUGERENCIAS PRODUCTO
========================================================*/
$("#txtBuscarProd").bind('keypress',function(e){

    var regex = new RegExp("^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);

    if(regex.test(key)){

        var valor = $(this).val()+key;
        $("#sugerencias").empty();
        //console.log(valor);
        var datos = new FormData();

        datos.append('sugerencia', valor);

        $.ajax({

            url: $rutaOculta+"ajax/producto.ajax.php",
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

                            sugerencia += '<option value="'+valor['SKU']+'">'+valor['SKU']+' '+valor['titulo']+'</option>';

                        });

                    }
                    else{

                        sugerencia += '<option value="1">No se encontro: '+valor+'</option>';

                    }

                    $("#sugerencias").append(sugerencia);

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

        var code = (e.keyCode ? e.keyCode : e.which);
        if(code!=13){

            e.preventDefault();
            return false;

        }

    }

});

/*=======================================================
BUSCAR PRODUCTO
========================================================*/
$rutaOculta = $("#rutaOculta").val();

$("#btnBuscarProd").on('click',function(e){

    e.preventDefault();
    var valor = $("#txtBuscarProd").val();

    var datos = new FormData();

    datos.append('valor', valor);
    datos.append('item', 'SKU');

    $.ajax({

        url: $rutaOculta+"ajax/producto.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            //console.log("respuesta: "+respuesta);
            if(respuesta != "false"){

                respuesta = JSON.parse(respuesta);
                var elemento = $("#"+respuesta['SKU']);
                //console.log(elemento.length);
                if(elemento.length==0){

                    var fila = "";

                    fila += '<tr id="'+respuesta['SKU']+'">';
                    fila +=     '<td>';
                    fila +=         '<input type="checkbox">';
                    fila +=     '</td>';
                    fila +=     '<td>';
                    fila +=         '<input type="number" min="1" pattern="^[0-9]+" class="form-control" name="cantidad[]"';
                    fila +=             'placeholder="Cantidad" value="1">';
                    fila +=     '</td>';
                    fila +=     '<td>';
                    fila +=         respuesta['SKU'];
                    fila +=         '<input type="hidden" class="form-control" value="'+respuesta['SKU']+'" name="SKU[]" readonly>';
                    fila +=     '</td>';
                    fila +=     '<td>';
                    fila +=         respuesta['titulo'];
                    fila +=     '</td>';
                    fila +=     '<td>'+respuesta['id_marca']+'</td>';
                    fila +=     '<td class="precio">$'+parseFloat(respuesta['precio']).toFixed(2)+'</td>';
                    fila +=     '<td class="importe">';
                    fila +=         '$'+parseFloat(respuesta['precio']).toFixed(2);
                    fila +=     '</td>';
                    fila += '</tr>';

                    $('#nulo').remove();
                    $("#cotizacion tbody").append(fila);

                }
                else{

                    //console.log(elemento.find("td .cantidad").eq(0));
                    //console.log(elemento.eq(0));
                    var cantidad = elemento.find("td .cantidad").eq(0).val();
                    cantidad++;
                    elemento.find("td .cantidad").eq(0).val(cantidad);

                }

                $("#txtBuscarProd").val('');
                $("#sugerencias").empty();
                VerificarProductos();
                $('#coste').change();

            }
            else{

                swal(

                    {

                        title: "Error",
                        text: "El producto no existe",
                        type: "error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: true,

                    },

                );

            }

        }

    });

});

/*=======================================================
Eliminar Productos
========================================================*/
$("#btnBorrar").on('click',function(e){

    e.preventDefault();
    var seleccion = $(this).is('[seleccion]');
    console.log(seleccion);

    if(seleccion>0){

        $('#cotizacion tbody input:checked').each(
            function(){

                var padreSuperior = $(this).closest('tr').remove();
                VerificarProductos();
                $('#coste').change();

            }

        );

    }
    else{

        $("#cotizacion tbody").empty();
        VerificarProductos();
        $('#coste').change();

    }


});

/*=======================================================
Verificar productos en COTIZACION
========================================================*/
function VerificarProductos(){

    var productos = $('#cotizacion tbody tr').length;
    if(productos<=0){

        var fila = '';

        fila += '<tr id="nulo">';
        fila +=     '<td colspan="7" class="text-center">';
        fila +=         'No existen productoa registrados en este momento';
        fila +=     '</td>';
        fila += '</tr>';

        $("#cotizacion tbody").append(fila);
        $("#fechaVenta").val();
        $("#folio").val("");

        venta = false;

        $("#btnVenta").attr('disabled','');

        $('#btnBorrar').removeAttr('seleccion');
        $('#btnBorrar span').text('Borrar Productos');

    }
    else{

        if(venta==false){

            venta=true;
            folio = parseInt(folio);

            var elementoFecha = $("#fechaVenta");
            folio = ('0000000000' + (folio+1)).slice(-10);

            //console.log(folio);

            var d = new Date();

            var month = d.getMonth()+1;
            var day = d.getDate();

            var output = d.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;

            elementoFecha.val(output);
            $("#folio").val(folio);

            $("#btnVenta").removeAttr('disabled');

        }

    }

};

$('#cotizacion').on('change','input[name="cantidad[]"]',function(e){

    e.preventDefault();
    var cantidad = parseFloat($(this).val()).toFixed(2);
    //console.log(cantidad);
    var padreSuperior = $(this).closest('tr');
    //console.log(importeElemento)
    var precio = parseFloat(padreSuperior.children('.precio').eq(0).text().replace('$',"")).toFixed(2);
    var importe = cantidad*precio;

    padreSuperior.children('.importe').eq(0).text('$'+importe.toFixed(2));

    $('#coste').change();

});

$('#coste').change(function(){

    var coste = $(this);
    var costes = coste.find('td');
    var elementoSubtotal = costes.eq(0);
    var elementoEnvio = costes.eq(1);
    var elementoTotal = costes.eq(2);
    var elementoCoste = $("#TotalCoste");

    var subtotal = parseFloat(CalcularSubtotal())
    var envio = parseFloat(0);

    if(subtotal<500 && subtotal>0){

        envio = parseFloat("40");

    }

    total = parseFloat(subtotal+envio);
    total = Number.isNaN(total)? 0 : total;

    elementoSubtotal.text("$"+subtotal.toFixed(2));
    elementoEnvio.text("$"+envio.toFixed(2));
    elementoTotal.text("$"+total.toFixed(2));
    elementoCoste.text(total.toFixed(2));

});

function CalcularSubtotal(){

    var productos = $("#cotizacion tbody tr");
    var subtotal = 0;
    //console.log((productos.length-1)+": "+productos.eq(productos.length-1).html());
    //console.log("------------------------------------");
    for(var i=0;i<productos.length; i++){

        //console.log(i+": "+parseFloat(productos.eq(i).children('td').eq(6).text().replace('$',"")));
        //console.log(productos.eq(i).find('td').eq(6));
        var precio = productos.eq(i).find('td').eq(6).text().replace('$',"");
        var subtotal = Number(subtotal);
        //console.log(typeof(subtotal)+": "+subtotal);
        //console.log(typeof(precio)+": "+precio);
        subtotal += parseFloat(precio);

    }
    //console.log(subtotal);
    return parseFloat(subtotal).toFixed(2);

}

/*=======================================================
Verificar productos en COTIZACION
========================================================*/
$("#btnImprimir").bind('click',function(e){

    $("#areaPdf").get(0).contentWindow.focus();
    $("#areaPdf").get(0).contentWindow.print();

});