<?php

use Dompdf\Dompdf;

class Ventas extends controller
{

  private $mdlVentas;
  private $mdlCliente;
  private $mdlProducto;
  private $mdlTipoPersona;
  private $modeloP;
  private $meses = [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre',
  ];


  public function __construct(){
    $this->mdlVentas = $this->loadModel("mdlVentas");
    $this->mdlCliente = $this->loadModel("mdlCliente");
    $this->mdlProducto = $this->loadModel("mdlProducto");
    $this->mdlTipoPersona = $this->loadModel("mdlTipoPersona");
    $this->modeloP = $this->loadModel("mdlPersona");

  }

  public function validacion(){
      $this->mdlVentas->__SET("idProducto", $_POST['id']);
      //$this->mdlVentas->__SET("cantidad", $_POST['campoCant']);
      $ValidarCant = $this->mdlVentas->validarCantidad();

      echo json_encode($ValidarCant);
  }


  public function generarpdfCreditos()
  {

    if(isset($_POST['btnconsultar'])){
      $fi = new DateTime($_POST['txtfechainicial1']);
      $ff = new DateTime($_POST['txtfechafinal1']);

      $fechaI = new DateTime($fi->format("Y-m-01"));
      $fechaF = new DateTime($ff->format("Y-m-t"));

      $intervalo = DateInterval::createFromDateString("1 month");
      $period = new DatePeriod($fechaI, $intervalo, $fechaF);
      $meses = [];

      foreach($period AS $p){
        $meses[] = ['mes' => $p->format('m'), 'anio' => $p->format('Y'), 'nombre_mes' => $this->meses[intval($p->format('m')) - 1]];
      }

      $primerMes = $meses[0];
      if(count($meses) > 1){
        $ultimoMes = $meses[count($meses) - 1];
        $rango = $primerMes['nombre_mes'] . " de " . $primerMes['anio'];
        $rango .= " hasta ";
        $rango .= $ultimoMes['nombre_mes'] . " de " . $ultimoMes['anio'];

      } else {
        $rango = $primerMes['nombre_mes'] . " de " . $primerMes['anio'];;
      }
      $this->mdlVentas->__SET('fechainicial',date("Y-m-d",strtotime($_POST['txtfechainicial1'])));
      $this->mdlVentas->__SET('fechafinal',date("Y-m-d",strtotime($_POST['txtfechafinal1'])));
      $ver = $this->mdlVentas->listarpdf();
      $totalCreditosFecha = $this->mdlVentas->listarCreditosFecha();
    }

    require_once APP . 'libs/dompdf/autoload.inc.php';
    // $urlImagen = URL . 'producto/generarcodigo?id=';
    // $productos = $this->mdlproducto->listar();
      $listarC = $this->mdlVentas->listarCreditosPdf();
    ob_start();
    require APP . 'view/Ventas/pdfCreditos.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    // $dompdf->load_html_file($urlImagen);
    $dompdf->setPaper('A4', 'landscape');
    //$dompdf->setPaper([0,0,200,841], 'portrait');
    $dompdf->render();
    $dompdf->stream("Informe Créditos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
  }


  public function generarpdfDetallesVentas()
  {
    $id = $_GET['txtId'];

    if(isset($id)){

    $detalles = $this->mdlVentas->getDetallesVenta($id);
    $info = $this->mdlVentas->getInfoVenta($id);
    $tabla = "";
    foreach ($detalles as $value) {
      $tabla .= '<tr>';
      $tabla .= '<td class="center">' . $value['id_producto'] . '</td>';
      $tabla .= '<td class="center">' . ucwords($value['nombre_producto']) . '</td>';
      $tabla .= '<td class="center">' . $value['cantidad'] . ' unidades</td>';
      $tabla .= '<td class="center"> $ ' . number_format($value['precio_venta'], "0", ".", ".") . '</td>';
      $tabla .= '<td class="price center"> $ ' . number_format($value['cantidad'] * $value['precio_venta'], "0",".", ".") . '</td>';
      $tabla .= '</tr>';
    }

    require_once APP . 'libs/dompdf/autoload.inc.php';
    ob_start();
    require APP . 'view/Ventas/pdfDetallesVentas.php';


    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    // $dompdf->load_html_file($urlImagen);
    // $dompdf->setPaper('A4', 'landscape');
    $dompdf->setPaper([0,0,380,841], 'portrait');
    $dompdf->render();
    $dompdf->stream("Recibo de Caja.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
  }
}


public function generarpdfDetallesVentas2()
{
  //$id = $_GET['txtId'];
  $id = $_GET['id'];

  if(isset($id)){

  $detalles = $this->mdlVentas->getDetallesVenta($id);
  $info = $this->mdlVentas->getInfoVenta($id);
  $tabla = "";
  foreach ($detalles as $value) {
    $tabla .= '<tr>';
    $tabla .= '<td class="center">' . $value['id_producto'] . '</td>';
    $tabla .= '<td class="center">' . ucwords($value['nombre_producto']) . '</td>';
    $tabla .= '<td class="center">' . $value['cantidad'] . ' unidades</td>';
    $tabla .= '<td class="center"> $ ' . number_format($value['precio_venta'], "0", ".", ".") . '</td>';
    $tabla .= '<td class="price center"> $ ' . number_format($value['cantidad'] * $value['precio_venta'], "0", ".", ".") . '</td>';
    $tabla .= '</tr>';
  }

  require_once APP . 'libs/dompdf/autoload.inc.php';
  ob_start();
  require APP . 'view/Ventas/pdfDetallesVentas.php';


  $html = ob_get_clean();
  $dompdf = new Dompdf();
  $dompdf->loadHtml($html);
  // $dompdf->load_html_file($urlImagen);
  // $dompdf->setPaper('A4', 'landscape');
  $dompdf->setPaper([0,0,380,830], 'portrait');
  $dompdf->render();
  $dompdf->stream("Informe Ventas.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
}
}


  public function generarpdfDetalleAbonos()
  {
    $id = $_GET['id'];

    $info = $this->mdlVentas->pdfDetallesAbono2($id);

    $tabla2 = "";
    foreach ($info as $val) {
      // var_dump($val);
      // exit();
      $tabla2 .= '<tr>';
      $tabla2 .= '<td style="text-align: center"> $ ' . number_format($val['total_venta'], "0", ".", ".") . '</td>';
      $tabla2 .= '<td style="text-align: center"> $ ' . number_format($val['valor_abono'], "0", ".", ".") . '</td>';
      $tabla2 .= '<td style="text-align: center"> $ ' . number_format($val['total_abonado'], "0", ".", ".") . '</td>';
      $tabla2 .= '<td style="text-align: center"> $ ' . number_format($val['pendiente'], "0", ".", ".") . '</td>';
      $tabla2 .= '</tr>';
    }

    require_once APP . 'libs/dompdf/autoload.inc.php';
    ob_start();
    require APP . 'view/Ventas/pdfDetallesAbonos.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    // $dompdf->load_html_file($urlImagen);
    // $dompdf->setPaper('A4', 'landscape');
    $dompdf->setPaper([0,0,300,700], 'portrait');
    $dompdf->render();
    $dompdf->stream("Recibo Abono Créditos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
  }




  public function informeVentas()
     {
       require APP . 'view/_templates/header.php';
       require APP. 'view/Ventas/reporteVentas.php';
       require APP . 'view/_templates/footer.php';
     }


     public function informeGanancias()
        {
          require APP . 'view/_templates/header.php';
          require APP. 'view/Ventas/pdfinformeGanancias.php';
          require APP . 'view/_templates/footer.php';
        }


     public function pdfVentas()
        {
          if(isset($_POST['btnconsultar'])){


            $fi = new DateTime($_POST['txtfechainicial1']);
            $ff = new DateTime($_POST['txtfechafinal1']);

            $fechaI = new DateTime($fi->format("Y-m-01"));
            $fechaF = new DateTime($ff->format("Y-m-t"));

            $intervalo = DateInterval::createFromDateString("1 month");
            $period = new DatePeriod($fechaI, $intervalo, $fechaF);
            $meses = [];

            foreach($period AS $p){
              $meses[] = ['mes' => $p->format('m'), 'anio' => $p->format('Y'), 'nombre_mes' => $this->meses[intval($p->format('m')) - 1]];
            }

            $primerMes = $meses[0];
            if(count($meses) > 1){
              $ultimoMes = $meses[count($meses) - 1];
              $rango = $primerMes['nombre_mes'] . " de " . $primerMes['anio'];
              $rango .= " hasta ";
              $rango .= $ultimoMes['nombre_mes'] . " de " . $ultimoMes['anio'];

            } else {
              $rango = $primerMes['nombre_mes'] . " de " . $primerMes['anio'];;
            }

            $this->mdlVentas->__SET('fechainicial',date("Y-m-d",strtotime($_POST['txtfechainicial1'])));
            $this->mdlVentas->__SET('fechafinal',date("Y-m-d",strtotime($_POST['txtfechafinal1'])));
            $ver = $this->mdlVentas->listarpdf();
            $totalVentasPorFecha = $this->mdlVentas->listarTotalFecha();

          }
          require_once APP . 'libs/dompdf/autoload.inc.php';
          // $urlImagen = URL . 'producto/generarcodigo?id=';
          // $productos = $this->mdlproducto->listar();
          ob_start();
          require APP . 'view/Ventas/pdfinformeVentas.php';
          $html = ob_get_clean();
          $dompdf = new Dompdf();
          $dompdf->loadHtml($html);
          // $dompdf->load_html_file($urlImagen);
          $dompdf->setPaper('A4', 'landscape');
          $dompdf->render();
          $dompdf->stream("Informe Ventas.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));

        }


        public function reporteGanancias()
           {

                 $this->mdlVentas->__SET('fechainicial',date("Y-m-d",strtotime($_POST['fecha1'])));
                 $this->mdlVentas->__SET('fechafinal',date("Y-m-d",strtotime($_POST['fecha2'])));

                     $detalles = $this->mdlVentas->listarganancias();

                     $cabecera = "";
                     $cabecera .= '<th>'.'El promedio de ganancias en el rango de fecha ingresado es de:&nbsp; ';
                     $cabecera .= '<td class="price"><strong> $ '.number_format($detalles["ganancias"], "0", ".", ".").'</strong></td>';
                     $cabecera .= '</th>';

                 echo json_encode([
                   'html' => $cabecera
                 ]);

     }


    public function index(){
      $listarConfiguracionVentas = $this->mdlVentas->listarConfiguracionVentas();
      $configuracion = $this->mdlVentas->listarConfiguracionVentas();

    if (isset ($_POST["btnRegistrarConfig"])) {
      $this->mdlVentas->__SET("_ValSubtotal_Minimo", $_POST["txtvalorminimo"]);
      $this->mdlVentas->__SET("_Porcentaje_MinimoD", $_POST["txtporcentajeminimo"]);
      $this->mdlVentas->__SET("_ValSubtotal_Maximo", $_POST["txtvalormaximo"]);
      $this->mdlVentas->__SET("_Porcentaje_MaximoD", $_POST["txtporcentajemaximo"]);
      if ($this->mdlVentas->modificarConfiguracionVentas()) {
          $_SESSION['alerta'] = 'swal({
            title: "Modificación exitosa!",
            type: "success",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          })';

          header("Location: ". URL . "otro/index");
          exit();
      }

    }

      if(isset($_POST['btn-guardar-venta'])){
          if($_POST['txtpago'] == "1"){
            $this->mdlVentas->__SET("valor_subtotal", $_POST['txtsubtotal']);
            $this->mdlVentas->__SET("valor_total", $_POST['txttotal']);
            $this->mdlVentas->__SET("codigo_cliente", $_POST['ddlcliente']);
            $this->mdlVentas->__SET("tipo_Pago", $_POST['txtpago']);
            $this->mdlVentas->__SET("codigoEmpleado", $_POST['empleado']);
            $this->mdlVentas->__SET("descuento", $_POST['txtdescuento']);
            $this->mdlVentas->__SET("dias_credito", $_POST['txtplazo']);

            $C = $this->mdlVentas->insertarVentaCredito();
            if($C){
              for ($i=0; $i < count($_POST['producto']); $i++) {
                $this->mdlVentas-> insertarDetalleVenta($_POST['producto'][$i], $_POST['cantidad'][$i], $_POST['precioProducto'][$i], $_POST['precioUnitario'][$i]);
              }
            }else{
              $_SESSION['alerta'] = 'swal({
                title: "Error en el registro!",
                type: "error",
                confirmButton: "#3CB371",
                confirmButtonText: "Aceptar",
                // confirmButtonText: "Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
              })';
              header("Location:".URL.'Ventas/index');
              exit();
              return false;
            }

          } else {
            $this->mdlVentas->__SET("valor_subtotal", $_POST['txtsubtotal']);
            $this->mdlVentas->__SET("valor_total", $_POST['txttotal']);
            $this->mdlVentas->__SET("codigo_cliente", $_POST['ddlcliente']);
            $this->mdlVentas->__SET("tipo_Pago", $_POST['txtpago']);
            $this->mdlVentas->__SET("codigoEmpleado", $_POST['empleado']);
            $this->mdlVentas->__SET("descuento", $_POST['txtdescuento']);

            $C = $this->mdlVentas->insertarVenta();
            if($C){
              for ($i=0; $i < count($_POST['producto']); $i++) {
                $this->mdlVentas-> insertarDetalleVenta($_POST['producto'][$i], $_POST['cantidad'][$i], $_POST['precioProducto'][$i], $_POST['precioUnitario'][$i]);
              }
              // var_dump($ultVenta);
              // exit();
            }else{
              $_SESSION['alerta'] = 'swal({
                title: "Error en el registro!",
                type: "error",
                confirmButton: "#3CB371",
                confirmButtonText: "Aceptar",
                // confirmButtonText: "Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
              })';
              header("Location:".URL.'Ventas/index');
              exit();
              return false;
            }
          }
          $ultVenta = $this->mdlVentas->ultimoId();

          $_SESSION['alerta'] = 'swal({
                  title: "Guardado exitoso!",
                  text: "¿Desea imprimir el recibo de caja?",
                  type: "success",
                  confirmButtonColor: "#3CB371",
                  cancelButtonText: "No",
                  showCancelButton: true,
                  confirmButtonText: "Sí",
                  closeOnConfirm: true,

                  },
                  function(isConfirm){
                  if (isConfirm) {
                    window.open("'.URL.'Ventas/generarpdfDetallesVentas?txtId='.$ultVenta['ultimo_id'].'");
                  }
                })';

                header("Location: ".URL."Ventas/index");
                exit();
      }

      $cliente = $this->mdlCliente->listar();
      $producto = $this->mdlProducto->listar();
      $tipo = $this->mdlTipoPersona->listarTipoPersonas();
      $configuraciones = $this->mdlProducto->consultarConfiguracionVentas();
      $TipoPersona = $this->mdlTipoPersona->listarTipoClientes();

      require APP . 'view/_templates/header.php';
      require APP . 'view/Ventas/registrarVentas.php';
      require APP . 'view/_templates/footer.php';
    }


    public function ultimaVenta(){
      $this->mdlVentas->__SET("codigo_venta", $_POST['']);
    }


  public function listarVentas(){
    $Ventas = $this->mdlVentas->listarVentas();
    $cliente = $this->mdlCliente->listar();
    $producto = $this->mdlProducto->listar();
    require APP . 'view/_templates/header.php';
    require APP . 'view/Ventas/listarVentas.php';
    require APP . 'view/_templates/footer.php';
  }

  public function listarConfiguracionVentas(){
    require APP . 'view/_templates/header.php';
    require APP . 'view/Ventas/listarConfiguracionVentas.php';
    require APP . 'view/_templates/footer.php';
  }


   public function ajaxDetallesVenta(){
      $detalles = $this->mdlVentas->getDetallesVenta($_POST['idVenta']);
      $info = $this->mdlVentas->getInfoVenta($_POST['idVenta']);

      $html = "";
      foreach ($detalles as $key => $value) {
        $html .= '<tr>';
        $html .= '<td>' . ucwords($value['nombre_producto']) . '</td>';
        $html .= '<td class="price">' . $value['precio_venta'] . '</td>';
        $html .= '<td>' . $value['cantidad'] . ' unidades</td>';
        $html .= '<td class="price">' . $value['cantidad'] * $value['precio_venta'] . '</td>';
        $html .= '</tr>';
      }
      echo json_encode([
        'codigoV'=>$info['id_ventas'],
        'empleado'=>$info['empleado'],
        'fecha' => $info['fecha_venta'],
        'cliente' => $info['cliente'],
        'subtotal' => $info['subtotal_venta'],
        'descuento' => $info['descuento'],
        'total' => $info['total'],
        'html' => $html,
      ]);
    }

    public function modificarEstado(){

      $guardar = false;
      $error = false;
      if($this->validarAbonos($_POST['id'])){
        $error = true;
        $estado = false;
        echo json_encode(["v"=>1]);
      } else {
        $estado = $this->mdlVentas->cambiarEstado($_POST['id'], $_POST['estado']);

        if($estado){
          echo json_encode(["v"=>1]);
        }else{
          echo json_encode(["v"=>0]);
        }

      }

      if($estado){
        $guardar = true;
      }
      else {
        $error = true;
      }

  if($guardar == true)
  {
  $_SESSION['alerta'] =  'swal({
    title: "Venta anulada!",
    type: "error",
    confirmButton: "#3CB371",
    confirmButtonText: "Aceptar",
    // confirmButtonText: "Cancelar",
    closeOnConfirm: false,
    closeOnCancel: false
  })';
  }

  if($error == true)
  {
  $_SESSION['alerta'] =  'swal({
    title: "Error al intentar anular la Venta!",
    type: "error",
    confirmButton: "#3CB371",
    confirmButtonText: "Aceptar",
    // confirmButtonText: "Cancelar",
    closeOnConfirm: false,
    closeOnCancel: false
  })';
  }
}


private function validarAbonos($idVenta){
  $resultados = $this->mdlVentas->getAbonos($idVenta);
  $total = intval($resultados['total']);
  return $total > 0;
}


    public function factura($cod){
      $factura = $this->mdlVentas->facturaVenta($cod);
      require APP."view/Ventas/factura.php";
    }



    public function listarVentasCredito(){


    if (isset($_POST["btnmodificarCredito"])) {

      $this->mdlVentas->__SET("dias_credito",$_POST["txtdiaslimiteCredito"]);
      $this->mdlVentas->__SET("codigo_venta",$_POST["txthiddenCredito"]);
      $modFecha = $this->mdlVentas->modificarCredito();


      if ($modFecha == true) {
          $_SESSION['alerta'] = ' swal({
              title: "Modificación exitosa!",
              type: "success",
              confirmButton: "#3CB371",
              confirmButtonText: "Aceptar",
              // confirmButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
            })';

            header("Location: ".URL."Ventas/listarVentasCredito");
            exit();
        }
        else
        {
          $_SESSION['alerta'] = ' swal({
              title: "Error en la modificación!",
              type: "error",
              confirmButton: "#3CB371",
              confirmButtonText: "Aceptar",
              // confirmButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
            })';
            header("Location: ".URL."Ventas/listarVentasCredito");
            exit();
        }
    }

    $clientesCredito = $this->mdlVentas->listarClientesCreditoV();
    $notificacionCredito = $this->mdlVentas->listarNotificacionesCredito();
    require APP . 'view/_templates/header.php';
    require APP . 'view/Ventas/listarCreditosVentas.php';
    require APP . 'view/_templates/footer.php';
  }



  public function listarClientesCredito(){

  $clientesCredito = $this->mdlVentas->listarClientesCreditoV();
  $notificacionCredito = $this->mdlVentas->listarNotificacionesCredito();
  $info = $this->mdlVentas->estadoAbono();
  require APP . 'view/_templates/header.php';
  require APP . 'view/Ventas/listarClientesCredito.php';
  require APP . 'view/_templates/footer.php';
}



  public function ajaxDetalleCreditosV()
  {
    $detalle = $this->mdlVentas->getDetalleCreditosV($_POST['idPersona']);
      $html = "";
          foreach ($detalle as $val) {
            $totalCredit = $val['total_venta'];
            $abonoCredit = $val['total_abonado'];
            $pendienteCredit = $totalCredit - $abonoCredit;
            $html .= '<tr>';
            $html .= '<td>'.$val['tipo_documento'].'</td>';
            $html .= '<td>'.$val['id_persona'].'</td>';
            $html .= '<td>'.$val['id_ventas'].'</td>';
            $html .= '<td>'.$val['fecha_venta'].'</td>';
            $html .= '<td>'.$val['fecha_limite_credito'].'</td>';
            $html .= '<td class="price">'.$val['total_venta'].'</$abonoCredit td>';
            $html .= '<td class="price">'.$val['total_abonado'].'</td>';
            $html .= '<td class="price">'.$pendienteCredit.'</td>';
              if($val["estado_credito"] == 0){
                $estado = "Pagado";
              } else if($val["estado_credito"] == 1) {
                $estado = "Pendiente";
              } else if($val["estado_credito"] == 2){
                $estado = "Condonado";
              }

              $html .= '<td>'.$estado.'</td>';
              $html .= '<td>';
              if($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3){
              if($val['estado_credito'] == 1){
                $html .= '<button type="button" id="idAbonoCreditV_btn" class="btn btn-warning btn-circle btn-md" onclick="abonosV('.$val['total_venta'].','.$val['id_ventas'].','.$pendienteCredit.')" title="Abonar"><i class="fa fa-money" aria-hidden="true"></i></button>';
                $html .= ' <button  title="Modificar Fecha Crédito" type="button" class="btn btn-success btn-circle btn-md" data-toggle="modal" onclick="ModificarCreditos('.$val['id_ventas'].')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
              }
              $html .= ' <button type="button" onclick="traerDetalleAbonosCreditosV('.$val["id_ventas"].')" class="btn btn-primary btn-circle btn-md" title="Ver Abonos"><i class="fa fa-eye" aria-hidden="true" ></i></button>';
            }
            if($_SESSION['ROL'] == 2){
            if($val['estado_credito'] == 1){
              $html .= '<button type="button" id="idAbonoCreditV_btn" class="btn btn-warning btn-circle btn-md" onclick="abonosV('.$val['total_venta'].','.$val['id_ventas'].','.$pendienteCredit.')" title="Abonar"><i class="fa fa-money" aria-hidden="true"></i></button>';
            }
            $html .= ' <button type="button" onclick="traerDetalleAbonosCreditosV('.$val["id_ventas"].')" class="btn btn-primary btn-circle btn-md" title="Ver Abonos"><i class="fa fa-eye" aria-hidden="true" ></i></button>';
          }
              if($val['estado_credito'] != 0){
                  if($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3){
                $html .= ' <button  title="Cambiar Estado" type="button" class="btn btn-danger btn-circle btn-md" data-toggle="modal" onclick="cambiarestado2('.$val["id_ventas"].', 2)"><i class="fa fa-refresh" aria-hidden="true"></i></button>';
              }
            }
              $html .= '</td></tr>';         //traerDetalleAbonosCreditosV()
          }
              $cabecera = '<tr>';
              $cabecera .= '<th>'.'Tipo de Documento'.'</th>';
              $cabecera .= '<th>'.'Identificación Cliente'.'</th>';
              $cabecera .= '<th>'.'Código Venta'.'</th>';
              $cabecera .= '<th>'.'Fecha Venta'.'</th>';
              $cabecera .= '<th>'.'Fecha Límite'.'</th>';
              $cabecera .= '<th>'.'Total Venta'.'</th>';
              $cabecera .= '<th>'.'Total Abonado'.'</th>';
              $cabecera .= '<th>'.'Crédito Pendiente'.'</th>';
              $cabecera .= '<th>'.'Estado Crédito'.'</th>';
              $cabecera .= '<th>'.'Opciones'.'</th>';
              $cabecera .= '</tr>';

              echo json_encode([
              'html' => $html,'cabecera'=>$cabecera
              ]);
  }



  public function generarReciboAbonos()
  {
    $id = $_GET['txtId'];

    if(isset($id)){

    $info = $this->mdlVentas->pdfDetallesAbono($id);

    $tabla2 = "";
    foreach ($info as $val) {
      $tabla2 .= '<tr>';
      $tabla2 .= '<td> $ ' . number_format($val['total_venta'], "0", ".", ".") . '</td>';
      $tabla2 .= '<td> $ ' . number_format($val['valor_abono'], "0", ".", ".") . '</td>';
      $tabla2 .= '<td> $ ' . number_format($val['total_abonado'], "0", ".", ".") . '</td>';
      $tabla2 .= '<td> $ ' . number_format($val['pendiente'], "0", ".", ".") . '</td>';
      $tabla2 .= '</tr>';
    }

    require_once APP . 'libs/dompdf/autoload.inc.php';
    ob_start();
    require APP . 'view/Ventas/pdfDetallesAbonos.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    // $dompdf->load_html_file($urlImagen);
    // $dompdf->setPaper('A4', 'landscape');
    $dompdf->setPaper([0,0,300,700], 'portrait');
    $dompdf->render();
    $dompdf->stream("Recibo Abono Créditos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
  }
}



  public function registrarAbonoCreditoVen(){

    if (isset($_POST["txtva"])== 'true') {

      if(isset($_POST['btnRegistrarAbono'])){
        $this->mdlVentas->__SET("valorAbonarCreditoV",$_POST['txtvalorabono']);
        $this->mdlVentas->__SET("codigo_venta", $_POST['txtidprestamoCredV']);
        $this->mdlVentas->__SET("codigoEmpleado", $_POST['empleadoAbonoVenta']);
        $consultaAbono = $this->mdlVentas->totalAbono($_POST['txtvalorabono']);
        if($consultaAbono['total'] !== null && $consultaAbono['total'] == 0){
          $this->mdlVentas->cambiarEstadoCredito(0);
        }

        if ($this->mdlVentas->insertarAbonoCreditoVen()) {

          $ultAbono = $this->mdlVentas->ultimoIdAbono();

          $_SESSION['alerta'] = 'swal({
                  title: "Guardado exitoso!",
                  text: "¿Desea imprimir el recibo de abono?",
                  type: "success",
                  confirmButtonColor: "#3CB371",
                  cancelButtonText: "No",
                  showCancelButton: true,
                  confirmButtonText: "Sí",
                  closeOnConfirm: true,

                  },
                  function(isConfirm){
                  if (isConfirm) {
                    window.open("'.URL.'Ventas/generarReciboAbonos?txtId='.$ultAbono["ultimo_id"].'");
                  }
                })';
          header("Location: ".URL."Ventas/listarVentasCredito");
          exit();
        }
        else
        {
          $_SESSION['alerta']=  'swal({
            title: "Error en el registro!",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          })';
          header("Location: ".URL."Ventas/listarVentasCredito");
          exit();
        }

      }

  }

    $notificacionCredito = $this->mdlVentas->listarNotificacionesCredito();
    $clientesCredito = $this->mdlVentas->listarClientesCreditoV();
    require APP . 'view/_templates/header.php';
    require APP . 'view/Ventas/listarCreditosVentas.php';
    require APP . 'view/_templates/footer.php';

  }



  public function ajaxDetalleAbonosCreditosV()
  {
    $detalle = $this->mdlVentas->listarAbonosCreditosV($_POST["id_ventas"]);
    $id_Credito = $_POST["id_ventas"];
    $ultimoAbonoVentas = $this->mdlVentas->ultimoAbonoVentas($_POST["id_ventas"]);
      $html = "";
          foreach ($detalle as $val) {
            $html .= '<tr>';
            $html .= '<td>'.$val['fechaAbono'].'</td>';
            $html .= '<td class="price">'.$val['valor_abono'].'</td>';
            $html .= '<td class="price">'.$val['saldo_abono'].'</td>';
            $html .= '<td>'.$val['empleado'].'</td>';
            $html .= '<td>';
            // '<button type="button" class="btn btn-success btn-circle btn-md" onclick="abono('.$val['valor_prestamo'].','.$val['id_prestamos'].')"  title="Abonar"><i class="fa fa-money" aria-hidden="true"></i></button>';
            // $html .= ' <button type="button" class="btn btn-primary btn-circle btn-md" onclick="traerDetalleAbonos('.$val['id_prestamos'].')"  title="Abonar"><i class="fa fa-eye" aria-hidden="true"></i></button>';
            $fechaActual = date("Y-m-d");
            if ($val["estado_abono"] == 1) {
              if($val['fechaAbono'] == $fechaActual){
                if($val['idabono'] == $ultimoAbonoVentas['ultimo']){
                  $html .= ' <a href="generarpdfDetalleAbonos?id='.$id_Credito.'" target="_blank" id="pdfDetalAbono">
                  <button class="btn btn-primary btn-circle btn-md" name="btnPdfPagos" title="Generar Pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                  </a>';
                }else{

                }
            $html .= ' <button  title="Anular" type="button" class="btn btn-success btn-circle btn-md" data-toggle="modal" id="btnbotoncheck" onclick="cambiarestado('.$val["idabono"].',0)"><i class="fa fa-check" aria-hidden="true"></i></button>';
          }else{
            if($val['idabono'] == $ultimoAbonoVentas['ultimo']){
            $html .= ' <a href="generarpdfDetalleAbonos?id='.$id_Credito.'" target="_blank" id="pdfDetalAbono">
                        <button class="btn btn-primary btn-circle btn-md" name="btnPdfPagos" title="Generar Pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                        </a>';
          }
        }

          }

            if ($val["estado_abono"] == 0) {
            $html .= ' <button title="Anulado" disabled="" id="btnanulado" type="button" class="btn btn-danger btn-circle btn-md" data-toggle="modal"><i class="fa fa-remove" aria-hidden="true"></i></button>';
            }
            $html .= '</td></tr>';

          }
              $cabecera = '<tr>';
              $cabecera .= '<th>'.'Fecha del Abono'.'</th>';
              $cabecera .= '<th>'.'Valor Abono'.'</th>';
              $cabecera .= '<th>'.'Total Abonado'.'</th>';
              $cabecera .= '<th>'.'Responsable Abono'.'</th>';
              $cabecera .= '<th>'.'Opciones'.'</th>';
              $cabecera .= '</tr>';

              echo json_encode([
              'html' => $html,'cabecera'=>$cabecera
              ]);
            }


  public function ajaxNombreCliente(){
    $info = $this->mdlVentas->getNombreCliente($_POST['idCliente']);

    echo json_encode([
      'cliente'=>$info['cliente'],
    ]);
  }


  public function infoCreditos(){

    header("Content-type: application/json");
    $this->mdlVentas->__SET('codigo_venta', $_POST["id_ventas"]);
    //$info = $this->mdlVentas->fechaLimiteCredito($_POST['id_ventas']);

    $informacionCredito = $this->mdlVentas->fechaLimiteCredito();
    echo json_encode($informacionCredito);
    // echo json_encode([
    //   'fecha'=>$info['fecha_limite_credito'],
    // ]);
  }



    public function modificarestadoC()
    {
          $estado = $this->mdlVentas->cambiarEstadoCredito2($_POST["codigo"], $_POST["estado"]);
          if ($estado) {
            echo json_encode(["v"=>1]);
          }
          else
          {
            echo json_encode(["v"=>2]);

          }
      }


      public function modificarestadoAbonos()
      {

        $estadoabonos = $this->mdlVentas->cambiarestadoAbonos($_POST["codigo"], $_POST["estado"]);
        if ($estadoabonos) {
          echo json_encode(["v"=>1]);
        }
        else
        {
          echo json_encode(["v"=>0]);
        }
      }

      public function registrarCliente(){
        $this->modeloP->__SET("idPersona", $_POST['numeroDoc']);
        $this->modeloP->__SET("nombres", ucwords($_POST['nombres']));
        $this->modeloP->__SET("apellidos", ucwords($_POST['apellidos']));
        $this->modeloP->__SET("celular", $_POST['celular']);
        $this->modeloP->__SET("tipoPersona", $_POST['tipoPersona']);
        $this->modeloP->__SET("genero", $_POST['genero']);
        $this->modeloP->__SET("tipoDocumento", $_POST['tipoDoc']);
        $this->modeloP->__SET("email", "");
        $this->modeloP->__SET("telefono", "");
        $this->modeloP->__SET("direccion", "");
        $persona = $this->modeloP->guardarPersona();
        header("Content-Type: application/json");
        echo json_encode([
          'error' => $persona? false : true,
          'id' => $this->modeloP->ultimoId(),
          'nombre' => $this->modeloP->nombres . " " . $this->modeloP->apellidos . " (" . ($this->modeloP->tipoPersona == 5? "Frecuente" : "No frecuente")  . ")",
        ]);
      }
  }
 ?>
