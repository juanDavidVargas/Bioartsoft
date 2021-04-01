<div class="row">
    <br><br>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="panel panel-primary">
          <div class="panel-heading" stlyle="height: 70px; width: 100px">
                <center><span style="text-align:center; color: #fff; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><strong>Listar Entradas</strong></span></center>
          </div>
      <div class="panel-body">
        <div class="dataTable_wrapper">
          <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
     <tr>
       <th>Código Entrada</th>
       <th>Valor Total</th>
       <th>Fecha Registro Entrada</th>
       <th>Identificación Proveedor</th>
       <th>Nombre Proveedor</th>
       <th>Estado</th>
       <th>Opciones</th>
     </tr>
   </thead>

   <tbody>
      <?php foreach ($datos as $value): ?>
     <tr>
       <td><?= $value["id_compras"] ?></td>
       <td class="valor"><?= $value["valor_total"] ?></td>
       <td><?= $value["fecha_compra"] ?></td>
       <td><?= $value["id_persona"] ?></td>
       <td><?= $value["proveedor"] ?></td>
       <td><?= $value["estado"] == 1?"Activa":"Anulada" ?></td>
       <td>
         <button type="button" class="btn btn-primary btn-circle btn-md" data-toggle="modal" data-target="#myForm2" onclick="traerDetallesCompra(<?= $value['id_compras'] ?>)" title="Ver Detalles"><i class="fa fa-eye" aria-hidden="true" title="Ver Detalles"></i></button></a>

         <?php
                $fechaActual = date("Y-m-d");
         ?>

         <?php if($value['fecha_compra'] == $fechaActual): ?>
         <?php if(($value['estado'] == 1) && ($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3)) { ?>
             <button type="button" class="btn btn-danger btn-circle btn-md" onclick="cambiarEstado(<?= $value['id_compras']?>, 0)" title="Anular"><i class="fa fa-remove" aria-hidden="true" title="Anular"></i></button>
           <?php }else {?>
           <?php } ?>
         <?php else: ?>

        <?php endif; ?>
       </td>
     </tr>
<?php endforeach; ?>
 </tbody>
  </table>
  <?php if($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3): ?>
  <div class="col-md-6 col-lg-7 col-xs-10">
    <a href="#" id="">
      <button class="btn btn-primary pull-right" name="btnComprasD" data-toggle="modal" data-target="#modal_reportes"><i class="fa fa-file-pdf-o" aria-hidden="true">&nbsp;&nbsp;Reporte Entradas</i></button>
    </a>
  </div>
<?php endif; ?>
</div>
</div>

<div class="modal fade" id="myForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="display:none" action="<?= URL ?>Compras/registrarCompra">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-body">
           <div class="modal-header">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
              <div class="panel panel-primary">
                  <div class="panel-heading" stlyle="height: 70px; width: 100px">
                        <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Detalle de Entrada Código: <span id="codigoC"></span></strong></center>
                  </div>
                <div class="panel-body" id="panel_compras">
                  <h5><strong>Entrada realizada por: <span id="empleado"></span></strong></h5>
                  <div class="dataTable_wrapper">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Fecha Entrada</th>
                            <th>Identificación Proveedor</th>
                            <th>Nombre Proveedor</th>
                            <th>Total Entrada</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td id="fecha-compra"></td>
                            <td id="id-proveedor"></td>
                            <td id="proveedor-compra"></td>
                            <td id="total-compra"></td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="table table-striped table-bordered table-hover" id="table-detalles">
                        <thead>
                          <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <h4 style="color: #337AB7">Productos</h4>
                        <tbody id="detalles-productos-compra">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-xs-5 col-lg-6">
                <button type="button" class="btn btn-secondary btn-md active pull-right"  data-dismiss="modal" title="Cerrar"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
              </div>

              <?php if($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3): ?>
              <div class="col-md-6 col-xs-6 col-lg-3">
                <a href="<?= URL ?>Compras/generarpdfDetallesCompras" target="_blank" id="pdfDeta">
                  <button class="btn btn-primary" name="btnComprasD"><i class="fa fa-file-pdf-o" aria-hidden="true">   Pdf Detalles Entradas</i></button>
                </a>
              </div>
            <?php endif; ?>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_reportes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="display:none" action="<?= URL ?>Compras/registrarCompra">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
              <div class="panel panel-primary">
                  <div class="panel-heading" stlyle="height: 70px; width: 100px">
                        <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Reporte de Entradas</strong></center>
                  </div>
                <div class="panel-body">
                  <form id="formPdfCompras" action="<?= URL ?>Compras/pdfCompras" method="post" data-parsley-validate="" target="_blank">
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
                          <div class="input-group date calendario" data-provide="datepicker">
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
                          <div class="input-group date calendario" data-provide="datepicker">
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
                      <div class="col-md-6 col-xs-8 col-lg-9">
                        <button type="submit" tabindex="3" class="btn btn-primary active pull-right" id="btn-pdf" name="btnconsultar" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"> Generar PDF Entradas</i></button>
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
              <div class="col-md-12 col-xs-12 col-lg-12">
                <button type="button" tabindex="4" id="btn_cancelar" class="btn btn-secondary btn-md active pull-right"  data-dismiss="modal" title="Cerrar"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
                <input type="hidden" tabindex="5">
              </div>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#btn_cancelar").blur(function(e){
        $("#txtfechafinal").focus();
      })
    })
  </script>


  <script type="text/javascript">
    $(document).ready(function(){
      $("#btn-pdf").click(function(){
        $("#formPdfCompras").parsley().validate();
      })
    });
  </script>


<script type="text/javascript">

$(document).ready(function(){

  $(".valor").priceFormat({centsLimit: 3, prefix: '$ '});

})

function traerDetallesCompra(id){
  var enlace = $("#pdfDeta");
  var nUrl = '<?= URL ?>Compras/generarpdfDetallesCompras?id=' + id;
  enlace.attr("href", nUrl);

  $.ajax({
    url:url+"Compras/ajaxDetallesCompra",
    type:'POST',
    dataType: 'json',
    data:{
      idCompra:id,
    }
  }).done(function(respuesta){
    $("#codigoC").text(respuesta.compra);
    $("#empleado").text(respuesta.empleado);
    $("#fecha-compra").text(respuesta.fecha);
    $("#proveedor-compra").text(respuesta.proveedor);
    $("#id-proveedor").text(respuesta.id);
    $("#total-compra").text(respuesta.total).priceFormat({
      centsLimit: 3,
      prefix: '$ '
    });
    $("#detalles-productos-compra").html(respuesta.html);
    $(".price").priceFormat({centsLimit: 3, prefix: '$ '});
  });
}

function cambiarEstado(cod, est){
    var bandera = true;
    swal({
      title: "¿Realmente desea anular esta entrada?",
      type: "warning",
      confirmButton: "#3CB371",
      confirmButtonText: "btn-danger",
      cancelButtonText: "Cancelar",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Aceptar",
      closeOnConfirm: false,

    },
    function(){
            var bandera = true;
            $.ajax({
              dataType:'json',
              type:'post',
              url:url+"Compras/modificarEstado",
              data:{id:cod, estado:est},
              async: false
            }).done(function(respuesta){
              if(respuesta.v == 1){

                window.location = url + "Compras/listarCompras";

              }else{

                  bandera = false;
              }
            }).fail(function(){


            })
            // location.href="<?= URL ?>Compras/listarCompras";
          });
          return bandera;
        }

        // $(".modal-content").css({
        //   width: '900px'
        // });
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
  $("#txtfechainicial1").change(function(){
    var valor = $('#txtfechainicial1').val();
    var valor2 = $('#txtfechafinal1').val();
    var valor3 = $('#txtfechainicial2').val();


    if(valor > valor2){
      swal({
              title: "Fecha inválida, esta fecha no puede ser mayor a la fecha final!",
              type: "error",
              confirmButtonColor: "#86CCEB",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,

              },
              function(isConfirm){
              if (isConfirm) {
                  $('#txtfechainicial1').val(valor3);
              }
            })
    }

  });

</script>

<script type="text/javascript">
  $("#txtfechafinal1").change(function(){
    var valor = $('#txtfechainicial1').val();
    var valor2 = $('#txtfechafinal1').val();
    var valor3 = $('#txtfechafinal2').val();


    if(valor2 < valor){
      swal({
              title: "Fecha inválida, esta fecha no puede ser menor a la fecha inicial!",
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
