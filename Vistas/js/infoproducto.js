$('#cotizacion').change();

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
                var fila = "";

                fila += '<tr>';
                fila +=     '<td>';
                fila +=         '<input type="checkbox" id="checkboxPrimary1">';
                fila +=     '</td>';
                fila +=     '<td>';
                fila +=         '<input type="number" min="1" pattern="^[0-9]+" class="form-control cantidad" name="cantidad[]"';
                fila +=             'placeholder="Cantidad" value="1">';
                fila +=     '</td>';
                fila +=     '<td>';
                fila +=         respuesta['SKU'];
                fila +=     '</td>';
                fila +=     '<td>';
                fila +=         respuesta['titulo'];
                fila +=     '</td>';
                fila +=     '<td>'+respuesta['tipo']+'</td>';
                fila +=     '<td class="precio">'+respuesta['precio']+'</td>';
                fila +=     '<td class="importe">';
                fila +=         '';
                fila +=     '</td>';
                fila += '</tr>';

                $('#nulo').remove();
                $("#cotizacion tbody").append(fila);
                $()
                $("#txtBuscarProd").val('');
                $('.cantidad').change();

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
            $('#cotizacion').change();

        }
    );

});

/*=======================================================
Verificar productos en COTIZACION
========================================================*/
$("#cotizacion").on('change',function(e){

    var productos = $('#cotizacion tbody tr').length;
    if(productos<=0){

        var fila = '';

        fila += '<tr id="nulo">';
        fila +=     '<td colspan="7">';
        fila +=         'No existen productoa registrados en este momento';
        fila +=     '</td>';
        fila += '</tr>';

        $("#cotizacion tbody").append(fila);

    }

});

$('#cotizacion').on('change','input.cantidad',function(e){

    e.preventDefault();
    var cantidad = $(this).val();
    //console.log(cantidad);
    var padreSuperior = $(this).closest('tr');
    //console.log(importeElemento)
    var precio = padreSuperior.children('.precio').eq(0).text();
    var importe = cantidad*precio;

    padreSuperior.children('.importe').eq(0).text(importe);

});