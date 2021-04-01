<style type="text/css">
  #panel{
    height: 100%;
  }
</style>
<div class="row">
<br><br>
</div>
<div class="row">
<div class="col-lg-12">
  <div class="panel panel-primary">
    <div class="panel-heading" stlyle="height: 70px; width: 100px">
        <center><span style="text-align:center; color: #fff; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><b>Listar Crédito Ventas</b></span></center>
    </div>
    <div class="panel-body">
      <div class="dataTable_wrapper">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
            <tr>
              <th>Identificación</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Tipo Cliente</th>
              <th>Ver Detalles</th>
            </tr>
          </thead>
          <tbody>

          <?php foreach($notificacionCredito as $cliente): ?>
              <tr style="color: red">
                <td><?=  $cliente['id_persona'] ?></td>
                <td><?=  $cliente['nombres'] ?></td>
                <td><?=  $cliente['apellidos'] ?></td>
                <td><?=  $cliente['Tbl_nombre_tipo_persona'] ?></td>
                <td><button type="button" class="btn btn-primary btn-circle btn-md" data-toggle="modal" data-target="#myJhoan" data-tipop = "<?=  $cliente['Tbl_nombre_tipo_persona'] ?>" title="Listar Créditos" onclick="traerDetalleCreditoV('<?=  $cliente['id_persona'] ?>')"><i class="fa fa-eye" aria-hidden="true"></i></button>
              </tr>
          <?php endforeach; ?>

          </tbody>
        </table>
      </div>

            <div class="modal fade" id="mdListarCreditos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
              <div class="modal-dialog" role="document" style="width: 90% !important">
                <div class="modal-content">
                  <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-primary">
                      <div class="panel-heading" stlyle="height: 70px; width: 100px">
                            <center><span id="creditosClientModal" style="text-align:center; color: #fff; font-size: 18px"><strong>Detalle de Crédito de: <span id="cliente"></span></strong></center>
                      </div>
                        <div class="panel-body">
                          <div class="dataTable_wrapper">
                            <div class="table-responsive">
                              <div id="cont-CreditosV">

                              </div>
                            </div>
                          </div>
                    </div>
                   </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-md-12 col-lg-12">
                    <button type="button" class="btn btn-secondary btn-active pull-right"  data-dismiss="modal"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
                  </div>
                </div>

            </div>
          </div>
        </div>
      </div>

            <div class="modal fade" id="mdListarAbonosCreditosV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body" id="modal-detalles-abonos-creditos">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-primary">
                      <div class="panel-heading" stlyle="height: 70px; width: 100px">
                        <center><span id="creditosClientModal" style="text-align:center; color: #fff; font-size: 18px"><strong>Detalle Abonos de: <span id="cliente-DetallesAbonos"><span></strong></center>
                      </div>
                        <div class="panel-body" id="panelAb">
                          <div class="dataTable_wrapper">
                            <div class="table-responsive">
                              <div id="contenido_abonos_CreditosV">

                              </div>
                            </div>
                            <br>
                          </div>
                    </div>
                   </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-6">
                <button type="button" class="btn btn-secondary btn-active pull-right"  data-dismiss="modal" style="margin-left:80%" onclick="abrirmodal()"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
              </div>
              <?php foreach($info as $va): ?>
                <?php if(($_SESSION['ROL'] == 1 && $va['estado_abono'] == 1) || ($_SESSION['ROL'] == 3 &&  $va['estado_abono'] == 1)): ?>
                <div class="col-xs-6 col-md-6 col-lg-6">
                  <a href="<?= URL ?>Ventas/generarpdfDetalleAbonos" target="_blank" id="pdfDeta">
                    <button class="btn btn-primary" name="btnComprasD"><i class="fa fa-file-pdf-o" aria-hidden="true">   Recibo de Abono</i></button>
                  </a>
                </div>
                <?php break; ?>
            <?php else: ?>

            <?php endif; ?>
          <?php endforeach; ?>
              </div>
              <br><br>
          </div>
        </div>
      </div>

      <div class="modal fade" id="abonoCreditosV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
            <form method="POST" id="form-abonos" action="<?php echo URL?>Ventas/registrarAbonoCreditoVen" data-parsley-validate="">
            <div class="row">
                <input type="hidden" name="txtidprestamoCredV" id="idprestamosCreditoV">
                <input type="hidden" name="" id="totalsumaabonoCred" value="">

                <div class="panel panel-primary" style="margin-left: 2%; margin-right: 2%">
                    <div class="panel-heading" stlyle="height: 70px; width: 100px">
                        <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Abono a Créditos de: <span id="cliente-abonos"></span></strong></center>
                    </div>

                    <div class="panel-body">
                      <div class="col-xs-12 col-md-6">
                    <label >Total Crédito Venta</label><br>
                    <input type="text" class="form-control" name="txtresta" placeholder="" id="idvalorCreditoV" disabled="">
                    <input type="hidden" name="txtva" id="idtruefalse" value="true">
                </div>
                <div class="col-xs-12 col-md-6">
                    <label >Crédito Pendiente</label><br>
                    <input type="text" class="form-control" name="txtresta" placeholder="" id="totalCreditoPendiente" disabled="">
                    <input type="hidden" name="txtva" id="idtruefalse" value="true">
               </div>

               <div class="col-xs-12 col-md-6">
                   <br>
                   <label >Ingresar Abono <span class="obligatorio">*</span></label><br>
                   <input type="number" class="form-control" placeholder="Valor Abono" id="idabono" onblur="validarAbonoCreditoV()" name="txtvalorabono" data-parsley-type="number" data-parsley-required="true">
                   <input type="hidden" name="empleadoAbonoVenta" value="<?= $_SESSION['USUARIO_ID']; ?>">
               </div>
            </div>
          </div>
          </div>
            <br>
              <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-6">
                  <button type="button" class="btn btn-secondary btn-active pull-right"  data-dismiss="modal" style="float: left" onclick="abrirmodal()"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
                </div>

                <div class="col-xs-6 col-md-3 col-lg-3">
                  <button type="submit" name="btnRegistrarAbono" onclick="return validarAbonoCreditoV()" class="btn btn-success btn-active" id="btn-Guardar-Abono"><i class="fa fa-floppy-o" aria-hidden="true">   Guardar</i></button>
                </div>
            </div>
          </form>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="mymodificarCredito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo URL?>Ventas/listarVentasCredito" method="POST" id="formModCredito" accept-charset="utf-8" data-parsley-validate="">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-primary">
              <div class="panel-heading" stlyle="height: 70px; width: 100px">
                  <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Modificar Fecha Límite Crédito</strong></center>
              </div>
            <div class="panel-body">
              <input type="hidden" name="txthiddenCredito" id="idCredito">
              <div class="row">
                <div class="col-xs-12 col-md-6" id="divFechalimite">
                  <label for="txtfechalimeteCredito">Fecha Límite</label>
                        <input type="text" class="form-control" name="txtfechalimeteCredito" data-parsley-required="true" format="yyyy-mm-dd" id="fechalim" readonly="true">
                      </div>

                      <div class="col-xs-12 col-md-6">
                        <label for="txtdiaslimiteCredito">Días Plazo <span class="obligatorio">*</span></label>
                        <input type="number" class="form-control" name="txtdiaslimiteCredito" data-parsley-required="true" id="diasPlazo" max="30" min="1">
                      </div>
                </div>

                <div class="col-md-3">
                </div>
              </div>
            </div>
          </div>
        </div>

          <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-6">
                  <button type="submit" name="btnmodificarCredito" class="btn btn-success btn-active pull-right" onclick="return validarFecha()" id="btnmodificarCredito" style="float: left; margin-left: 70px"><i class="fa fa-floppy-o" aria-hidden="true">   Guardar</i></button>
                </div>

                <div class="col-xs-6 col-md-6 col-lg-4">
                  <button type="button" class="btn btn-secondary btn-active"  data-dismiss="modal" onclick="abrirmodal()"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
                </div>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

function abonosV(valor,id_ventas, valorCreditoPendienteV){

  $("#abonoCreditosV").modal();
  $('#mdListarCreditos').modal('hide');
  $("#idvalorCreditoV").val(valor);
  $("#idprestamosCreditoV").val(id_ventas);
  $("#totalCreditoPendiente").val(valorCreditoPendienteV);

  $("#totalCreditoPendiente").priceFormat({centsLimit: 3, prefix: '$ '});
  $("#idvalorCreditoV").priceFormat({centsLimit: 3, prefix: '$ '});
}


  function traerDetalleCreditoV(id) {
    var enlace = $("#pdfDeta");
    var nUrl = '<?= URL ?>Ventas/generarpdfDetalleAbonos?id=' + id;
    enlace.attr("href", nUrl);

    traerNombreCliente(id);

    $.ajax({
      url: url+'Ventas/ajaxDetalleCreditosV',
      type: 'post',
      dataType: 'json',
      data: {idPersona:id},
    })
    .done(function(respuesta) {

      var html = '<table class="table table-striped table-bordered table-hover" id="listarDetalleV" style="width: 100% !important">' +
                                '<thead id="cabecTab" >' +
                                '</thead>' +
                                '<tbody id="detal_CreditosV">' +
                                '</tbody>' +
                                '</table>';
      $("#cont-CreditosV").html(html);
      $('#detal_CreditosV').append(respuesta.html);
      $('#cabecTab').append(respuesta.cabecera);
      //$("#cliente").text(respuesta.cliente);
      $('#mdListarCreditos').modal("show");
      $(".price").priceFormat({centsLimit: 3, clearPrefix: true});

    var tabla = $('#listarDetalleV').DataTable({
    language: {
      url: "http://cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    }, responsive: true,
    sort: false
      });

    });

  }

  function traerDetalleAbonosCreditosV(id_ventas) {
    $.ajax({
      url: url+'Ventas/ajaxDetalleAbonosCreditosV',
      type: 'post',
      dataType: 'json',
      data: {id_ventas:id_ventas},
    })
    .done(function(respuesta) {

      var html = '<table class="table table-striped table-bordered table-hover" id="listarAbonoCreditosVent" style="width: 100% !important">' +
                                '<thead id="titulosCredV">' +
                                '</thead>' +
                                '<tbody id="detalles_prestamoCredV">' +
                                '</tbody>' +
                                '</table>';
      $('#contenido_abonos_CreditosV').html(html);
      $('#detalles_prestamoCredV').append(respuesta.html);
      $('#titulosCredV').append(respuesta.cabecera);
      $("#mdListarAbonosCreditosV").modal("show");
      $('#mdListarCreditos').modal('hide');
      $(".price").priceFormat({centsLimit: 3, clearPrefix: true});

    var tabla = $('#listarAbonoCreditosVent').DataTable({
    language: {
      url: "http://cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    }, responsive: true,
    sort: false
      });

    });
  }
</script>

<script type="text/javascript">
  function abrirmodal() {
    $('#mdListarCreditos').modal('show');
  }
</script>

<script type="text/javascript">
 function validarAbonoCreditoV(){
   var valorAbonoCV = parseInt($("#idabono").val());
   var valorTotalCV = parseInt($("#idvalorCreditoV").val().replace("$", "").replace(",", "").replace(".", ""));
   var valorPendienteCV = parseInt($("#totalCreditoPendiente").val().replace("$", "").replace(",", "").replace(".", ""));
        if(valorAbonoCV > valorPendienteCV){
          swal({
            title: "El valor del abono es superior al crédito pendiente!",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          });

          $("#idabono").val("");

          return false;
          }
        else
        {
          return true;
        }
   }
</script>


<script type="text/javascript">
  function cambiarestado2(cod, est){
  swal({
    title: "¿Realmente desea cambiar el estado del crédito?",
    type: "warning",
    confirmButton: "#3CB371",
    //confirmButtonText: "btn-danger",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Aceptar",
    closeOnConfirm: false,

  },
  function(isConfirm){
      if (isConfirm) {
        swal({
          title: "Estado cambiado.!",
          type: "success",
          confirmButton: "#3CB371",
          confirmButtonText: "Aceptar",
          // confirmButtonText: "Cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          $.ajax({
            dataType:'json',
            type:'post',
            url:url+"Ventas/modificarEstadoC",
            data:{codigo:cod, estado:est}
          }).done(function(respuesta){
            if(respuesta.v == 1){
              window.location = url + "Ventas/listarVentasCredito";
            }else if(respuesta.v == 2){
            window.location = url + "Ventas/listarVentasCredito";
          }else{
            sweealert("Error cambiando el estado");
          }
          }).fail(function(){

          })
        });
      }
      });
}

</script>

<script type="text/javascript">
  function abonar(nombre, detalle)
    {

      var campos = $(detalle).parent().parent().parent();

      $('#abonos').modal("show");
      $('#myJhoan').modal('hide');
         setTimeout(function(){
          var nombre = $(detalle).attr("data-valor");

         },500);

    }

    function traerNombreCliente(id){
      $.ajax({
        url:url+"Ventas/ajaxNombreCliente",
        type:'POST',
        dataType: 'json',
        data:{ idCliente:id}
      }).done(function(respuesta){
        $("#cliente").text(respuesta.cliente);
        $("#cliente-abonos").text(respuesta.cliente);
        $("#cliente-DetallesAbonos").text(respuesta.cliente);
      });
    }
</script>

<script type="text/javascript">
$("#btn-Guardar-Abono").click(function(){

  $("#form-abonos").parsley().validate();
})

</script>


<script type="text/javascript">
  $("#btnmodificarCredito").click(function(){

    $("#formModCredito").parsley().validate();
  })
</script>


<script type="text/javascript">
  function cambiarestado(cod, est){
  swal({
    title: "¿Realmente desea anular el abono?",
    type: "warning",
    confirmButton: "#3CB371",
    //confirmButtonText: "btn-danger",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Aceptar",
    closeOnConfirm: false,

  },
  function(isConfirm){
      if (isConfirm) {
        swal({
          title: "Abono Anulado.!",
          type: "error",
          confirmButton: "#3CB371",
          confirmButtonText: "Aceptar",
          // confirmButtonText: "Cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          $.ajax({
            dataType:'json',
            type:'post',
            url:url+"Ventas/modificarestadoAbonos",
            data:{codigo:cod, estado:est}
          }).done(function(respuesta){
            if(respuesta.v == 1){
              window.location = url + "Ventas/listarVentasCredito";
            }else if(respuesta.v == 0){
              window.location = url + "Ventas/listarVentasCredito";
          }else{
            sweealert("Error cambiando el estado");
          }
          }).fail(function(){

          })
        });
      }
      });
}

</script>


<script type="text/javascript">
function ModificarCreditos(id_ventas){
  $.ajax({
    type:"POST",
    url:url+"Ventas/infoCreditos",
    data:{
    id_ventas: id_ventas,
  },
  success:function(respuesta){

  $("#fechalim").val(respuesta.fecha_limite_credito);
      $("#idCredito").val(respuesta.id_ventas);
      $("#mymodificarCredito").modal("show");
      $("#mdListarCreditos").modal("hide");
},
  });
}

$("#idabono").keydown(function(e){
  if(e.which === 189 || e.which === 69){
    e.preventDefault();
    //return false;
  }
});


$("#diasPlazo").keydown(function(e){
  if(e.which === 189 || e.which === 69){
    e.preventDefault();
    //return false;
  }
});
</script>
