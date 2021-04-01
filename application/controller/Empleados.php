<?php

use Dompdf\Dompdf;

  class Empleados extends controller
  {

      private $modeloP;
      private $mdlTipoPersona;
      private $modeloUsuario;
      private $modelo;
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

      function __construct(){
        $this->modeloP = $this->loadModel("mdlPersona");
        $this->mdlTipoPersona = $this->loadModel("mdlTipoPersona");
      }


      public function listarPrestamosVencer(){

      //$clientesCredito = $this->modeloP->listarClientesCreditoV();
      $notificacionPrestamos = $this->modeloP->listarNotificacionesPrestamos();
      //$info = $this->modeloP->estadoAbono();
      require APP . 'view/_templates/header.php';
      require APP . 'view/Empleados/prestamosVencer.php';
      require APP . 'view/_templates/footer.php';
    }


      public function pdfPrestamos()
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
             $this->modeloP->__SET('fechainicial',date("Y-m-d",strtotime($_POST['txtfechainicial1'])));
             $this->modeloP->__SET('fechafinal',date("Y-m-d",strtotime($_POST['txtfechafinal1'])));
             $ver = $this->modeloP->listarInformePrestamos();
             $totalPrestamosFecha = $this->modeloP->totalPorFecha();

           }

           require_once APP . 'libs/dompdf/autoload.inc.php';
           // $urlImagen = URL . 'producto/generarcodigo?id=';
           // $productos = $this->mdlproducto->listar();
           ob_start();
           require APP . 'view/Empleados/pdfinformePrestamos.php';
           $html = ob_get_clean();
           $dompdf = new Dompdf();
           $dompdf->loadHtml($html);
           // $dompdf->load_html_file($urlImagen);
           $dompdf->setPaper('A4', 'landscape');
           $dompdf->render();
           $dompdf->stream("Informe Préstamos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
         }


      public function informePagos()
      {

        $listarPagos = $this->modeloP->listarPagosEmp();

      require_once APP . 'libs/dompdf/autoload.inc.php';
        $listarPagos = $this->modeloP->listarPagosEmp();
        ob_start();
        require APP . 'view/Empleados/pdfinformePagos.php';
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->load_html_file($urlImagen);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Informe Pagos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
      }


      public function generarpdfDetalleAbonos()
      {
        $id = $_GET['id'];

        $modelo = $this->loadModel("mdlEmpleados");
        $listarPrestamos = $modelo->pdfDetallesAbono($id);

        $tabla2 = "";
        foreach ($listarPrestamos as $val) {
          $tabla2 .= '<tr>';
          $tabla2 .= '<td style="text-align: center"> $ ' . number_format($val['valor_prestamo'], "0", ".", ".") . '</td>';
          $tabla2 .= '<td style="text-align: center"> $ ' . number_format($val['valor'], "0", ".", ".") . '</td>';
          $tabla2 .= '<td style="text-align: center"> $ ' . number_format($val['abonado'], "0", ".", ".") . '</td>';
          $tabla2 .= '<td style="text-align: center"> $ ' . number_format($val['pendiente'], "0", ".", ".") . '</td>';
          $tabla2 .= '</tr>';
        }

        require_once APP . 'libs/dompdf/autoload.inc.php';
        ob_start();
        require APP . 'view/Empleados/pdfDetallesAbonosPrestamos.php';
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->load_html_file($urlImagen);
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper([0,0,300,700], 'portrait');
        $dompdf->render();
        $dompdf->stream("Recibo Abono Préstamos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
    }


      public function informePrestamos()
      {

        $listarPrestamos = $this->modeloP->listarInformePrestamos();

      require_once APP . 'libs/dompdf/autoload.inc.php';
      $listarPrestamos = $this->modeloP->listarInformePrestamos();
        ob_start();
        require APP . 'view/Empleados/pdfinformePrestamos.php';
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Informe Préstamos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
      }


      public function generarpdfPagos()
      {
        $id = $_GET['id'];
        $this->modeloP->__SET("idPersona", $id);
        $listarPagos = $this->modeloP->listarPagosPorEmp();

        $tabla = "";
        foreach ($listarPagos as $val) {
          $tabla .= '<tr>';
          $tabla .= '<td>' . $val['tipo_documento'] . '</td>';
          $tabla .= '<td>' . $val['id_persona'] . '</td>';
          $tabla .= '<td>' . ucwords($val['empleado']) . '</td>';
          $tabla .= '<td>' . $val['Tbl_nombre_tipo_persona'] . '</td>';
          if($val['Tbl_nombre_tipo_persona'] == "Empleado-temporal"){
          $tabla .= '<td>' . $val['tipo_pago'] . '</td>';
          $tabla .= '<td>' . $val['fecha_pago'] . '</td>';
          $tabla .= '<td> $ ' . number_format($val['valor_dia'], "0", ".", ".") . '</td>';
          $tabla .= '<td>' . $val['cantidad_dias'] . '</td>';
          $tabla .= '<td> $ ' . number_format($val['total_pago'], "0", ".", ".") . '</td>';
          }else{
            $tabla .= '<td>' . $val['tipo_pago'] . '</td>';
            $tabla .= '<td>' . $val['fecha_pago'] . '</td>';
            $tabla .= '<td> $ ' . number_format($val['Valor_dia'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valorComision'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valor_prima'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valor_cesantias'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valor_vacaciones'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['total_pago'], "0", ".", ".") . '</td>';
          }
          $tabla .= '</tr>';
        }

        require_once APP . 'libs/dompdf/autoload.inc.php';
        ob_start();
        require APP . 'view/Empleados/pdfinformePagos.php';

        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->load_html_file($urlImagen);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Informe Pagos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
      }

      public function generarpdfPrestamos($id)
      {
        //$id = $_GET['id'];
        $this->modeloP->__SET("idPersona", $id);

        $listarPrestamos = $this->modeloP->listarPrestamosEmp();
        // var_dump($listarPrestamos);
        // exit();

        $tabla = "";
        foreach ($listarPrestamos as $val) {
          $tabla .= '<tr>';
          $tabla .= '<td>' . $val['tipo_documento'] . '</td>';
          $tabla .= '<td>' . $val['id_persona'] . '</td>';
          $tabla .= '<td>' . ucwords($val['empleado']) . '</td>';
          $tabla .= '<td>' . $val['Tbl_nombre_tipo_persona'] . '</td>';
          $tabla .= '<td>' . $val['fecha_prestamo'] . '</td>';
          $tabla .= '<td> $ ' . number_format($val['valor_prestamo'], "0", ".", ".") . '</td>';
          $tabla .= '<td>' . $val['descripcion'] . '</td>';
          $tabla .= '<td>' . $val['fecha_limite'] . '</td>';
          $tabla .= '</tr>';
        }

        require_once APP . 'libs/dompdf/autoload.inc.php';
        ob_start();
        require APP . 'view/Empleados/pdfDetallesPrestamos.php';

        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->load_html_file($urlImagen);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Informe Pagos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
      }



      public function generarReciboAbonos()
      {
        $id = $_GET['txtId'];

        // var_dump($id);
        // exit();
        if(isset($id)){

        $modelo = $this->loadModel("mdlEmpleados");
        $listarPrestamos = $modelo->pdfDetallesAbono($id);

        $tabla2 = "";
        foreach ($listarPrestamos as $val) {
          $tabla2 .= '<tr>';
          // $tabla2 .= '<td>' . $val['id_persona'] . '</td>';
          // $tabla2 .= '<td>' . $val['cliente'] . '</td>';
          $tabla2 .= '<td> $ ' . number_format($val['valor_prestamo'], "0", ".", ".") . '</td>';
          $tabla2 .= '<td> $ ' . number_format($val['valor'], "0", ".", ".") . '</td>';
          $tabla2 .= '<td> $ ' . number_format($val['abonado'], "0", ".", ".") . '</td>';
          $tabla2 .= '<td> $ ' . number_format($val['pendiente'], "0", ".", ".") . '</td>';
          $tabla2 .= '</tr>';
          // echo "<pre>";
          // var_dump($tabla2);
          // exit();
        }

        require_once APP . 'libs/dompdf/autoload.inc.php';
        ob_start();
        require APP . 'view/Empleados/pdfDetallesAbonosPrestamos.php';
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->load_html_file($urlImagen);
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper([0,0,300,700], 'portrait');
        $dompdf->render();
        $dompdf->stream("Recibo Abono Préstamos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
    }
}




      public function ListarPrest(){

        $modelo2 = $this->loadModel("mdlConfiguracionPago");
        $configuracion = $modelo2->listarConfiguracion();
        $confi2 = $modelo2->listarConfiguracion2();
        $modelo = $this->loadModel("mdlEmpleados");
        $listarPrestamos = $this->modeloP->ListarPrestamos2();

        if (isset($_POST["btnRegistrarAbono"])) {

            $modelo->__SET("valor", $_POST["txtvalorabono"]);
            $modelo->__SET("estadoabonos", 1);
            $modelo->__SET("Tbl_Prestamos_idprestamos",$_POST["txtidprestamo"]);
            $modelo->__SET("id_prest",$_POST["txtidprestamo"]);

            if ($modelo->registrarAbonoPrestamo()) {

              $sumarabo =  implode('',$modelo->sumarAbonos());
              $valorPrestamo = $_POST["txtresta"];
              $valorPendiente = (int)$valorPrestamo - (int)$sumarabo;

                if ($valorPendiente == 0) {
                  $modelo->modificarEstadoPre();
                }
                $idP = $_POST["txtidprestamo"];
                $ultimoAbonoPrestamo = $modelo->ultimoAbonoPrestamo($idP);

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
                          window.open("'.URL.'Empleados/generarReciboAbonos?txtId='.$idP.'");
                        }
                      })';

              header("Location: ".URL."Empleados/ListarPrest");
              exit();

            }else{
              $_SESSION['jhoan'] = ' swal({
               title: "Error en el registro!",
               type: "error",
               confirmButton: "#3CB371",
               confirmButtonText: "Aceptar",
               // confirmButtonText: "Cancelar",
               closeOnConfirm: false,
               closeOnCancel: false
             })';
             header("Location: ".URL."Empleados/ListarPrest");
             exit();
            }
        }

        if (isset($_POST["btnmodificarprestamo"])) {
        $modelo->__SET("fecha_limite",$_POST["txtfechalimetepre"]);
        $modelo->__SET("id_prestamos",$_POST["txthideidprestamo"]);

        if ($modelo->modificarprestamos()) {
              $_SESSION['alerta'] = ' swal({
                  title: "Modificación exitosa!",
                  type: "success",
                  confirmButton: "#3CB371",
                  confirmButtonText: "Aceptar",
                  // confirmButtonText: "Cancelar",
                  closeOnConfirm: false,
                  closeOnCancel: false
                })';

                header("Location: ".URL."Empleados/ListarPrest");
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
                header("Location: ".URL."Empleados/ListarPrest");
                exit();
            }
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/Empleados/listarPrestamo.php';
        require APP . 'view/_templates/footer.php';
      }



      public function registrarPrestamo(){
        $modelo = $this->loadModel("mdlEmpleados");
        $listarEmpleadoFijo = $this->modeloP->ListarPersEmpleado();

        if (isset($_POST["btnRegistrarPrestamo"])) {

          $modelo->__SET("estado_prestamo", 1);
          $modelo->__SET("valor_prestamo", $_POST["txtvalorprestamo"]);
          $modelo->__SET("fecha_prestamo", date("Y-m-d",strtotime($_POST["txtfechaPrestamo"])));
          $modelo->__SET("fecha_limite", date("Y-m-d",strtotime($_POST["txtfechalimite"])));
          $modelo->__SET("descripcion", $_POST["txtdescripcion"]);
          $modelo->__SET("Tbl_Persona_id_persona", $_POST["txtIdentifica"]);

          if ($modelo->registrarPrestamo()) {

            $_SESSION['jhoan'] = ' swal({
                title: "Guardado exitoso!",
                type: "success",
                confirmButton: "#3CB371",
                confirmButtonText: "Aceptar",
                // confirmButtonText: "Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
              })';

              header("Location: ".URL."Empleados/registrarPrestamo");
              exit();

          }else{
            $_SESSION['jhoan'] = ' swal({
                title: "Error en el registro!",
                type: "error",
                confirmButton: "#3CB371",
                confirmButtonText: "Aceptar",
                // confirmButtonText: "Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
              })';
          }
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/Empleados/registrarPrestamo.php';
        require APP . 'view/_templates/footer.php';
      }

      public function reportePrestamos(){

        $modelo = $this->loadModel("mdlConfiguracionPago");
        $configuracion = $modelo->listarConfiguracion();
        require APP . 'view/_templates/header.php';
        require APP . 'view/Empleados/reportePrestamos.php';
        require APP . 'view/_templates/footer.php';
      }


      public function generarComprobantePagos()
      {
      $id = $_GET['txtId'];

      if(isset($id)){
        //$this->modeloP->__SET("idPersona", $id);

        $listarPagos = $this->modeloP->listarPagosEmp($id);

        $tabla = "";
        foreach ($listarPagos as $val) {

          $tabla .= '<tr>';
          $tabla .= '<td>' . ucwords($val['tipo_pago']) . '</td>';
          if($val['Tbl_nombre_tipo_persona'] == "Empleado-temporal" && $val['tipo_pago'] == "Pago Normal"){
            $tabla .= '<td>' . $val['cantidad_dias'] . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valor_dia_temporal'], "0", ".", ".") . '</td>';
          }elseif($val['Tbl_nombre_tipo_persona'] == "Empleado-fijo" && $val['tipo_pago'] == "Pago Normal"){
            $tabla .= '<td> $ ' . number_format($val['Valor_dia'], "0", ".", ".") . '</td>';
            $tabla .= '<td> ' .$val["cantidad_dias"] . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valorVentas'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valorComision'], "0", ".", ".") . '</td>';
          }
          elseif($val['tipo_pago'] == "Pago Final" && $val['Tbl_nombre_tipo_persona'] == "Empleado-fijo"){
            $tabla .= '<td> $ ' . number_format($val['valorVentas'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valorComision'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valor_vacaciones'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valor_cesantias'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valor_prima'], "0", ".", ".") . '</td>';
          }else{
            $tabla .= '<td> $ ' . number_format($val['Valor_dia'], "0", ".", ".") . '</td>';
            $tabla .= '<td> ' .$val["cantidad_dias"] . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valorVentas'], "0", ".", ".") . '</td>';
            $tabla .= '<td> $ ' . number_format($val['valorComision'], "0", ".", ".") . '</td>';
          }
        }
        $tabla .= '</tr>';

        require_once APP . 'libs/dompdf/autoload.inc.php';
        ob_start();
        require APP . 'view/Empleados/pdfDetallesPagos.php';

        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->load_html_file($urlImagen);
        //$dompdf->setPaper('A4', 'landscape');
          $dompdf->setPaper([0,0,900,700], 'portrait');
        $dompdf->render();
        $dompdf->stream("Comprobante Pagos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
      }
    }




      public function registrarPagos(){
        $modelo = $this->loadModel("mdlEmpleados");
        $modelo2 = $this->loadModel("mdlConfiguracionPago");
        $modelo3 = $this->loadModel("mdlUsuario");
        $configuracion = $modelo2->listarConfiguracion();
        $configuracion2 = $modelo2->listarConfiguracionPagos();
        $listarE = $this->modeloP->ListarPersEmpleadoFijo();
        $TipoPersona = $this->mdlTipoPersona->listarTipoPersonas();
        $listarE = $this->modeloP->ListarPersEmpleadoFijo();

        if (isset($_POST["btnRegistrarPago"])) {

          if ($_POST["tipoEmp"] == "1") {
            $modelo->__SET("valorVentas", $_POST["txtValorVentas"]);
            $modelo->__SET("valorComision", $_POST["txtvalorcomi"]);
            $modelo->__SET("cantidad_dias", $_POST["txtdiaspagar"]);
            $modelo->__SET("valor_prima", $_POST["txtValorprimaServicios"]);
            $modelo->__SET("valor_cesantias", $_POST["txtvalorcesantias"]);
            $modelo->__SET("valor_vacaciones", $_POST["txtvalorvacaciones"]);
            $modelo->__SET("estado", 1);
            $modelo->__SET("numero_docu", $_POST["txtIdentificacion"]);
            $modelo->__SET("fecha_liquidación",$_POST["txtfechaPagoliquidacion"] );

            if ($modelo->registrarPagoEmpleados()) {
                $modelo->modificarfechaLiquidacion();
                $idpa = $modelo->ultimoPago();

                if ($_POST["tipoPago"] == 1) {
                $modelo->__SET("id_pago", implode("", $idpa));
                $modelo->__SET("idTbl_Configuracion", $_POST["tipoPago"]);
                $modelo->__SET("valorTotal", $_POST["txttotalpagonormal"]);
                $modelo->registrarDetallepagoconfi();
                }
                if ($_POST["tipoPago"] == 2) {
                    if ($_POST["txtValorprestamo"] != 0) {
                        $arr1 = $_POST["txtidPrestamosPen"];
                        $stringId = implode('', $arr1);
                        $ids = explode(",", $stringId);
                        $arrValores = $_POST["txtvalorPrestamosPen"];
                        $stringValores = implode('', $arrValores);
                        $valores = explode(",", $stringValores);

                      for ($i=0; $i < count($ids); $i++) {
                          $modelo->__SET("Tbl_Prestamos_idprestamos", $ids[$i]);
                          $modelo->__SET("id_prest", $ids[$i]);
                          $modelo->__SET("estadoabonos", 1);
                        for ($v=0; $v < count($valores); $v++) {
                          if ($i == $v) {
                            $modelo->__SET("valor", $valores[$v]);
                            $modelo->registrarAbonoPrestamo();
                          }
                        }
                            $modelo->modificarEstadoPre();
                      }
                    }
                $modelo->__SET("id_pago", implode("", $idpa));
                $modelo->__SET("idTbl_Configuracion", $_POST["tipoPago"]);
                $modelo->__SET("valorTotal", $_POST["txttotalliquidacion"]);
                $modelo->registrarDetallepagoconfi();
                $modelo3->ModificarEstadoUsuDesdeLiquidacion($_POST["txtIdentificacion"]);
                }

                $ultPago = $modelo->ultimoId();

                $_SESSION['alerta'] = 'swal({
                        title: "Guardado exitoso!",
                        text: "¿Desea imprimir el comprobante de pago?",
                        type: "success",
                        confirmButtonColor: "#3CB371",
                        cancelButtonText: "No",
                        showCancelButton: true,
                        confirmButtonText: "Sí",
                        closeOnConfirm: true,

                        },
                        function(isConfirm){
                        if (isConfirm) {

                          window.open("'.URL.'Empleados/generarComprobantePagos?txtId='.$ultPago['ultimo_id'].'");
                        }
                      })';

                header("Location: ".URL."Empleados/registrarPagos");
                exit();
            }else{
              $_SESSION['jhoan'] = ' swal({
            title: "Error en el registro!",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          })';

          header("Location: ".URL."Empleados/registrarPagos");
          exit();
            }

          }

          if ($_POST["tipoEmp"] == "2")
          {

            $modelo->__SET("cantidad_Dias", $_POST["txtdiasLaborados"]);
            $modelo->__SET("valor_dia", $_POST["txtValorDia"]);
            $modelo->__SET("estado", 1);
            $modelo->__SET("numero_docu", $_POST["txtIdentificacion"]);

            if ($modelo->registrarPagoEmpleadoTemporal()) {
              $idpa = $modelo->ultimoPago();
              $modelo->__SET("id_pago", implode("", $idpa));
              $modelo->__SET("idTbl_Configuracion", 1);
              $modelo->__SET("valorTotal", $_POST["txtvalortemporales"]);
              $modelo->registrarDetallepagoconfiTemp();

              $ultPago = $modelo->ultimoId();

              $_SESSION['alerta'] = 'swal({
                        title: "Guardado exitoso!",
                        text: "¿Desea imprimir el comprobante de pago?",
                        type: "success",
                        confirmButtonColor: "#3CB371",
                        cancelButtonText: "No",
                        showCancelButton: true,
                        confirmButtonText: "Sí",
                        closeOnConfirm: true,

                        },
                        function(isConfirm){
                        if (isConfirm) {
                          window.open("'.URL.'Empleados/generarComprobantePagos?txtId='.$ultPago['ultimo_id'].'");
                        }
                      })';

                header("Location: ".URL."Empleados/registrarPagos");
                exit();

            }else{
              $_SESSION['jhoan'] = ' swal({
                  title: "Error en el registro!",
                  type: "error",
                  confirmButton: "#3CB371",
                  confirmButtonText: "Aceptar",
                  // confirmButtonText: "Cancelar",
                  closeOnConfirm: false,
                  closeOnCancel: false
                })';

                header("Location: ".URL."Empleados/registrarPagos");
                exit();
            }

          }

        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/Empleados/registrarPagos.php';
        require APP . 'view/_templates/footer.php';
      }


      public function ListarConfiguraciones()
      {
        $modelo = $this->loadModel("mdlConfiguracionPago");
        $configuracion = $modelo->listarConfiguracion();
        if (isset($_POST["btnMostrar"])) {

        $configuracion = $modelo->listarConfiguracion();
        $confi2 = $modelo->listarConfiguracion2();
        $configuracion2 = $modelo->listarConfiguracionPa();
        }

        if (isset($_POST["btnmodificarconfi"])) {
        $configuracion = $modelo->listarConfiguracion();
        $confi2 = $modelo->listarConfiguracion2();

          $modelo->__SET("tiempo_pago",$_POST["txttiemPago"]);
          $modelo->__SET("Valor_dia",$_POST["txtvalordia"]);
          $modelo->__SET("valor_dia_temporal",$_POST["txtvalordiaTemporal"]);
          $modelo->__SET("porcentaje_comision",$_POST["txtporComision"]);
          $modelo->__SET("valor_base",$_POST["txtvBase"]);

          if ($modelo->modificarConfiguracion()) {

            $modelo->modificarValorBase();

            $_SESSION['alerta'] = ' swal({
              title: "Guardado exitoso",
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
          else
          {
            $_SESSION['alerta'] = ' swal({
              title: "Error en el registro!",
              type: "error",
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

        require APP . 'view/_templates/header.php';
        require APP . 'view/otro/index.php';
        require APP . 'view/_templates/footer.php';
      }

      public function reciboPago(){

        $modelo = $this->loadModel("mdlConfiguracionPago");
        $configuracion = $modelo->listarConfiguracion();
        require APP . 'view/_templates/header.php';
        require APP . 'view/Empleados/reciboPago.php';
        require APP . 'view/_templates/footer.php';
      }

      public function listarPagos(){

        $modelo = $this->loadModel("mdlConfiguracionPago");
        $configuracion = $modelo->listarConfiguracion();
        $confi2 = $modelo->listarConfiguracion2();
        $modelo = $this->loadModel("mdlEmpleados");
        //$listarE = $this->modeloP->ListarPersEmpleadoFijo();
        $listarEmp = $modelo->listarPagosEmp();

        if (isset($_POST["btnActualizarPrestamo"])) {

          $modelo->__SET("id_prestamo",$_POST["txtidprestamo"]);
          $modelo->__SET("valor_prestamo",$_POST["txtresta"]);

          if ($modelo->actualizarAbono()) {
            $_SESSION['alerta'] = ' swal({
              title: "Guardado exitoso",
              type: "success",
              confirmButton: "#3CB371",
              confirmButtonText: "Aceptar",
              // confirmButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
            })';
          }
          else
          $_SESSION['alerta'] = ' swal({
            title: "Error en el registro",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          })';
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/Empleados/listarPagos.php';
        require APP . 'view/_templates/footer.php';
      }

      public function comprobante(){

        $modelo = $this->loadModel("mdlConfiguracionPago");
        $configuracion = $modelo->listarConfiguracion();
        require APP . 'view/_templates/header.php';
        require APP . 'view/Empleados/comprobante.php';
        require APP . 'view/_templates/footer.php';
      }

     public function ajaxDetallePagos()
      {
        $modelo = $this->loadModel("mdlConfiguracionPago");
        $configuracion = $modelo->listarConfiguracion();
        $modelo = $this->loadModel("mdlEmpleados");
        $detalle = $modelo->getDetallePagos($_POST["idPersona"]);
          $fijo = false;
          $html = "";
          $cabecera = "";
              foreach ($detalle as $value)
              {
                $estado = $value["estado"] == 1?"Realizado":"Anulado";
                $html .= '<tr>';
                // $html .= '<td>'.$value['Tbl_Persona_id_persona'].'</td>';
                $html .= '<td>'.$value['fecha_pago'].'</td>';
                $empleado = $value['nombres'];

                if($value['Tbl_nombre_tipo_persona'] == "Empleado-fijo"){
                  $fijo = true;
                  $html .= '<td>'.$value['tipo_pago'].'</td>';
                  $html .= '<td class="price">'.$value['valorVentas'].'</td>';
                  $html .= '<td class="price">'.$value['valorComision'].'</td>';
                  $html .= '<td class="price">'.$value['valor_prima'].'</td>';
                  $html .= '<td class="price">'.$value['valor_vacaciones'].'</td>';
                  $html .= '<td class="price">'.$value['valor_cesantias'].'</td>';
                  $html .= '<td class="price">'.$value['total_pago'].'</td>';
                }

                if($value['Tbl_nombre_tipo_persona'] == "Empleado-temporal"){
                  $fijo = false;
                  $html .= '<td>'.$value['cantidad_Dias'].'</td>';
                  $html .= '<td class="price">'.$value['valor_dia'].'</td>';
                  $html .= '<td class="price">'.$value['total_pago'].'</td>';
                }
                  // $html .= '<td>'.$value['valorTotal'].'</td>';
                  $html .= '<td>'.$estado.'</td>';
                  $html .= '<td>';
                  // '<button type="button" class="btn btn-success btn-circle btn-md" data-toggle="modal" data-target="#myModal" title="Generar Recibo"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                  // </button>';
                $fechaActual = date("Y-m-d");
                if($value['fecha_pago'] != $fechaActual && $value["estado"] == 1){
                    $html .= ' <button  disabled ="" title="Anular" type="button" class="btn btn-danger btn-circle btn-md" data-toggle="modal" onclick="cambiarestado('.$value["id_pago"].', 0, '.$value['Tbl_Persona_id_persona'].', '.$value['id_abono'].', \''.$value['tipo_pago'].'\' )"><i class="fa fa-remove" aria-hidden="true"></i></button>';
                }else if($value['fecha_pago'] == $fechaActual && $value["estado"] == 1){
                    $html .= ' <button title="Anular" type="button" class="btn btn-danger btn-circle btn-md" data-toggle="modal" onclick="cambiarestado('.$value["id_pago"].', 0, '.$value['Tbl_Persona_id_persona'].' , '.$value['id_abono'].', '.$value['id_prestamo'].', \''.$value['tipo_pago'].'\' )"><i class="fa fa-remove" aria-hidden="true"></i></button>';
                }
                if ($value["estado"]==0) {
                  $html .= ' <button  disabled="" title="Cambiar Estado" type="button" class="btn btn-danger btn-circle btn-md" data-toggle="modal"><i class="fa fa-ban" aria-hidden="true"></i></button>';
                }
                  $html .= '</td></tr>';
              }
                  $cabecera .= '<tr>';
                  // $cabecera .= '<th>'.'Identidad'.'</th>';
                  $cabecera .= '<th>'.'Fecha Pago'.'</th>';

                if($fijo == true){
                  $cabecera .= '<th>'.'Tipo de Pago'.'</th>';
                  $cabecera .= '<th>'.'Valor en Ventas'.'</th>';
                  $cabecera .= '<th>'.'Comisiones'.'</th>';
                  $cabecera .= '<th>'.'Prima'.'</th>';
                  $cabecera .= '<th>'.'Vacaciones'.'</th>';
                  $cabecera .= '<th>'.'Cesantias'.'</th>';
                  $cabecera .= '<th>'.'Valor Total'.'</th>';
                }

                if(isset($value) && $value['Tbl_nombre_tipo_persona'] == "Empleado-temporal"){
                  $fijo = false;
                  $cabecera .= '<th>'.'Días Laborados'.'</th>';
                  $cabecera .= '<th>'.'Valor Día'.'</th>';
                }

                if(isset($value) && $value['Tbl_nombre_tipo_persona'] == "Empleado-temporal"){
                  $cabecera .= '<th>'.'Total Pago'.'</th>';
                }
                  $cabecera .= '<th>'.'Estado'.'</th>';
                  $cabecera .= '<th>'.'Opción'.'</th>';
                  $cabecera .= '</tr>';

                  echo json_encode([
                  'html' => $html,'cabecera'=>$cabecera
                  ]);
      }

      public function ajaxDetallePrestamos()
        {
          $modelo = $this->loadModel("mdlConfiguracionPago");
          $configuracion = $modelo->listarConfiguracion();
          $modelo = $this->loadModel("mdlEmpleados");
          $detalle = $modelo->getDetallePrestamos($_POST["idPersona"]);


            $fijo = false;
            $html = "";
                foreach ($detalle as $val) {
                  $idPre = $val['id_prestamos'];
                  $detalleAbono = $modelo->traerValorAbonoPorPrestamo($idPre);

                   $abonoAnulado = $detalleAbono['TotalAbono'];
                   $estadoAbono = $detalleAbono['estado_abono'];

                   if ($abonoAnulado != null) {
                      $abono = $val['Total'] - $abonoAnulado;
                   }
                   else
                   {
                    $abono = $val['Total'];
                   }
                    $empleado = $val['empleado'];
                    $valorpres = $val['valor_prestamo'];
                  $valorPen = $valorpres - $abono;
                  $html .= '<tr>';
                  $html .= '<td>'.$val['tipo_documento'].'</td>';
                  $html .= '<td>'.$val['id_persona'].'</td>';
                  $html .= '<td>'.$val['fecha_prestamo'].'</td>';

                    $html .= '<td>'.$val['fecha_limite'].'</td>';
                    $html .= '<td class="price">'.$val['valor_prestamo'].'</td>';
                    $v= $val['Total']==null?0:$abono;
                    $html .= '<td class="price">'.$v.'</td>';
                    $html .= '<td class="price">'.$valorPen.'</td>';
                    $html .= '<td>'.$val['descripcion'].'</td>';
                    $estado = $val["estado_prestamo"] == 0?"Pagado":"Pendiente";
                    $estado1 = $val["estado_prestamo"] == 1?"Pendiente":"Pagado";
                    $estado3 = $val["estado_prestamo"] == 3?"Condonado":"Pendiente";


                    // $html .= '<td>'.$value['valorTotal'].'</td>';
                    if ($val["estado_prestamo"] == 0) {
                    $html .= '<td>'.$estado.'</td>';
                    }
                    else if ($val["estado_prestamo"] == 1) {
                    $html .= '<td>'.$estado1.'</td>';
                    }
                    else if ($val["estado_prestamo"] == 3) {
                    $html .= '<td>'.$estado3.'</td>';
                  }else{
                    // $html .= '<td>'.$estado.'</td>';
                  }
                    $html .= '<td>';
                    if ($val["estado_prestamo"] == 1) {
                    $html.='<button type="button" class="btn btn-warning btn-circle btn-md" onclick="abono('.$val['valor_prestamo'].','.$val['id_prestamos'].','.$valorPen.')"  title="Abonar"><i class="fa fa-money" aria-hidden="true"></i></button>';
                    $html .= ' <button  title="Modificar Préstamo" type="button" class="btn btn-success btn-circle btn-md" data-toggle="modal" onclick="Modificarprestamo('.$val['id_prestamos'].')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                    $html .= ' <button type="button" onclick="traerDetalleAbonos('.$val["id_prestamos"].')" class="btn btn-primary btn-circle btn-md"   title="Ver Abonos"><i class="fa fa-eye" aria-hidden="true" ></i></button>';
                    $html .= ' <button  title="Cambiar Estado" type="button" class="btn btn-danger btn-circle btn-md" data-toggle="modal" id="btnbotoncheck" onclick="cambiarestadoprestamo('.$val['id_prestamos'].',3 )"><i class="fa fa-refresh" aria-hidden="true"></i></button>';
                    }

                    else if($val['estado_prestamo'] == 3){
                    $html .= ' <button type="button" onclick="traerDetalleAbonos('.$val["id_prestamos"].')" class="btn btn-primary btn-circle btn-md"   title="Ver Abonos"><i class="fa fa-eye" aria-hidden="true" ></i></button>';
                    $html .= ' <button  title="Cambiar Estado" type="button" class="btn btn-danger btn-circle btn-md" data-toggle="modal" id="btnbotoncheck" onclick="cambiarestadoprestamo('.$val['id_prestamos'].',3 )"><i class="fa fa-refresh" aria-hidden="true"></i></button>';
                    $html .= '</td></tr>';
                  }else{
                        $html .= ' <button type="button" onclick="traerDetalleAbonos('.$val["id_prestamos"].')" class="btn btn-primary btn-circle btn-md"   title="Ver Abonos"><i class="fa fa-eye" aria-hidden="true" ></i></button>';
                  }
              }
                    $cabecera = '<tr>';
                    $cabecera .= '<th>'.'Tipo de Documento'.'</th>';
                    $cabecera .= '<th>'.'Identificación'.'</th>';
                    $cabecera .= '<th>'.'Fecha Préstamo'.'</th>';
                    $cabecera .= '<th>'.'Fecha Límite'.'</th>';
                    $cabecera .= '<th>'.'Valor del Préstamo'.'</th>';
                    $cabecera .= '<th>'.'Total Abono'.'</th>';
                    $cabecera .= '<th>'.'Valor Pendiente'.'</th>';
                    $cabecera .= '<th>'.'Descripción'.'</th>';
                    $cabecera .= '<th>'.'Estado Préstamo'.'</th>';
                    $cabecera .= '<th>'.'Opciones'.'</th>';
                    $cabecera .= '</tr>';

                    echo json_encode([
                    'html' => $html,'cabecera'=>$cabecera
                    ]);

        }

      public function ajaxDetalleAbonos()
      {
        $modelo = $this->loadModel("mdlConfiguracionPago");
        $configuracion = $modelo->listarConfiguracion();
        $modelo = $this->loadModel("mdlEmpleados");
        $detalle = $modelo->ListarAbonos($_POST["id_prestamos"]);
        $id_prestam = $_POST["id_prestamos"];
        $ultimoAbono = $modelo->traerUltimoAbono($_POST["id_prestamos"]);

          $html = "";
              foreach ($detalle as $val) {
                $html .= '<tr>';
                $html .= '<td>'.$val['fecha_abono'].'</td>';
                $html .= '<td class="price">'.$val['valor'].'</td>';
                //$html .= '</tr>';
                //$html .= '<td class="price">'.$val['valor'].'</td>';
                // $html .= '</tr>';
                // $html .= '<td>'.$val['valor'].'</td>';
                // $html .= '</tr>';

                  $html .= '<td>';
                  // '<button type="button" class="btn btn-success btn-circle btn-md" onclick="abono('.$val['valor_prestamo'].','.$val['id_prestamos'].')"  title="Abonar"><i class="fa fa-money" aria-hidden="true"></i></button>';
                  // $html .= ' <button type="button" class="btn btn-primary btn-circle btn-md" onclick="traerDetalleAbonos('.$val['id_prestamos'].')"  title="Abonar"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                  $fechaActual = date("Y-m-d");
                  if($val['fecha_abono'] == $fechaActual){
                  if ($val["estado_abono"] == 1) {
                    $html .= ' <button  title="Anular" type="button" class="btn btn-success btn-circle btn-md" data-toggle="modal" id="btnbotoncheck" onclick="cambiarestadoabono('.$val["idTbl_Abono_Prestamo"].',0); devolverAbono('.$val['valor'].','.$id_prestam.');"><i class="fa fa-check" aria-hidden="true"></i></button>';
                    if($val['idTbl_Abono_Prestamo'] == $ultimoAbono['ultimo']){
                      $html .= ' <a href="generarpdfDetalleAbonos?id='.$id_prestam.'" target="_blank" id="pdfDetalAbono">
                      <button class="btn btn-primary btn-circle btn-md" name="btnPdfPagos" title="Generar Pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                      </a>';
                    }else{

                    }
                  }
                }else{
                    if($val['idTbl_Abono_Prestamo'] == $ultimoAbono['ultimo']){
                  $html .= ' <a href="generarpdfDetalleAbonos?id='.$id_prestam.'" target="_blank" id="pdfDetalAbono">
                              <button class="btn btn-primary btn-circle btn-md" name="btnPdfPagos" title="Generar Pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                              </a>';
                }
                }

                  if ($val["estado_abono"] == 0) {
                  $html .= ' <button title="Anulado" disabled="" id="btnanulado" type="button" class="btn btn-danger btn-circle btn-md" data-toggle="modal"><i class="fa fa-remove" aria-hidden="true"></i></button>';
                  }
                  $html .= '</td></tr>';
              }
                  $cabecera = '<tr>';
                  $cabecera .= '<th>'.'Fecha del Abono'.'</th>';
                  $cabecera .= '<th>'.'Valor'.'</th>';
                  $cabecera .= '<th>'.'Opciones'.'</th>';
                  $cabecera .= '</tr>';

                  echo json_encode([
                  'html' => $html,'cabecera'=>$cabecera
                  ]);
      }

      public function modificarestado()
      {
        $modelo = $this->loadModel("mdlConfiguracionPago");
        $configuracion = $modelo->listarConfiguracion();
        $modelo = $this->loadModel("mdlEmpleados");
        $estadopagos = $modelo->cambiarestado($_POST["id"], $_POST["estado"]);

        if ($estadopagos) {
          echo json_encode(["v"=>1]);
        }
        else
        {
          echo json_encode(["v"=>0]);
        }
      }

      public function sumarAbono()
      {
        $modelo = $this->loadModel("mdlEmpleados");
        $modelo->__SET("id_prestamo", $_POST["id_pre"]);
        $sumaAbono = $modelo->sumarAbonos();
        $abono = implode('', $sumaAbono);

        if ($abono) {
          echo json_encode(["v"=>$abono]);
        }
        else
        {
          echo json_encode(["v"=>NULL]);
        }
      }

      public function fechaUnDiaDespues()
      {
        $modelo = $this->loadModel("mdlConfiguracionPago");
        $configuracion = $modelo->listarConfiguracion();
      	$modelo = $this->loadModel("mdlEmpleados");
        $modelo->__SET("id_pago", $_POST["id_pre"]);
      }


      public function ajaxNombreEmpleado(){

        $modelo = $this->loadModel("mdlEmpleados");
        $modelo->__SET("idPersona", $_POST["idPersona"]);
        $info = $modelo->getEmpleado();

          echo json_encode([
            'html'=>ucwords($info['empleado']),
            'id'=>$info['id_persona']
          ]);
        }

      public function valorVentasEmp()
      {
        $modelo = $this->loadModel("mdlEmpleados");
        $modelo->__SET("id_persona", $_POST["Idp"]);
        $modelo->__SET("fecha_inicial",date("Y-m-d",strtotime($_POST["fech"])));
        $modelo->__SET("fecha_final", date("Y-m-d"));
        $tot = $modelo->totalVentasEmpleado();
        $sumtotal = implode('', $tot);

        if ($sumtotal) {
          echo json_encode(["v"=>$sumtotal]);
        }
        else
        {
          echo json_encode(["v"=>null]);
        }

      }

      public function validarcantiPres()
      {
        $modelo = $this->loadModel("mdlEmpleados");
        $modelo->__SET("id_persona", $_POST["identidad"]);
        $result = $modelo->valicantipre();
        $resultadoprestamo = implode('', $result);

        if ($resultadoprestamo) {
          echo json_encode(["v"=>$resultadoprestamo]);
        }
        else
        {
          echo json_encode(["v"=>null]);
        }
      }

      public function valorprestamopendiente()
      {
        $modelo = $this->loadModel("mdlEmpleados");
        $modelo->__SET("id_persona", $_POST["identificacion"]);
        $valortotalpre = $modelo->prestamopendiente();
        // $resultadovalorprestamo = implode('', $valortotalpre);

        if ($valortotalpre) {
          echo json_encode(["v"=>$valortotalpre]);
        }
        else
        {
          echo json_encode(["v"=>null]);
        }
      }

      public function infoprestamos()
      {
        header("Content-type: application/json");
        $modelo = $this->loadModel("mdlEmpleados");
        $modelo->__SET("id_prestamos", $_POST["id_prestamos"]);

        $informacionprestamo = $modelo->informacionprestamo();
        echo json_encode($informacionprestamo);
      }

      public function modificarestadoAbonos()
      {

        $modelo = $this->loadModel("mdlEmpleados");
        $estadoabonos = $modelo->cambiarestadoAbonos($_POST["id"], $_POST["estado"]);

        if ($estadoabonos) {
          echo json_encode(["v"=>1]);
        }
        else
        {
          echo json_encode(["v"=>0]);
        }
      }

      public function modificarestadoPrestamo()
      {

        $modelo = $this->loadModel("mdlEmpleados");
        $estadoPrestamo = $modelo->cambiarestadoPrestamo($_POST["id"], $_POST["estado"]);

        if ($estadoPrestamo) {
          echo json_encode(["v"=>1]);
        }
        else
        {
          echo json_encode(["v"=>3]);
        }
      }

      public function ValidarAnularPrestamo()
      {
        $modelo = $this->loadModel("mdlEmpleados");
        $modelo->__SET("id_prestamos",$_POST["cod"]);
        $abonoPrestamo = $modelo->nullEnAbonos();

        if ($abonoPrestamo) {
          echo json_encode(["v"=>$abonoPrestamo]);
        }
        else
        {
          echo json_encode(["v"=>null]);
        }
      }

	public function retornarAbono()
 	{
        $modelo = $this->loadModel("mdlEmpleados");
        $modelo->__SET('valor_abono',$_POST["valorAbono"]);
        $modelo->__SET('id_prestamos',$_POST["id_prestam"]);
        $valorAbonoreturn = $modelo->devolverAbonoPrestamo();

        if ($valorAbonoreturn) {
          echo json_encode(["v"=>1]);
        }
        else
        {
          echo json_encode(["v"=>0]);
        }
      }

  }
?>
