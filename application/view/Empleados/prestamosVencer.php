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
        <center><span style="text-align:center; color: #fff; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><b>Listar Préstamos Empleados</b></span></center>
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
              <th>Tipo Empleado</th>
              <th>Ver Detalles</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($notificacionPrestamos as $prestamos): ?>
              <tr style="color: red">
                <td><?=  $prestamos['id_persona'] ?></td>
                <td><?=  $prestamos['nombres'] ?></td>
                <td><?=  $prestamos['apellidos'] ?></td>
                <td><?=  $prestamos['Tbl_nombre_tipo_persona'] ?></td>
                <td><button type="button" class="btn btn-primary btn-circle btn-md" data-toggle="modal" data-target="#myJhoan" data-tipop = "<?=  $prestamos['Tbl_nombre_tipo_persona'] ?>" title="Detalles Préstamo" onclick="traerDetallePrestamos('<?=  $prestamos['id_persona'] ?>')"><i class="fa fa-eye" aria-hidden="true"></i></button>
                <a href="<?= URL ?>Empleados/generarpdfPrestamos/<?= $prestamos['id_persona'] ?>" target="_blank" id="pdfDetalPagos">
                    <button class="btn btn-success btn-circle btn-md" name="btnPdfPagos" title="Generar Pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                </a>
              </tr>
            </td>
          </tbody>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_reportes_prestamos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="display:none" style="width: 50px" action="<?= URL ?>Compras/registrarCompra">
   <div class="modal-dialog" role="document">
       <div class="modal-content" style="width: 900px">
         <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-primary">
                  <div class="panel-heading" stlyle="height: 70px; width: 100px">
                        <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px">Reporte de Préstamos</center>
                  </div>
                <div class="panel-body" id="panel_compras">
                  <form id="formprestamos" action="<?= URL ?>Empleados/pdfPrestamos" method="post" data-parsley-validate="" target="_blank">
                  <div class="row">
                    <br>
                    <div class="row">
                      <div class="col-md-1"></div>
                      <div   class="col-md-4">
                        <?php
                          $hoy2 = Date("Y-m-d");
                          $hoy1 = Date("Y-m-d");
                          $nuevaFecha = strtotime('-3 month', strtotime($hoy1));
                          $nuevaFecha = date('Y-m-d', $nuevaFecha);
                         ?>
                          <label for="">Fecha Inicial <span class="obligatorio">*</span></label>
                          <div class="input-group date" data-provide="datepicker">
                          <input type="text" tabindex="1" class="form-control" readonly="true" name="txtfechainicial1" id="txtfechainicial1" value="<?= $nuevaFecha ?>" data-parsley-required="true">
                          <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                        </div>
                        </div>
                        <input type="hidden" name="txtfechainicial2" id="txtfechainicial2" value="<?= $nuevaFecha ?>">
                      </div>
                      <div class="col-md-1"></div>
                      <div   class="col-md-4">
                          <label for="">Fecha Final <span class="obligatorio">*</span></label>
                          <div class="input-group date" data-provide="datepicker">
                          <input type="text" tabindex="2" class="form-control" name="txtfechafinal1" readonly="true" id="txtfechafinal1"  value="<?= $hoy1 ?>"data-parsley-required="true">
                          <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                        </div>
                        </div>
                        <input type="hidden" name="txtfechafinal2" id="txtfechafinal2" value="<?= $hoy2 ?>">
                    </div>
                  </div>
                  <br><br>
                  <div class="row">
                    <div class="col-md-5"></div>
                      <div class="col-md-4">
                        <button type="submit" tabindex="3" class="btn btn-primary active" id="btn-pdf" name="btnconsultar" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true">  Generar Reporte</i></button>
                      </div>
                  </div>
                  <br>
                  </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-9">
                <button type="button" tabindex="4" id="btn_cancelar" class="btn btn-secondary btn-md active pull-right"  data-dismiss="modal"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
                <input type="hidden" tabindex="5">
              </div>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>

            <div class="modal fade" id="myJhoan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
              <div class="modal-dialog" role="document" style="width: 90% !important">
                <div class="modal-content">
                  <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-primary" >
                        <div class="panel-heading" stlyle="height: 70px; width: 100px">
                              <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px">Detalle de Préstamos de: <span id="empleado-prestamo"></span></span></center>
                        </div>
                        <div class="panel-body">
                          <div class="dataTable_wrapper">
                            <div class="table-responsive">
                              <div id="cont-table">

                              </div>
                            </div>
                          </div>
                    </div>
                   </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-md-12 col-lg-12">
                    <button type="button" class="btn btn-secondary btn-active pull-right"  data-dismiss="modal" style="margin-left:80%" onclick="abrirmodal()"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="mymodificarprestamo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
        <div class="modal-dialog modal-xs" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <form action="<?php echo URL?>Empleados/ListarPrest" method="POST" id="formModPrest" accept-charset="utf-8" data-parsley-validate="" onsubmit="return validarFechaLim()">
              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading" stlyle="height: 70px; width: 100px">
                          <center><span  id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"> Modificar Fecha Límite</span></center>
                    </div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-xs-12 col-md-6" id="divFechalimite">
                        <label>Fecha Límite:</label>
                          <div class="input-group date" data-provide = "datepicker">
                            <div class="input-group-addon" style="border-radius:5px;">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="txtfechalimetepre" data-parsley-required="true" style="border-radius:5px;" step="1" format="yyyy-mm-dd" id="fechalim" readonly="" onchange="validarFechaLim()">
                          </div>
                      </div>
                      <input type="hidden" id="limitemod">
                      <input type="hidden" name="txthideidprestamo" id="idprest">
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                      <div class="col-xs-6 col-md-6 col-lg-7">
                        <button type="button" class="btn btn-secondary btn-active pull-right"  data-dismiss="modal" onclick="abrirmodal()"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
                      </div>
                      <div class="col-xs-5 col-md-6 col-lg-2">
                        <button type="submit" name="btnmodificarprestamo" class="btn btn-success btn-active" id="btnmodificarprestamo"><i class="fa fa-floppy-o" aria-hidden="true">   Guardar</i></button>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

            <div class="modal fade" id="abonosPrestamos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-body" id="modal-detal-abonos">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-primary" >
                        <div class="panel-heading" stlyle="height: 70px; width: 100px">
                              <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px">Detalle de Abonos de: <span id="empleado-det-abonos"></span></span></center>
                        </div>
                        <div class="panel-body">
                          <div class="dataTable_wrapper">
                            <div class="table-responsive">
                              <div id="contenido_abonos">

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
                <div class="col-xs-11 col-md-11 col-lg-11">
                <button type="button" class="btn btn-secondary btn-active pull-right"  data-dismiss="modal" onclick="abrirmodal()"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
              </div>
              </div>
              <br>
          </div>
        </div>
      </div>

            <div class="modal fade" id="abonos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form method="POST" id="abonar" action="<?php echo URL?>Empleados/ListarPrest" data-parsley-validate="" onsubmit="return validarAbono()">
                  <div class="modal-body">
                  <div class="row">
                      <input type="hidden" name="txtidprestamo" id="idprestamos">
                      <input type="hidden" name="" id="totalsumaabono">

                  <div class="panel panel-primary" style="margin-left: 2%; margin-right: 2%">
                    <div class="panel-heading" stlyle="height: 70px; width: 100px">
                          <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px">Abono de Préstamos de: <span id="empleado"></span></span></center>
                    </div>
                    <div class="panel-body">
                    <div class="col-xs-12 col-md-6">
                        <label >Valor Préstamo</label><br>
                        <input type="text" class="form-control" name="txtresta" placeholder="" id="idvalorPrestamo" readonly="">
                        <input type="hidden" name="txtva" id="idtruefalse" value="true">
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <label >Valor Pendiente</label><br>
                      <input type="text" class="form-control" name="txtpendiente" placeholder="" id="idvalorPendiente" readonly="">
                    </div>
                      <div class="col-xs-12 col-md-6">
                        <br>
                        <label >Valor Abono <span class="obligatorio">*</span></label><br>
                        <input type="number" class="form-control" placeholder="Valor Abono" id="idabono" min="1000" step="500" maxlength="8" name="txtvalorabono" data-parsley-type="integer" data-parsley-required="true">
                    </div>
                    </div>
                  </div>
                </div>

                    <div class="row">
                      <div class="col-xs-6 col-md-6 col-lg-6">
                      <button type="button" class="btn btn-secondary btn-active pull-right"  data-dismiss="modal" style="float: right" onclick="abrirmodal()"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
                      </div>
                      <div class="col-xs-6 col-md-6 col-lg-3">
                          <button type="submit" name="btnRegistrarAbono" class="btn btn-success btn-active" id="btnguararAbono" style="float: left"><i class="fa fa-floppy-o" aria-hidden="true">   Guardar</i></button>
                      </div>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <script type="text/javascript">
        $("#txtfechainicial1").change(function(){
          var valor = $('#txtfechainicial1').val();
          var valor2 = $('#txtfechainicial2').val();


          if(valor < valor2){
            swal({
                    title: "Fecha inválida, la fecha no puede ser menor a 3 meses!",
                    type: "error",
                    confirmButtonColor: "#86CCEB",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: true,

                    },
                    function(isConfirm){
                    if (isConfirm) {
                        $('#txtfechainicial1').val(valor2);
                    }
                  })
          }

        });

      </script>
      <script type="text/javascript">
      $("#txtfechafinal1").change(function(){
        var valor3 = $('#txtfechafinal1').val();
        var valor4= $('#txtfechafinal2').val();
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

        <script type="text/javascript">
          $(document).ready(function(){

            $("#btnmodificarprestamo").click(function(){
              validarFechaLim();
                $("#formModPrest").parsley().validate();
              }
            })
          })
        </script>

<script type="text/javascript">
  $(document).ready(function(){

    $("#btnguararAbono").click(function(){

      $("#abonar").parsley().validate();
    })
  })
</script>

<script type="text/javascript">

function abono(valor,idprestamo,valorpen){

  $("#abonos").modal();
  $('#myJhoan').modal('hide');
  $("#idvalorPrestamo").val(valor);
  $("#idprestamos").val(idprestamo);
  $("#idvalorPendiente").val(valorpen);

  $("#idvalorPrestamo").priceFormat({centsLimit: 3, prefix: "$ "});
  $("#idvalorPendiente").priceFormat({centsLimit: 3, prefix: "$ "});
}


  function traerDetallePrestamos(id) {
    var enlace = $("#pdfDetaPrestamos");
    var nUrl = '<?= URL ?>Empleados/generarpdfDetalleAbonos?id=' + id;
    enlace.attr("href", nUrl);
    traerNombreEmpleado(id);

    $.ajax({
      url: url+'Empleados/ajaxDetallePrestamos',
      type: 'post',
      dataType: 'json',
      data: {idPersona:id},
    })
    .done(function(respuesta) {

      var html = '<table class="table table-striped table-bordered table-hover" id="listarDetalle" style="width: 100% !important">' +
                                '<thead id="tit" >' +
                                '</thead>' +
                                '<tbody id="detal_pre">' +
                                '</tbody>' +
                              '</table>';
      $("#cont-table").html(html);
      $('#detal_pre').append(respuesta.html);
      $('#tit').append(respuesta.cabecera);
      $('#empleado').append(respuesta.empleado);
      $('#empleado-prestamo').append(respuesta.empleado);
      $('#empleado-det-abonos').append(respuesta.empleado);
      $(".price").priceFormat({centsLimit: 3, prefix: '$ '});


    var tabla = $('#listarDetalle').DataTable({
    language: {
      url: "http://cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    }, responsive: true,
    sort: false
      });

    });

  }

  function traerDetalleAbonos(id_prestamos) {

    $.ajax({
      url: url+'Empleados/ajaxDetalleAbonos',
      type: 'post',
      dataType: 'json',
      data: {id_prestamos:id_prestamos},
    })
    .done(function(respuesta) {

      var html = '<table class="table table-striped table-bordered table-hover" id="listarabono" style="width: 100% !important">' +
                                '<thead id="titulos" >' +
                                '</thead>' +
                                '<tbody id="detalles_prestamo">' +
                                '</tbody>' +
                              '</table>';
      $('#contenido_abonos').html(html);
      $('#detalles_prestamo').append(respuesta.html);
      $('#titulos').append(respuesta.cabecera);
      $("#abonosPrestamos").modal("show");
      $('#myJhoan').modal('hide');
      $(".price").priceFormat({centsLimit: 3, prefix: '$ '});

    var tabla = $('#listarabono').DataTable({
    language: {
      url: "http://cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    }, responsive: true,
    sort: false
      });

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
</script>
<script type="text/javascript">
  function abrirmodal() {
    $('#myJhoan').modal('show');
    $("#idabono").val("");
  }
</script>
<script type="text/javascript">

 function validarAbono() {
     var valorabo = parseInt($("#idabono").val());
     var pendiente = parseInt($("#idvalorPendiente").val().replace("$", "").replace(",", "").replace(".", ""));
     var valorpres = parseInt($("#idvalorPrestamo").val().replace("$", "").replace(",", "").replace(".", ""));
        if(valorabo > pendiente){
          swal({
                title: "El valor del abono es superior al valor pendiente!",
                type: "error",
                confirmButton: "#3CB371",
                confirmButtonText: "Aceptar",
                // confirmButtonText: "Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
              });
          return false;
          }
        else
        {
          return true;
        }
   }

</script>
<script type="text/javascript">
function traerNombreEmpleado(id){
  $.ajax({
    url:url+"Empleados/ajaxNombreEmpleado",
    type:'POST',
    dataType: 'json',
    data:{
      idPersona:id,
    }
  }).done(function(respuesta){
    $("#empleado-prestamo").text(respuesta.html);
    $("#empleado-det-abonos").text(respuesta.html);
    $("#empleado").text(respuesta.html);
  });
}
</script>

<script type="text/javascript">
function Modificarprestamo(id_prestamos){
  $.ajax({
type:"POST",
url:url+"Empleados/infoprestamos",
data:{
  id_prestamos: id_prestamos,
},
success:function(respuesta){

  $("#fechalim").val(respuesta.fecha_limite);
  $("#limitemod").val(respuesta.fecha_limite);
  $("#valorprestamos").val(respuesta.valor_prestamo);
  $("#idprest").val(respuesta.id_prestamos);
  $("#mymodificarprestamo").modal("show");
  $("#myJhoan").modal("hide");

},
  });
}
</script>

<script type="text/javascript">
      function cambiarestadoabono(cod, est){
  swal({
    title: "¿Realmente desea anular el abono?",
    type: "warning",
    confirmButton: "#3CB371",
    confirmButtonText: "btn-danger",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Aceptar",
    closeOnConfirm: false,

  },
  function(isConfirm){
      if (isConfirm) {
        swal({
          title: "Abono anulado.!",
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
            url:url+"Empleados/modificarestadoAbonos",
            data:{id:cod, estado:est}
          }).done(function(respuesta){
            if(respuesta.v == 1){
              window.location = url + "Empleados/listarPrest";
            }else{
              sweealert("Error al cambiar el estado");
            }
          }).fail(function(){

          })
        });
      }
      });
}
</script>
<script type="text/javascript">
  function devolverAbono(valorAbono,id_prestam) {

    $.ajax({
      url: url +'Empleados/retornarAbono',
      type: 'POST',
      dataType: 'JSON',
      data: {valorAbono:valorAbono,id_prestam:id_prestam},
    })
    .done(function(respuesta) {
      if (respuesta.v) {
        window.location = url + "Empleados/listarPrest";
      };
    });
  }
</script>

<script type="text/javascript">
$("#valorprestamos").keydown(function(e){
  if(e.which === 189 || e.which === 69){
    e.preventDefault();

  }

});

$("#idabono").keydown(function(e){
  if(e.which === 189 || e.which === 69){
    e.preventDefault();

  }

});

      function cambiarestadoprestamo(cod, est){
        // validarSiTieneAbono(cod);
  swal({
    title: "¿Realmente desea cambiar el estado del préstamo?",
    type: "warning",
    confirmButton: "#3CB371",
    confirmButtonText: "btn-danger",
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
            url:url+"Empleados/modificarestadoPrestamo",
            data:{id:cod, estado:est}
          }).done(function(respuesta){
            if(respuesta.v == 1){
              window.location = url + "Empleados/listarPrest";
            }else{
              sweealert("Error al cambiar el estado");
            }
          }).fail(function(){

          })
        });
      }
      });
}
</script>
<script type="text/javascript">
  function validarSiTieneAbono(cod) {
    $.ajax({
      url: url + 'Empleados/ValidarAnularPrestamo',
      type: 'POST',
      dataType: 'JSON',
      data: {cod: cod},
    })
    .done(function(respuesta) {
        if (respuesta.v == null) {
        }
        else
        {
          swal({
            title: "Préstamo con abonos registrados,no se puede cambiar el estado!",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          });
        }
    });

  }

  function validarFechaLim() {
    var Limite = $("#fechalim").val();
    var fechte = $("#limitemod").val();

    if (Limite <= fechte) {
      swal({
        title: "La fecha no puede ser menor o igual a la fecha límite!",
        type: "error",
        confirmButton: "#3CB371",
        confirmButtonText: "btn-danger",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Aceptar",
        closeOnConfirm: true,
        },
        function(isConfir){
          $("#fechalim").val(fechte);
          });
        return false;
    }else{
       return true;
    }
  }
</script>
