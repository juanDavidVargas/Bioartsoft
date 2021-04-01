
<form id="formPdfVentas" action="<?= URL ?>Ventas/pdfVentas" method="post" data-parsley-validate="" target="_blank">
  <div class="panel panel-primary" style="margin-top: 5px">
<div class="row">
  <br>
  <div class="panel-heading" stlyle="height: 70px; width: 100px">
      <center><span style="text-align:center; color: #337AB7; margin-top: 10px; margin-bottom: 10px; font-size: 20px">Reporte de Ventas</span></center>
    </div>
    <div class="panel-body">
  <div class="row">
    <div class="col-md-1"></div>
    <div   class="col-md-4">
        <label for="">Fecha Inicial <span class="obligatorio">*</span></label>
        <div class="input-group date" data-provide="datepicker">
        <input type="text" class="form-control" name="txtfechainicial" id="txtfechainicial" placeholder="Fecha Inicial" readonly="true" data-parsley-required="true">
        <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
      </div>
      </div>
    </div>
    <div class="col-md-1"></div>
    <div   class="col-md-4">
        <label for="">Fecha Final <span class="obligatorio">*</span></label>
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
      <button type="submit"class="btn btn-primary active" id="btn-pdf" name="btnconsultar"><i class="fa fa-file-pdf-o" aria-hidden="true"> Generar PDF Ventas</i></button>
    </div>
</div>
</div>
</div>
</div>
</form>

<script type="text/javascript">
  $(document).ready(function(){
    $("#btn-pdf").click(function(){
      $("#formPdfVentas").parsley().validate();
    })
  });
</script>
