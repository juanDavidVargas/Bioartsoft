
<form id="formGanancias" action="<?= URL ?>Ventas/reporteGanancias" method="post" data-parsley-validate="">
<div class="panel panel-primary" style="margin-top: 5px">
<div class="row">
  <br>
    <div class="panel-heading" stlyle="height: 70px; width: 100px">
        <center><span style="text-align:center; color: #337AB7; margin-top: 10px; margin-bottom: 10px; font-size: 20px">Listar Ganancias</span></center>
    </div>
    <div class="panel-body">
  <div class="row">
    <div class="col-md-1"></div>
    <div   class="col-md-4">
        <label for="">Fecha Inicial </label>
        <div class="input-group date" data-provide="datepicker">
        <input type="text" class="form-control" name="txtfechainicial" id="txtfechainicial" placeholder="Fecha Inicial" readonly="true" data-parsley-required="true">
        <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
      </div>
      </div>
    </div>
    <div class="col-md-1"></div>
    <div   class="col-md-4">
        <label for="">Fecha Final </label>
        <div class="input-group date" data-provide="datepicker">
        <input type="text" class="form-control" name="txtfechafinal" id="txtfechafinal" readonly="true"  placeholder="Fecha final" data-parsley-required="true">
        <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
      </div>
      </div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-5"></div>
    <div class="col-md-4">
      <button type="button"class="btn btn-primary active" id="btn-ganancias" name="btnconsultarganancia" onclick="consultarGanancia()"><i class="fa fa-building-o" aria-hidden="true" data-toggle="modal" data-target="#modal-ganancias"> Generar Ganancias</i></button>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="modal-ganancias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
 <div class="modal-dialog" role="document">
   <div class="modal-content modal-xs">
           <div class="modal-body">
           <div class="row">
             <div class="col-md-12">
               <div class="panel panel-primary" >
                 <div class="panel-heading" stlyle="height: 70px; width: 100px">
                   <center><span style="color: #fff; font-size: 20px" id="myModalLabel">Detalles Promedio de Ganancias</span></center>
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
           <button type="button" class="btn btn-secondary btn-active"  data-dismiss="modal" style="margin-left:80%" onclick="abrirmodal()"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
           </div>
       </div>
      </div>
    </div>
</form>

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
  var fecha2 = $("#txtfechafinal").val();
  console.log(fecha1, fecha2);

  if(fecha1 == "" && fecha2 == ""){
    swal({
      title: "No se ingresarón fechas!",
      type: "error",
      confirmButton: "#3CB371",
      confirmButtonText: "Aceptar",
      closeOnConfirm: false,
      closeOnCancel: false,
    },
    function(isConfirm) {
      if (isConfirm) {
        swal({
          title: "Por favor ingresar una fecha válida!",
          type: "error",
          confirmButton: "#3CB371",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false,
          closeOnCancel: false,
        });
        $("#modal-ganancias").modal('hide');
  }
});
}else{

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
                            $("#conte-table").html(respuesta.cabecera);
                            $(".price").priceFormat({centsLimit: 3, clearPrefix: true});
                          });

                      }

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
