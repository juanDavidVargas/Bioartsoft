
<br>
<button type="button" class="btn btn-primary btn-circle btn-md pull-right" data-toggle="modal" data-target="#mod_ayuda_reg-Productos">
  <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
</button>
<form class="" id="formulariopro" action="<?= URL ?>producto/registrarProductos" method="POST" data-parsley-validate="">
  <br><br>
  <div class="panel panel-primary" style="margin-top: 5px">
    <div class="panel-heading" stlyle="height: 70px; width: 100px">
      <center><span style="color: #FFF; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><strong>Registrar Productos (Obligatorios * )</strong></span></center>
    </div>
  <div class="row">
    <br>
      <div class="panel-body" style="width: 100%">
        <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-12 col-xs-12 col-lg-3">
                    <label for="inputTwitter" class="control-label">Nombre Producto <span class="obligatorio">*</span></label>
                    <input name="txtnombreproducto" tabindex="1" id="txtnombreproducto" type="text"  pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@\-\.\\ \/$]+" maxlength="20" class="form-control"  placeholder="Nombre Producto" data-parsley-required="true">
                </div>

              <div class="col-md-12 col-xs-12 col-lg-3">
                <label for="form-control">Categoría <span class="obligatorio">*</span></label>
                <select name="txtcategoria" tabindex="2" id="txtcategoria" class="form-control" data-parsley-type"alphanum" data-parsley-required="true">
                  <option value="">Seleccionar Categoría</option>
                  <?php foreach ($categorias as   $value): ?>
                    <option value="<?= $value['id_categoria']  ?>"><?= $value['nombre']  ?></option>
                  <?php endforeach ?>
                </select>
              </div>

            <div class="col-md-12 col-xs-12 col-lg-3">
                <label for="inputTwitter" class="control-label">Precio Unitario <span class="obligatorio">*</span></label>
                <input name="txtpreciocompra" tabindex="3" id="txtpreciocompra" type="number" data-parsley-type="integer" min="0" step="10" class="form-control" placeholder="Precio Unitario" data-parsley-required="true">
            </div>
            <div class="col-md-1">
            </div>
          </div>
          <br><br>

  <div class="row">
  <div class="col-md-1">
  </div>

    <div class="col-md-12 col-xs-12 col-lg-3">
        <label for="inputTwitter" class="control-label">Precio al Detal <span class="obligatorio">*</span></label>
        <input name="txtprecioventa" tabindex="4" type="number" id="txtprecioventa" data-parsley-type="integer" min="0" step="10" class="form-control" placeholder="Precio Detal" data-parsley-required="true">
    </div>
    <div class="col-md-12 col-xs-12 col-lg-3">
        <label for="inputTwitter" class="control-label">Precio al por Mayor <span class="obligatorio">*</span></label>
        <input id="txtprecioalpormayor" tabindex="5" type="number" name="txtprecioalpormayor" data-parsley-type="integer" min="0" step="10" class="form-control"  placeholder="Precio por Mayor" data-parsley-required="true">
    </div>

    <div class="col-md-12 col-xs-12 col-lg-3" id="tamano" >
      <label for="form-control">Descripción</label>
      <textarea id="txttamano1" tabindex="7"  name="txttamano1" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@\-\.\\ \/$]+" maxlength="100"  class="form-control"></textarea>
    </div>

    <div class="col-md-1">
    </div>
  </div>
  <br><br>

  <div class="row">

    <div class="col-md-1">
    </div>

    <div class="col-md-12 col-xs-12 col-lg-3">
      <label for="inputTwitter" class="control-label">Stock Mínimo <span class="obligatorio">*</span></label>
      <input id="txtstock" tabindex="8" name="txtstock" data-parsley-type="number" min="1" type="number"  max="50" class="form-control"  placeholder="Stock Mínimo" data-parsley-required="true">
    </div>

    <div class="col-md-8 col-xs-12 col-lg-3">
    </div>

  </div>

  <br><br><br>
  <div class="row">
    <div class="col-md-6 col-xs-6 col-lg-6">
      <button  name="btnguardarpro" type="submit" tabindex="9" id="btn-guardar-producto" class="btn btn-success active pull-right" title="Guardar"><i class="fa fa-floppy-o" aria-hidden="true">    Guardar</i></button>
    </div>
    <div class="col-md-6 col-xs-6 col-lg-3">
      <button type="reset" class="btn btn-danger active" tabindex="10" onclick="cancelar()" id="btn-Cancelar" title="Cancelar"><i class="fa fa-remove" aria-hidden="true">   Cancelar</i></button>
      <input type="hidden" tabindex="11">
    </div>
</div>
</div>
</div>
</div>
</form>


<div class="modal fade" id="mod_ayuda_reg-Productos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                 <div class="row">
                   <div class="col-xs-12 col-md-12 col-lg-12">
                     <div class="panel panel-primary">
                       <div class="panel-heading" stlyle="height: 70px; width: 100px">
                             <center><span class="modal-title" id="myModalLabel" style="color: #FFF; font-size: 18px"><strong>Ayuda de Registrar Productos</strong></span></center>
                       </div>
                       <div class="panel-body">
                           <p ALIGN="justify">Señor usuario a la hora de realizar un registro tener en cuenta las siguientes recomendaciones:</p>
                           <ol>
                             <li>Los campos marcados con asterisco (*) son obligatorios, por o tanto sino se llenan
                             el sistema no le dejará seguir.</li>
                             <li>Evitar ingresar nombres de productos ya existentes.</li>
                             <li>El precio unitario no puede ser mayor al precio al detal y precio al por mayor.</li>
                             <li>El precio al detal no puede ser menor al precio al por mayor.</li>
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

<script type="text/javascript">
  $(document).ready(function(){
    $("#btn-Cancelar").blur(function(e){
      $("#txtnombreproducto").focus();
    })
  })
</script>

<?php if (isset($errorCodigo) && $errorCodigo == false): ?>
<script type="text/javascript">
    $(document).ready(function(){
      swal({
            title: "Código ya existe, no se puede registrar!",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          });
    });
</script>
<?php endif; ?>

<?php if (isset($errorNombre) && $errorNombre == false): ?>
<script type="text/javascript">
    $(document).ready(function(){
      swal({
            title: "Nombre ya existe, no se puede registrar!",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
          });
    });
</script>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function(){
  $("#btn-modal").click(function(){
    $("#myForm2").modal('show');
    return false;
  });
});
</script>

<script>
$(document).ready(function(){

$("#btn-guardar-producto").click(function(){
  $('#formulariopro').parsley().validate();
  });
  });
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
</script>


<script type="text/javascript">
  $("#txtpreciocompra").keydown(function(e){
    if(e.which === 189 || e.which === 69 || e.which === 190){
      e.preventDefault();
    }
  });

  $("#txtprecioventa").keydown(function(e){
    if(e.which === 189 || e.which === 69 || e.which === 190){
      e.preventDefault();
    }
  });

  $("#txtprecioalpormayor").keydown(function(e){
    if(e.which === 189 || e.which === 69 || e.which === 190){
      e.preventDefault();
    }
  });

  $("#txtstock").keydown(function(e){
    if(e.which === 189 || e.which === 69 || e.which === 190){
      e.preventDefault();
    }
  });
</script>

<script type="text/javascript">
  $(function(){

    $("#txtnombreproducto").change(function(){

      var campoNombre = $("#txtnombreproducto").val();

      $.ajax({
        url: url + 'producto/validacionNombre',
        data:{'campoNombre': campoNombre},
        type: 'post',
        dataType:"text"
      }).done(function(resut){

        if(resut == "1"){
          swal({
                title: "Nombre de Producto ya existe!",
                type: "error",
                confirmButton: "#3CB371",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
                closeOnCancel: false
              });
        }
      });
    });
  });
</script>


<script type="text/javascript">
  $("#txtprecioalpormayor").change(function(){
    var precio1 = parseInt($("#txtpreciocompra").val());
    var precio2 = parseInt($("#txtprecioventa").val());
    var precio3 = parseInt($("#txtprecioalpormayor").val());

    if(precio1 <  precio2 && precio1 < precio3 && precio2 > precio3){

        return true;
    }else{
      swal({
            title: "Precios inválidos, verificar valores!",
            type: "error",
            confirmButton: "#3CB371",
            confirmButtonText: "Aceptar",
            // confirmButtonText: "Cancelar",
            closeOnConfirm: true,
            closeOnCancel: false
          },
        function (isConfirm){
          if(isConfirm){
            $("#txtpreciocompra").val("");
            $("#txtprecioventa").val("");
            $("#txtprecioalpormayor").val("");

          }
        });
      return false;
    }
  })
</script>
