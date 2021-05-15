$(document).ready(function(){

    $("textarea").on("keypress",function(e){

        console.log($(this).val().length);

    });

    /***************************************************************/
    /* Variables y constantes */

    Ubicacion = null;
    let seleccion = {

        presionado: {

            pagina: null, 
            fila: null,
            columna: null,

        },
        liberado: {

            pagina: null,
            fila: null,
            columna: null,

        },

    };
    let tdInicio = null;
    let catalogo = true;

    const ConstHojaAlto = 297;
    const ConstHojaAncho = 210;
    const ConstTd_heigh = ConstHojaAlto/4;
    const ConstTd_width = ConstHojaAncho/4;

    let hojaAlto = ConstHojaAlto;
    let hojaAncho = ConstHojaAncho;
    let td_heigh = ConstTd_heigh;
    let td_width = ConstTd_width;
    let pdfOrientacion = "p";

    /***************************************************************/
    /* Objetos y su inicializacion */

    $("#menu").hide();

    // Get the navbar
    let navbar = $("#navbar");

    // Get the offset position of the navbar
    let sticky = navbar.offset().top;

    /***************************************************************/
    /* Eventos */

    /* Desplazamiento */

    $(window).scroll(function(){

        //console.log($(window).scrollTop()+" - "+sticky);
        if ( $(window).scrollTop() > sticky) {
        
            navbar.addClass("sticky")
        
        } else {
            
            navbar.removeClass("sticky");
        
        }

    });

    /* Botones */

    $("#nuevaPagina").on("click",function(e){

        e.preventDefault();

        agregarPagina();

    });

    $("#imprimir").on('click',function(e){

        e.preventDefault();
        $(window).scrollTop(0);
        let nombreArchivo = $("#archivo").val();
        generarPDF(nombreArchivo);

    });

    /* Orientacion */
    /* Permite cambiar la orientacion de la hoja */
    $("#orientacion").on("change",function(e){

        let orientacion = $(this).val();
        switch(orientacion){

            case "Horizontal":

                hojaAlto = ConstHojaAncho;
                hojaAncho = ConstHojaAlto;
                td_heigh = ConstTd_width;
                td_width = ConstTd_heigh;
                pdfOrientacion = "l";
                $(".pagina").addClass("horizontal");

            break;

            default:

                hojaAlto = ConstHojaAlto;
                hojaAncho = ConstHojaAncho;
                td_heigh = ConstTd_heigh;
                td_width = ConstTd_width;
                pdfOrientacion = "p";
                $(".pagina").removeClass("horizontal");

            break;

        }


    });

    /* Archivo */
    /* Permite cambiar el formato de la hoja para permitir
    diferentes requerimientos especificos de cada archivo */

    $("#tipoArchivo").on("change",function(e){

        e.preventDefault();
        LimpiarDocumento();
        let archivo = $(this).val();
        console.log(archivo);
        switch(archivo){

            case "Etiquetas":

                catalogo = false;
                $("#orientacion").val('Horizontal');
                $("#orientacion").change();
                //$("#orientation").css('display','none');
                //$("#orientation").attr('disabled','disabled');

            break;

            default:

                catalogo = true;

            break;

        }

        agregarPagina();


    });

    /*
        1 = Left   mouse button
        2 = Centre mouse button
        3 = Right  mouse button
    */

    /* subrayar(Tabla) */

    $("#documento").on('mousedown','td',function(e){

        if(catalogo==true){

            if(e.which == 1){
                    
                e.preventDefault();
                tdInicio = this;
                let celda = calcularCelda(tdInicio);
                seleccion['presionado']['pagina'] = celda['pagina'];
                seleccion['presionado']['fila'] = celda['fila'];
                seleccion['presionado']['columna'] = celda['columna'];

                $("#documento").on('mouseenter','td',function(e){

                    if(tdInicio!=this){

                        e.preventDefault();
                        let celda = calcularCelda(this);

                        if(seleccion["presionado"]["pagina"]==celda["pagina"]){

                            limpiarSeleccion();
                            seleccion['liberado']['pagina'] = celda['pagina'];
                            seleccion['liberado']['fila'] = celda['fila'];
                            seleccion['liberado']['columna'] = celda['columna'];
                            seleccionarCelda();

                        }

                    }
                    else{

                        tdInicio = null;
                        limpiarSeleccion();

                    }

                });

            }

        }
    
    })
    .on('mouseup','td',function(e){
    
        if(catalogo==true){

            if(e.which == 1){

                $("#documento").unbind('mouseenter');

                if(tdInicio == this){

                    limpiarSeleccion();

                }

            }

        }

    });

    /* menu */
    /* muestra y ubica el menu dezplegable */
    $("#documento").on('contextmenu','td',function(e){

        console.log((catalogo)? 'catalogo':'etiquetas');
        if(catalogo==true){
            
            let seleccion = $(".seleccion");
            if(seleccion.length>0){

                $("#1").siblings().css('display','none');
                $("#1").css('display','block');

            }
            else{

                $("#1").css('display','none');
                $("#1").siblings().css('display','block');

            }

            $("#menu").css({'display':'block','left':e.pageX,'top':e.pageY});
            if(tdInicio==null || tdInicio!=this){

                tdInicio = this;

            }

            return false;

        }

    });

    /* contextmenu permite visualizar el menu al presionar el boton derecho
    del mouse */
    $("#menu").contextmenu(function(e){

        return false;

    });

    $(document).click(function(e){

        if(e.button == 0){

            $("#menu").css("display","none");

        }

    });

    $(document).keydown(function(e){

        if(e.keycode == 27){

            $("#menu").css("display","none");

        }

    });

    /* Evento menu */
    /* Al desplegar el menu se muestran tres opciones, y dependiento de la
    seleccionada, se realiza una opcion */
    $("#menu").click(function(e){

        switch(e.target.id){

            //Combinar Celdas
            case "1":

                console.log("Combinar");
                combinar();
                break;

            //Separar Celda
            case "2":
                
                console.log("Separar");
                separar();
                break;

            //Insertar Imagen
            case "3":
                
                console.log("Agregar Imagen");
                $("#imagen").trigger('click');
                break;

            case "4":

                console.log("Quitar imagen")
                quitarImagen();
                break;

            case "5":

                console.log("Eliminar Pagina")
                eliminarPagina();
                break;

        }

    });

    /* Insertar imagen */
    $("#imagen").on('change',function(e){

        input = this;
        let error = 0;
        if(input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {

                error = validarArchivo(input);
                switch(error){

                    case 0:

                        console.log("cambio");
                        let ruta = e.target.result;
                        agregarImagen(ruta);

                        break;

                    case 1:

                        alert("El Archivo no es compatible")

                        break;

                    case 2:

                        alert("El Archivo no puede superar los 100 MB");

                        break;

                }

                $("#imagen").replaceWith( $("#imagen").val('').clone( true ));

            }

            reader.readAsDataURL(input.files[0]);

        }

    });

    /***************************************************************/
    /* Funciones */

    /* Calcular celdas*/
    /* Permite convertir un objeto de tipo "td" en coordenadas de posicion */
    function calcularCelda(celda){

        var posicion = {

            pagina: null,
            fila: null,
            columna: null,

        }

        let pagina = $(celda).closest(".pagina").index();
        let fila = $(celda).closest('tr').index();
        let columna = $(celda).index();

        posicion["pagina"] = pagina;
        posicion['fila'] = fila;
        posicion['columna'] = columna;

        return posicion;

    }

    

    /* Seleccionar celdas */
    /* Es la funcion que se encarga de seleccionar las celdas de la pagina */
    function seleccionarCelda(){

        let tr = true;
        let td = true;

        let inicio = [];
        let fin = [];

        var pagina = seleccion["presionado"]["pagina"];

        inicio["pagina"] = pagina;
        fin["pagina"] = pagina;

        //Vertival
        /* establece el punto vertical menor como inicio y 
        al mayor como fin*/
        if(seleccion["presionado"]["fila"]<seleccion["liberado"]["fila"]){

            inicio["fila"] = seleccion["presionado"]["fila"];
            fin["fila"] = seleccion["liberado"]["fila"];

        }
        else{

            inicio["fila"] = seleccion["liberado"]["fila"];
            fin["fila"] = seleccion["presionado"]["fila"];

        }

        //Horizontal
        /* establece el punto horizontal menor como inicio y 
        al mayor como fin*/
        if(seleccion["presionado"]["columna"]<seleccion["liberado"]["columna"]){

            inicio["columna"] = seleccion["presionado"]["columna"];
            fin["columna"] = seleccion["liberado"]["columna"];

        }
        else{

            inicio["columna"] = seleccion["liberado"]["columna"];
            fin["columna"] = seleccion["presionado"]["columna"];

        }

        /* guarda los iniciadores de columna(hi) y fila(vi) */
        let hi = inicio["columna"];
        let vi = inicio["fila"];

        /* Variable que permite guardar aquellas celdas resultado de una
        combinacion, para evitar repetir la operacion */
        let celdasCombinadas = [];

        /* Es una variable que permite conocer el momento en el que existe un cambio,
        permite adaptar la seleccion a los cambios surgidos*/
        let cambio = false;

        while(tr){

            inicio['columna'] = hi;
            cambio = false;
            td = true;
            while(td){

                let celda = obtenerTd(inicio);
                
                var ancla = celda.attr("anclaje");
                
                /* Verifica si es producto de una cambinacion*/
                /* Tambien verifica que la operacion no se repita */
                if(typeof ancla !== "undefined" && !celdasCombinadas.includes(ancla)){

                    celdasCombinadas.push(ancla);

                    let coord = ancla.split("-");

                    let anclaCoord = {

                        'pagina': pagina,
                        fila: parseInt(coord[0]),
                        columna: parseInt(coord[1])

                    }

                    let celdaBase = obtenerTd(anclaCoord);
                    celdaBaseColumna = anclaCoord['columna']+((typeof celdaBase.attr('colspan') === 'undefined')? 0:celdaBase.attr('colspan')-1);
                    celdaBaseFila = anclaCoord['fila']+((typeof celdaBase.attr('rowspan') === 'undefined')? 0:celdaBase.attr('rowspan')-1)

                    if(anclaCoord['columna']<hi){

                        hi = anclaCoord['columna'];
                        cambio = true;

                    }

                    if(celdaBaseColumna>fin['columna']){

                        fin['columna'] = celdaBaseColumna;
                        cambio = true;

                    }

                    if(anclaCoord['fila']<vi){

                        vi = anclaCoord['fila'];
                        cambio = true;

                    }
                    
                    if(celdaBaseFila>fin['fila']){

                        fin['fila'] = celdaBaseFila;
                        cambio = true;

                    }

                }

                if(!cambio){

                    celda.closest('tr').addClass('indice');
                    celda.addClass("seleccion");
                    td = ( inicio['columna'] != fin['columna'] );
                    inicio['columna']++;

                }

                else{

                    break;

                }

            }

            if(!cambio){

                tr = ( inicio['fila'] != fin['fila'] );
                inicio['fila']++;

            }
            
            else{

                inicio['fila'] = vi;

            }

        }

    }

    /* Limpiar */
    /* Limpiar los td resultado de la seleccion */
    function limpiarSeleccion(){

        $("table td").removeClass("seleccion");
        $('table tr').removeClass('indice');

    }

    /* Combinar */
    /* Permite combinar los td resultados de una seleccion */
    /* Esta parte es meramente esterica, en realidad oculta casi todos los
    td, y deja uno, el cual se dimensionara para tomar el tamaño de los faltantes*/
    function combinar(){

        if($(".seleccion").length>0){

            let tr = $("table .indice");
            let td = tr.eq(0).find('.seleccion');

            let largo = tr.length;
            let ancho = td.length;;

            var posicion = {

                pagina: seleccion["presionado"]["pagina"],
                fila: tr.eq(0).index(),
                columna: td.eq(0).index(),

            }

            let anclaje = posicion['fila']+"-"+posicion['columna'];
            let inicio = obtenerTd(posicion);

            $(".seleccion").attr("anclaje",anclaje);
            
            inicio.removeClass("seleccion");
            inicio.attr('colspan',ancho);
            inicio.attr('rowspan',largo);
            
            inicio.css('min-height',(td_heigh*largo)+"mm");
            inicio.css('min-width',(td_width*ancho)+"mm");
            
            $(".seleccion").addClass("ocultar");
            $(".seleccion").removeAttr('style');
            
            limpiarSeleccion();
            tdInicio=null;

        }

    }

    /* Obtener td */
    /* busca y retorna el td de la tabla a la que hace referencia la posicion */
    function obtenerTd(td){

        if(td!=null && typeof td !== "undefined"){

            return $(".pagina").eq(td['pagina']).find("tr").eq(td['fila']).find("td").eq(td['columna']);

        }

        return null;

    }

    /* Seperar */
    /* Separa los td resultados de una combinacion */
    /* Esta parte es meramente estetica, pues en realidad, redimenciona los td,
    y visualiza aquellos ocultos*/
    function separar(){

        if(tdInicio!=null){

            let celda = calcularCelda(tdInicio);
            
            let anclaje = celda['fila']+"-"+celda['columna'];

            let celdasOcultas = $("td[anclaje='"+anclaje+"']");

            celdasOcultas.attr("rowspan",1);
            celdasOcultas.attr("colspan",1);

            celdasOcultas.css('min-height',td_heigh+"mm");
            celdasOcultas.css('min-width',td_width+"mm");

            celdasOcultas.removeClass("ocultar");
            celdasOcultas.removeAttr('anclaje');

        }
        tdInicio = null;

    }

    /* Agregar Imagen */
    function agregarImagen(ruta){

        if(tdInicio!=null){

            let celda = calcularCelda(tdInicio);
            let obtener = obtenerTd(celda);

            let imagen = 'background-image:url('+ruta+');';
            imagen += 'background-repeat:no-repeat;';
            imagen += 'background-size: 100% 100%;'; 
            imagen += 'width: 197; height: 279;"';

            obtener.attr('style',imagen);

        }

        tdInicio = null;

    }

    /* Quitar Imagen */
    function quitarImagen(){

        if(tdInicio!=null){

            let celda = calcularCelda(tdInicio);
            let obtener = obtenerTd(celda);

            console.log(obtener);
            obtener.removeAttr("style");

        }

    }

    /* Eliminar Pagina */
    function eliminarPagina(){

        let celda = calcularCelda(tdInicio);
        let paginas = $("#documento");
        if(paginas.children().length>1){

            //console.log(paginas.children('div').eq(celda['pagina']));
            paginas.children('div').eq(celda['pagina']).remove();

        }

        tdInicio = null;

    }

    /* Elimina todas las paginas */
    function LimpiarDocumento(){

        $('.pagina').remove()

    }

    /* Permite agregar una hoja */

    function agregarPagina(){

        console.log((pdfOrientacion=="l")? 'horizontal':'');
        let ClaseEtiquetas = ""
        let etiquetas = ""
        if(!catalogo){

            ClaseEtiquetas = 'etiquetas';
            etiquetas += "<div>"
            etiquetas += '<div contenteditable="true" maxlength="58" placeholder="Nombre Pieza" class="et-nombre"></div>';
            etiquetas += '<div contenteditable="true" maxlength="8" placeholder="Clave" class="et-clave"></div>';
            etiquetas += "</div>";

        }
        let pagina = '<div class="pagina '+((pdfOrientacion=="l")? 'horizontal':'')+'">';

        pagina += '<table>'

        pagina += '<tbody>'

        for(let j=0; j<4;j++){

            pagina += '<tr>';

                for(let i=0; i<4; i++){

                    pagina += '<td class="'+ClaseEtiquetas+'">'

                    pagina += etiquetas;

                    pagina += '</td>'

                }

            pagina += '</tr>';

        }

        pagina += '</tbody>';

        pagina += '</table>';

        pagina += '</div>';

        $("#documento").append(pagina);

    }

    /* Generer PDF */
    function generarPDF(nombreArchivo){

        let elementos = $(".pagina table");
        let td = elementos.find('td');
        if(elementos.length!=0){

            //console.log((pdfOrientacion=="l")? 'Horizontal':'Vertical');

            let pdf = new jsPDF(pdfOrientacion, 'mm', [hojaAlto,hojaAncho]);

            var width = pdf.internal.pageSize.width; 
            var height = pdf.internal.pageSize.height;

            var deferreds = [];

            sinBorde(td);

            $(".et-nombre").attr("placeholder","");
            $(".et-clave").attr("placeholder","");

            let imagenes = [];

            for(let i=0; i<elementos.length; i++){
                
                var deferred = $.Deferred();
                deferreds.push(deferred.promise());
                generateCanvas(elementos.get(i), i,deferred,imagenes);

            }

            $.when.apply($, deferreds).then(function () { // executes after adding all images

                let i = j = 0;

                while(typeof imagenes !== "undefined" && imagenes.length > 0){

                    if(imagenes[j]['indice']==i){

                        pdf.addImage(imagenes[j]['imagen'], 'PNG', -2, 0, width, height);
                        pdf.addPage();
                        imagenes.splice(j,1);
                        i++;
                        j = 0;

                    }
                    else{

                        j++;

                    }

                }

                var pageCount = pdf.internal.getNumberOfPages();
                pdf.deletePage(pageCount);
                pdf.save(nombreArchivo+'.pdf');
                td.removeClass("sinBorde");
                $(".et-nombre").attr("placeholder","Nombre Pieza");
                $(".et-clave").attr("placeholder","Clave");

            });

        }
        else{

            alert("Ocurrio un error inesperado, informar al programador");

        }

    }

    function generateCanvas(elemento, i, deferred,imagenes){

        html2canvas(elemento).then(function(canvas) {

            var ctx = canvas.getContext('2d');
            ctx.webkitImageSmoothingEnabled = false;
            ctx.mozImageSmoothingEnabled = false;
            ctx.imageSmoothingEnabled = false;
            var canvasImg = canvas.toDataURL("image/png,1.0");
            let imagen = {

                indice: i,
                imagen: canvasImg

            }

            imagenes.push(imagen);
            deferred.resolve();

        });

    }

    /***************************************************************/
    /* Funciones simples */

    function validarArchivo(valor){

        if(valor.files && valor.files[0]) {

            console.log("entre");
            var extensiones_permitidas = [".png", ".bmp", ".jpg", ".jpeg"];
            var tamano = 100; // EXPRESADO EN MB.
            var rutayarchivo = valor.value;
            var ultimo_punto = valor.value.lastIndexOf(".");
            var extension = rutayarchivo.slice(ultimo_punto, rutayarchivo.length);
            if(extensiones_permitidas.indexOf(extension) == -1){

                return 1;
                //alert("Extensión de archivo no valida");
            
            }
            else if((valor.files[0].size / 1048576) > tamano)
            {

                return 2;
                //alert("El archivo no puede superar los "+tamano+"MB");
                
            }

        }

        return 0;

    }

    /***************************************************************/
    /* Funciones Extras */

    $("#documento").on('keypress',"div[contenteditable='true'][maxlength]", function (event) {

        var cntMaxLength = parseInt($(this).attr('maxlength'));

        if ($(this).text().length >= cntMaxLength && event.keyCode != 8) {
            event.preventDefault();
        }

    });

    $("#documento").focusout("div[contenteditable='true']",function(){
        var element = $(this);        
        if (!element.text().replace(" ", "").length) {
            element.empty();
        }
    });

    /*===================================================================
    Quitar boorde
    ====================================================================*/

    /*
    $("#borde").change(function (){

        let elementos = $(".pagina table");
        let td = elementos.find('td');
        sinBorde(td);

    });
    */

    function sinBorde(td){

        if($("#borde").prop("checked") == false){

            td.addClass("sinBorde");
            td.find('div[contenteditable="true"]').addClass("sinBorde");

        }
        else{

            td.removeClass("sinBorde");
            td.find('div[contenteditable="true"]').removeClass("sinBorde");

        }

    }

});