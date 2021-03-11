/*==========================================
CABEZOTE
==========================================*/

$('#btnCategorias').on('click',function(e){

    if(window.matchMedia("(max-width:576px)").matches){

        $('#btnCategorias').after($('#categorias').slideToggle("fast"));

    }
    else{

        $('#encabezado').after($('#categorias').slideToggle("fast"));

    }

});

$(window).resize(function(){

    var categorias = $("#categorias").css('display');
    //console.log(categorias);
    if( (categorias=='block') && 
        (window.matchMedia("(max-width:576px)").matches)){

        $('#btnCategorias').after($('#categorias'));

    }
    else if((categorias=='block')){

        $('#encabezado').after($('#categorias'));

    }

});