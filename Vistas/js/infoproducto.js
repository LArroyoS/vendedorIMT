var venta = false;
var folio = "0000000000";

/*=======================================================
BUSCAR PRODUCTO
========================================================*/
var contador = 0;
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
                    fila +=         '<input type="checkbox" id="checkboxPrimary1">';
                    fila +=         '<input type="hidden" value="'+respuesta['id']+'" name="id[]">'
                    fila +=     '</td>';
                    fila +=     '<td>';
                    fila +=         '<input type="number" min="1" pattern="^[0-9]+" class="form-control cantidad" name="cantidad[]"';
                    fila +=             'placeholder="Cantidad" value="1">';
                    fila +=     '</td>';
                    fila +=     '<td>';
                    fila +=         respuesta['SKU'];
                    fila +=     '</td>';
                    fila +=     '<td>';
                    fila +=         respuesta['id_marca'];
                    fila +=     '</td>';
                    fila +=     '<td>'+respuesta['tipo']+'</td>';
                    fila +=     '<td class="precio">$'+parseFloat(respuesta['precio']).toFixed(2)+'</td>';
                    fila +=     '<td class="importe">';
                    fila +=         '';
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
                $('.cantidad').change();
                VerificarProductos();

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

$()

/*=======================================================
Eliminar Productos
========================================================*/
$("#btnBorrar").on('click',function(e){

    $('#cotizacion tbody input:checked').each(
        function(){

            var padreSuperior = $(this).closest('tr').remove();
            $('#coste').change();
            VerificarProductos();

        }
    );

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

    }
    else{

        if(venta==false){

            venta=true;
            folio = parseInt(folio);

            var elementoFecha = $("#fechaVenta");
            folio = ('0000000000' + (folio+1)).slice(-10);

            console.log(folio);

            var d = new Date();

            var month = d.getMonth()+1;
            var day = d.getDate();

            var output = d.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;

            elementoFecha.val(output);
            $("#folio").val(folio); 

        }

    }

};

$('#cotizacion').on('change','input.cantidad',function(e){

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

    var subtotal = parseFloat(elementoSubtotal.text().replace('$',"")).toFixed(2);
    var envio = parseFloat(0);

    subtotal = parseFloat(CalcularSubtotal());
    if(subtotal<500 && subtotal>0){

        envio = parseFloat("40");

    }

    total = parseFloat(subtotal+envio);

    elementoSubtotal.text("$"+subtotal.toFixed(2));
    elementoEnvio.text("$"+envio.toFixed(2));
    elementoTotal.text("$"+total.toFixed(2));
    elementoCoste.text(total.toFixed(2));

});

function CalcularSubtotal(){

    var productos = $("#cotizacion tbody tr");
    var subtotal = 0;
    var precio = 0;
    for(i=0;i<productos.length; i++){

        //console.log(productos.eq(i).children('td').eq(6));
        precio =  parseFloat(productos.eq(i).children('td').eq(6).text().replace('$',"")).toFixed(2);
        subtotal = subtotal+precio;

    }
    return parseFloat(subtotal).toFixed(2);

}