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

        e.preventDefault();
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){

            $("#btnBuscarProd").click();

        }
        return false;

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
                //console.log(respuesta);
                if(elemento.length==0){

                    var fila = "";

                    fila += '<tr id="'+respuesta['SKU']+'">';
                    fila +=     '<td>';
                    fila +=         '<input type="checkbox">';
                    fila +=     '</td>';
                    fila +=     '<td>';
                    fila +=         '<input type="number" min="1" pattern="^[0-9]+" class="form-control cantidad" name="cantidad[]"';
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
                    $('input[name="cantidad[]"]').last().focus();

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
        fila +=         'No existen productos registrados en este momento';
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

        $("#btnVenta").removeAttr('disabled');

    }

};

$('#cotizacion').bind('keypress', 'input[name="cantidad[]"]',function(e){

    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);

    if(!regex.test(key)){

        e.preventDefault();
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){

            $("#txtBuscarProd").focus();

        }
        return false;

    }

});

$('#cotizacion').on('change','input[name="cantidad[]"]',function(e){

    e.preventDefault();
    var cantidad = parseFloat($(this).val()).toFixed(2);
    if(cantidad>0){

        //console.log(cantidad);
        var padreSuperior = $(this).closest('tr');
        //console.log(importeElemento)
        var precio = parseFloat(padreSuperior.children('.precio').eq(0).text().replace('$',"")).toFixed(2);
        var importe = cantidad*precio;

        padreSuperior.children('.importe').eq(0).text('$'+importe.toFixed(2));

        $('#coste').change();

    }else{

        $(this).val(1);

    }

});

$('#coste').change(function(){

    var coste = $(this);
    var costes = coste.find('td');
    var elementoSubtotal = costes.eq(0);
    var elementoEnvio = costes.eq(1);
    var elementoTotal = costes.eq(2);
    var elementoCoste = $("#TotalCoste");

    var subtotal = parseFloat(CalcularSubtotal())
    subtotal = Number.isNaN(subtotal)? 0:subtotal;

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

/*========================================================
Nueva venta
=========================================================*/
$('#btnNV').on('click',function(){

    $("#cotizacion tbody").empty();
    VerificarProductos();
    $('#coste').change();
    /*
    $("#cliente").attr('data-readonly','');
    $("#direccion").attr('disabled','');
    */

});

