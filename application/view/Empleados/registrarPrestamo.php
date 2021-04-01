
<br>
<button type="button" class="btn btn-primary btn-circle btn-md pull-right" data-toggle="modal" data-target="#mod_ayuda_prestamos">
  <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
</button>
 <div class="row">
    <br><br>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading" stlyle="height: 70px; width: 100px">
                <center><span style="text-align:center; color: #fff; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><strong>Registrar Préstamos</strong></span></center>
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
                        <th>Estado</th>
                        <th>Realizar Préstamo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($listarEmpleadoFijo as $empleado): ?>
                        <tr>
                          <td><?=  $empleado['id_persona'] ?></td>
                          <td><?=  ucwords($empleado['nombres']) ?></td>
                          <td><?=  ucwords($empleado['apellidos']) ?></td>
                          <td><?=  $empleado['Tbl_nombre_tipo_persona'] ?></td>
                          <td><?php if($empleado['estado'] == 1): ?>
                                Habilitado
                              <?php else:  ?>
                                Inhabilitado
                          <?php endif ?></td>
                          <td><button type="button" class="btn btn-primary btn-circle btn-md" data-tipo = "<?= $empleado['Tbl_nombre_tipo_persona']?>" data-estadoE = "<?= $empleado['estado'] ?>" data-identi = "<?= $empleado['id_persona'] ?>" onclick="prestamosEmp('<?= $empleado['id_persona'] ?>',this)" title="Registrar Préstamo"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
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

    <div class="modal fade" id="myjh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body" style="margin: 0 auto">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <br><br>
                <form class="" action="<?php echo URL?>Empleados/registrarPrestamo" method="post" id="myFor" onsubmit="return validarfe()" data-parsley-validate="">
                  <input type="hidden" name="tipoEmpl" id="tipoEmpl" value="">
                <div class="row">
                <input type="hidden"  id="estadoempleado">
                <div class="panel panel-primary" style="margin-left: 2%; margin-right: 2%">
                    <div class="panel-heading" stlyle="height: 70px; width: 100px">
                          <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Registrar Préstamo</strong></span></center>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                  <div class="col-xs-12 col-md-6">
                      <label id="labelIdentificacion">Identificación</label><br>
                      <input type="text" class="form-control" name="txtIdentifica" placeholder="Identificacion" value="" id="iden" readonly="">
                  </div>
                  <div class="col-md-6">
                      <label id="labelTipoEmpleado">Tipo de Empleado</label><br>
                      <input type="text" class="form-control" name="txtTipoEmpleado" placeholder="Tipo Empleado" value="" id="tipoEmplea" readonly="">
                  </div>
                </div>
              <br>
              <div class="row">
                <div class="col-xs-12 col-md-6" id="divFechapago">
                  <label id="labelFechaPago">Fecha de Préstamo:</label>
                  <div class="">
                    <div class="input-group date">
                      </div>
                      <input type="text" class="form-control" name="txtfechaPrestamo" step="1"  value="<?php echo date("Y-m-d");?>" format="yyyy-mm-dd" readonly="">
                    </div>
                  </div>

                <div class="col-xs-12 col-md-6" id="divFechapagolimite">
                  <label id="labelFechaLimite">Fecha Límite:</label>
                  <div class="">
                    <div class="input-group date calendario" data-provide = "datepicker">
                      <div class="input-group-addon" style="border-radius:5px;">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <?php $hoy = date("Y-m-d");
                            $nuevafecha = strtotime ('+30 day' , strtotime($hoy)) ;
                            $nuevafecha = date ('Y-m-d', $nuevafecha);
                        ?>
                        <?php $hoy2 = date("Y-m-d");
                            $nuevafecha2 = strtotime ('+30 day' , strtotime($hoy2)) ;
                            $nuevafecha2 = date ('Y-m-d', $nuevafecha2);
                        ?>
                      <input type="text" class="form-control pull-right" name="txtfechalimite" onchange="validarfe()" required="" id="Flimite" style="border-radius:5px;" step="1"  value="<?php echo $nuevafecha ?>" format="yyyy-mm-dd" readonly="">
                    </div>
                      <input type="hidden" value="<?php echo $nuevafecha2 ?>" format="yyyy-mm-dd" id="limite">
                  </div>
                </div>
              </div>

                <div class="row">
                <div class="col-xs-6 col-md-6" id="divvalorprestamo">
                  <br>
                  <label>Valor Préstamo <span class="obligatorio">*</span></label>
		              <input type="hidden" name="txtTope" value="1000000" id="tope">
                  <input type="number" min ="1000" id="valorpres" maxlength="8" name="txtvalorprestamo" size="4" class="form-control" data-parsley-type="integer" data-parsley-required="true">
                </div>
                <div class="col-xs-6 col-md-6" id="divdescripcion">
                  <br>
                  <label>Descripción</label>
                  <textarea class="form-control" rows="3" name="txtdescripcion" id="descri"></textarea>
                </div>
              </div>
              </div>
        </div>

        <div class="row">
          <div class="col-xs-6 col-md-6 col-lg-6" id="btnGuardarPrestamo">
            <button type="submit" class="btn btn-success btn-md active pull-right" name="btnRegistrarPrestamo" id="btnguardarPrestamo" title="Guardar"><i class="fa fa-floppy-o" aria-hidden="true">   Guardar</i> </button>
          </div>
          <div class="col-xs-6 col-md-6 col-lg-3">
            <button type="button" class="btn btn-danger btn-md active" onclick="cancelarRegPrestamo()" id="bcancelarRegPrest" title="Cancelar Registro"><i class="fa fa-times" aria-hidden="true">   Cancelar</i> </button>
          </div>
        </div>

      </div>
    </div>
</div>
</div>
</div>
</form>

<div class="modal fade" id="mod_ayuda_prestamos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                 <div class="row">
                   <div class="col-xs-12 col-md-12 col-lg-12">
                     <div class="panel panel-primary">
                       <div class="panel-heading" stlyle="height: 70px; width: 100px">
                             <center><span class="modal-title" id="myModalLabel" style="color: #FFF; font-size: 18px"><strong>Ayuda Préstamos</strong></span></center>
                       </div>
                       <div class="panel-body">
                           <p ALIGN="justify">Tener en cuenta para el registro de los préstamos lo siguiente:</p>
                           <ul>
                             <li ALIGN="justify">El préstamo solo se le podrá registrar al empleado fijo.</li>
                             <li ALIGN="justify">Los empleados que se encuentren inhabilitados no se les podrá registrar un préstamo.</li>
                             <li ALIGN="justify">Los empleados que tengan préstamos en estado pendiente no se les podrá registrar otro préstamo.</li>
                             <li ALIGN="justify">El valor del préstamo no puede ser mayor a $ 1,000.000 .</li>
                           </ul>
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

<script type="text/javascript">
$(document).ready(function() {
  $('.calendario').datepicker({
    pickTime: false,
    autoclose: true
  });
});
</script>

          <script type="text/javascript">
            $(document).ready(function(){

              $("#btnguardarPrestamo").click(function(){
                validarfe();
                $("#myFor").parsley().validate();
              })
            })
          </script>

          <script type="text/javascript">
            function cancelarprestamo() {
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

            function cerrarpre() {
              $("#valorpres").val("");
              $("#descri").val("");
            }
          </script>
          <script type="text/javascript">

<script type="text/javascript">

$(function(){

  $("#btnguardarPrestamo").click(function(){
    validarfe();
    var campoId = $("#iden").val();

    $.ajax({
      url: url + 'Empleados/validacionPrestamo',
      data:{'campoId': campoId},
      type: 'post',
      dataType:"text"
    }).done(function(resut){

      if(resut == "1"){
        swal({
              title: "Empleado ya tiene préstamos registrados en estado Pendiente, no se puede registrar!",
              type: "error",
              confirmButton: "#3CB371",
              confirmButtonText: "Aceptar",
              // confirmButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
            });
      }
    });
  });
});

</script>

<script type="text/javascript">
$("#valorpres").keydown(function(e){
  if(e.which === 189 || e.which === 69){
    e.preventDefault();

  }

});

function validarfe() {
  var felimite = $("#Flimite").val();
  var feli = $("#limite").val();
  var valorpre = $("#valorpres").val();
  var tope = parseInt($("#tope").val());
  var valor = parseInt($("#valorpres").val());
  if (valor > tope) {
    swal({
      title: "Valor máximo permitido 1.000.000",
      type: "warning",
      confirmButton: "#3CB371",
      confirmButtonText: "btn-danger",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Aceptar",
      closeOnConfirm: true,
      },
      function(isConfir){
        $("#valorpres").val(10000);
        });
      return false;
  };
  if (felimite < feli) {
    swal({
      title: "La fecha no puede ser menor a la fecha límite!",
      type: "warning",
      confirmButton: "#3CB371",
      confirmButtonText: "btn-danger",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Aceptar",
      closeOnConfirm: true,
      },
      function(isConfir){
        $("#Flimite").val(feli);
        });
      return false;
  }else if(valorp.length < 4){
    alert("valor invalido");
    return false;
  }
  else{
    return true;
  }
}

    function cancelarRegPrestamo() {
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
