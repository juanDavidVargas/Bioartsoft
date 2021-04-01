<br>
<button type="button" class="btn btn-primary btn-circle btn-md pull-right" data-toggle="modal" data-target="#mod_ayuda_regBajas">
  <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
</button>
<form id="frmBajas" method="post"  action="<?= URL ?>producto/registrarBajas" data-parsley-validate="">
  <br><br>
  <div class="panel panel-primary" style="margin-top: 5px">
    <div class="panel-heading" stlyle="height: 70px; width: 100px">
      <center><span style="text-align:center; color: #FFF; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><strong>Registrar Bajas</strong></span></center>
    </div>
   <div class="row">
     <br>


    <div class="panel-body">
    <div class="col-sm-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>Información de la Baja</strong></h3>
        </div>

        <div class="panel-body">
          <div class="form-group">
            <label for="">Tipo de Baja <span class="obligatorio">*</span></label>
            <select id="txttipo" tabindex="1" name="tipo_baja" id="baja" class="form-control" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@\-\.\\ \/$]+" data-parsley-required="true">
              <option value="">Seleccionar</option>
              <option value="Hurto">Hurto</option>
              <option value="Averia">Avería</option>
            </select>
          </div>
          <hr>
          <div class="form-group">
            <label for="">Producto <span class="obligatorio">*</span></label>
            <select class="form-control" tabindex="2" id="cmb_producto" name="cmb_producto" data-parsley-type="alphanum" data-parsley-required="true">
              <option value="">Seleccionar</option>
              <?php foreach ($producto as $value): ?>
                <?php if($value['estado'] == 1): ?>
                  <option value="<?= $value['id_producto'] ?>" data-cantidad="<?= $value['cantidad']?>" ><?= $value['id_producto']. " ".$value['nombre_producto'] ?></option>
                <?php else: ?>

                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group" id="cantidad">
            <label for="">Cantidad <span class="obligatorio">*</span></label>
            <input id="txt_cantidad" tabindex="3" type="text" class="form-control" min="1" maxlength="4" data-parsley-type="number" data-parsley-required="true">
            <input type="hidden" value="" id="unidades-actuales">
              <input type="hidden" value="<?= $_SESSION['USUARIO_ID'] ?>" id="id-empleado" name="empleadoId">
          </div>
          <div class="form-group">
            <button  type="button" tabindex="4" class="btn btn-primary pull-right" id="btn-agregar" title="Agregar"><i class="fa fa-plus plus"></i>   Agregar</button>
            <input type="hidden" tabindex="5">
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6" style="max-height: 350px; overflow-y: auto">
      <table id="tabla-detalles" class="table table-bordered">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Tipo de baja</th>
            <th>Opción</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <div class="col-md-6 col-xs-6 col-lg-10">
      <button class="btn btn-success active pull-right" id="btn-guardarBajas" type="submit"  name="btn-agregar" title="Guardar"><i class="fa fa-floppy-o" ></i>   Guardar</button>
    </div>
      <div class="col-md-6 col-xs-6 col-lg-2">
        <button class="btn btn-danger active pull-right" onclick="cancelar()" id="btn-cancelar" type="button"  name="btn-agregar" title="Cancelar"><i class="fa fa-remove" ></i>   Cancelar</button>
      </div>
  </div>
  </div>
</div>
</form>


<div class="modal fade" id="mod_ayuda_regBajas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                 <div class="row">
                   <div class="col-xs-12 col-md-12 col-lg-12">
                     <div class="panel panel-primary">
                       <div class="panel-heading" stlyle="height: 70px; width: 100px">
                             <center><span class="modal-title" id="myModalLabel" style="color: #FFF; font-size: 18px"><strong>Ayuda de Registrar Bajas</strong></span></center>
                       </div>
                       <div class="panel-body">
                           <p ALIGN="justify">Tener en cuenta para el registro de la baja lo siguiente:</p>
                           <ol>
                             <li>Todos los campos que tienen el asterisco (*) son obligatorios, por lo tanto si no se
                                  diligencian el sistema no le dejará seguir.</li>
                             <li ALIGN="justify">En el campo de producto, para una mayor agilidad se recomienda usar la pistola
                                                  para leer el código del producto y así asociarlo mas fácil y rápido.</li>
                             <li ALIGN="justify">En caso de que se haya equivocado en una cantidad o en un producto en el
                                                  momento de agregar, con el icono de color rojo con forma de basurero, se puede quitar
                                                  la selección inicial.</li>
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
    $("#btn-agregar").blur(function(e){
      $("#txttipo").focus();
    })
  })
</script>

<input type="hidden" id="txtProductoS" focus="true" autocomplete="off" >
<style media="screen">
  #txtProductoS{
    border: 0 !important;
  }
  #txtProductoS:focus:hover{
    border: 0px solid white !important;
  }
  #txtProductoS:active{
    border: 0px solid white !important;
  }
  #txtProductoS:hover{
    border: 0px solid white !important;
  }
</style>

<script>
$(document).ready(function(){

  var example = null;
  $("body").keydown(function(e){
    if(e.which == 13){
      $("#cmb_producto").val($("#txtProductoS").val()).trigger("change");
      $("#txtProductoS").val("");
      $("#txt_cantidad").val("");
      $("#txttipo").val("");
    } else {
      var c = String.fromCharCode(e.keyCode);
      var input = $("#txtProductoS");
      input.val(input.val() + c);
    }
  });

  $("#txt_cantidad").keyup(function(e){
    $("#txtProductoS").val("");
  });

  $("body").attr("tabindex", "10");

  $("#txttipo").change(function(){
    setTimeout(function(){
      $("body").focus();
    }, 200);
  });

  $("#cmb_producto").change(function(){
    setTimeout(function(){
      $("body").focus();
    }, 200);
  });

    // $("#txttipo").select2();
    $("#cmb_producto").select2();

  $("#frmBajas").submit(function(){
   var productos = $("[data-producto]").length;
   if(productos == 0) {
     swal({
           title: "No se encontraron productos asociados!",
           type: "error",
           confirmButton: "#3CB371",
           confirmButtonText: "Aceptar",
           // confirmButtonText: "Cancelar",
           closeOnConfirm: false,
           closeOnCancel: false
         });
   }else{

   }
    return productos > 0;

  });
})


  $(function(){
    $("#btn-agregar").click(function(){
      agregarfila();
      return false;
    });
  });

  function agregarfila(){

    if(validarC()){

    if($("#frmBajas").parsley().validate()){

      var productoTxt = $("#cmb_producto option:selected").text();

      var producto = $("#cmb_producto").val();

      var cantidad = $("#txt_cantidad").val();
      var tipo =  $("#txttipo").val();

      var cantidad2 = $("#cmb_producto [value='" + producto + "']").attr("data-cantidad");

      $("#unidades-actuales").val(cantidad2);

      if(cantidad <= 0){
         swal("Ingresar una cantidad válida!");
      }else{

      var bandera =  true;
      var romper = false;
      $(".datos").each(function(key,value){


        var v=$(value).find("input[id='txtproducto']").val();
        var ti=$(value).find("input[id='tipo']").val();
        // var t=$("#tipo").val();

         if(v == producto && ti== tipo){

            var cantAnt = parseInt($(value).find("td.cantidad2").text());
            var cantAct = parseInt($("#txt_cantidad").val());
            var cTotal = parseInt($("#unidades-actuales").val());

            if((cantAnt + cantAct) > cTotal){

              swal({
                    title: "Cantidad actual: "+cTotal+ " unidades. Cantidad agregada " + cantAnt + " unidades.",
                    type: "error",
                    confirmButton: "#3CB371",
                    confirmButtonText: "Aceptar",
                    // confirmButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                  });

               romper = true;
            }else{

              var c = $(value).find('td.cantidad2').text(cantAnt + cantAct);
              var input = $(c.parent().find("td.hiddens > input[name='cantidad[]']"));
              input.val(cantAnt + cantAct);
              $(value).find('input#cantidad');
              $(value).find("td.cantidad2").text(cantAnt + cantAct);
              bandera=false;
            }

         }

      });

      if(romper === true){
        return false;
      }

      if(bandera){
        var hiddens = '<input id="txtproducto" type="hidden" name="producto[]" value="' + producto + '">';
        hiddens += '<input type="hidden" id="cantidad" name="cantidad[]" value="' + cantidad + '">';
        hiddens +='<input type="hidden" id="tipo" name="tipo[]" value="' + tipo + '">';
        var html = '<tr class="datos" data-producto="true">'+
                '<td id="producto2" class="hiddens">' + hiddens + productoTxt + '</td>' +
                '<td class="cantidad2">' + cantidad + '</td>' +
                  '<td id="producto2">' +  tipo + '</td>'+
                '<td>' +
                  '<button class="btn btn-danger" onclick="eliminarfila($(this))" title="Eliminar">' +
                    '<i class="fa fa-trash"></i>' +
                  '</button>' +
                '</td>' +
              '</tr>';
        $("#tabla-detalles").append(html);

          }
        }
     }
  }

  $("#txt_cantidad").val(1);

}

  function eliminarfila(obj){
    obj.closest("tr").remove();
  }

</script>


<script type="text/javascript">
  $(function(){

    $("#txt_cantidad").keyup(function(){

      var campoCant = $("#txt_cantidad").val();
      var id = $("#cmb_producto").val();

      $.ajax({
        url: url + 'producto/validacionCantidad',
        data:{'id': id},
        type: 'post',
        dataType:"json",
        async:false
      }).done(function(resut){
        var cantidad = parseInt(resut.cantidad);
        var ccant = parseInt(campoCant);
        if(cantidad < ccant){
          swal({
                title: "Cantidad ingresada no disponible!\n Cantidad actual: "+resut.cantidad+ " unidades",
                type: "error",
                confirmButton: "#3CB371",
                confirmButtonText: "Aceptar",
                // confirmButtonText: "Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
              });

               $("#txt_cantidad").val(resut.cantidad);
        }
      });
    });
  });

  function validarC()
  {
    var campoCant = $("#txt_cantidad").val();
    var id = $("#cmb_producto").val();
    var bandera = true;
    $.ajax({
      url: url + 'producto/validacionCantidad',
      data:{'id': id},
      type: 'post',
      dataType:"json",
      async:false
    }).done(function(resut){
      var cantidad = parseInt(resut.cantidad);
      var ccant = parseInt(campoCant);
      if(cantidad < ccant){
        swal({
              title: "Cantidad ingresada no disponible!\n Cantidad actual: "+resut.cantidad+ " unidades",
              type: "error",
              confirmButton: "#3CB371",
              confirmButtonText: "Aceptar",
              // confirmButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
            });
        bandera = false;
      }
    });

    return bandera;
  }


  </script>

  <script type="text/javascript">

  var band = true;
  function validarCantidad(){

   var cant = $("#txt_cantidad").val();

   if(cant > resut.cantidad){
     var band = false;
   }

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
