<?php 

    require_once "../Controladores/productos.controlador.php";
    require_once "../Modelos/productos.modelo.php";
    require_once "../Controladores/clientes.controlador.php";
    require_once "../Modelos/clientes.modelo.php";
    require_once "../Controladores/usuarios.controlador.php";
    require_once "../Modelos/usuarios.modelo.php";
    require_once "../Controladores/cotizacion.controlador.php";
    require_once "../Modelos/cotizacion.modelo.php";

    class CotizacionPDF{

        public $vendedor;
        public $cliente;
        public $direccion;
        public $telefono;
        public $cantidad;
        public $sku;
        public $folio;
        private $envio = 40;

        public function consultarCotizacion(){

            $resultao = "error";
            
            if($this->folio!=""){

                $item = 'id';
                $valor = $this->folio;
                $cotizacion = ControladorCotizacion::ctrInfoCotizacion($item,$valor);

                if($cotizacion){

                    $itemVendedor = 'id';
                    $valorVendedor = $cotizacion['vendedor_id'];
                    $vendedor = ControladorUsuarios::ctrMostrarUsuario($itemVendedor,$valorVendedor);

                    $ordenarDC = "id";
                    $itemDC = 'cotizacion_id';
                    $valorDC = $this->folio;
                    $detallesCotizacion = ControladorCotizacion::ctrListarDetalleCotizacion($ordenarDC,$itemDC,$valorDC);

                    if($vendedor && $detallesCotizacion){

                        $cotizacion['id_vendedor'] = $vendedor['nombre'];
                        $detalle = array();
                        foreach($detallesCotizacion as $key => $productos){

                            $itemProducto = "id";
                            $valorProducto = $productos['producto_id'];
                            $producto = ControladorProductos::ctrMostrarInfoProducto($itemProducto,$valorProducto);

                            $itemMarca = "id";
                            $valorMarca = isset($producto['id_marca'])? $producto['id_marca']:null;
                            $marca = ControladorProductos::ctrMostrarInfoMarca($itemMarca,$valorMarca);

                            $productos['producto_id'] = isset($producto['SKU'])? $producto['SKU']: 'Desconocido';
                            $productos['producto_nombre'] = $producto['titulo'];
                            $productos['id_marca'] = isset($marca['marca'])? $marca['marca']: 'Desconocida';

                            $detalle[] = $productos;

                        }

                        $cotizacion['detalle'] = $detalle;
                        $resultado = $cotizacion;

                    }

                }

            }

            echo json_encode($resultado);

        }

        public function generarCotizacion(){

            $resultado = 'error';

            if($this->vendedor!="" && $this->cliente!="" &&
                $this->direccion!="" && $this->telefono!="" &&
                $this->cantidad!=null && $this->sku!=null){

                $itemVendedor = 'id';
                $valorVendedor = $this->vendedor;
                $vendedor = ControladorUsuarios::ctrMostrarUsuario($itemVendedor,$valorVendedor);

                $itemCliente = 'telefono';
                $valorCliente = $this->telefono; 
                $cliente = ControladorClientes::ctrMostrarInfoCliente($itemCliente,$valorCliente);

                if($cliente==false){

                    $datosCliente = array(
                        "nombre"=>$this->cliente,
                        "direccion"=>$this->direccion,
                        "telefono"=>$this->telefono,
                    );

                    $nuevoCliente = ControladorClientes::ctrInsertarCliente($datosCliente);

                }

                if(isset($vendedor['id'])){

                    $datosCotizacion = array(
                        "vendedor_id"=>$vendedor['id'],
                        "nombre_cliente"=>$this->cliente,
                        "direccion_cliente"=>$this->direccion,
                        "telefono"=>$this->telefono,
                        "envio"=> '',
                        "subtotal"=> '',
                    );

                    $conexion = Conexion::conectar();

                    Conexion::iniciarTransaccion($conexion);

                    $cotizacion = ControladorCotizacion::ctrRegistroCotizacion($datosCotizacion,$conexion);

                    if($cotizacion && is_numeric($cotizacion)){

                        try{

                            $subtotal = 0;
                            $itemProducto = 'SKU';
                            $detalle = true;

                            foreach($this->sku as $key => $sku1){

                                $valorProducto = $sku1;
                                $producto = ControladorProductos::ctrMostrarInfoProducto($itemProducto,$valorProducto,$conexion);
                                $precio = (($producto['descuentoOferta']>0)? $producto['precioOferta']:$producto['precio']);
                                $importe = $this->cantidad[$key]*$precio;

                                $datosDetalleCotizacion = array(
                                    "id" => ($key+1),
                                    "cotizacion_id"=>$cotizacion,
                                    "producto_id"=>$producto['id'],
                                    "cantidad"=> $this->cantidad[$key],
                                    "precio_unitario"=> $producto['precio'],
                                    "descuentoOferta"=> $producto['descuentoOferta'],
                                    'precioDescuento'=> $producto['precioOferta'],
                                );

                                $detalle_cotizacion = ControladorCotizacion::ctrRegistroDetalleCotizacion($datosDetalleCotizacion);
                                if($detalle_cotizacion!='ok'){

                                    $detalle = false;
                                    break;

                                }
                                else{

                                    $subtotal += $importe;

                                }

                            }

                            $datosActualizaCotizacion = array(
                                'id' => $cotizacion,
                                "valor"=> $subtotal,
                            );

                            $itemActualizaCotizacion = 'subtotal';
                            $actualizaSubtotal = ControladorCotizacion::ctrActualizarCotizacion($datosActualizaCotizacion,$itemActualizaCotizacion);

                            $actualizaEnvio = true;
                            if($subtotal<500){

                                $datosActualizaCotizacion = array(
                                    'id' => $cotizacion,
                                    "valor"=> $this->envio,
                                );

                                $itemActualizaCotizacion = 'envio';
                                $actualizaEnvio = ControladorCotizacion::ctrActualizarCotizacion($datosActualizaCotizacion,$itemActualizaCotizacion);

                            }

                            $item = 'id';
                            $valor = $cotizacion;
                            $resultado = ControladorCotizacion::ctrInfoCotizacion($item,$valor);

                            if($actualizaSubtotal && $actualizaEnvio && $detalle && $resultado){

                                Conexion::commit($conexion);

                            }
                            else{

                                Conexion::rollBack($conexion);

                            }

                        }
                        catch(PDOException $ex){

                            $respuesta = false;
                            Conexion::rollBack($conexion);

                        }

                    }

                }

            }

            echo json_encode($resultado);

        }

        public function sugerenciaCotizacion(){

            $valor = $this->folio;

            if($valor=="" || $valor==null){

                $valor=null;

            }

            $respuesta = ControladorCotizacion::ctrSugerenciaFolios($valor);
            /* encode: convierte array en string */
            echo json_encode($respuesta);
            //echo json_encode($datos)

        }

        public function ajaxValidarCompra(){

            $item = 'estado';
            $datos = array('id' => $this->folio,
                            'valor' => 1);

            $respuesta = ControladorCotizacion::ctrActualizarCotizacion($datos,$item);

            echo json_encode($respuesta);

        }

    }

    if(isset($_POST['tel']) && isset($_POST['SKU'])){

        $cotizacion = new CotizacionPDF();
        $cotizacion->vendedor = $_POST['vendedor'];
        $cotizacion->cliente = $_POST['cliente'];
        $cotizacion->direccion = $_POST['direccion'];
        $cotizacion->telefono = $_POST['tel'];
        $cotizacion->cantidad = isset($_POST['cantidad'])? explode(',',$_POST['cantidad']): null;
        $cotizacion->sku = isset($_POST['SKU'])? explode(',',$_POST['SKU']): null;
        $cotizacion->generarCotizacion();

    }
    else if(isset($_POST['folio'])){

        $cotizacion = new CotizacionPDF();
        $cotizacion->folio = $_POST['folio'];
        $cotizacion->consultarCotizacion();

    }
    else if(isset($_POST['folio'])){

        $cotizacion = new CotizacionPDF();
        $cotizacion->folio = $_POST['folio'];
        $cotizacion->consultarCotizacion();

    }
    else if(isset($_POST['sugerencia'])){

        $cotizacion = new CotizacionPDF();
        $cotizacion->folio = $_POST['sugerencia'];
        $cotizacion->sugerenciaCotizacion();

    }
    else if(isset($_POST['confirmar'])){

        $cotizacion = new CotizacionPDF();
        $cotizacion->folio = $_POST['confirmar'];
        $cotizacion->ajaxValidarCompra();

    }
    else{

        echo json_encode('error');

    }