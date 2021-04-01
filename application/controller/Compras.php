<?php

  use Dompdf\Dompdf;

  class Compras extends Controller{

    private $mdlCompras;
    private $mdlProveedor;
    private $mdlProducto;
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
      $this->mdlCompras = $this->loadModel("mdlCompras");
      $this->mdlProducto = $this->loadModel("mdlProducto");
      $this->mdlProveedor = $this->loadModel("mdlProveedor");
    }

    public function index(){


        if(isset($_POST['btn-modificar'])){
          if($_POST["txtpreciocompra"] <  $_POST["txtprecioventa"] && $_POST["txtpreciocompra"] < $_POST["txtprecioalpormayor"] && $_POST["txtprecioventa"] > $_POST["txtprecioalpormayor"]){
          $this->mdlCompras->__SET("Codigo_producto", $_POST['txtcodigo']);
          $this->mdlCompras->__SET("precio_unitario", $_POST['txtpreciocompra']);
          $this->mdlCompras->__SET("precio_por_mayor", $_POST['txtprecioalpormayor']);
          $this->mdlCompras->__SET("precio_detal", $_POST['txtprecioventa']);
          $producto = $this->mdlCompras->modificarPrecios();

          if($producto == true){
            $_SESSION['alerta'] = ' swal({
              title: "Modificación exitosa!",
              type: "success",
              confirmButton: "#3CB371",
              confirmButtonText: "Aceptar",
              // confirmButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
            })';

            header("Location: ".URL."Compras/index");
            exit();
          }else{
            $_SESSION['alerta'] = ' swal({
              title: "Error en la modificación!",
              type: "error",
              confirmButton: "#3CB371",
              confirmButtonText: "Aceptar",
              // confirmButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
            })';

            header("Location: ".URL."Compras/index");
            exit();
          }
        }else{
          $_SESSION['alerta'] = ' swal({
            title: "Precios inválidos!",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          })';
          header("Location: ".URL."Compras/index");
          exit();
        }

        }

      $proveedor = $this->mdlProveedor->listar();
      $proveedorN = $this->mdlProveedor->listarNatural();
      $proveedorJ = $this->mdlProveedor->listarJuridico();
      $producto = $this->mdlProducto->listar();
      $categoria = $this->mdlProducto->listarca();

      require APP . 'view/_templates/header.php';
      require APP . 'view/Compras/registrarCompra.php';
      require APP . 'view/_templates/footer.php';
    }


    public function informeproducto()
       {
         require APP . 'view/_templates/header.php';
         require APP. 'view/Compras/pdfinformeproducto.php';
         require APP . 'view/_templates/footer.php';
       }


       public function pdfCompras()
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
              $this->mdlCompras->__SET('fechainicial',date("Y-m-d",strtotime($_POST['txtfechainicial1'])));
              $this->mdlCompras->__SET('fechafinal',date("Y-m-d",strtotime($_POST['txtfechafinal1'])));
              $ver = $this->mdlCompras->listarpdf();
              $totalCompraFecha = $this->mdlCompras->totalPorFecha();


            }

            require_once APP . 'libs/dompdf/autoload.inc.php';
            // $urlImagen = URL . 'producto/generarcodigo?id=';
            // $productos = $this->mdlproducto->listar();
            ob_start();
            require APP . 'view/Compras/pdfinforme2.php';
            $html = ob_get_clean();
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            // $dompdf->load_html_file($urlImagen);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream("Informe Compras.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
          }



          public function generarpdfDetallesCompras()
          {
            $id = $_GET['id'];

            $detalles2 = $this->mdlCompras->pdfDetallesCompra($id);

            $tabla2 = "";
            foreach ($detalles2 as $val) {
              $tabla2 .= '<tr>';
              $tabla2 .= '<td>' . $val['fecha_compra'] . '</td>';
              $tabla2 .= '<td>' . ucwords($val['proveedor']) . '</td>';
              $tabla2 .= '<td> $ ' . number_format($val['valor_total'], "0", ".", ".") . '</td>';
              $tabla2 .= '</tr>';
            }

            $detalles = $this->mdlCompras->getDetallesCompra($id);
            $tabla = "";
            foreach ($detalles as $value) {
              $tabla .= '<tr>';
              $tabla .= '<td>' . ucwords($value['nombre_producto']) . '</td>';
              $tabla .= '<td>' . $value['cantidad'] . ' unidades</td>';
              $tabla .= '<td>$ ' . number_format($value['valor_compra'], "0", ".", ".") . '</td>';
              $tabla .= '<td>$ ' . number_format($value['total'], "0", ".", ".") . '</td>';
              $tabla .= '</tr>';
            }

            require_once APP . 'libs/dompdf/autoload.inc.php';
            ob_start();
            require APP . 'view/Compras/pdfDetallesCompras.php';


            $html = ob_get_clean();
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            // $dompdf->load_html_file($urlImagen);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream("Informe Compras.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
          }



    public function registrarCompra(){
      $guardar=false;
      $error=false;
      $this->mdlCompras->__SET("codigo_proveedor", $_POST['ddlproveedor']);
      $this->mdlCompras->__SET("valor_total", $_POST['txttotal']);
      $this->mdlCompras->__SET("empleado", ucwords($_POST['hdempleado']));
      $C = $this->mdlCompras->insertarCompra();

      if($C){

        for ($i=0; $i < count($_POST['producto']); $i++) {
          $this->mdlCompras->insertarDetalleCompra($_POST['producto'][$i], $_POST['cantidad'][$i], $_POST['precioProducto'][$i]);
        }

        if($C){

          $guardar = true;
        }
        else {
          $error = true;
        }
      }

      if($guardar == true)
      {
          $_SESSION['alerta']=  'swal({
            title: "Guardado exitoso!",
            type: "success",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          })';

          header("Location: ".URL."Compras/index");
          exit();
      }

      if($error == true)
      {
        $_SESSION['alerta'] =  'swal({
          title: "Error en el registro!",
          type: "error",
          confirmButton: "#3CB371",
          confirmButtonText: "Aceptar",
          // confirmButtonText: "Cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        })';
      }

      header("Location:".URL.'Compras/index');
      exit();
    }



    public function listarCompras(){
      $modeloconfiguracion = $this->loadModel("mdlConfiguracionPago");
      $configuracion = $modeloconfiguracion->listarConfiguracion();
      $datos = $this->mdlCompras->listarCompras();
      $proveedor = $this->mdlProveedor->listar();
      $proveedorJ = $this->mdlProveedor->listarJuridico();
      $producto = $this->mdlProducto->listar();
      require APP . 'view/_templates/header.php';
      require APP . 'view/Compras/listarCompras.php';
      require APP . 'view/_templates/footer.php';
    }


    public function modificarEstado(){
      $guardar = false;
      $error = false;

      if($this->validarProductos()){
          $error = true;
          $estado = false;
          echo json_encode(["v"=>1]);
      } else {
          $estado = $this->mdlCompras->cambiarEstado($_POST['id'], $_POST['estado']);
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
     title: "Entrada anulada!",
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
     title: "Error al intentar anular la compra!",
     type: "error",
     confirmButton: "#3CB371",
     confirmButtonText: "Aceptar",
     // confirmButtonText: "Cancelar",
     closeOnConfirm: false,
     closeOnCancel: false
   })';
  }
}



    private function validarProductos(){
      $id = $_POST['id'];
      $detalles = $this->mdlCompras->getDetallesCompra($id);
      $error = false;

      foreach ($detalles as $key => $detalle) {
        $cantProd = intval($detalle['cantidad_producto']);
        $cantComp = intval($detalle['cantidad']);
        $error = $cantProd < $cantComp;
        if($error){ break; }
      }
      return $error;
    }



    public function ajaxDetallesCompra(){

      $detalles = $this->mdlCompras->getDetallesCompra($_POST['idCompra']);
      $info = $this->mdlCompras->getInfoCompra($_POST['idCompra']);

      $html = "";
      foreach ($detalles as $key => $value) {
        $html .= '<tr>';
        $html .= '<td>' . ucwords($value['nombre_producto']);
        $html .= '</td>';

        $html .= '<td>' . $value['cantidad'] . ' unidades</td>';
        $html .= '<td class="price">' . $value['valor_compra'] . '</td>';
        $html .= '<td class="price">' . $value['total'] . '</td>';
        $html .= '</tr>';
      }
      echo json_encode([
        'compra'=>$info['id_compras'],
        'empleado'=>$info['empleado'],
        'fecha' => $info['fecha_compra'],
        'proveedor' => $info['proveedor'],
        'id' => $info['id_persona'],
        'total' => $info['total'],
        'html' => $html,
      ]);
    }


    public function registrarProducto(){
      $this->mdlProducto->__SET("nombre_producto", ucwords($_POST['nombreProd']));
      $this->mdlProducto->__SET("Tbl_Categoria_idcategoria", $_POST['categ']);
      $this->mdlProducto->__SET("precio_unitario", $_POST['precioUnit']);
      $this->mdlProducto->__SET("precio_detal", $_POST['precioDet']);
      $this->mdlProducto->__SET("precio_por_mayor", $_POST['precioMay']);
      $this->mdlProducto->__SET("stock", $_POST['stockMin']);
      $producto = $this->mdlProducto->guardar();
      $productoID = $this->mdlProducto->ultimoIdProducto();

        header("Content-Type: application/json");
        echo json_encode([
          'error' => $producto? false : true,
          'id' => $productoID['id_producto'],
          'precioD' => $productoID['precio_detal'],
          'precioM' => $productoID['precio_por_mayor'],
          'precioU' => $productoID['precio_unitario'],
          'idProducto' => $this->mdlProducto->id_producto,
          'nombre' => $productoID['id_producto'] . " ".$this->mdlProducto->nombre_producto,
        ]);
        }


        public function modificarPrecios(){
          $this->mdlCompras->__SET("Codigo_producto", $_POST['id']);
          $this->mdlCompras->__SET("precio_unitario", $_POST['precioUnit']);
          $this->mdlCompras->__SET("precio_detal", $_POST['precioDet']);
          $this->mdlCompras->__SET("precio_por_mayor", $_POST['precioMay']);
          $producto = $this->mdlCompras->modificarPrecios();
          $this->mdlProducto->__SET("id_producto", $_POST['id']);
          $productoID = $this->mdlProducto->IdProdModificado();

            header("Content-Type: application/json");
            echo json_encode([
              'error' => $producto? false : true,
              'idP' => $productoID['id_producto'],
              'precio1' => $productoID['precio_detal'],
              'precio2' => $productoID['precio_por_mayor'],
              'precio3' => $productoID['precio_unitario'],
              'nombreP' => $productoID['id_producto'] . " ".$productoID['nombre_producto'],
            ]);
            }
  }
