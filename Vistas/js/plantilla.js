/*===========================================
PLANTILLA
============================================*/
$rutaOculta = $("#rutaOculta").val();

$.ajax({

    url: $rutaOculta+"ajax/plantilla.ajax.php",
    success: function(respuesta){

        var colorFondo = JSON.parse(respuesta).colorFondo;
        var colorTexto = JSON.parse(respuesta).colorTexto;
        var barraSuperior = JSON.parse(respuesta).barraSuperior;
        var textoSuperior = JSON.parse(respuesta).textoSuperior;

        $(".backColor, .backColor a")
            .css({"background": colorFondo,
            "color": colorTexto});

        $(".barraSuperior, .barraSuperior a")
            .css({"background": barraSuperior,
            "color": textoSuperior});

    }

});

/*===========================================
CUADRICULA O LISTA
============================================*/

var btnList = $(".btnList");
var i=0;

for(i = 0; i<btnList.length; i++){

    $("#btnGrid"+i).click(function(){

        var numero = $(this).attr("id").substr(-1);

        $(".list"+numero).hide();
        $(".grid"+numero).show();
        $(this).addClass("backColor");
        $("#btnList"+numero).removeClass("backColor");

    });

    $("#btnList"+i).click(function(){

        var numero = $(this).attr("id").substr(-1);
        $(".list"+numero).show();
        $(".grid"+numero).hide();
        $(this).addClass("backColor");
        $("#btnGrid"+numero).removeClass("backColor");

    });

}

/*===========================================
EFECTO CON SCROLL
============================================*/

$(window).scroll(function(){

    var scrollY = window.pageYOffset;
    //console.log("Scroll: "+ scrollY);

    if(window.matchMedia("(min-width: 768px)").matches){

        if($(".banner").html() != null){

            if(scrollY < ($(".banner").offset().top)-150){

                //console.log("es menor");
                $(".banner img").css({"margin-top": (-scrollY/2)+"px"});
    
            }else{
    
                scrollY = 0;
    
            }

        }

    }

});

/*================================================
SCROLLUP
================================================*/

$.scrollUp({

    scrollText:"",
    scrollSpeed: 500,
    easingType: "easeOutQuint"

});

/*================================================
HERRAMIENTA TOOLTIP
================================================*/

$('[data-toggle="tooltip"]').tooltip();

/*===========================================
BREADCRUMB
============================================*/

var pagActiva = $(".pagActiva").html();

if(pagActiva != null){

    //El caracter g indica varios (todos los guines)
    var regPagActiva = pagActiva.replace(/-/g, " ");    
    $(".pagActiva").html(regPagActiva);

}

/*===========================================
ENLACES PAGINACION
============================================*/

var url = window.location.href;

var indice = url.split("/");

var pag = 1;

if(indice.length>5){

    var pag = indice[5];

}

//console.log(indice);

$("#item"+pag).addClass("active");


