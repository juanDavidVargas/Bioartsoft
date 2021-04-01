
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form class="" action="" method="post">
          <div class="row">
            <div class="col-md-12 col-xs-12 col-lg-12">
              <div class="panel panel-primary" >
              <div class="panel-heading" stlyle="height: 70px; width: 100px">
                    <center><span style="text-align:center; color: #fff; font-size: 18px"><b>BIOARTSOFT</b></span></center>
                </div>
                <div class="panel-body">
                  <p>&copy; SENA. Todos los derechos reservados</p>
                  <p>Información del sistema</p>
                  <div class="panel panel-default">
                    <p style="margin-left: 5px">Versión del software: 1.0. 2016</p>
                    <p style="margin-left: 5px">Desarrolladores:</p>
                    <p style="margin-left: 5px">Aprendices SENA</p>
                    <ul>
                      <li>Juan David Vargas Penagos (jdvargas752@misena.edu.co)</li>
                      <li>Jhoan Esneider López Tapias (jhoanlt19@gmail.com)</li>
                      <li>Johnatan Ramírez Restrepo (jramirezres86@gmail.com)</li>
                      <li>Diego Alexander López Gómez (dalopez971@misena.edu.co)</li>
                      <li>Cristian Alexis Piedrahita Rojas (capiedrahita126@misena.edu.co)</li>
                    </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-12 col-lg-12">
            <button type="button" class="btn btn-primary btn-active pull-right"  data-dismiss="modal"><i class="fa fa-check-circle" aria-hidden="true">   Aceptar</i></button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

  <div class="modal fade" id="modal-money" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12 col-md-12 col-xs-12">
                <div class="panel panel-primary" >
                <div class="panel-heading" stlyle="height: 70px; width: 100px">
                      <center><span style="text-align:center; color: #fff; font-size: 18px"><strong>Ganancias</strong></span></center>
                  </div>
                  <div class="panel-body">
                    <form id="formGanancias" action="<?= URL ?>Ventas/reporteGanancias" method="post" data-parsley-validate="">
                    <div class="row">
                      <br>
                        <div class="panel-body">
                      <div class="row">
                        <div class="col-md-1"></div>
                        <div   class="col-md-4">
                          <?php
                            $hoy1 = Date("Y-m-d");
                            $hoy2 = Date("Y-m-d");
                            $nuevaFecha = strtotime('-1 month', strtotime($hoy1));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);
                          ?>
                            <label for="">Fecha Inicial <span class="obligatorio">*</span></label>
                            <div class="input-group date calendario" data-provide="datepicker">
                            <input type="text" class="form-control" name="txtfechainicial" value="<?= $nuevaFecha ?>" id="txtfechainicial" placeholder="Fecha Inicial" readonly="true" data-parsley-required="true">

                            <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                          </div>
                          </div>
                          <input type="hidden" class="form-control" name="txtfechainicial2" value="<?= $nuevaFecha ?>" id="txtfechainicial2">
                        </div>
                        <div class="col-md-1"></div>
                        <div   class="col-md-4">
                            <label for="">Fecha Final <span class="obligatorio">*</span></label>
                            <div class="input-group date calendario" data-provide="datepicker">
                            <input type="text" class="form-control" name="txtfechafinal" value="<?= $hoy1 ?>" id="txtfechafinal1" readonly="true"  placeholder="Fecha final" data-parsley-required="true">
                            <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                          </div>
                          </div>
                      </div>
                      <input type="hidden" class="form-control" name="txtfechafinal2" value="<?= $hoy2 ?>" id="txtfechafinal2">
                      <input type="hidden" class="form-control" name="txtfechafinal3" value="<?= $nuevaFecha ?>" id="txtfechafinal3">
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-7 col-xs-9 col-lg-7">
                          <button type="button"class="btn btn-primary active pull-right" id="btn-ganancias" name="btnconsultarganancia" onclick="consultarGanancia()"><i class="fa fa-building-o" aria-hidden="true" data-toggle="modal" data-target="#modal-ganancias"> Generar Ganancias</i></button>
                        </div>
                    </div>
                    </div>
                    </div>
                    </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-11 col-md-12 col-lg-12">
              <button type="button" class="btn btn-secondary btn-active pull-rigth"  data-dismiss="modal" style="margin-left:80%"><i class="fa fa-remove" aria-hidden="true">&nbsp;&nbsp;Cerrar</i></button>
          </div>
        </div>
      </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-ganancias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
 <div class="modal-dialog" role="document">
   <div class="modal-content modal-xs">
           <div class="modal-body">
           <div class="row">
             <div class="col-md-12 col-xs-12 col-lg-12">
               <div class="panel panel-primary" >
                 <div class="panel-heading" stlyle="height: 70px; width: 100px">
                   <center><span style="color: #fff; font-size: 18px" id="myModalLabel"><strong>Detalle Promedio Ganancias</strong></span></center>
                 </div>
                 <div class="panel-body">
                   <div class="dataTable_wrapper">
                     <div class="table-responsive">
                       <div id="conte-table">

                       </div>
                     </div>
                   </div>
             </div>
            </div>
           </div>
           </div>
           <div class="row">
             <div class="col-xs-8 col-lg-12 col-md-12">
               <button type="button" class="btn btn-secondary btn-active pull-right" onclick="abrirModal()"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
           </div>
         </div>
         </div>
       </div>
      </div>
    </div>

    <div class="modal fade" id="modal-ayuda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
     <div class="modal-dialog" role="document">
       <div class="modal-content modal-xs">
               <div class="modal-body">
               <div class="row">
                 <div class="col-md-12">
                   <div class="panel panel-primary" >
                     <div class="panel-heading" stlyle="height: 70px; width: 100px">
                       <center><span style="color: #fff; font-size: 18px" id="myModalLabel"><strong>Ayudas</strong></span></center>
                     </div>
                     <div class="panel-body">
                      <p ALIGN="justify">El icono ayuda en forma de pregunta "?", estará ubicado en la parte superior
                      de cada una de las vistas con el fin de dar una orientación al usuario de aquellos procesos
                      más complejos de la aplicación.</p>
                 </div>
                </div>
               </div>
               </div>
               <div class="row">
                 <div class="col-xs-12 col-lg-12 col-md-12">
                   <button type="button" class="btn btn-primary btn-active pull-right" style="margin-left:80%" data-dismiss="modal"><i class="fa fa-check-circle" aria-hidden="true">   Aceptar</i></button>
               </div>
             </div>
           </div>
           </div>
          </div>
        </div>

        <div class="modal fade" id="mod_ayuda_modificacionPersonas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-body">
                         <div class="row">
                           <div class="col-xs-12 col-md-12 col-lg-12">
                             <div class="panel panel-primary">
                               <div class="panel-heading" stlyle="height: 70px; width: 100px">
                                     <center><span class="modal-title" id="myModalLabel" style="color: #FFF; font-size: 18px"><strong>Ayuda de Listar Usuarios-Empleados</strong></span></center>
                               </div>
                               <div class="panel-body">
                                   <p ALIGN="justify">Señor usuario en esta vista usted se va a encontrar con diferentes
                                      opciones ubicadas al lado izquierdo de la tabla, cada una con una acción
                                      diferente, esas opciones son:</p>
                                   <ul>
                                     <li><strong>Opcion de Modificación:</strong>
                                         <ol>Tener en cuenta a la hora de modificar un empleado lo siguiente:
                                           <li ALIGN="justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian,
                                             el sistema no le dejará seguir.</li>
                                             <li ALIGN="justify">Los campos nombre de usuario y email no pueden ser idénticos a datos ya registrados.</li>
                                             <li ALIGN="justify">Al cambiar un empleado temporal a vinculado, el campo fecha de contrato cargará la fecha actual
                                               inicialmente, si usted desea cambiar esa fecha, está no puede ser menor ni superior
                                               a los 3 meses.</li>
                                         </ol>
                                         <br>
                                     </li>
                                     <li><strong>Opción de Cambio de Contraseña:</strong>
                                       <ol>Tener en cuenta a la hora de cambiar una contraseña lo siguente:
                                         <li ALIGN="justify">La longitud de la contraseña debe ser mayor a 4 caracteres.</li>
                                         <li ALIGN="justify">Ambos campos deben coincidir.</li>
                                       </ol>
                                     </li>
                                   </ul>
                                   <p ALIGN="justify">Por seguridad el empleado rol administrador no se le permitirá el cambio de estado.</p>
                               </div>
                               <br>
                             </div>
                           </div>
                         </div>
                <div class="row">
                  <div class="col-md-12 col-xs-12 col-lg-12">
                     <button type="button" class="btn btn-primary btn-md active pull-right" data-dismiss="modal"><i class="fa fa-check-circle" aria-hidden="true">&nbsp;Aceptar</i></button>
                  </div>
              </div>
          </div>
        </div>
        </div>
        </div>

    <script>
        var url = "<?php echo URL; ?>";
    </script>

  <script src="<?php echo URL ?>js/bootstrap.min.js"></script>

  <script src="<?php echo URL ?>js/sb-admin-2.js"></script>

  <script src="<?php echo URL ?>js/application.js"></script>

  <script src="<?php echo URL ?>js/metisMenu.min.js"></script>

  <!-- <script type="text/javascript" src="<?php echo URL ?>js/jquery.select2.js"></script> -->
  <script type="text/javascript" src="<?php echo URL ?>js/select2.full.min.js"></script>
  <script type="text/javascript" src="<?php echo URL ?>js/select2.min.js"></script>
  <script type="text/javascript">
    $(".js-example-basic-multiple").select2();
  </script>
  <script type="text/javascript" src="<?php echo URL ?>js/sweetAlert.min.js"></script>
  <script type="text/javascript" src="<?php echo URL ?>js/funciones.js"></script>
  <script type="text/javascript" src="<?php echo URL ?>js/funciones2.js"></script>
  <script type="text/javascript" src="<?php echo URL ?>js/datatables.min.js"></script>
  <script type="text/javascript" src="js/Spanish.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
  $('#dataTables-example').DataTable({
    language: {
      url: "http://cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    }, responsive: true,
    sort: false
  });

});
  </script>

  <script type="text/javascript">
  $(document).ready(function() {
    $('.calendario').datepicker({
      pickTime: false,
      autoclose: true
    });
  });
</script>

  <script type="text/javascript">
    $("#txtfechainicial").change(function(){
      var valor = $('#txtfechainicial').val();
      var valor2 = $('#txtfechainicial2').val();

      if(valor < valor2){
        swal({
                title: "Fecha inválida, la fecha no puede ser menor a 1 mes!",
                type: "error",
                confirmButtonColor: "#86CCEB",
                confirmButtonText: "Aceptar",
                closeOnConfirm: true,

                },
                function(isConfirm){
                if (isConfirm) {
                    $('#txtfechainicial').val(valor2);
                }
              })
      }

    });
  </script>

  <script type="text/javascript">
  $("#txtfechafinal1").change(function(){
    var valor3 = $('#txtfechafinal1').val();
    var valor4 = $('#txtfechafinal2').val();
    if(valor3 > valor4)
    {
      swal({
              title: "Fecha inválida, esta fecha no puede ser mayor a la actual!",
              type: "error",
              confirmButtonColor: "#86CCEB",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,

              },
              function(isConfirm){
              if (isConfirm) {
                  $('#txtfechafinal1').val(valor4);
              }
            })
    }
  });
  </script>

  <script src="<?php echo URL ?>js/bootstrap-datepicker.min.js"></script>
  <script src= "<?= URL ?>js/jquery.price_format.2.0.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    <?php
    if (isset($_SESSION['alerta']) != false && $_SESSION['alerta'] != null){
      echo $_SESSION['alerta'];
      $_SESSION['alerta'] = null;
    }
  ?>
  });
</script>
<script type="text/javascript">
function abrirModal(){
  $("#modal-money").modal("show");
  $("#modal-ganancias").modal("hide");
}
</script>

<script type="text/javascript">
      function editar(id_persona, listarE)
      {

        // var tiempop = $("#inputTipoPago").val();
        // if (tiempop == "Mensual") {
        //     $("#idDia").attr('max',30)
        //     $("#idDia").val(30);
        // }
        // else
        // {
        //   $("#idDia").val(15);
        // }

        var campos = $(listarE).parent().parent().parent();
        $('#identi').val(campos.find("td").eq(0).text());
        $('#tipoEmpleado').val(campos.find("td").eq(3).text());
        $('#fecha_Contrato').val(campos.find("td").eq(4).text());
        $('#idfechafin').val(campos.find("td").eq(5).text());
        $('#fechaliquidacion2').val(campos.find("td").eq(5).text());
        $('#idfechaPagoPJunio').val(campos.find("td").eq(6).text());
        $('#idfechainicial').val(campos.find("td").eq(7).text());
        $('#estadoem').val(campos.find("td").eq(9).text());

        $('#myjhoanlopez').modal("show");

           setTimeout(function(){
            var tipo = $(listarE).attr("data-tipo");
            var identidad = $(listarE).attr("data-identi");
            var fechafin = $(listarE).attr("data-fechafin");
            var fechafinContrato = $(listarE).attr("data-fechafin");
            var nombre = $(listarE).attr("data-nombre");
            var fechacontrato1 = $(listarE).attr("data-fechacontrato");
            var PagoPrimaJunio = $(listarE).attr("data-fechaPagoPJunio");
            if ($(listarE).attr("data-fechaultipago") == "") {
                fechainicial2 = $(listarE).attr("data-fechacontrato");
            }else{
                fechainicial2 = $(listarE).attr("data-fechaultipago");
            }
            var estaemple = $(listarE).attr("data-estadoemp");
            var emp = $('#tipoEmpleado').val(tipo);
            var identidad = $('#identi').val(identidad);
            var fechafin = $('#idfechafin').val(fechafin);
            var fechafincontrato = $('#fechaliquidacion2').val(fechafinContrato);
            var nombre = $('#nombre').val(nombre);
            var fechacontrato = $("#fecha_Contrato").val(fechacontrato1);
            var PagoPrimaJunio = $("#idfechaPagoPJunio").val(PagoPrimaJunio);
            var fechainicial = $("#idfechainicial").val(fechainicial2);
            var estadoemple = $("#estadoem").val(estaemple);
            var fechaactual = new Date().toJSON().slice(0,10);
            $("#valor_Ventas").val(0);
            $("#divvalorventas").show();
            $("#divvalorprimaservicios").hide();

            //Calculando los días a pagar
            var date1 = new Date(fechainicial2);
            var date2 = new Date(fechaactual);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            $("#idDia").val(diffDays);

              if (fechainicial2 == "") {
                  $("#idfechainicial").val(fechacontrato1);
              }else if(fechainicial){
                $("#idfechainicial").val(fechainicial2);
              }

                if (estaemple == 0) {
                  swal({
                  title: "El empleado se encuentra inhabilitado, para registrar pagos cambie el estado del empleado.!",
                  type: "warning",
                  confirmButton: "#3CB371",
                  confirmButtonText: "btn-danger",
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false,
                }),
                  setTimeout(function(){
                  $('#myjhoanlopez').modal("hide");
                },900);
                }
                else if(fechainicial2 == fechaactual)
                {
                  swal({
                      title: "El empleado tiene un pago normal registrado en la fecha actual.",
                      type: "warning",
                      confirmButtonColor: "#86CCEB",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: true,

                      },
                      function(isConfirm){
                      if (isConfirm) {
                          $("#selectTipoPago").select2("destroy");
                            $("#selectTipoPago").val(2);
                            $("#selectTipoPago").select2();
                            cambiarCampos();
                      }
                    });
                }

                    if (tipo == "Empleado-fijo"){

                      var fechaactual2 = new Date().toJSON().slice(0,10);
                      $("#divvalorpenditeprestamo").hide();
                      $("#divDiasLaborados").hide();
                      $("#divPagoTotalPrimates").hide();
                      $("#divValorDiatemporal").hide();
                      $("#divPagoTotalTemporales").hide();
                      $("#CalcularTemporal").hide();
                      $("#divTipoPago").show();
                      $("#divTiempoPago").show();
                      $("#divPorcentaje").show();
                      $("#divValorBase").hide();
                      $("#divIdentificacion").show();
                      $("#valor_Ventas").show();
                      $("#divFechaInicial").show();
                      $("#divPagoTotal").show();
                      $("#detalle").show();
                      $("#labelValorVentas").show();
                      $("#calcularFijo").show();
                      $("#divvalorprima").hide();
                      $("#divvalorvacaciones").hide();
                      $("#divinteresescesantias").hide();
                      $("#divPagoTotalliquidacion").hide();
                      $("#tipoEmp").val(1);
                      $("#btnGuardarPagoFijo").show();
                      $("#divdias").show();
                      $("#divValordia").show();
                      $("#idbotonventas").show();
                      $("#btnGuardarliqui").hide();
                      $("#btnGuardarPrima").hide();
                      $("#btnGuardartempo").hide();
                      // $("#divvalorpenditeprestamo").hide();
                      $("#divvalorultipago").hide();
                      $("#divvalorprimaservicios").hide();
                      var datee = fechaactual2;
                      var elemm = datee.split('-');
                      var yearr = elemm[0];
                      var mess = elemm[1];
                      var diaa = elemm[2];

                      if (mess == 6 && diaa >= 15 && diaa <=30 ) {
                          $("#divvalorprimaservicios").show();
                      };

                      if (mess == 12 && diaa >= 15 && diaa <=30 ) {
                          $("#divvalorprimaservicios").show();
                      };
                    }

                    if (tipo == "Empleado-temporal") {
                      $("#divvalorpenditeprestamo").hide();
                      $("#divDiasLaborados").show();
                      $("#divValorDia").show();
                      $("#divPagoTotalPrimates").hide();
                      $("#CalcularTemporal").show();
                      $("#divTipoPago").hide();
                      $("#divdias").hide();
                      $("#divTiempoPago").hide();
                      $("#divPorcentaje").hide();
                      $("#divValordia").hide();
                      $("#divValorBase").hide();
                      $("#divIdentificacion").show();
                      $("#valor_Ventas").hide();
                      $("#divFechaInicial").hide();
                      $("#divPagoTotal").hide();
                      $("#divPagoTotalliquidacion").hide();
                      $("#labelValorVentas").hide();
                      $("#calcularFijo").hide();
                      $("#divvalorprima").hide();
                      $("#divvalorvacaciones").hide();
                      $("#tipoEmp").val(2);
                      $("#divValorDiatemporal").removeAttr('style');
                      $("#divrow").removeAttr('style');
                      $("#valor_Ventas").removeAttr("data-parsley-required");
                      $("#btnGuardartempo").show();
                      $("#btnGuardarliqui").hide();
                      $("#btnGuardarPrima").hide();
                      $("#idbotonventas").hide();
                      $("#divPagoTotalTemporales").show();
                      $("#divFechacontrato").hide();
                      $("#divFechapagoliquidacion").hide();
                      // $("#divvalorpenditeprestamo").hide();
                      $("#divvalorventas").hide();
                      $("#divvalorultipago").hide();
                      $("#divvalorprimaservicios").hide();

                    };
           },500);
      }

       function cantiprestamos() {
              var identidad = $("#iden").val();

            $.ajax({
              url: url +'Empleados/validarcantiPres',
              type: 'POST',
              dataType: 'JSON',
              data: {identidad: identidad},
            })
            .done(function(respuesta) {
              if(respuesta.v != null && respuesta.v == 1){
                  mensaje5();
                  setTimeout(function(){

                  $('#myjh').modal("hide");
                  },1200);
                  }
            })
            }

      function prestamosEmp(id_persona, listarE)
      {
        // var tipo = $(listarE).attr("data-tipo-empleado");
        // alert(tipo);

        var campos = $(listarE).parent().parent();
        $('#iden').val(campos.find("td").eq(0).text());
        $('#nombre').val(campos.find("td").eq(1).text());
        $('#tipoEmplea').val(campos.find("td").eq(3).text());
        $('#estadoempleado').val(campos.find("td").eq(9).text());
        cantiprestamos();
        $('#myjh').modal("show");
           setTimeout(function(){



            var tipo = $(listarE).attr("data-tipo");
            var identidad = $(listarE).attr("data-identi");
            var Estado = $(listarE).attr("data-estadoE");

                    var emp = $('#tipoEmpleado').val(tipo);
                    var identidad = $('#identi').val(identidad);
                    var Estadoemp = $("#estadoempleado").val(Estado);


                      if (Estado == 0) {
                        swal({
                        title: "El empleado se encuentra inhabilitado, para registrar préstamos cambie el estado del empleado.",
                        type: "warning",
                        confirmButton: "#3CB371",
                        confirmButtonText: "btn-danger",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false,
                      }),
                        setTimeout(function(){
                        $('#myjh').modal("hide");
                      },900);
                      };

                    if (tipo == "Empleado-fijo"){

                      $("#btnGuardarPagoFijo").show();
                      $("#btncancelarreistro").show();
                      $("#divDiasLaborados").hide();
                      $("#divPagoTotalPrimate").hide();
                      $("#divValorDia").hide();
                      $("#CalcularTemporal").hide();
                      $("#divTipoPago").show();
                      $("#divTiempoPago").show();
                      $("#divPorcentaje").show();
                      $("#divValorBase").show();
                      $("#divIdentificacion").show();
                      $("#valor_Ventas").show();
                      $("#divFechainicial").hide();
                      $("#divPagoTotal").show();
                      $("#detalle").show();
                      $("#labelValorVentas").show();
                      $("#calcularFijo").show();
                      $("#divvalorprima").hide();
                      $("#divvalorvacaciones").hide();
                      $("#divinteresescesantias").hide()
                      $("#tipoEmp").val(1);

                    }

                    if (tipo == "Empleado-temporal") {
                      // $("#modalcss").attr({
                      //   style: 'width : 40% !important'

                      // });

                      $("#divDiasLaborados").show();
                      $("#divValorDia").show();
                      $("#divValorDiafijo");
                      $("#CalcularTemporal").show();
                      $("#divTipoPago").hide();
                      $("#divTiempoPago").hide();
                      $("#divPorcentaje").hide();
                      $("#divValorBase").hide();
                      $("#divIdentificacion").show();
                      $("#valor_Ventas").hide();
                      $("#divFechaInicial").hide();
                      $("#divPagoTotal").show();
                      $("#detalle").show();
                      $("#labelValorVentas").hide();
                      $("#calcularFijo").hide();
                      $("#divvalorprima").hide();
                      $("#divvalorvacaciones").hide();
                      $("#divinteresescesantias").show()
                      $("#tipoEmp").val(2);

                    };
           },500);

      }

      function cancelarregiconfiguracion() {

              swal({
      title: "¿Realmente desea cancelar el registro?",
      type: "warning",
      confirmButton: "#3CB371",
      confirmButtonText: "btn-danger",
      cancelButtonText: "Cancelar",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Aceptar",
      closeOnConfirm: false,

    },
    function(isConfir){
        if (isConfir) {
          swal({
            title: "Registro cancelado!",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfir){
            window.location.reload();
          });
        }
        });
            }

          function cerrar() {
            window.location.reload();
            }

  </script>

  <script type="text/javascript">
    $(document).ready(function{
      $('.datepicker').datepicker({
    language: 'es'
    });

    })
  </script>


  <script type="text/javascript">
    $(document).ready(function(){
      $("#btnconsultarganancia").click(function(){
        $("#formGanancias").parsley().validate();
      })
    });
  </script>

  <script type="text/javascript">
  function consultarGanancia() {

    var fecha1 = $("#txtfechainicial").val();
    var fecha2 = $("#txtfechafinal1").val();

    $.ajax({
      url: url + 'Ventas/reporteGanancias',
      type: 'POST',
      dataType: 'JSON',
      data: {fecha1: fecha1,
             fecha2: fecha2},
    })
    .done(function(respuesta) {

      var html = '<table class="table table-striped table-bordered table-hover" id="listarDetalleganancias" style="width: 100% !important">' +
                                '<thead id="titu" >' +
                                '</thead>' +
                                '<tbody id="detal_ganancias">' +
                                '</tbody>' +
                              '</table>';
                              $("#conte-table").html(respuesta.html);
                              $(".price").priceFormat({centsLimit: 3, prefix: '$ '});
                            });

                        $("#modal-money").modal("hide");
                    }
  </script>

  <?php if(isset($error) && $error == true): ?>
  <script type="text/javascript">
  swal({
    title: "No existen registros en ese rango de fecha!",
    type: "error",
    confirmButton: "#3CB371",
    confirmButtonText: "Aceptar",
    // confirmButtonText: "Cancelar",
    closeOnConfirm: false,
    closeOnCancel: false
  });
  </script>
  <?php endif; ?>

  <script type="text/javascript">
  $("#txtfechainicial").change(function(){
    var val = $('#txtfechainicial').val();
    var val2 = $('#txtfechafinal2').val();
    var val3 = $('#txtfechafinal3').val();

    if(val > val2)
    {
      swal({
              title: "Fecha inválida, esta fecha no puede ser mayor a la fecha final!",
              type: "error",
              confirmButtonColor: "#86CCEB",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,

              },
              function(isConfirm){
              if (isConfirm) {
                  $('#txtfechainicial').val(val3);
              }
            })
    }
  });
  </script>

  <script type="text/javascript">
  $("#txtfechafinal1").change(function(){
    var val = $('#txtfechafinal1').val();
    var val2 = $('#txtfechainicial').val();
    var val3 = $('#txtfechafinal2').val();

    if(val <  val2)
    {
      swal({
              title: "Fecha inválida, esta fecha no puede ser menor a la fecha inicial!",
              type: "error",
              confirmButtonColor: "#86CCEB",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,

              },
              function(isConfirm){
              if (isConfirm) {
                  $('#txtfechafinal1').val(val3);
              }
            })
    }
  });
  </script>

</body>
</html>
