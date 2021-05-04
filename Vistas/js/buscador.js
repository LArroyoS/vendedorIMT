/*=====================================================
SUSPENDER REDIRECCIÓN
======================================================*/

$("#buscador a").on('click',function(e){

    e.preventDefault();
    var redireccion = $("#rutaOculta").val();
    //console.log(redirecion);
    //console.log(input);
    if($("#buscador input").val() != ""){

        redireccion = $("#buscador a").attr("href");
        $(location).prop('href', redireccion);

    }

});

/*=====================================================
BUSCADOR
======================================================*/


$("#buscador input").change(function(){

    var busqueda = $(this).val();
    var espresion = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;
    if(!espresion.test(busqueda)){

        $(this).val("");

    }
    else{

        var direccion = $("#buscador a");
        var evaluarBusqueda = busqueda.replace(/[áéíóúÁÉÍÓÚ ]/g, "_");
        var rutaBuscador = direccion.attr("href");

        if(busqueda != ""){

            direccion.attr("href", rutaBuscador+"/"+evaluarBusqueda);

        }

    }

});

/*=====================================================
BUSCADOR CON ENTER
======================================================*/

$("#buscador input").focus(function(){

    $(document).keyup(function(event){

        event.preventDefault();
        if(event.keyCode == 13 && 
            $("#buscador input").val() != ""){

                var rutaBuscador = $("#buscador a").attr("href");
                window.location.href = rutaBuscador;

            }

    });

});