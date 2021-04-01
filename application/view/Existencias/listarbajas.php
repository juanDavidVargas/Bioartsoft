
<div class="row">
  <br>
  <button type="button" class="btn btn-primary btn-circle btn-md pull-right" data-toggle="modal" data-target="#mod_ayuda_listarBajas">
    <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
  </button>
    <br><br>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading" stlyle="height: 70px; width: 100px">
            <center><span style="text-align:center; color: #fff; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><strong>Listar Bajas</strong></span></center>
          </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Código Bajas</th>
                                <th>Empleado Responsable Baja</th>
                                <th>Estado</th>
                                <th>Fecha Baja</th>
                                <th>Anular</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($bajas as $value): ?>
                           <tr>
                             <td><?= $value['id_bajas'] ?></td>
                             <td><?= $value['nombre_persona'] ?></td>
                             <td><?= $value['estado'] == 1? "Activo" : "Eliminado" ?></td>
                             <td><?= $value['fecha_salida'] ?></td>
                             <td>

                               <?php
                                    $fechaActual = date('Y-m-d');
                               ?>

                               <?php if($value['fecha_salida'] == $fechaActual): ?>
                               <?php if(($value['estado'] == 1) && ($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3)) { ?>
                                   <button type="button" class="btn btn-primary btn-circle btn-md" data-toggle="modal" data-target="#myForm2" onclick="traerDetallesBaja(<?= $value['id_bajas'] ?>)" title="Ver Detalles"><i class="fa fa-eye" aria-hidden="true" title="Ver Detalles"></i></button></a>
                                   <button type="button" class="btn btn-danger btn-circle btn-md" onclick="cambiarEstado(<?= $value['id_bajas']?>, 0)" title="Anular"><i class="fa fa-remove" aria-hidden="true" title="Anular"></i></button>
                                <?php }else {?>
                                    <button type="button" class="btn btn-primary btn-circle btn-md" data-toggle="modal" data-target="#myForm2" onclick="traerDetallesBaja(<?= $value['id_bajas'] ?>)" title="Ver Detalles"><i class="fa fa-eye" aria-hidden="true" title="Ver Detalles"></i></button></a>
                                <?php } ?>
                                <?php else: ?>
                                  <button type="button" class="btn btn-primary btn-circle btn-md" data-toggle="modal" data-target="#myForm2" onclick="traerDetallesBaja(<?= $value['id_bajas'] ?>)" title="Ver Detalles"><i class="fa fa-eye" aria-hidden="true" title="Ver Detalles"></i></button></a>
                                <?php endif; ?>
                             </td>
                           </tr>
                          <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
              </div>

            <div class="col-sm-12">
          <?php foreach ($bajas as $value): ?>
          <?php if($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3): ?>
          <?php if($value['estado'] == 1): ?>
                <center>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-reporte_bajas"><i class="fa fa-file-pdf-o" aria-hidden="true">&nbsp;&nbsp;Reporte Bajas</i></button>
                </center>
                <?php break; ?>
          <?php else: ?>
          <?php endif; ?>
          <?php endif; ?>
          <?php endforeach; ?>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="display:none" style="width: 50px" action="<?= URL ?>producto/listarProductos">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
        <div class="modal-body">

            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                  <div class="panel-heading" stlyle="height: 70px; width: 100px">
                      <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Detalle de Baja Código: <span id="baja"><span></strong></center>
                  </div>
                  <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                             <tr>
                              <th>Producto</th>
                              <th>Cantidad</th>
                              <th>Tipo de Baja</th>
                            </tr>
                          </thead>
                          <tbody class="precios" id="detalles-bajas">

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-secondary btn-md active pull-right"  data-dismiss="modal" title="Cerrar"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="mod_ayuda_listarBajas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                     <div class="row">
                       <div class="col-xs-12 col-md-12 col-lg-12">
                         <div class="panel panel-primary">
                           <div class="panel-heading" stlyle="height: 70px; width: 100px">
                                 <center><span class="modal-title" id="myModalLabel" style="color: #FFF; font-size: 18px"><strong>Ayuda de Listar Bajas</strong></span></center>
                           </div>
                           <div class="panel-body">
                               <p ALIGN="justify">En esta sección solo se mostrará más detalladamente la información de la baja
                                                  que fue registrada, pero en caso de querer anular una baja tener en cuenta
                                                  la siguiente recomendación.</p>
                               <ol>
                                 <li>Una baja solo podrá ser anulada el mismo día en fue registrada.</li>
                                 <li>En las fechas del reporte de las bajas, evitar ingresar fechas mayores o menores
                                   a los 3 meses.</li>
                               </ol>
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

    <div class="modal fade" id="modal-reporte_bajas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="display:none" style="width: 50px" action="<?= URL ?>producto/listarProductos">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-primary">
                      <div class="panel-heading" stlyle="height: 70px; width: 100px">
                          <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Reporte Bajas</strong></center>
                      </div>
                      <div class="panel-body">
                        <form id="formPdfBajas" action="<?= URL ?>producto/pdfBajas" method="post" data-parsley-validate="" target="_blank">
                        <div class="row">
                          <br>
                            <div class="panel-body">
                          <div class="row">
                            <?php
                            $hoy2 = Date("Y-m-d");
                            $hoy1 = Date("Y-m-d");
                            $nuevaFecha = strtotime('-3 month', strtotime($hoy1));
                            $nuevaFecha = date('Y-m-d', $nuevaFecha);
                             ?>
                            <div   class="col-md-6 col-xs-12 col-lg-6">
                                <label for="">Fecha Inicial <span class="obligatorio">*</span></label>
                                <div class="input-group date calendario" data-provide="datepicker">
                                <input type="text" tabindex="1" class="form-control" readonly="true"name="txtfechainicial1" id="txtfechainicial1"  value="<?= $nuevaFecha ?>" data-parsley-required="true">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                              </div>
                              </div>
                                <input type="hidden" class="form-control" name="txtfechai2" value="<?= $nuevaFecha ?>" id="txtfechai2">
                            </div>

                            <div   class="col-md-6 col-xs-12 col-lg-6">
                                <label for="">Fecha Final <span class="obligatorio">*</span></label>
                                <div class="input-group date calendario" data-provide="datepicker">
                                <input type="text" tabindex="2" class="form-control" name="txtfechafinal" readonly="true" id="txtfechafinal"  value="<?= $hoy1 ?>" data-parsley-required="true">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                              </div>
                              </div>

                              <input type="hidden"  name="txtfechafinal2"  id="txtfechafinal2"  value="<?= $hoy2 ?>" >
                              <input type="hidden"  name="txtfechafinal3"  id="txtfechafinal3"  value="<?= $nuevaFecha ?>" >
                              <input type="hidden"  name="txtfechafinal4"  id="txtfechafinal4"  value="<?= $hoy2 ?>" >
                          </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-7 col-xs-10 col-lg-9">
                              <button type="submit" tabindex="3" class="btn btn-primary active pull-right" id="btn-pdf" name="btnconsultar" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"> Generar PDF Bajas</i></button>
                            </div>
                        </div>
                        </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    <button type="button" tabindex="4" class="btn btn-secondary btn-md active pull-right"  data-dismiss="modal" id="cerrar" title="Cerrar"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
                    <input type="hidden" tabindex="5">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function(){
            $("#cerrar").blur(function(e){
              $("#txtfechainicial").focus();
            })
          })
        </script>

        <script type="text/javascript">
          $(document).ready(function(){
            $("#btn-pdf").click(function(){
              $("#formPdfBajas").parsley().validate();
            })
          });
        </script>


<script type="text/javascript">

function cambiarEstado(cod, est){
    var bandera = true;
    swal({
      title: "¿Realmente desea anular la baja?",
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
        var bandera = true;
        if (isConfirm) {
          swal({
            title: "Baja Anulada.!",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm){
            var bandera = true;
            $.ajax({
              dataType:'json',
              type:'post',
              url:url+"producto/AnularBaja",
              data:{id:cod, estado:est},
              async: false
            }).done(function(respuesta){
              if(respuesta.v == 1){
                window.location = url + "producto/listarBajas";
                bandera = false;
              }else{
                swal({
                  title: "Error al intentar anular la baja!",
                  type: "error",
                  confirmButton: "#3CB371",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false,
                  closeOnCancel: false
                });
              }
            }).fail(function(respuesta){
              if(respuesta.v == 0){
                swal({
                  title: "Error al intentar anular la baja!",
                  type: "error",
                  confirmButton: "#3CB371",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false,
                  closeOnCancel: false
                });
                  window.location = url + "producto/listarBajas";
              }

            })

          });
        }
        });

        return bandera;
}

  function traerDetallesBaja(id){
    $.ajax({
      url:url+"producto/ajaxDetallesBajas",
      type:'POST',
      dataType: 'json',
      data:{
        'idbaja':id,
      }
    }).done(function(respuesta){
      $("#baja").text(respuesta.baja);
      $("#detalles-bajas").html(respuesta.html);
    });
  }
</script>

<script type="text/javascript">
  $("#txtfechainicial1").change(function(){
    var valor = $('#txtfechainicial1').val();
    var valor2 = $('#txtfechai2').val();


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
$("#txtfechafinal").change(function(){
  var valor3 = $('#txtfechafinal').val();
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
                $('#txtfechafinal').val(valor4);
            }
          })
  }
});
</script>

<script type="text/javascript">
$("#txtfechainicial1").change(function(){
  var val = $('#txtfechainicial1').val();
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
                $('#txtfechainicial1').val(val3);
            }
          })
  }
});
</script>

<script type="text/javascript">
$("#txtfechafinal").change(function(){
  var val = $('#txtfechafinal').val();
  var val2 = $('#txtfechafinal3').val();
  var val3 = $('#txtfechafinal4').val();

  if(val <= val2)
  {
    swal({
            title: "Fecha inválida, esta fecha no puede ser igual o menor a la fecha inicial!",
            type: "error",
            confirmButtonColor: "#86CCEB",
            confirmButtonText: "Aceptar",
            closeOnConfirm: true,

            },
            function(isConfirm){
            if (isConfirm) {
                $('#txtfechafinal').val(val3);
            }
          })
  }
});
</script>
