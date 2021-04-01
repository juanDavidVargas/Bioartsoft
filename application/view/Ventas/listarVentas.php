<div class="row">
  <br><br>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading" stlyle="height: 70px; width: 100px">
                <center> <span style="text-align:center; color: #fff; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><strong>Listar Ventas</strong></span></center>
            </div>
            <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="dataTable_wrapper">
          <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
   <thead>
     <tr>
       <th>Código</th>
       <th>Total Venta</th>
       <th>Fecha Registro Venta</th>
       <th>Identificación Cliente</th>
       <th>Nombre Cliente</th>
       <th>Tipo Pago</th>
       <th>Estado</th>
       <th>Opciones</th>
     </tr>
   </thead>

   <tbody>
      <?php foreach ($Ventas as $value):?>
     <tr>
       <td><?= $value["id_ventas"] ?></td>
       <td><?= "$ " . number_format($value["total_venta"], "0", ".", ".") ?></td>
       <td><?= $value["fecha_venta"] ?></td>
       <td><?= $value['tipo_documento'].' - '.$value["Tbl_persona_idpersona_cliente"] ?></td>
       <td><?= $value["cliente"] ?></td>
       <td><?= $value["tipo_de_pago"] == 2? "Contado": "Crédito" ?></td>
       <td><?= $value["estado"] == 1?"Activa":"Anulada" ?></td>
       <td>

         <?php
                $fechaActual = date('Y-m-d');
         ?>

         <!-- <button type="button" class="btn btn-primary btn-circle btn-md" data-toggle="modal" data-target="#myForm2" onclick="traerDetallesVenta(<?= $value['id_ventas'] ?>)" title="Detalles venta"><i class="fa fa-eye" aria-hidden="true" title="Detalles venta"></i></button></a> -->
        <button type="button" class="btn btn-primary btn-circle btn-md" data-toggle="modal" data-target="#myForm2" onclick="traerDetallesVenta(<?= $value['id_ventas'] ?>)" title="Detalles venta"><i class="fa fa-eye" aria-hidden="true" title="Detalles venta"></i></button></a>

        <?php if($value['fecha_venta'] == $fechaActual): ?>

         <?php if(($value['estado'] == 1) && ($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3)) { ?>
             <button type="button" class="btn btn-danger btn-circle btn-md" onclick="cambiarEstado(<?= $value['id_ventas']?>, 0)" title="Anular venta"><i class="fa fa-remove" aria-hidden="true" title="Anular venta"></i></button>
           <?php }else {?>
             <!-- <button type="button" class="btn btn-danger btn-circle btn-md" onclick="cambiarEstado(<?= $value['codigo']?>, 1)"><i class="fa fa-remove" aria-hidden="true"></i></button> -->
           <?php } ?>

         <?php else: ?>

         <?php endif; ?>

       </td>
     </tr>
<?php endforeach; ?>
 </tbody>
  </table>
</div>

    <?php if($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3): ?>
          <div class="row">
           <div class="col-sm-12">
             <center>
               <button class="btn btn-primary" data-toggle="modal" data-target="#modalReporteVentas"><i class="fa fa-file-pdf-o" aria-hidden="true">   Reporte de ventas </i></button>
           </center>
           </div>
         </div>
    <?php endif; ?>

</div>
<div class="modal fade" id="myForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="display:none" action="<?= URL ?>Ventas/index">
   <div class="modal-dialog" role="document">
       <div class="modal-content" style="">
             <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" stlyle="height: 70px; width: 100px">
                            <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Detalle de Venta Código: <span id="codigo-venta"></strong></span></center>
                        </div>
                      <div class="panel-body" id="panel_ventas">
                          <h5><strong>Venta realizada por: <span id="empleado"></span></strong></h5>
                        <div class="dataTable_wrapper">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>Fecha Venta</th>
                                  <th>Nombre Cliente</th>
                                  <th>Subtotal</th>
                                  <th>Descuento</th>
                                  <th>Total</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td id="fecha-venta"></td>
                                  <td id="cliente-venta"></td>
                                  <td id="subtotal-venta"></td>
                                  <td id="descuento-venta"></td>
                                  <td id="total-venta"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="table table-striped table-bordered table-hover" id="table-detalles-ventas">
                              <thead>
                                <tr>
                                  <th>Producto</th>
                                  <th>Precio</th>
                                  <th>Cantidad</th>
                                  <th>Total</th>
                                </tr>
                              </thead>
                              <h4 style="color: #337AB7">Productos</h4>
                              <tbody id="detalles-productos-venta">

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-xs-6 col-lg-8">
                      <button type="button" class="btn btn-secondary btn-md active pull-right"  data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"> Cerrar</span></button>
                    </div>
                <?php if($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3): ?>
                  <?php foreach($Ventas as $val): ?>
                    <?php if($val['estado'] == 1): ?>
                      <div class="col-md-6 col-xs-6 col-lg-2">
                        <a href="<?= URL ?>Ventas/generarpdfDetallesVentas2" target="_blank" id="pdfDeta">
                          <button class="btn btn-primary" name="btnComprasD"><i class="fa fa-file-pdf-o" aria-hidden="true">   Recibo de Caja</i></button>
                        </a>
                      </div>
                    <?php break; ?>
                    <?php else: ?>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
                  </div>
                </div>
                <br>
              </div>
            </div>
          </div>
        </div>


        <div class="modal fade" id="modalReporteVentas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="display:none" action="<?= URL ?>Ventas/index">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                     <div class="modal-body">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading" stlyle="height: 70px; width: 100px">
                                    <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Reporte Ventas</strong></center>
                                </div>
                              <div class="panel-body" id="panel_ventas">
                                <form id="formPdfVentas" action="<?= URL ?>Ventas/pdfVentas" method="post" data-parsley-validate="" target="_blank">
                                <div class="row">
                                  <br>
                                  <div class="panel-body">
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
                                        <div class="input-group date calendario" data-provide="datepicker">
                                        <input type="text" tabindex="1" class="form-control" name="txtfechainicial1" id="txtfechainicial1" value="<?= $nuevaFecha ?>" readonly="true" data-parsley-required="true">
                                        <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                      </div>
                                      </div>
                                      <input type="hidden" class="form-control" name="txtfechainicial2" id="txtfechainicial2" value="<?= $nuevaFecha ?>" >
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div   class="col-md-4">
                                        <label for="">Fecha Final <span class="obligatorio">*</span></label>
                                        <div class="input-group date calendario" data-provide="datepicker">
                                        <input type="text" tabindex="2" class="form-control" name="txtfechafinal1" id="txtfechafinal1" readonly="true"  value="<?= $hoy1 ?>" data-parsley-required="true">
                                        <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                      </div>
                                      </div>
                                      <input type="hidden"  name="txtfechafinal2" id="txtfechafinal2" value="<?= $hoy2 ?>">
                                      <input type="hidden"  name="txtfechafinal2" id="txtfechafinal3" value="<?= $nuevaFecha ?>">
                                  </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-8 col-xs-10 col-lg-8">
                                      <button type="submit" tabindex="3" class="btn btn-primary active pull-right" id="btn-pdf" name="btnconsultar"><i class="fa fa-file-pdf-o" aria-hidden="true"> Generar PDF Ventas</i></button>
                                    </div>
                                </div>
                                </div>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-11 col-xs-11 col-lg-11">
                              <button type="button" tabindex="4" id="cancelar" class="btn btn-secondary btn-md active pull-right"  data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"> Cerrar</span></button>
                              <input type="hidden" tabindex="5">
                            </div>
                          </div>
                        </div>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>

                <script type="text/javascript">
                  $(document).ready(function(){
                    $("#cancelar").blur(function(e){
                      $("#txtfechainicial").focus();
                    })
                  })
                </script>

<script type="text/javascript">
function traerDetallesVenta(id){
  var enlace = $("#pdfDeta");
  var nUrl = '<?= URL ?>Ventas/generarpdfDetallesVentas2?id=' + id;
  enlace.attr("href", nUrl);

  $.ajax({
    url:url+"Ventas/ajaxDetallesVenta",
    type:'POST',
    dataType: 'json',
    data:{
      idVenta:id,
    }
  }).done(function(respuesta){
    $("#codigo-venta").text(respuesta.codigoV);
    $("#empleado").text(respuesta.empleado);
    $("#fecha-venta").text(respuesta.fecha);
    $("#cliente-venta").text(respuesta.cliente);
    $("#subtotal-venta").text(respuesta.subtotal).priceFormat({centsLimit: 3, prefix: '$ '});
    $("#descuento-venta").text(respuesta.descuento).priceFormat({centsLimit: 3, prefix: '$ '});
    $("#total-venta").text(respuesta.total).priceFormat({centsLimit: 3, prefix: '$ '});
    $("#detalles-productos-venta").html(respuesta.html);
    $(".price").priceFormat({centsLimit: 3, prefix: '$ '});
  });
}


function cambiarEstado(cod, est){
    var bandera = true;
  swal({
    title:"¿Realmente desea anular esta venta?",
    type: "warning",
    confirmButton: "#3CB371",
    confirmButtonText:"btn-error",
    cancelButtonText:"Cancelar",
    showCancelButton: true,
    confirmButtonClass:"btn-danger",
    confirmButtonText:"Aceptar",
    closeOnConfirm:false,
  },
      function(){
          var bandera = true;
        $.ajax({
          dataType:'json',
          type:'post',
          url:url+"Ventas/modificarEstado",
          data:{id:cod, estado:est},
          async: false
        }).done(function(respuesta){
          if(respuesta.v == 1){
            window.location = url + "Ventas/listarVentas";
          }else{

            bandera = false;
          }
        }).fail(function(){

        })
        });
          return bandera;
       }

      //  $(".modal-content").css({
      //    width: '900px'
      //  });
</script>
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

</script>
<script type="text/javascript">
$("#txtfechainicial1").change(function(){
  var valor = $('#txtfechainicial1').val();
  var valor2 = $('#txtfechafinal2').val();

  if(valor > valor2)
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
                $('#txtfechainicial1').val(valor2);
            }
          })
  }
});
</script>

<script type="text/javascript">
$("#txtfechafinal1").change(function(){
  var valor = $('#txtfechafinal1').val();
  var valor2 = $('#txtfechafinal3').val();
  var valor3 = $('#txtfechafinal2').val();

  if(valor <= valor2)
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
                $('#txtfechafinal1').val(valor3);
            }
          })
  }
});
</script>
