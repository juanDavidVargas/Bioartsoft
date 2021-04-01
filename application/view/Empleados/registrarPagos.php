<br>
<button type="button" class="btn btn-primary btn-circle btn-md pull-right" data-toggle="modal" data-target="#mod_ayuda_pagos">
  <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
</button>
<div class="row">
    <br><br>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading" stlyle="height: 70px; width: 100px">
              <center><span style="text-align:center; color: #fff; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><strong>Registrar Pagos</strong></span></center>
            </div>
            <div class="panel-body">
              <div class="dataTable_wrapper">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                      <tr>
                        <th>Número Documento</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Tipo Empleado</th>
                        <th style="display:none">Terminación Contrato</th>
                        <th>Estado</th>
                        <th>Registrar Pago</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($listarE as $empleado): ?>
                        <tr>
                          <td><?=  $empleado['id_persona'] ?></td>
                          <td><?=  $empleado['nombres'] ?></td>
                          <td><?=  $empleado['apellidos'] ?></td>
                          <td><?=  $empleado['Tbl_nombre_tipo_persona'] ?></td>
                          <td style="display: none"><?=  $empleado['fecha_Contrato'] ?></td>
                          <td style="display: none"><?=  $empleado['fecha_Terminacion_Contrato'] ?></td>
                          <td style="display: none"><?=  $empleado['fechaPPJunio'] ?></td>
                          <td style="display: none"><?=  $empleado['Fechaulti'] ?></td>
                          <td><?php if($empleado['estado'] == 1): ?>
                                Habilitado
                              <?php else:  ?>
                                Inhabilitado
                              <?php endif ?>
                          </td>
                          <td><button type="button" class="btn btn-primary btn-circle btn-md" data-tipo = "<?= $empleado['Tbl_nombre_tipo_persona']  ?>" data-fechafin = "<?=  $empleado['fecha_Terminacion_Contrato'] ?>" data-identi = "<?= $empleado['id_persona'] ?>" data-fechacontrato = "<?=  $empleado['fecha_Contrato'] ?>" data-fechaultipago ="<?= $empleado['Fechaulti'] ?>" data-fechaPagoPJunio = "<?= $empleado['fechaPPJunio'] ?>" data-estadoemp = "<?= $empleado['estado'] ?>"  data-nombre = "<?=  $empleado['nombres']. " ".$empleado['apellidos'] ?>" onclick="editar('<?= $empleado['id_persona'] ?>',this)"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="myjhoanlopez" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard   ="false" data-backdrop = "static" style="height: 103% !important">
          <div class="modal-dialog modal-lg" role="document" id="modalcss">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrarpago()">
                  <span aria-hidden="true">&times;</span>
                </button>
                <br>
              <div class="modal-header">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-primary">
                      <div class="panel-heading" stlyle="height: 70px; width: 100px">
                            <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Registrar Pago</strong></center>
                      </div>
              <div class="modal-body" style="margin: 0 auto">
                <form class="" action="<?php echo URL?>Empleados/registrarPagos" method="post" id="myForm" data-parsley-validate="">
                <div class="row">
                  <input type="hidden"  id="estadoem">
                    <div class="col-xs-12 col-md-4" id="divIdentificacion">
                      <label id="labelIdentificacion">Identificación</label><br>
                      <input type="text" class="form-control" name="txtIdentificacion" placeholder="Identificacion" value="" id="identi" readonly="">
                    </div>
                    <div class="col-xs-12 col-md-4" id="divNombre">
                      <label>Nombre</label><br>
                      <input type="text" class="form-control" name="txtnombre" value="" id="nombre" readonly="">
                    </div>
                    <div class="col-xs-12 col-md-4" id="divTipoEmpleado">
                      <label id="labelTipoEmpleado">Tipo de empleado</label><br>
                      <input type="text" class="form-control" name="txtTipoEmpleado" placeholder="Identificacion" value="" id="tipoEmpleado" readonly="">
                    </div>
                </div>
                <br>
                <div class="row">
                  <?php foreach ($configuracion as $valor): ?>
                    <div class="col-xs-12 col-md-4" id="divValorDiatemporal" style="display: none">
                      <label for="">Valor día</label>
                      <input type="number" id="valorDiatemporal" name="txtValorDia" class="form-control" data-parsley-type="integer" data-parsley-required="true" onchange="vali()" maxlength="8" value="<?= number_format($valor['valor_dia_temporal'],'0','.','.') ?>" readonly="">
                    </div>
                  <?php endforeach; ?>
                  <div class="col-xs-12 col-md-4" id="divDiasLaborados" style="display: none">
                    <label id="labelDias">Días Laborados <span class="obligatorio">*</span></label>
                    <input type="number" min="1" id="dias_laborados" name="txtdiasLaborados" class="form-control" data-parsley-type="number" data-parsley-required="true" onchange="vali()" maxlength="2">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-md-4" id="divValorBase">
                    <label id="labelValorBase">Valor Base</label><br>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">$</span>
                      <input type="text" class="form-control" name="txtvalorBase" placeholder="Valor Base" value="<?= number_format($valor["valor_base"],'0','.','.') ?>" readonly="" id="valorBase">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-4" id="divFechacontrato" style="display: none">
                    <label id="labelFechacontrato">Fecha inicio de labores:</label>
                    <div class="">
                      <div class="input-group date" data-provide = "datepicker">
                        <div class="input-group-addon" style="border-radius:5px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" disabled="" class="form-control pull-right" name="txtfechacontrato" id="fecha_Contrato" style="border-radius:5px;"  value="">
                        <input type="hidden" id="idfechaPagoPJunio">
                      </div>
                    </div>
                  </div>
                    <input type="hidden" name="" id="fechaliquidacion2">
                    <input type="hidden" name="" id="idcantidaddedias">
                    <input type="hidden" name="txtidPrestamosPen[]" id="idPrestamosPen">
                    <input type="hidden" name="txtvalorPrestamosPen[]" id="valorPrestamosPen">
                  <div class="col-xs-12 col-md-4" id="divFechapagoliquidacion" style="display: none">
                    <label id="labelFechaPago">Finalización de labores:</label>
                    <div class="">
                      <div class="input-group date" data-provide ="datepicker">
                        <div class="input-group-addon" style="border-radius:5px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" onchange="vali()" name="txtfechaPagoliquidacion" id="idfechafin" style="border-radius:5px;" readonly="">
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                  <input type="hidden" name="tipoEmp" id="tipoEmp" value="">

                  <?php foreach ($configuracion as $valor): ?>
                  <div class="row">
                    <div class="col-xs-12 col-md-4" id="divTipoPago">
                      <label id="labelTipoPago">Tipo de pago</label><br>
                      <select class="form-control" name="tipoPago" id="selectTipoPago"  style="width: 100%">
                        <?php foreach ($configuracion2 as $confi): ?>
                         <option value="<?= $confi['idTbl_Configuracion'] ?>" id="opc" ><?= $confi['tipo_pago'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-xs-12 col-md-4" id="divTiempoPago">
                      <label id="labelTiempoPago">Período de pago</label>
                      <input id="inputTipoPago" type="text" class="form-control" name="txttiempoPago" placeholder="Tiempo de Pago" value="<?= $valor["tiempo_pago"] ?>" readonly="">
                      <input type="hidden" name="txtidconfiguracion" value="<?= $valor["idTbl_Configuracion"] ?>">
                    </div>
                    <div class="col-xs-12 col-md-4" id="divdias">
                      <label>Días a pagar</label><br>
                      <input type="number" class="form-control" name="txtdiaspagar" placeholder="Cantidad de Días"  min="0" max="30" id="idDia" size="2" maxlength="2" onkeyup="checkday(this)" onchange="valid()" data-parsley-required="true">
                    </div>
                    <div class="col-xs-12 col-md-4" id="divvalorultipago">
                      <label>Total dias a pagar</label>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">$</span>
                        <input type="number" class="form-control" name="txtValorultipago" id="valor_pagoLi" value="0" min="0" readonly="">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button" id="idbotoncalcularpagoenliqui" onclick="calcularElPagoNormalEnLiquidacion()" style="background-color: #E0F8E0" title="Calcular Pago"> <b>Calcular</b></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-xs-12 col-md-4" style="" id="divPorcentaje">
                      <label id="labelPorcentaje">Porcentaje comisión</label><br>
                      <div class="input-group">
                        <div class="input-group-addon">%</div>
                        <input type="text" class="form-control" name="txtporceComision" placeholder="Porcentaje Comision" value="<?= floatval($valor["porcentaje_comision"]) * 100 ?>" readonly="">
                      </div>
                      <input type="hidden" class="form-control" name="txtporceComision" placeholder="Porcentaje Comision" value="<?= $valor["porcentaje_comision"]. " %" ?>" readonly="" id="comision">
                    </div>
                    <div class="col-xs-12 col-md-4" id="divValordia">
                      <label>Valor día</label><br>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">$</span>
                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="valorDia" readonly="" value="<?= number_format($valor["Valor_dia"],'0','.','.') ?>" name="txtvalordia">
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-4" id="divFechaInicial" style="">
                      <label>Fecha último pago:</label>
                      <div class="">
                        <div class="input-group date" data-parsley-required="true">
                          <div class="input-group-addon" style="border-radius:5px;">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" name="txtfechainicial" id="idfechainicial" style="border-radius:5px;" step="1" readonly="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <?php endforeach; ?>
                    <div class="col-xs-12 col-md-4" id="divvalorventas">
                      <label id="labelValorVentas">Valor ventas</label>
                      <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">$</span>
  		                  <input type="text" class="form-control" placeholder="Valor Ventas" name="txtValorVentas" id="valor_Ventas" readonly="">
  		                  <span class="input-group-btn">
  		                    <button class="btn btn-default" type="button" id="idbotonventas" onclick="traervalorVentas()"><span class="fa fa-search-plus"></span></button><button type="button" class="btn btn-default" onclick="limpiarCampos();"><span class="fa fa-trash-o"></span></button>
  		                  </span>
		                  </div>
                    </div>
                    <div class="col-xs-12 col-md-4" id="divvalorprimaservicios">
                      <label>Prima</label>
                      <div class="input-group">
                        <input type="number" class="form-control" placeholder="Valor Prima" name="txtValorprimaServicios" id="valor_primaser" value="0" min="0" readonly="">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button" id="idbotonasociarprima" onclick="valorPrima1()" style="background-color: #E0F8E0" title="Calcular Pago"> <b>Calcular</b></button>
                        </span>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-4" id="divvalorpenditeprestamo">
                      <label id="labelValorVentas">Pendiente de Préstamos</label>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">$</span>
                        <input type="number" class="form-control" placeholder="Valor Pendiente" name="txtValorprestamo" id="valor_penprestamos" readonly="" min="0" value="0">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button" id="idbotonprestamos" onclick="traervalorprestamopen();" title="Traer Préstamos"><span class="fa fa-search-plus"></span></button><button type="button" class="btn btn-default" onclick="limpiarCampos();"><span class="fa fa-trash-o"></span></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-xs-12 col-md-12" id="divPagoTotal">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title"><strong>PAGO TOTAL</strong></h3>
                        </div>
                        <div class="panel-body" id="detalle">
                          <div class="col-xs-12 col-md-4">
                            <div class="panel-footer">
                              <h5 style="font-weight: bold">Salario Neto: <input type="hidden" id="neto" name="txttotalsalario" value=""> <span id="total">0</span></h5>
                            </div>
                          </div>
                          <div class="col-xs-12 col-md-4">
                            <div class="panel-footer">
                              <h5 style="font-weight: bold">Comisiones: <input type="hidden" id="valorcomision" name="txtvalorcomi" value=""> <span id="totalco">0</span></h5>
                            </div>
                          </div>
                          <div class="col-xs-12 col-md-4">
                            <div class="panel-footer">
                              <h5 style="font-weight: bold">Total: <input type="hidden" id="totalpago" name="txttotalpagonormal" value=""> <span id="totalpagos">0</span></h5>
                            </div>
                          </div>
                          <div class="row">
                            <button onclick="calcularSalario()" id="calcularFijos" type="button" class="btn btn-primary pull-right" style="margin-top: 10px; margin-right: 5%" title="Calcular"><i class="fa fa-building" aria-hidden="true">  Calcular</i></button>
                          </div>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-xs-12 col-md-12" style="margin-top: 10px;" id="divPagoTotalliquidacion">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title"><strong>PAGO TOTAL</strong></h3>
                        </div>
                        <div class="panel-body" id="detalle">
                          <div class="col-xs-12 col-md-4">
                            <div class="panel-footer">
                              <h5 style="font-weight: bold">Vacaciones: <input type="hidden" id="valorvacacionestot" name="txtvalorvacaciones" value=""> <span id="totalvacaciones">0</span></h5>
                            </div>
                          </div>
                          <div class="col-xs-12 col-md-4">
                            <div class="panel-footer">
                              <h5 style="font-weight: bold">Cesantias: <input type="hidden" id="valorcesantias" name="txtvalorcesantias" value=""> <span id="idtotalcesantias">0</span></h5>
                            </div>
                          </div>
                          <div class="col-xs-12 col-md-4">
                            <div class="panel-footer">
                              <h5 style="font-weight: bold">Total: <input type="hidden" id="valortotliquidacion" name="txttotalliquidacion" value=""> <span id="totalliquidaciones">0</span></h5>
                            </div>
                          </div>
                          <div class="row">
                            <button onclick="calcularSalario()" id="calcularFijos" type="button" class="btn btn-primary pull-right" style="margin-top: 10px; margin-right: 5%" title="Calcular Pago"><i class="fa fa-building" aria-hidden="true">   Calcular</i></button>
                          </div>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-md-12" style="margin-top: 80px;" id="divPagoTotalTemporales">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title"><strong>Pago Total</strong></h3>
                        </div>
                        <div class="panel-body" id="detalle">
                          <div class="col-xs-12 col-md-6">
                            <div class="panel-footer">
                              <h5 style="font-weight: bold">Valor Total: <input type="hidden" id="valortotaltempo" name="txtvalortemporales" value=""><span id="totaltemporales">0</span></h5>
                            </div>
                          </div>
                          <div class="row">
                            <button onclick="calcularTemporal()" id="CalcularTemporal" type="button" class="btn btn-primary pull-right" style="margin-top: 10px; margin-right: 5%"><i class="fa fa-building" aria-hidden="true" title="Calcular Pago"> Calcular</i></button>
                          </div>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-1 col-md-3">
                    </div>
                      <div class="col-xs-5 col-md-3" id="btnGuardarPagoFijo">
                        <button type="submit" class="btn btn-success btn-md active"  name="btnRegistrarPago" onclick="return validarTotales()" id="bguardar" title="Guardar"><i class="fa fa-floppy-o" aria-hidden="true">   Guardar</i></button>
                      </div>
                      <div class="col-xs-5 col-md-3">
                        <button type="button" class="btn btn-danger btn-md active" onclick="cancelar()" style="float: right;" id="bcancelar" title="Cancelar Registro"><i class="fa fa-times" aria-hidden="true">   Cancelar</i> </button>
                      </div>
                      <div class="col-md-3">
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>


<div class="modal fade" id="mod_ayuda_pagos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                 <div class="row">
                   <div class="col-xs-12 col-md-12 col-lg-12">
                     <div class="panel panel-primary">
                       <div class="panel-heading" stlyle="height: 70px; width: 100px">
                             <center><span class="modal-title" id="myModalLabel" style="color: #FFF; font-size: 18px"><strong>Ayuda Registro de Pagos</strong></span></center>
                       </div>
                       <div class="panel-body">
                           <p ALIGN="justify">Señor usuario tener en cuenta estas recomendaciones a la hora de registrar un pago:</p>
                           <ol>
                             <li ALIGN="justify">Dependiendo el tipo de pago y el tipo de empleado se habilitan o inhabilitan campos.</li>
                             <li ALIGN="justify">Los campos marcados con asterisco (*) son obligatorios, por lo tanto si no se diligencian el sistema
                                                  no dejará seguir.</li>
                             <li ALIGN="justify">El campo valor prima solo se activará cuando el sistema se encuentre en las fechas del 15 al 30 de Junio
                                                  y del 15 al 30 de Diciembre.</li>
                               <li ALIGN="justify">Al registrar un pago final, si el empleado no ha cumplido el año de labores los diferentes valores
                                    como prima, cesantías, vacaciones, etc. se pagarán de forma proporcional de acuerdo a los días laborados
                                    desde la fecha de contrato hasta la fecha de ese pago.</li>
                           </ol>
                       </div>
                       <br>
                     </div>
                   </div>
                 </div>
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
             <button type="button" class="btn btn-primary btn-md active pull-right"  data-dismiss="modal" onclick="abrirmodal2()"><i class="fa fa-check-circle" aria-hidden="true">&nbsp;Aceptar</i></button>
           </div>
      </div>
  </div>
</div>
</div>
</div>


      <script>
        function calcularElPagoNormalEnLiquidacion() {
          var valordia = $("#valorDia").val();
          var dias = $("#idDia").val();

          var valor = valordia.replace('.', '');
          var pago = parseInt(dias * valor);
          $("#valor_pagoLi").val(pago);

          $("#valorvacacionestot").val(0);
          $("#totalvacaciones").html(0);
          $("#valorcesantias").val(0);
          $("#idtotalcesantias").html(0);
          $("#valortotliquidacion").val(0);
          $("#totalliquidaciones").html(0);
          $("#valortotaltempo").val(0);
          $("#totaltemporales").html(0);

        }
      </script>
      <script type="text/javascript">
    		function traervalorVentas(){

    			var Idper = $("#identi").val();
    			var fechai = $("#idfechainicial").val();

    			$.ajax({
    				url: url +'Empleados/valorVentasEmp',
    				type: 'POST',
    				dataType: 'JSON',
    				data: {Idp:Idper, fech:fechai},
    			})
    			.done(function(respuesta) {
    				if(respuesta.v != null){
    					var valor = respuesta.v;
              		$("#valor_Ventas").val(valor);
              		$("#neto").val("");
			        $("#total").html(0);
			        $("#valorcomision").val("");
			        $("#totalco").html(0);
			        $("#totalpago").val("");
			        $("#totalpagos").html(0);
	              }else if(respuesta.v == null){
	              		var valor = respuesta.v;
                    swal({
                    title: "El empleado no tiene ventas registradas",
                    confirmButton: "#3CB371",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false,
                    });
              		$("#valor_Ventas").val(0);
	              }
	      			})
      	}
      	</script>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#bguardar").click(function(){
              $("#myForm").parsley().validate();
            });
          });

        //Validaciones de fechas en liquidación
        function vali() {
          $("#valorvacacionestot").val(0);
          $("#totalvacaciones").html(0);
          $("#valorcesantias").val(0);
          $("#idtotalcesantias").html(0);
          $("#valortotliquidacion").val(0);
          $("#totalliquidaciones").html(0);
          $("#valortotaltempo").val(0);
          $("#totaltemporales").html(0);
          // $("#valor_primaser").val(0);

          if ($("#idDia").val() == "") {
            swal({
              title: "No se han ingresado días validos!",
              type: "error",
              confirmButton: "#3CB371",
              confirmButtonText: "btn-danger",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,
              },
              function(isConfir){
                $("#valorvacacionestot").val(0);
                $("#totalvacaciones").html(0);
                $("#valorcesantias").val(0);
                $("#idtotalcesantias").html(0);
                $("#valortotliquidacion").val(0);
                $("#totalliquidaciones").html(0);
                $("#valortotaltempo").val(0);
                $("#totaltemporales").html(0);
                });
                return false;
          };

          var fechaContrato = $("#fecha_Contrato").val();

            var fechafinal = $("#idfechafin").val();
            var fincontrato2 = $("#fechaliquidacion2").val();
            var f1 = new Date(fechaContrato);
            var f2 = new Date(fechafinal);
            var f3 = new Date(fincontrato2);

              if(f1 >= f2){
                swal({
                    title: "La fecha de liquidación no puede ser menor o igual a la fecha de contrato.!",
                    type: "warning",
                    confirmButton: "#3CB371",
                    confirmButtonText: "btn-danger",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: true,
                    },
                    function(isConfir){
                      $("#idfechafin").val(fincontrato2);
                      });
                      return false;
              }
              else if(f2 > f3){
                $("#idfechafin").val(fincontrato2);
                  swal({
                    title: "Fecha Invalida.!",
                    type: "warning",
                    confirmButton: "#3CB371",
                    confirmButtonText: "btn-danger",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: true,
                    },
                    function(isConfir){
                      $("#idfechafin").val(fincontrato2);
                      });
                    return false;
              }else if(f2 < f3){
                // $("#divvalorprimaservicios").show();
                return true;
              }
              else{
                // $("#divvalorprimaservicios").show();
                // $("#valor_primaser").val(0);
                return true;
                }
        }

        function valid() {
          $("#neto").val("");
          $("#total").html(0);
          $("#valorcomision").val("");
          $("#totalco").html(0);
          $("#totalpago").val("");
          $("#totalpagos").html(0);
          $("#valor_pagoLi").val(0);
          $("#valorvacacionestot").val("");
          $("#totalvacaciones").html(0);
          $("#valorcesantias").val("");
          $("#idtotalcesantias").html(0);
          $("#valortotliquidacion").val("");
          $("#totalliquidaciones").html(0);
        }

        </script>
        <script type="text/javascript">

             function calcularSalario(){
              if (vali()) {
              var salario = $("#valorBase").val().replace('.','').replace('$','').replace('.','');
              var PendientePrestamos = parseInt($("#valor_penprestamos").val());
              var valorDia = parseInt($("#valorDia").val().replace('.',''));
              var CantidaddeDias = parseInt($("#idDia").val());
              var pagoNormalCalculadoLiqui = parseInt($("#valor_pagoLi").val());
              var ventas = $("#valor_Ventas").val().replace('.','').replace(",", "");
              var comision = $("#comision").val();
              var resulcomision = Math.round(ventas * comision);
              $("#valorcomi").val(resulcomision);
              var prima = parseInt($("#valor_primaser").val());
              var vacaciones = parseInt($("#valorvacaciones").val());
              var resulvacaprima = prima + vacaciones;
              var pagoneto = valorDia * CantidaddeDias;
              var pagototal = pagoneto + resulcomision + prima;
              $("#vacaprima").val(resulvacaprima);
              var cesa =  parseInt($("#valorcesantias").val());

               //En este bloque se saca la diferencia de días entre la fecha de contrato y fecha final
              var fechaContrato = $("#fecha_Contrato").val();
              var fechafinal = $("#idfechafin").val();
              var date1 = new Date(fechaContrato);
              var date2 = new Date(fechafinal);
              var timeDiff = Math.abs(date2.getTime() - date1.getTime());
              var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

              //Valor de las cesantias
              var valortotalcesantias = parseInt((salario * diffDays) / 360);

              //Valor de las vacaciones
              var valvacaciones = parseInt((salario * diffDays) / 720);

              //Valor total liquidación
              var totalliquidaciones = valvacaciones + valortotalcesantias + pagoNormalCalculadoLiqui + prima - PendientePrestamos;

              //Salario Neto
               var html = '        <div class="cta-desc">';
                   html += '           <p data-valor="'+pagoneto+'"></p>';
                   html += '    </div>';
                   html += '<input type="hidden" name="total" value="'+total+'">';
                   html += ' </div>';

                $("#detalle").append(html);
                    calcularTotal();

                //Valor Comision
                var html1 = '        <div class="cta-desc">';
                   html1 += '           <p data-valorcomision="'+resulcomision+'"></p>';
                   html1 += '    </div>';
                   html1 += '<input type="hidden" name="" value="'+valorcomision+'">';
                   html1 += ' </div>';

                   $("#detalle").append(html1);
                    calcularTotal();

                //Pago total
                var html2 = '        <div class="cta-desc">';
                   html2 += '           <p data-valorfinal="'+pagototal+'"></p>';
                   html2 += '    </div>';
                   html2 += '<input type="hidden" id="" name="txttotal" value="'+totalpago+'">';
                   html2 += ' </div>';

                   $("#detalle").append(html2);
                    calcularTotal();

                //Valor Cesantias
                var html3 = '        <div class="cta-desc">';
                   html3 += '           <p data-valorcesantias="'+valortotalcesantias+'"></p>';
                   html3 += '    </div>';
                   html3 += '<input type="hidden" name="" value="'+valorcesantias+'">';
                   html3 += ' </div>';

                   $("#detalle").append(html3);
                    calcularTotal();

                //Valor Vacaciones
                var html4 = '        <div class="cta-desc">';
                   html4 += '           <p data-valorvacaciones="'+valvacaciones+'"></p>';
                   html4 += '    </div>';
                   html4 += '<input type="hidden" name="" value="'+valorvacacionestot+'">';
                   html4 += ' </div>';

                   $("#detalle").append(html4);
                    calcularTotal();

                //Valor Total liquidación
                var html5 = '        <div class="cta-desc">';
                   html5 += '           <p data-valorliquidacion="'+totalliquidaciones+'"></p>';
                   html5 += '    </div>';
                   html5 += '<input type="hidden" name="" value="'+valortotliquidacion+'">';
                   html5 += ' </div>';


                   $("#detalle").append(html5);
                    calcularTotal();
              }
            }

             function calcularTotal(){

               if ($("#selectTipoPago").val() == 1) {
               var total = 0;
               var valorcomision = 0;
               var totalpago = 0;
               var salarioBase = $("#valorBase").val();
               var valorDia = $("#valor_Dia").val();
               var CantidaddeDias = $("#idDia").val();
               var valorVentas = parseInt($("#valor_Ventas").val().replace(',',''));
               var valorComision = parseInt($("#comision").val());

               $("[data-valor]").each(function(key, value){

                 total = parseInt($(value).attr("data-valor"));

               });

               $("[data-valorcomision]").each(function(key, value){

                 valorcomision = parseInt($(value).attr("data-valorcomision"));

               });

               $("[data-valorfinal]").each(function(key, value){

                 totalpago = parseInt($(value).attr("data-valorfinal"));

               });

                $("#total").html(total);
                $("#neto").val(total);
                $("#totalco").html(valorcomision);
                $("#valorcomision").val(valorcomision);
                $("#totalpagos").html(totalpago);
                $("#totalpago").val(totalpago);

                $("#total").priceFormat(
                {
                centsLimit: 3,
                clearPrefix: true
                }
                );

                $("#totalco").priceFormat(
                {
                centsLimit: 3,
                clearPrefix: true
                }
                );

                $("#totalpagos").priceFormat(
                {
                centsLimit: 3,
                clearPrefix: true
                }
                );
              }
              else if($("#selectTipoPago").val() == 2)
              {
                var total = 0;
                var valorcesantias = 0;
                var valorvacacionestot = 0;
                var valortotliquidacion = 0;
                var salarioBase = $("#valorBase").val();
                var valorVentas = $("#valor_Ventas").val().replace(',','');
                var valorComision = $("#comision").val();
                var valorvacaprima = $("#vacaprima").val();
                var cesantias = $("#valorcesantias").val();

               $("[data-valorcesantias]").each(function(key, value){

               valorcesantias = parseInt($(value).attr("data-valorcesantias"));

               });

               $("[data-valorvacaciones]").each(function(key, value){

               valorvacacionestot = parseInt($(value).attr("data-valorvacaciones"));

               });

               $("[data-valorliquidacion]").each(function(key, value){

               valortotliquidacion = parseInt($(value).attr("data-valorliquidacion"));

               });

                $("#total").html(total);
                $("#txttotal").val(total);
                $("#idtotalcesantias").html(valorcesantias);
                $("#valorcesantias").val(valorcesantias);
                $("#totalvacaciones").html(valorvacacionestot);
                $("#valorvacacionestot").val(valorvacacionestot);
                $("#totalliquidaciones").html(valortotliquidacion);
                $("#valortotliquidacion").val(valortotliquidacion);

                $("#total").priceFormat(
                {
                centsLimit: 3,
                clearPrefix: true
                }
                );

                $("#idtotalcesantias").priceFormat(
                {
                centsLimit: 3,
                clearPrefix: true
                }
                );

                $("#totalvacaciones").priceFormat(
                {
                centsLimit: 3,
                clearPrefix: true
                }
                );

                $("#totalliquidaciones").priceFormat(
                {
                centsLimit: 3,
                clearPrefix: true
                }
                );

               }
             }

             function valitempo() {

                var diasTemporal = $("#valorDiatemporal").val().replace('.','');
                var diasLaborados = $("#dias_laborados").val();
                var tipoEmpleado = $("#tipoEmpleado").val();

                if(diasTemporal == "" || diasLaborados == "" && tipoEmpleado == "Empleado-temporal"){
                  swal({
                        title: "No se han ingresado un número válido!",
                        type: "error",
                        confirmButton: "#3CB371",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false,
                        closeOnCancel: false
                      });
                      return false;
                      $("#valortotaltempo").val("");
                      $("#idfechafin").removeAttr("data-parsley-required");
                  }
                  else{
                    return true;
                  }
            }

             function calcularTemporal() {
                if (valitempo()) {
                 var dias = $("#dias_laborados").val();
                 var valorDia = $("#valorDiatemporal").val().replace('.','');

                 var html = '<div class="row"><div class="col-md-9 cta-contents">';
                     html += '        <div class="cta-desc">';
                     html += '           <p data-valor="'+dias * valorDia+'"></p>';
                     html += '    </div>';
                     html += '<input type="hidden" name="total" value="'+valortotaltempo+'">';
                     html += ' </div>';
                     html += '  </div>';
                     html += '</div>';

                  $("#detalle").append(html);

                  calcularSalarioTemporal();
                }
             }

             function calcularSalarioTemporal(){

               var valortotaltempo = 0;
               var dias = $("#dias_laborados").val();
               var valorDia = $("#valorDiatemporal").val().replace('.','');

               $("[data-valor]").each(function(key, value){

                 valortotaltempo = parseInt(dias) * parseInt(valorDia);

               });
                $("#totaltemporales").html(valortotaltempo);
                $("#valortotaltempo").val(valortotaltempo);
                $("#totaltemporales").priceFormat(
                {
                centsLimit: 3,
                clearPrefix: true
                }
                );
             }
             </script>
             <script type="text/javascript">
               $(document).ready(function(){
                 $("#selectTipoPago").select2();
                 $("#selectTipoPago").change(function(){
                  cambiarCampos();
                  $("#idfechafin").val($("#idfechafin").val());
              });
            });
               function cambiarCampos() {
                 var tipo=$("#selectTipoPago").val();
                 var fechaliquidacion2 = $("#fechaliquidacion2").val();
                 var ultimoPago = $("#idfechainicial").val();
                 var fechaactual2 = new Date().toJSON().slice(0,10);
                  if(tipo == 1) {
                    $("#idfechafin").val(fechaliquidacion2);
                    var fechaactual2 = new Date().toJSON().slice(0,10);
                    var dato = fechaactual2;
                    var elemento = dato.split('-');
                    var years = elemento[0];
                    var meses = elemento[1];
                    var dias = elemento[2];
                    if (meses == 6 && dias >= 15 && dias <=30 ) {
                          $("#divvalorprimaservicios").show();
                      }
                    if (meses == 6 && dias < 15) {
                          $("#divvalorprimaservicios").hide();
                      }
                    if (meses == 6 && dias == 31) {
                          $("#divvalorprimaservicios").hide();
                      }
                    if (meses != 6) {
                          $("#divvalorprimaservicios").hide();
                      }
                    if (meses == 12 && dias >= 15 && dias <=30 ) {
                          $("#divvalorprimaservicios").show();
                      }
                    if (meses == 12 && dias < 15) {
                          $("#divvalorprimaservicios").hide();
                      }
                    if (meses == 12 && dias == 31) {
                          $("#divvalorprimaservicios").hide();
                      }
                    if (meses != 12) {
                          $("#divvalorprimaservicios").hide();
                      }

                    $("#divTipoPago").show();
                    $("#divTiempoPago").show();
                    $("#divPorcentaje").show();
                    $("#divValorBase").hide();
                    $("#divIdentificacion").show();
                    $("#divTipoEmpleado").show();
                    $("#divFechacontrato").hide();
                    $("#divDiasLaborados").hide();
                    $("#divvalorvacaciones").hide();
                    $("#divvalorcesantias").hide();
                    $("#divvalorventas").show();
                    $("#divPagoTotal").show();
                    $("#divFechapagoliquidacion").hide();
                    $("#divValordia").show();
                    $("#divFechaInicial").show();
                    $("#divdias").show();
                    $("#divPagoTotalliquidacion").hide();
                    $("#divPagoTotalTemporallol").hide();
                    $("#divvalorpenditeprestamo").hide();
                    $("#divvalorultipago").hide();
                    $("#valor_penprestamos").val(0);
                    $("#valor_ultimopago").val(0);
                    $("#valor_primaser").val(0);
                    $("#valor_pagoLi").val(0);
                    $("#totalvacaciones").html("0");
                    $("#idtotalcesantias").html("0");
                    $("#totalliquidaciones").html("0");
                    $("#valorvacacionestot").val(0);
                    $("#valorcesantias").val(0);
                    $("#valortotliquidacion").val(0);

                  }else if (tipo == 2) {

                    $("#idfechafin").val(fechaliquidacion2);
                    var fechaactual2 = new Date().toJSON().slice(0,10);
                    var dato = fechaactual2;
                    var elemento = dato.split('-');
                    var years = elemento[0];
                    var meses = elemento[1];
                    var dias = elemento[2];

                    if (meses == 12 && dias >= 15 && dias <=30 ) {
                          $("#divvalorprimaservicios").hide();
                      }
                    if (meses == 12 && dias < 15) {
                          $("#divvalorprimaservicios").hide();
                      }
                    if (meses == 12 && dias == 31) {
                          $("#divvalorprimaservicios").hide();
                      }
                    if (meses != 12) {
                          $("#divvalorprimaservicios").hide();
                      }

                    $("#divFechacontrato").removeAttr('style');
                    $("#divFechapagoliquidacion").removeAttr('style');
                    $("#divTipoPago").show();
                    $("#divTiempoPago").hide();
                    $("#divPorcentaje").hide();
                    $("#divValorBase").show();
                    $("#divIdentificacion").show();
                    $("#divTipoEmpleado").show();
                    $("#divDiasLaborados").hide();
                    $("#divvalorprima").show();
                    $("#divvalorvacaciones").show();
                    $("#divvalorcesantias").show();
                    $("#divvalorventas").hide();
                    $("#divPagoTotal").hide();
                    $("#divValordia").hide();
                    $("#divFechaInicial").hide();
                    $("#divdias").show();
                    $("#divPagoTotalliquidacion").show();
                    $("#divPagoTotaltemporal").hide();
                    $("#divvalorpenditeprestamo").show();
                    $("#divvalorultipago").show();
                    $("#valor_Ventas").val(0);
                    $("#total").html("0");
                    $("#totalco").html("0");
                    $("#totalpagos").html("0");
                    $("#neto").val(0);
                    $("#valorcomision").val(0);
                    $("#totalpago").val(0);
                    $("#valor_primaser").val(0);
                    $("#valorvacacionestot").val(0);
                    $("#valorcesantias").val(0);
                    $("#valortotliquidacion").val(0);

                  }
                  if(tipo == 1 && ultimoPago == fechaactual2){
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
               }
          </script>

          <script type="text/javascript">
          function error() {
              swal({
                title: "La fecha de liquidación no puede ser menor a la la fecha de contrato",
                type: "error",
                confirmButton: "#3CB371",
                confirmButtonText: "btn-danger",
                cancelButtonText: "Cancelar",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,

                });
            };

            function cerrarpago() {
              $("#valor_Ventas").val("");
              $("#neto").val("");
              $("#valorcomision").val("");
              $("#totalpago").val("");
              $("#valorvacacionestot").val("");
              $("#valorcesantias").val("");
              $("#valortotliquidacion").val("");
              $("#valortotaltempo").val("");
              $("#dias_laborados").val("");
              $("#valor_penprestamos").val("");
              $("#selectTipoPago").select2("destroy");
              $("#selectTipoPago").val(1);
              $("#selectTipoPago").select2();

              $("#total").html(0);
              $("#totalco").html(0);
              $("#totalpagos").html(0);
              $("#totalvacaciones").html(0);
              $("#idtotalcesantias").html(0);
              $("#totalliquidaciones").html(0);
              $("#totaltemporales").html(0);
              cambiarCampos();
            }
          </script>
          <script type="text/javascript">
            function cancelar() {
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
                      closeOnConfirm: false,
                      closeOnCancel: false
                    },
                    function(isConfir){
                      window.location.reload();
                    });
                  }
                  });
               }
          </script>
          <script type="text/javascript">
              function isNum(arg)
              {
                var args = arg;

                if (args == "" || args == null || args.length == 0)
                {
                  return false;
                }

                args = args.toString();

                for (var i = 0;  i<args.length;  i++)
                {
                  if ((args.substring(i,i+1) < "0" || args.substring(i, i+1) > "9") && args.substring(i, i+1) != ".")
                  {
                  return false;
                  }
                }
                return true;
              }
          </script>

          <script type="text/javascript">
            function checkday(aa)
            {
              var val = aa.value;
              var valc = val.substring(0,1);

              if(val.length>0 && val.length<3)
              {
                if(!isNum(val) || val == 0)
                {
                  aa.value="";
                }
                else if( val < 1 || val > 30)
                {
                  aa.value=valc;
                }
              }
              else if(val.length>2)
              {
                val = val.substring(0, 2);
                aa.value=val;
              }

            }
          </script>

          <script type="text/javascript">
            $("#valorDiatemporal").keydown(function(e){
              if(e.which === 189 || e.which === 69){
                e.preventDefault();
              }
            });

            $("#dias_laborados").keydown(function(e){
              if(e.which === 189 || e.which === 69){
                e.preventDefault();
              }
            });

            $("#idDia").keydown(function(e){
              if(e.which === 189 || e.which === 69){
                e.preventDefault();
              }
            });

            $("#calcularFijos").click(function(){
              var dias = $("#idDia").val();
              var fecha = $("#idfeter").val();

              if(dias == ""){
                swal({
                    title: "No se han ingresado días válidos!",
                    type: "error",
                    confirmButton: "#3CB371",
                    confirmButtonText: "Aceptar",
                    // confirmButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                  });
                    $("#neto").val("");
                    $("#valorcomision").val("");
                    $("#totalpago").val("");
                    $("#valorvacacionestot").val("");
              }
            });

          </script>

          <script type="text/javascript">
          function validarTotales(){
              var tipoPago = $("#selectTipoPago").val();
              var tipoEmpleado = $("#tipoEmpleado").val();

              if(tipoPago == 1 && tipoEmpleado == "Empleado-fijo"){
                $("#valorDiatemporal").removeAttr("data-parsley-required");
                $("#dias_laborados").removeAttr("data-parsley-required");

                var neto = $("#neto").val();

                if(neto == NaN || neto == "" || neto == 0){
                  swal({
                    title: "No hay totales calculados!",
                    type: "error",
                    confirmButton: "#3CB371",
                    confirmButtonText: "Aceptar",
                    // confirmButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                  });
                  return false;
                }else{
                  return true;
                }
              }else if(tipoPago == 2 && tipoEmpleado == "Empleado-fijo"){

                $("#valorDiatemporal").removeAttr("data-parsley-required");
                $("#dias_laborados").removeAttr("data-parsley-required");

                var vacaciones = $("#valorvacacionestot").val();

                if(vacaciones == NaN || vacaciones == "" || vacaciones == 0){
                  swal({
                    title: "No hay totales calculados!",
                    type: "error",
                    confirmButton: "#3CB371",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                  });
                  return false;
                }else{
                  return true;
                }

              }
              else if(tipoEmpleado == "Empleado-temporal"){
                  var totalTemp = $("#valortotaltempo").val();
                  if(totalTemp == NaN || totalTemp == "" || totalTemp == 0){
                    swal({
                      title: "No hay totales calculados!",
                      type: "error",
                      confirmButton: "#3CB371",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    });
                  return false;
                }
              }else{
                return true;
              }
            }
          </script>
          <script type="text/javascript">
          function traervalorprestamopen() {
            var identificacion = $("#identi").val();

            $.ajax({
              url: url +'Empleados/valorprestamopendiente',
              type: 'POST',
              dataType: 'JSON',
              data: {identificacion: identificacion},
            })
            .done(function(respuesta) {
              if (respuesta.v != null) {
                var valorp = respuesta.v;
                var suma = 0;
                var ids = "";
                var array = [];
                var valores = [];
                for (var i = 0; i <= valorp.length - 1; i++) {
                  var id = valorp[i]["id_prestamos"];
                  var valor = valorp[i]["valor_prestamo"];
                  suma = suma + parseInt(valor);

                  array.push(id);
                  valores.push(valor);
                  // if (i == 0) {
                  //   $("#idPrestamosPen2").val(id);
                  // }else{
                  //   $("#idPrestamosPen").val(id);
                  // }
                };
                $("#idPrestamosPen").val(array);
                $("#valor_penprestamos").val(suma);
                $("#valorPrestamosPen").val(valores);
                $("#valorvacacionestot").val(0);
      	        $("#totalvacaciones").html(0);
      	        $("#valorcesantias").val(0);
      	        $("#idtotalcesantias").html(0);
      	        $("#valortotliquidacion").val(0);
      	        $("#totalliquidaciones").html(0);
              }else if(respuesta.v == null){
              	var valorp = respuesta.v;
                swal({
                title: "El empleado no tiene préstamos pendientes",
                confirmButton: "#3CB371",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                });
              	$("#valor_penprestamos").val(0);
              }

            })
          }
        </script>
          <script>
            function valorPrima1() {

              var selectipo = $("#selectTipoPago").val();
              var tipooptionSelect = $("#selectTipoPago").val();
              //Valor Prima
              var salario = parseInt($("#valorBase").val().replace('.','').replace('$','').replace('.',''));
              var fechaContrato = $("#fecha_Contrato").val();
              var fechafinalizacionContrato = $("#idfechafin").val();
              var fechapago = new Date().toJSON().slice(0,10);

              var date123 = new Date(fechaContrato);
              var date223 = new Date(fechapago);
              var timeDiffsjunio = Math.abs(date223.getTime() - date123.getTime());
              var diffDayssjunio = Math.ceil(timeDiffsjunio / (1000 * 3600 * 24));
              var datejunio = fechaContrato;
              var elemjunio = datejunio.split('-');
              var yearjunio = elemjunio[0];
              var mesjunio = elemjunio[1];
              var diajunio = elemjunio[2];

              var date12 = new Date(fechaContrato);
              var date22 = new Date(fechafinalizacionContrato);
              var timeDiffs = Math.abs(date22.getTime() - date12.getTime());
              var diffDayss = Math.ceil(timeDiffs / (1000 * 3600 * 24));
              var date = fechaContrato;
              var elem = date.split('-');
              var year = elem[0];
              var mes = elem[1];
              var dia = elem[2];

              //Cuando hay primas pagadas
              var fechaContrato2 = $("#idfechaPagoPJunio").val();
              var fechapago2 = new Date().toJSON().slice(0,10);
              var date12jhoan = new Date(fechaContrato2);
              var date22jhoan = new Date(fechafinalizacionContrato);
              var timeDiffsjhoan = Math.abs(date22jhoan.getTime() - date12jhoan.getTime());
              var diffDayssjhoan = Math.ceil(timeDiffsjhoan / (1000 * 3600 * 24));

              // var fecha1 = new Date(2008,06,10);
              // var fecha2 = new Date(2008,06,15);
              // var diasDif = fecha2.getTime() - fecha1.getTime();
              // var dias = Math.round(diasDif/(1000 * 60 * 60 * 24));
              // alert("dias de diferencia: " + dias);

              var dates = fechaContrato2;
              var elems = dates.split('-');
              var years = elems[0];
              var mess = elems[1];
              var dias = elems[2];


              //Pago de prima en pago final
              if (mes >= 1 && mes <=6 && tipooptionSelect == 2) {
                var PagototalPrima = diffDayss * parseInt(salario) / 360;
                $("#valor_primaser").val(parseInt(PagototalPrima));
              }
              //Pago de prima en pago normal
              if (mes >= 1 && mes <=6 && tipooptionSelect == 1) {
                var PagototalPrima = diffDayssjunio * parseInt(salario) / 360;
                $("#valor_primaser").val(parseInt(PagototalPrima));
              }

              if (mes >=6 && mes <= 12 && fechaContrato2 == "") {
                var PagototalPrima3 = diffDayssjunio * parseInt(salario) / 360;
                $("#valor_primaser").val(parseInt(PagototalPrima3));
              };

              if(mess >= 6 && mess <= 12){
                var PagototalPrima2 = diffDayssjhoan * parseInt(salario) / 360;
                $("#valor_primaser").val(parseInt(PagototalPrima2));
              }

            }
          </script>
          <script type="text/javascript">
          	function  limpiarCampos() {
        	  	$("#valor_penprestamos").val(0);
        	  	$("#valor_Ventas").val(0);
        	  	$("#neto").val("");
        			$("#total").html(0);
        			$("#valorcomision").val("");
        			$("#totalco").html(0);
        			$("#totalpago").val("");
        			$("#totalpagos").html(0);
  		        $("#valorvacacionestot").val(0);
  		        $("#totalvacaciones").html(0);
  		        $("#valorcesantias").val(0);
  		        $("#idtotalcesantias").html(0);
  		        $("#valortotliquidacion").val(0);
  		        $("#totalliquidaciones").html(0);
          	}

          	$("input[name='txtValorDia']").on('keyup keypress blur change', function(e) {
			    //return false if not 0-9
			    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			       return false;
			    }else{
			        //limit length but allow backspace so that you can still delete the numbers.
			        if( $(this).val().length >= parseInt($(this).attr('maxlength')) && (e.which != 8 && e.which != 0)){
			            return false;
			        }
			    }
			});
			$("input[name='txtdiasLaborados']").on('keyup keypress blur change', function(e) {
			    //return false if not 0-9
			    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			       return false;
			    }else{
			        //limit length but allow backspace so that you can still delete the numbers.
			        if( $(this).val().length >= parseInt($(this).attr('maxlength')) && (e.which != 8 && e.which != 0)){
			            return false;
			        }
			    }
			});
      $("input[name='txtValorDia']").on('keyup keypress blur change', function(e) {
          //return false if not 0-9
          if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
             return false;
          }else{
              //limit length but allow backspace so that you can still delete the numbers.
              if( $(this).val().length >= parseInt($(this).attr('maxlength')) && (e.which != 8 && e.which != 0)){
                  return false;
              }
          }
      });
        $(".price").priceFormat({
          centsLimit: 3,
          prefix: '$ '
        });

          </script>
