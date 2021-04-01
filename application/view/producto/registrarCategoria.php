
<br>
<button type="button" class="btn btn-primary btn-circle btn-md pull-right" data-toggle="modal" data-target="#mod_ayuda_categorias">
  <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
</button>
<form id="formulariocate" action="<?= URL ?>producto/registrarCategoria" method="post" data-parsley-validate="">
  <br><br>
<div class="panel panel-primary" style="margin-top: 5px">
  <div class="panel-heading" stlyle="height: 70px; width: 100px">
    <center><span style="text-align:center; color: #FFF; margin-top: 10px; margin-bottom:10px; font-size: 18px"><strong>Gestionar Categorías</strong></span></center>
  </div>
<div class="row">
  <br>

  <div class="panel-body">
    <div class="col-md-6 col-xs-12 col-lg-5">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><strong style="font-size: 18px;"><strong>Registrar Categoría</strong></strong></h3>
        </div>
        <div class="panel-body">
          <div class="row">
          <div class="col-md-12">
             <label for="form-control" class="control-label">Nombre Categoría <span class="obligatorio">*</span></label>
             <input type="text" tabindex="1" name="txtnombrec" minlength="4" maxlength="30" data-parsley-type="alphanum" id="txtnombrec"class="form-control" data-parsley-required="true">
         </div>
       </div>
       <br>
       <div class="row">
          <div class="col-md-6 col-xs-6 col-lg-6">
              <button type="submit" tabindex="2" class="btn btn-success active pull-right" id="btn-guardar" name="btn-ca" title="Guardar"><i class="fa fa-floppy-o" aria-hidden="true">   Guardar</i></button>
          </div>
          <div class="col-md-6 col-xs-6 col-lg-3">
              <button type="reset" tabindex="3" class="btn btn-danger active" onclick="cancelar()" id="btnCancelar" title="Cancelar"><i class="fa fa-remove" aria-hidden="true">   Cancelar</i></button>
              <input type="hidden" tabindex="4">
          </div>
         </div>
       </div>
     </div>
    </div>
  </form>


  <div class="modal fade" id="mod_ayuda_categorias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                   <div class="row">
                     <div class="col-xs-12 col-md-12 col-lg-12">
                       <div class="panel panel-primary">
                         <div class="panel-heading" stlyle="height: 70px; width: 100px">
                               <center><span class="modal-title" id="myModalLabel" style="color: #FFF; font-size: 18px"><strong>Ayuda de Gestionar Categorías</strong></span></center>
                         </div>
                         <div class="panel-body">
                             <p ALIGN="justify">Señor usuario en esta vista usted se va a encontrar varios paneles, los cuales hacen
                             diferentes acciones cada uno, esos paneles son:</p>
                             <ul>
                               <li><strong>Panel de Registro:</strong>
                                   <ol>Tener en cuenta a la hora de registrar una categoría lo siguiente:
                                     <li ALIGN="justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian,
                                       el sistema no le dejará seguir.</li>
                                       <li ALIGN="justify">No ingresar nombres ya existentes en la base de datos.</li>
                                   </ol>
                               </li>
                               <br>
                               <li><strong>Panel de Modificación:</strong>
                                  <ol>En este panel se listarán todas las categorías registradas.<br>
                                    Tener en cuenta para la modificación de una categoría lo siguiente:
                                    <li ALIGN="justify">No ingresar nombres ya existentes en la base de datos.</li>
                                    <li ALIGN="justify">Los nombres ingresados deben contener por lo menos 3 caracteres.</li>
                                  </ol>
                               </li>
                             </ul>
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
      $("#btnCancelar").blur(function(e){
        $("#txtnombrec").focus();
      })
    })
  </script>

  <div class="col-md-6 col-xs-12 col-lg-7">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><strong style="font-size: 18px;">Listar Categorías</strong></h3>
      </div>
      <div class="panel-body" id="panel_categorias">
        <div class="dataTable_wrapper">
          <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
               <tr>
                 <th>Código</th>
                 <th>Nombre Categoría</th>
                 <th>Modificar</th>
               </tr>
           </thead>

 <tbody>
   <?php foreach ($cate as $value): ?>
     <tr>
       <td><?= $value['id_categoria']  ?></td>
       <td><?= $value['nombre'] ?></td>
       <td>
          <button type="button" class="btn btn-success btn-circle btn-md" onclick="Traerdatoscategoria('<?= $value['id_categoria']?>')" data-toggle="modal" data-target="#myForm" title="Modificar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>

  </td>
     </tr>
   <?php endforeach ?>

 </div>
</tbody>
</table>
</div>
     </div>
   </div>
  </div>
  </div>
 </div>

 <form action="<?= URL ?>producto/listarCategorias/" method="POST"  id="form-modi" data-parsley-validate="">
   <div class="modal fade" id="myForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
     <div id="frmModCateg" method="post" data-parsley-validate="">

           <div class="modal-dialog" role="document">
             <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="panel panel-primary" style="margin-left: 2%; margin-right: 2%">
                     <div class="panel-heading" stlyle="height: 70px; width: 100px">
                       <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Modificar Categoría</strong></span></center>
                     </div>
                     <div class="panel-body">
                       <div class="col-md-6">
                     <label for="form-control">Código</label><br>
                     <input type="text" tabindex="1"  id="txtcodigo-show" class="form-control" value="1" disabled="true">
                     <input type="hidden" id="txtcodigo" name="txtcodigo" class="form-control" >

                  </div>
                  <div class="col-md-6">
                    <label for="form-control">Nombre <span class="obligatorio">*</span></label><br>
                     <input  id="txtnombreca" tabindex="2" name="txtnombreca" type="text" class="form-control" data-parsley-type="alphanum" minlength="3" maxlength="30" data-parsley-required="true">
                 </div>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6 col-md-6 col-lg-6">
            <button type="submit" tabindex="4" id="btn-modica" name="btn-modificar-categoria" class="btn btn-success btn-md active  pull-right" title="Modificar"><i class="fa fa-floppy-o" aria-hidden="true">   Modificar</i></button>
            <input type="hidden" tabindex="5">
          </div>
          <div class="col-xs-6 col-md-6 col-lg-3">
            <button type="button" tabindex="3" class="btn btn-secondary btn-md active"  data-dismiss="modal" title="Cerrar"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
          </div>
        </div>
   </div>
   </div>
 </div>
 </div>
 </div>
 </form>

 <script type="text/javascript">
   $(document).ready(function(){
     $("#btn-modica").blur(function(e){
       $("#txtcodigo-show").focus();
     })
   })
 </script>

 <script type="text/javascript">
   $(document).ready(function(){
       $("#btn-modica").click(function(){
         $("#form-modi").parsley().validate();
       })
 })

 </script>
</div>

<script>
$(document).ready(function(){

  $("#btn-guardar").click(function(){

      $("#txtnombreca").removeAttr("data-parsley-required");
      $("#formulariocate").parsley().validate();
  })
})
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
  $(function(){

    $("#txtnombrec").blur(function(){

      var txtnombrec = $("#txtnombrec").val();

      $.ajax({
        url: url + 'producto/validacionCategoria',
        data:{'txtnombrec': txtnombrec},
        type: 'post',
        dataType:"text"
      }).done(function(resut){

        if(resut == "1"){
          swal({
                title: "Nombre de categoría ya existe!",
                type: "error",
                confirmButton: "#3CB371",
                confirmButtonText: "Aceptar",
                // confirmButtonText: "Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
              });
              $("#txtnombrec").val("");
        }

      });
    });
  });
</script>

<script type="text/javascript">
  $(function(){

    $("#txtnombrec").keyup(function(){

      var txtnombrec = $("#txtnombrec").val();

      $.ajax({
        url: url + 'producto/validacionCategoria',
        data:{'txtnombrec': txtnombrec},
        type: 'post',
        dataType:"text"
      }).done(function(resut){

        if(resut == "1"){
          swal({
                title: "Nombre de categoría ya existe!",
                type: "error",
                confirmButton: "#3CB371",
                confirmButtonText: "Aceptar",
                // confirmButtonText: "Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
              });
              $("#txtnombrec").val("");
        }

      });
    });
  });
</script>


<script type="text/javascript">
  $(function(){

    $("#txtnombreca").keyup(function(){

      var txtnombrec = $("#txtnombreca").val();

      $.ajax({
        url: url + 'producto/validacionCategoria',
        data:{'txtnombrec': txtnombrec},
        type: 'post',
        dataType:"text"
      }).done(function(resut){

        if(resut == "1"){
          swal({
                title: "Nombre de categoría ya existe!",
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


<?php if (isset($categ) && $categ == false): ?>
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

        window.location("producto/registrarCategoria.php");
    });
  </script>
<?php endif; ?>

<?php if(isset($guarda) && $guarda == true): ?>
<script type="text/javascript">
  $(document).ready(function(){
  swal({
        title: "Guardado exitoso!",
        type: "success",
        confirmButton: "#3CB371",
        confirmButtonText: "Aceptar",
        // confirmButtonText: "Cancelar",
        closeOnConfirm: false,
        closeOnCancel: false
      })
  })
</script>
<?php endif; ?>
