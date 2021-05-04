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