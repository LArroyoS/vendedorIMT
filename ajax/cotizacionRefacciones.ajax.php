<?php 

    require_once "../extensiones/fpdf/draw.php";
    require_once "../Controladores/productos.controlador.php";
    require_once "../Modelos/productos.modelo.php";

    class CotizacionPDF{

        public $folio;
        public $vendedor;
        public $cliente;
        public $direccion;
        public $telefono;
        public $cantidad;
        public $sku;

        private function comoMoneda($value) {
            return '$' . number_format($value, 2);
        }

        private function comoPeso($value) {
            return number_format($value, 2).' kg';
        }

        public function generarCotizacion(){

            $pdf = 'error';

            if($this->folio!="" && $this->vendedor!="" && $this->cliente!="" &&
                $this->direccion!="" && $this->telefono!="" &&
                $this->cantidad!=null && $this->sku!=null){

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
                $fpdf->Cell(130,$alto,utf8_decode($this->vendedor),'BR',0,'',false);
                $fpdf->Cell(30,$alto,utf8_decode(date('d/m/Y')),'BLR',0,'C'.false);
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
                        utf8_decode($this->cliente)
                        ));
                $fpdf->Row(array(utf8_decode("DIRECCIÓN: "),
                                utf8_decode($this->direccion)
                                ));

                $formato = "(".substr($this->telefono,0,3).")"." ".substr($this->telefono,5,3)." - ".substr($this->telefono,6,4);

                $fpdf->Row(array(utf8_decode("TELÉFNO: "),
                                utf8_decode($formato)
                                ));
                $fpdf->Ln(5);

                /*================================================================================
                tabla 3 Costos (lista productos)
                =================================================================================*/
                $fpdf->SetFontTable(array($tipoLetra,$tipoLetra,$tipoLetra,$tipoLetra,$tipoLetra,$tipoLetra));
                $fpdf->SetStyleFontTable(array('B','B','B','B','B','B','B'));
                $fpdf->SetTamFontTable(array($tamLetra,$tamLetra,$tamLetra,$tamLetra,$tamLetra,$tamLetra));
                $fpdf->SetFont($tipoLetra,'B',$tamLetra);
                $fpdf->SetWidths(array(15,25,65,35,30,25));
                $fpdf->SetWidths(array(15,25,60,20,25,25,25));
                $fpdf->SetAligns(array('C','C','C','C','C','C','C'));
                $fpdf->SetbordeYrelleno(array('DF','DF','DF','DF','DF','DF','DF'));
                $fpdf->Row(array(utf8_decode("CANT."),
                                utf8_decode("CLAVE"),
                                utf8_decode("DESCRIPCIÓN"),
                                utf8_decode("MARCA"),
                                utf8_decode("PESO"),
                                utf8_decode("PRECIO UNITARIO"),
                                utf8_decode("IMPORTE")));

                $fpdf->SetFont($tipoLetra,'',$tamLetra);
                $fpdf->SetAligns(array('C','C','L','C','C','C','R'));
                $fpdf->SetbordeYrelleno(array('','','','','','',''));
                $fpdf->SetStyleFontTable(array('B','','','','','',''));

                $subtotal = 0;
                foreach($this->sku as $key => $sku1){

                    $item = 'SKU';
                    $valor = $sku1;
                    $producto = ControladorProductos::ctrMostrarInfoProducto($item,$valor);

                    $itemMarca = "id";
                    $valorMarca = $producto['id_marca'];
                    $marca = ControladorProductos::ctrMostrarInfoMarca($itemMarca,$valorMarca);

                    $producto['id_marca'] = isset($marca['marca'])? $marca['marca']: 'Desconocida';

                    $precio = $this->cantidad[$key]*$producto['precio'];
                    $subtotal += $precio; 
                    $fpdf->Row(array(utf8_decode($this->cantidad[$key]),
                                utf8_decode($producto['SKU']),
                                utf8_decode($producto['titulo']),
                                utf8_decode($producto['id_marca']),
                                utf8_decode($this->comoPeso($producto['peso'])),
                                utf8_decode($this->comoMoneda($producto['precio'])),
                                utf8_decode($this->comoMoneda($precio))));

                }

                /*================================================================================
                tabla 4 Costos (subtotal, envio y total)
                =================================================================================*/
                $fpdf->SetFont($tipoLetra,'B',$tamLetra);
                $fpdf->Cell(145,$alto,utf8_decode("PESOS MXN."),0,0,'C',false);
                $fpdf->Cell(25,$alto,utf8_decode("SUBTOTAL:"),1,0,'',false);
                $fpdf->SetFont($tipoLetra,'',$tamLetra);
                $fpdf->Cell(25,$alto,utf8_decode($this->comoMoneda($subtotal)),1,0,'R',false);
                $fpdf->Ln();

                $envio = 0;
                if($subtotal<500){

                    $envio = 40;

                }

                $total = $subtotal+$envio;

                $fpdf->SetFont($tipoLetra,'B',$tamLetra);
                $fpdf->Cell(145,$alto,"",0,0,'C',false);
                $fpdf->Cell(25,$alto,utf8_decode("ENVIO:"),1,0,'',false);
                $fpdf->SetFont($tipoLetra,'',$tamLetra);
                $fpdf->Cell(25,$alto,utf8_decode($this->comoMoneda($envio)),1,0,'R',false);
                $fpdf->Ln();
                $fpdf->SetFont($tipoLetra,'B',$tamLetra);
                $fpdf->Cell(145,$alto,"",0,0,'C',false);
                $fpdf->Cell(25,$alto,utf8_decode("TOTAL:"),1,0,'',false);
                $fpdf->SetFont($tipoLetra,'',$tamLetra);
                $fpdf->Cell(25,$alto,utf8_decode($this->comoMoneda($total)),1,0,'R',false);
                $fpdf->Ln(10);

                $fpdf->Close();
                $pdf = $fpdf->OutPut('S','cotizacion-'.$this->cliente.$this->folio.".php");
                $pdf = base64_encode($pdf);

            }

            $resultado = array('resultado' => $pdf,);
            echo json_encode($resultado);

        }

    }

    if(isset($_POST["folio"])){

        $cotizacion = new CotizacionPDF();
        $cotizacion->folio = $_POST['folio'];
        $cotizacion->vendedor = $_POST['vendedor'];
        $cotizacion->cliente = $_POST['cliente'];
        $cotizacion->direccion = $_POST['direccion'];
        $cotizacion->telefono = $_POST['tel'];
        $cotizacion->cantidad = isset($_POST['cantidad'])? explode(',',$_POST['cantidad']): null;
        $cotizacion->sku = isset($_POST['SKU'])? explode(',',$_POST['SKU']): null;
        $cotizacion->generarCotizacion();

    }
    else{

        echo json_encode(false);

    }


?>