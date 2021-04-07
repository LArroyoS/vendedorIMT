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

        public $vendedor;
        public $cliente;
        public $direccion;
        public $telefono;
        public $cantidad;
        public $sku;

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
                    $cliente = ControladorClientes::ctrMostrarInfoCliente($itemCliente,$valorCliente);

                }

                if(isset($vendedor['id']) && isset($cliente['id'])){

                    $datosCotizacion = array(
                        "vendedor_id"=>$vendedor['id'],
                        "cliente_id"=>$cliente['id'],
                        "envio"=> '',
                        "total"=> '',
                    );

                    $cotizacion = ControladorCotizacion::ctrRegistroCotizacion($datosCotizacion);
                    echo json_encode($cotizacion);

                    echo json_encode('______________'.$cotizacion);
                    if($cotizacion!='error'){

                        $subtotal = 0;
                        $itemProducto = 'SKU';
                        foreach($this->sku as $key => $sku1){

                            $valorProducto = $sku1;
                            $producto = ControladorProductos::ctrMostrarInfoProducto($itemProducto,$valorProducto);
                            $precio = (($producto['descuentoOferta']>0)? $producto['precioOferta']:$producto['precio']);
                            $importe =  $this->cantidad[$key]*$precio;

                            $datosDetalleCotizacion = array(
                                "cotizacion_id"=>$cotizacion,
                                "producto_id"=>$producto['id'],
                                "cantidad"=> $this->cantidad[$key],
                                "precio_unitario"=> $producto['precio'],
                                "descuentoOferta"=> $producto['descuentoOferta'],
                                'precioDescuento'=> $producto['precioOferta'],
                            );

                            $detalle_cotizacion = ControladorCotizacion::ctrRegistroDetalleCotizacion($datosDetalleCotizacion);
                            $subtotal += $importe;

                        }

                        $envio = 0;
                        if($subtotal<500){

                            $envio = 40;

                        }

                        $datosActualizaCotizacion = array(
                            'id' => $cotizacion,
                            "valor"=> $subtotal,
                        );

                        $itemActualizaCotizacion = 'subtotal';
                        $actualiza = ControladorCotizacion::ctrActualizarCotizacion($datosActualizaCotizacion,$itemActualizaCotizacion);

                        if($envio>0){

                            $datosActualizaCotizacion = array(
                                'id' => $cotizacion,
                                "envio"=> $envio,
                            );

                            $itemActualizaCotizacion = 'envio';
                            $actualiza = ControladorCotizacion::ctrActualizarCotizacion($datosActualizaCotizacion,$itemActualizaCotizacion);

                        }

                        $item = 'id';
                        $valor = $cotizacion;
                        $resultado = '';
                        $resultado = ControladorCotizacion::ctrInfoCotizacion($item,$valor);
                        echo json_encode('ppppppp');
                        echo json_encode($resultado);
                    }

                }

            }

            echo json_encode($resultado);

        }

    }

    if(isset($_POST["folio"])){


    }
    else if(isset($_POST['SKU'])){

        $cotizacion = new CotizacionPDF();
        $cotizacion->vendedor = $_POST['vendedor'];
        $cotizacion->cliente = $_POST['cliente'];
        $cotizacion->direccion = $_POST['direccion'];
        $cotizacion->telefono = $_POST['tel'];
        $cotizacion->cantidad = isset($_POST['cantidad'])? explode(',',$_POST['cantidad']): null;
        $cotizacion->sku = isset($_POST['SKU'])? explode(',',$_POST['SKU']): null;
        $cotizacion->generarCotizacion();

    }