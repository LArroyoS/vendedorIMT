<?php 

    require_once "../extensiones/fpdf/draw.php";
    require_once "../Controladores/productos.controlador.php";
    require_once "../Modelos/productos.modelo.php";
    require_once "../Controladores/clientes.controlador.php";
    require_once "../Modelos/clientes.modelo.php";
    require_once "../Controladores/usuarios.controlador.php";
    require_once "../Modelos/usuarios.modelo.php";
    require_once "../Controladores/cotizacion.controlador.php";
    require_once "../Modelos/cotizacion.modelo.php";

    class CotizacionPDF{

        public $folio;

        private function comoMoneda($value) {
            return '$' . number_format($value, 2);
        }

        private function comoPeso($value) {
            return number_format($value, 2).' kg';
        }

        private function comoTelefono($value){
            return "(".substr($value,0,3).")"." ".substr($value,5,3)." - ".substr($value,6,4);
        }

        public function mostrarCotizacion(){

            $pdf = 'error';

            if($this->folio!=""){

                $itemC = 'id';
                $valorC = $this->folio;
                $cotizacion = ControladorCotizacion::ctrInfoCotizacion($itemC,$valorC);

                if($cotizacion){

                    $ordenarDC = "id";
                    $itemDC = 'cotizacion_id';
                    $valorDC = $this->folio;
                    $detallesCotizacion = ControladorCotizacion::ctrListarDetalleCotizacion($ordenarDC,$itemDC,$valorDC);

                    $itemVendedor = 'id';
                    $valorVendedor = $cotizacion['vendedor_id'];
                    $vendedor = ControladorUsuarios::ctrMostrarUsuario($itemVendedor,$valorVendedor);

                    $itemCliente = 'id';
                    $valorCliente = $cotizacion['cliente_id'];
                    $cliente = ControladorClientes::ctrMostrarInfoCliente($itemCliente,$valorCliente);

                    if($detallesCotizacion && $cliente && $vendedor){

                        $fpdf = $this->generarCotizacion($cotizacion,$detallesCotizacion,$cliente,$vendedor);

                        $pdf = $fpdf->OutPut('S','cotizacion-'.$cliente['nombre'].'_'.$this->folio.".php");
                        $pdf = base64_encode($pdf);

                    }

                }

            }

            $resultado = array('resultado' => $pdf,);
            echo json_encode($resultado);

        }

        public function imprimirCotizacion(){

            $pdf = 'error';

            if($this->folio!=""){

                $itemC = 'id';
                $valorC = $this->folio;
                $cotizacion = ControladorCotizacion::ctrInfoCotizacion($itemC,$valorC);

                if($cotizacion){

                    $ordenarDC = "id";
                    $itemDC = 'cotizacion_id';
                    $valorDC = $this->folio;
                    $detallesCotizacion = ControladorCotizacion::ctrListarDetalleCotizacion($ordenarDC,$itemDC,$valorDC);

                    $itemVendedor = 'id';
                    $valorVendedor = $cotizacion['vendedor_id'];
                    $vendedor = ControladorUsuarios::ctrMostrarUsuario($itemVendedor,$valorVendedor);

                    $itemCliente = 'id';
                    $valorCliente = $cotizacion['cliente_id'];
                    $cliente = ControladorClientes::ctrMostrarInfoCliente($itemCliente,$valorCliente);

                    if($detallesCotizacion && $cliente && $vendedor){

                        $fpdf = $this->generarCotizacion($cotizacion,$detallesCotizacion,$cliente,$vendedor);

                        $fpdf->OutPut('D','cotizacion-'.$cliente['nombre'].'_'.$this->folio.".php");
                        $pdf = 'ok';

                    }

                }

            }

            $resultado = array('resultado' => $pdf,);
            echo json_encode($resultado);

        }

        public function generarCotizacion($cotizacion,$detallesCotizacion,$cliente,$vendedor){

            $alto = 6;
            $tamLetra = 10;
            $tipoLetra = 'Arial';

            $fpdf = new Draw();

            $fpdf->AddFont('calibri', '', 'calibri.php');
            $fpdf->AddFont('arlon', 'B', 'arlon.php');
            $fpdf->AddFont('rockwell', 'B', 'rockb.php');
            $fpdf->AddFont('junegull', 'B', 'junegull.php');
            //agrega pagina
            //no se requiere volver a usar a menos que se decee forzar agregar nueva pagina,
            //pues una ves agregada una pagina, se añaden nuevas si el contenido se sale
            //horoentacion y tamaño
            $fpdf->AddPage('PORTRAINT','A4');
            //Agrega estilo e fuente
            //fuente,estilo y tamaño
            $fpdf->SetFont($tipoLetra,'',$tamLetra);
            //cambia el color de la celda
            //rojo,verde,azul
            $fpdf->SetFillColor(194,194,194);
            $fpdf->SetDrawColor(0,0,0);
            //Agrega el texto en un tipo tabla
            //alto,ancho y texto + opcionales (bordes, ? ,alineacio, rellenar, link)

            /*================================================================================
            tabla 1 Costos (vendedor)
            =================================================================================*/
            $fpdf->SetFont($tipoLetra,'B',$tamLetra);
            $fpdf->Cell(35,$alto,utf8_decode("FOLIO:"),'LT',0,'',false);
            $fpdf->SetFont($tipoLetra,'',$tamLetra);
            $fpdf->Cell(130,$alto,utf8_decode($this->folio),'TR',0,"",false);
            $fpdf->SetFont($tipoLetra,'B',$tamLetra);
            $fpdf->Cell(30,$alto,utf8_decode("FECHA:"),'TLR',0,'C','',false);
            $fpdf->Ln();
            $fpdf->SetFont($tipoLetra,'B',$tamLetra);
            $fpdf->Cell(35,$alto,utf8_decode("VENDEDOR:"),'LB',0,'',false);
            $fpdf->SetFont($tipoLetra,'',$tamLetra);
            $fpdf->Cell(130,$alto,utf8_decode($vendedor['nombre']),'BR',0,'',false);

            $fecha = strtotime($cotizacion['fecha']);

            $fpdf->Cell(30,$alto,utf8_decode(date('d/m/Y',$fecha)),'BLR',0,'C'.false);
            $fpdf->Ln(11);

            /*================================================================================
            tabla 2 Costos (Cliente)
            =================================================================================*/

            $fpdf->SetHeight($alto);
            $fpdf->SetFontTable(array($tipoLetra,$tipoLetra));
            $fpdf->SetStyleFontTable(array('B',''));
            $fpdf->SetTamFontTable(array($tamLetra,$tamLetra));

            $fpdf->SetFont($tipoLetra,'B',$tamLetra);
            $fpdf->Cell(195,$alto,utf8_decode("DATOS DE FACTURACIÓN"),1,0,'C',true);
            $fpdf->Ln();
            $fpdf->SetWidths(array(55,140));
            $fpdf->Row(array(utf8_decode("NOMBRE DEL CLIENTE:"),
                    utf8_decode($cliente['nombre'])
                ));
            $fpdf->Row(array(utf8_decode("DIRECCIÓN: "),
                    utf8_decode($cliente['direccion'])
                ));

            $telefono = $this->comoTelefono($cliente['telefono']);

            $fpdf->Row(array(utf8_decode("TELÉFNO: "),
                    utf8_decode($telefono)
                ));
            $fpdf->Ln(5);

            /*================================================================================
            tabla 3 Costos (lista productos)
            =================================================================================*/
            $fpdf->SetFontTable(array($tipoLetra,$tipoLetra,$tipoLetra,$tipoLetra,$tipoLetra,$tipoLetra));
            $fpdf->SetStyleFontTable(array('B','B','B','B','B'));
            $fpdf->SetTamFontTable(array($tamLetra,$tamLetra,$tamLetra,$tamLetra,$tamLetra,$tamLetra));
            $fpdf->SetFont($tipoLetra,'B',$tamLetra);
            $fpdf->SetWidths(array(20,30,75,35,35));
            $fpdf->SetAligns(array('C','C','C','C','C'));
            $fpdf->SetbordeYrelleno(array('DF','DF','DF','DF','DF'));
            $fpdf->Row(array(utf8_decode("CANT."),
                            utf8_decode("CLAVE"),
                            utf8_decode("DESCRIPCIÓN"),
                            utf8_decode("PRECIO UNITARIO"),
                            utf8_decode("IMPORTE")));

            $fpdf->SetFont($tipoLetra,'',$tamLetra);
            $fpdf->SetAligns(array('C','C','L','C','R'));
            $fpdf->SetbordeYrelleno(array('','','','',''));
            $fpdf->SetStyleFontTable(array('B','','','',''));

            $subtotal = 0;
            foreach($detallesCotizacion as $key => $detalle){

                $item = 'id';
                $valor = $detalle['id'];
                $producto = ControladorProductos::ctrMostrarInfoProducto($item,$valor);

                $itemMarca = "id";
                $valorMarca = $producto['id_marca'];
                $marca = ControladorProductos::ctrMostrarInfoMarca($itemMarca,$valorMarca);

                $producto['id_marca'] = isset($marca['marca'])? $marca['marca']: 'Desconocida';

                $precio = (($producto['descuentoOferta']>0)? $producto['precioOferta']:$producto['precio']);
                $importe = $detalle['cantidad']*$precio;

                $fpdf->Row(array(utf8_decode($detalle['cantidad']),
                            utf8_decode($producto['SKU']),
                            utf8_decode($producto['titulo']),
                            utf8_decode($this->comoMoneda($precio)),
                            utf8_decode($this->comoMoneda($importe))));

            }

            $total = $cotizacion['subtotal']+$cotizacion['envio'];
            /*================================================================================
            tabla 4 Costos (subtotal, envio y total)
            =================================================================================*/
            $fpdf->SetFont($tipoLetra,'B',$tamLetra-1);
            $fpdf->Cell(62,6,utf8_decode("FORMAS DE PAGO"),0,0,'L',false);
            $fpdf->SetFont($tipoLetra,'B',$tamLetra-2);
            $fpdf->Cell(63,$alto,utf8_decode("PESOS MXN."),0,0,'C',false);
            $fpdf->SetFont($tipoLetra,'B',$tamLetra);
            $fpdf->Cell(35,$alto,utf8_decode("SUBTOTAL:"),1,0,'',false);
            $fpdf->SetFont($tipoLetra,'',$tamLetra);
            $fpdf->Cell(35,$alto,utf8_decode($this->comoMoneda($cotizacion['subtotal'])),1,0,'R',false);
            $fpdf->Ln();

            $fpdf->SetFont($tipoLetra,'B',$tamLetra-1);
            $fpdf->Cell(40,$alto,"BANCOMER: ",0,0,'L',false);
            $fpdf->SetFont($tipoLetra,'',$tamLetra-1);
            $fpdf->Cell(85,$alto,"0113993450",0,0,'L',false);
            $fpdf->SetFont($tipoLetra,'B',$tamLetra);
            $fpdf->Cell(35,$alto,utf8_decode("ENVIO:"),1,0,'',false);
            $fpdf->SetFont($tipoLetra,'',$tamLetra);
            $fpdf->Cell(35,$alto,utf8_decode($this->comoMoneda($cotizacion['envio'])),1,0,'R',false);
            $fpdf->Ln();
            $fpdf->SetFont($tipoLetra,'B',$tamLetra-1);
            $fpdf->Cell(40,$alto,"CLAVE INTERBANCARIA: ",0,0,'L',false);
            $fpdf->SetFont($tipoLetra,'',$tamLetra-1);
            $fpdf->Cell(85,$alto,"012180001139934501",0,0,'L',false);
            $fpdf->SetFont($tipoLetra,'B',$tamLetra);
            $fpdf->Cell(35,$alto,utf8_decode("TOTAL:"),1,0,'',false);
            $fpdf->SetFont($tipoLetra,'',$tamLetra);
            $fpdf->Cell(35,$alto,utf8_decode($this->comoMoneda($total)),1,0,'R',false);
            $fpdf->Ln(10);

            //Salto de linea
            //tamaño
            $fpdf->Ln();
            $fpdf->Close();

            return $fpdf;

        }

    }

    if(isset($_POST["folio"])){

        $cotizacion = new CotizacionPDF();
        $cotizacion->folio = $_POST['folio'];
        $cotizacion->mostrarCotizacion();

    }
    else if(isset($_POST["imprimir"])){

        $cotizacion = new CotizacionPDF();
        $cotizacion->folio = $_POST['imprimir'];
        $cotizacion->imprimirCotizacion();

    }
    else{

        echo json_encode(false);

    }


?>