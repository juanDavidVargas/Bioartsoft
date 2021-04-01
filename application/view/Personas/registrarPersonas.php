<br>
<button type="button" class="btn btn-primary btn-circle btn-md pull-right" data-toggle="modal" data-target="#mod_ayuda_registroPersonas">
  <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
</button>

<form  id="el-form" method="post" action="<?= URL ?>Personas/registrarPersonas" data-parsley-validate="">
  <br><br>
  <div class="panel panel-primary" style="margin-top: 5px">
    <div class="panel-heading" stlyle="height: 70px; width: 100px">
      <center><span style="text-align:center; color: #FFF; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><strong>Registrar Personas (Obligatorios * )</strong></span></center>
    </div>
    <div class="row">
      <br>
    <div class="panel-body">control
        <div class="row">

          <div class="col-md-1">
          </div>

          <?php if ($_SESSION['ROL'] == 1):?>
          <div class="col-md-3">
            <label for="">Tipo persona <span class="obligatorio">*div</span></label>
            <select class="form-control" tabindex="1" id="tipoPersona" name="txtTipoPersona" style="width: 100%" data-parsley-type="alphanum" data-parsley-required="true">
              <option value="">Seleccionar</option>
              <?php foreach ($TipoPersona as $value): ?>
                <?php if($value['idTbl_tipo_persona'] != 1 && $value['idTbl_tipo_persona'] != 2): ?>
                <option value="<?= $value['idTbl_tipo_persona'] ?>"><?= $value['Tbl_nombre_tipo_persona'] ?></option>
              <?php endif; ?>

               <?php endforeach; ?>
            </select>
          </div>
        <?php elseif ($_SESSION['ROL'] == 3):?>
        <div class="col-md-3">
          <label for="">Tipo persona <span class="obligatorio">*</span></label>
          <select class="form-control" tabindex="1" id="tipoPersona" name="txtTipoPersona" style="width: 100%" data-parsley-type="alphanum" data-parsley-required="true">
            <option value="">Seleccionar</option>
            <?php foreach ($TipoPersona as $value): ?>
              <option value="<?= $value['idTbl_tipo_persona'] ?>"><?= $value['Tbl_nombre_tipo_persona'] ?></option>

             <?php endforeach; ?>
          </select>
        </div>
        <?php elseif ($_SESSION['ROL'] == 2):?>
        <div class="col-md-3">
          <label for="">Tipo persona <span class="obligatorio">*</span></label>
          <select class="form-control" tabindex="1" id="tipoPersona" name="txtTipoPersona" style="width: 100%" data-parsley-type="alphanum" data-parsley-required="true">
            <option value="">Seleccionar</option>
            <?php foreach ($TipoPerVendedor as $value): ?>
              <option value="<?= $value['idTbl_tipo_persona'] ?>"><?= $value['Tbl_nombre_tipo_persona'] ?></option>

             <?php endforeach; ?>
          </select>
        </div>
      <?php endif; ?>

          <div class="col-md-3">
              <label for="">Tipo de documento <span class="obligatorio">*</span></label>
              <select name="txtTipoDocumento" tabindex="2" class="form-control" id="documento" style="width: 100%" data-parsley-required="true" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\.\?_~\\ \\()\/$]+">
                  <option value="">Seleccionar</option>
                  <option value="Cédula">Cédula</option>
                  <option value="Cédula Extranjera">Documento de  Extranjería</option>
              </select>
            </div>
             <div class="col-md-3">
                <label for="">Número de documento <span class="obligatorio">*</span></label>
                <input type="text" tabindex="3" name="txtIdPersona"  minlength="7" maxlength="15" style="width: 100%"class="form-control" id="campoId" placeholder="Número Documento" data-parsley-required="true">
            </div>

            <div class="col-md-1">
            </div>

          </div>
          <br><br>

          <div class="row">

            <div class="col-md-1">
            </div>

            <div class="col-md-3">
                <label for="">Nombres <span class="obligatorio">*</span></label>
                 <input type="text" tabindex="4"  name="txtNombres" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@\-\.\\ \/$]+" minlength="3" maxlength="30" class="form-control" style="width: 100%" id="campoNombre" placeholder="Nombres" data-parsley-required="true">
           </div>

            <div class="col-md-3">
                <label for="">Apellidos <span class="obligatorio">*</span></label>
                  <input type="text" tabindex="5"  name="txtApellidos" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@\-\.\\ \/$]+" minlength="3" maxlength="30" class="form-control" id="campoApellido" placeholder="Apellidos" data-parsley-required="true">
              </div>
             <div class="col-md-3">
                 <label for="">Número de teléfono</label>
                <input type="text" tabindex="6" name="txtTelefono" maxlength="10" minlength="7" data-parsley-type="number" class="form-control" id="campoTelefono" placeholder="Teléfono" data-parsley-required="false">
            </div>

            <div class="col-md-1">
            </div>

          </div>
          <br><br>

       <div class="row">

         <div class="col-md-1">
         </div>

         <div class="col-md-3">
             <label for="">Número de Celular <span class="obligatorio">*</span></label>
             <input type="text" tabindex="7"  name="txtCelular" maxlength="12" minlength="10" data-parsley-type="number" class="form-control" id="campoCelular" placeholder="Número Celular" data-parsley-required="true">
         </div>
          <div class="col-xs-12 col-md-3">
              <div class="form-group">
                <label for="">Correo Electrónico <span id="asterisco">*</span></label>
                <input type="email" tabindex="8" class="form-control" name="txtEmail" id="campoEmail" data-parsley-type="email" placeholder="Email"  data-parsley-required="true">
               </div>
          </div>
          <div class="col-md-3">
            <label for="">Género <span class="obligatorio">*</span></label>
            <select id="genero" tabindex="9" name="txtGenero" class="form-control" style="width: 100%" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" data-parsley-required="true">
                <option value="">Seleccionar</option>
                 <option value="Masculino">Masculino</option>
                 <option value="Femenino">Femenino</option>
            </select>
          </div>

          <div class="col-md-1">
          </div>
        </div>
            <br><br>

            <div class="row">
              <div class="col-md-1">
              </div>
              <div class="col-md-3">
                    <label for="">Dirección</label>
                     <input type="text" tabindex="10" name="txtDireccion" maxlength="50" minlength="3" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9@#\-\_\\.\\ \/$]+" class="form-control" id="campoDireccion" placeholder="Dirección" data-parsley-required="false">
                </div>

                <?php
                    $hoy1 = Date("Y-m-d");
                    $nuevaFecha = strtotime('-3 month', strtotime($hoy1));
                    $nuevaFecha = date('Y-m-d', $nuevaFecha);
                    $nuevaFecha2 = strtotime('+3 month', strtotime($hoy1));
                    $nuevaFecha2 = date('Y-m-d', $nuevaFecha2);
                 ?>

              <div id="conFechaContrato" style="display: none" class="col-md-3">
                  <label for="">Fecha Contrato <span class="obligatorio">*</span></label>
                  <div class="input-group date calendario" data-provide="datepicker">
                  <input type="text" tabindex="11" class="form-control" name="txtFechaContrato" id="campoFechaContrato" value="<?= $hoy1 ?>" readonly="true" placeholder="Fecha Contrato" data-parsley-requred="true">
                  <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
                </div>
                </div>
              </div>
              <input type="hidden" id="campoFechaContrato2" value="<?= $nuevaFecha ?>">
              <input type="hidden" id="campoFechaContrato3" value="<?= $nuevaFecha2 ?>">
              <div class="col-md-3" id="conTipoRol" style="display: none">
                  <label for="">Rol <span class="obligatorio">*</span></label>
                <select name="txtRol" tabindex="12" id="campoTipoRol" class="form-control"  style="width: 100%" data-parsley-required="true">
                     <option value="" >Seleccionar</option>
                     <?php foreach ($Roles as $valor): ?>
                       <option value="<?= $valor['id_rol'] ?>"><?= $valor['nombre_rol'] ?></option>
                      <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-1">
              </div>
            </div>
                <br><br>
                <div class="row">
                  <div class="col-md-1">
                  </div>
                  <div class="col-md-3" id="conNombreUsuario" style="display: none">
                        <label for="">Nombre usuario <span class="obligatorio">*</span></label>
                      <input type="text" tabindex="13" name="txtUsuario" maxlength="30" minlength="3" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9@#\-\_\\.\\ \/$]+" class="form-control" id="campoNombreUsuario" placeholder="Nombre Usuario" data-parsley-required="true">
                  </div>
            <div class="col-xs-12 col-md-3" id="conClave" style="display: none">
                  <label for="inputPassword"  class="control-label">Contraseña <span class="obligatorio">*</span></label>
                  <input type="password" tabindex="14" maxlength="7" minlength="4" name="txtClave" class="form-control" id="campoClave" placeholder="Contraseña" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\*\?_~\\.\\()\/$]+" data-parsley-required="true">
            </div>
            <div class="col-xs-12 col-md-3" id="conConfirmar" style="display: none">
                  <label for="">Confirmar contraseña <span class="obligatorio">*</span></label>
                  <input type="password" tabindex="10" maxlength="7" minlength="4" name="txtConfClave" data-parsley-equalto="#campoClave" class="form-control" id="campoConfirmar" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\*\?_~\\.\()\/$]+" placeholder="Confirmar Contraseña" data-parsley-required="true">
            </div>
            <div class="col-md-1">
            </div>
          </div>
          <br><br>

          <div class="row">
            <div class="col-md-1">
            </div>
              <div class="col-xs-12 col-md-3" id="conNit" style="display: none">
                    <label for="">Nit Empresa <span class="obligatorio">*</span></label>
                  <input type="text" tabindex="16"  name="txtnit" maxlength="30" minlength="6" class="form-control" id="campoNit" placeholder="Nit Empresa" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\*\?_~\\.\()\/$]+" data-parsley-required="true">
            </div>

            <div class="col-xs-12 col-md-3" id="conNombreEmpresa" style="display: none">
                <label for="">Nombre Empresa <span class="obligatorio">*</span></label>
                <input type="text" tabindex="17"  name="txtnombreEmpresa" maxlength="30" minlength="3" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\.\?_~\\ \\()\/$]+" class="form-control" id="campoNombreEmpresa" placeholder="Nombre Empresa" data-parsley-required="true">
            </div>

            <div class="col-xs-12 col-md-3" id="conDireccionEmpresa" style="display: none">
                <label for="">Teléfono Empresa <span class="obligatorio">*</span></label>
                  <input type="text" tabindex="18"  name="txtDireccionEmpresa" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\.\?_~\\ \\()\/$]+" minlength="6" maxlength="20" class="form-control" id="campoDireccionEmpresa" placeholder="Teléfono Empresa" data-parsley-required="true">
            </div>
            <div class="col-md-1">
            </div>
          </div>
          </div>

              <div class="row">
                 <div class="col-md-6 col-xs-6 col-lg-6">
                     <button type="submit" tabindex="19" name="btnGuardarPersona" id="btn-enviar" class="btn btn-success active pull-right" title="Guardar"><i class="fa fa-floppy-o" aria-hidden="true">  Guardar</i></button>
                 </div>
                 <div class="col-md-6 col-xs-6 col-lg-3">
                   <button type="reset" tabindex="20" class="btn btn-danger active" onclick="cancelar()" id="btn-Cancel" title="Cancelar"><i class="fa fa-remove" aria-hidden="true">  Cancelar</i></button>
                </div>
              <input type="hidden" tabindex="21">
             <div class="col-md-2">
          </div>
        </div>
        <br>
  </div>
</div>
</form>

<div class="modal fade" id="mod_ayuda_registroPersonas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                 <div class="row">
                   <div class="col-xs-12 col-md-12 col-lg-12">
                     <div class="panel panel-primary">
                       <div class="panel-heading" stlyle="height: 70px; width: 100px">
                             <center><span class="modal-title" id="myModalLabel" style="color: #FFF; font-size: 18px"><strong>Registrar Personas</strong></span></center>
                       </div>
                       <div class="panel-body">
                           <p ALIGN="justify">Señor usuario a la hora de realizar un registro tener en cuenta las siguientes recomendaciones:</p>
                           <ol>
                             <li ALIGN="justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian,
                               el sistema no le dejará seguir.</li>
                             <li ALIGN="justify">El campo número de documento, su logitud debe ser mayor a los 7 caracteres.</li>
                             <li ALIGN="justify">En el momento del registro no se debe ingresar un número de documento ya existente en la base de datos.</li>
                           </ol>
                       </div>
                       <br>
                     </div>
                   </div>
                 </div>
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
             <button type="button" class="btn btn-primary btn-md active pull-right"  data-dismiss="modal"><i class="fa fa-check-circle" aria-hidden="true">&nbsp;Aceptar</i></button>
          </div>
      </div>
  </div>
</div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $("#btn-Cancel").blur(function(e){
      $("#tipoPersona").focus();
    })
  })
</script>

<script type="text/javascript">

  $(document).ready(function(){
    $("#btn-enviar").click(function(){
        $("#el-form").parsley().validate();
    });

     $("#tipoPersona").select2();
     $("#tipoPersona").change(function(){
      var tipo=$(this).val();
      if (tipo == 1) {
        $("#conFechaContrato").slideDown();
        $("#campoFechaContrato").attr("data-parsley-required", 'true');
        $("#conTipoRol").slideDown();
        $("#campoTipoRol").attr("data-parsley-required", 'true');
        $("#conNombreUsuario").slideDown();
        $("#campoNombreUsuario").attr("data-parsley-required", 'true');
        $("#conClave").slideDown();
        $("#campoClave").attr("data-parsley-required", 'true');
        $("#conConfirmar").slideDown();
        $("#campoConfirmar").attr("data-parsley-required", 'true');
        $("#conNit").slideUp();
        $("#campoNit").removeAttr("data-parsley-required");
        $("#conNombreEmpresa").slideUp();
        $("#campoNombreEmpresa").removeAttr("data-parsley-required");
        $("#conDireccionEmpresa").slideUp();
        $("#campoDireccionEmpresa").removeAttr("data-parsley-required");
        $("#campoEmail").attr("data-parsley-required", "true");
        $("#asterisco").show();
      }else if (tipo == 2) {
        $("#conFechaContrato").slideUp();
        $("#campoFechaContrato").removeAttr("data-parsley-required");
        $("#conTipoRol").slideDown();
        $("#campoTipoRol").attr("data-parsley-required", 'true');
        $("#conNombreUsuario").slideDown();
        $("#campoNombreUsuario").attr("data-parsley-required", 'true');
        $("#conClave").slideDown();
        $("#campoClave").attr("data-parsley-required", 'true');
        $("#conConfirmar").slideDown();
        $("#campoConfirmar").attr("data-parsley-required", 'true');
        $("#conNit").slideUp();
        $("#campoNit").removeAttr("data-parsley-required");
        $("#conNombreEmpresa").slideUp();
        $("#campoNombreEmpresa").removeAttr("data-parsley-required");
        $("#conDireccionEmpresa").slideUp();
        $("#campoDireccionEmpresa").removeAttr("data-parsley-required");
        $("#campoEmail").attr("data-parsley-required", "true");
        $("#asterisco").show();
      }else if(tipo == 4){
        $("#conFechaContrato").slideUp()
        $("#campoFechaContrato").removeAttr("data-parsley-required");
        $("#conNit").slideDown();
        $("#campoNit").attr("data-parsley-required", 'true');
        $("#conNombreEmpresa").slideDown();
        $("#campoNombreEmpresa").attr("data-parsley-required", 'true');
        $("#conDireccionEmpresa").slideDown();
        $("#campoDireccionEmpresa").attr("data-parsley-required", 'true');
        $("#conNombreUsuario").slideUp();
        $("#campoNombreUsuario").removeAttr("data-parsley-required");
        $("#conClave").slideUp();
        $("#campoClave").removeAttr("data-parsley-required");
        $("#conConfirmar").slideUp();
        $("#campoConfirmar").removeAttr("data-parsley-required");
        $("#conTipoRol").slideUp();
        $("#campoTipoRol").removeAttr("data-parsley-required");
        $("#campoEmail").removeAttr("data-parsley-required");
        $("#asterisco").hide();
      }else if(tipo == 3){
        $("#conFechaContrato").slideUp()
        $("#campoFechaContrato").removeAttr("data-parsley-required");
        $("#conNit").slideUp();
        $("#campoNit").removeAttr("data-parsley-required");
        $("#conNombreEmpresa").slideUp();
        $("#campoNombreEmpresa").removeAttr("data-parsley-required");
        $("#conDireccionEmpresa").slideUp();
        $("#campoDireccionEmpresa").removeAttr("data-parsley-required");
        $("#conNombreUsuario").slideUp();
        $("#campoNombreUsuario").removeAttr("data-parsley-required");
        $("#conClave").slideUp();
        $("#campoClave").removeAttr("data-parsley-required");
        $("#conConfirmar").slideUp();
        $("#campoConfirmar").removeAttr("data-parsley-required");
        $("#conTipoRol").slideUp();
        $("#campoTipoRol").removeAttr("data-parsley-required");
        $("#campoEmail").removeAttr("data-parsley-required");
        $("#asterisco").hide();
        }else if(tipo == 5){
          $("#conFechaContrato").slideUp()
          $("#campoFechaContrato").removeAttr("data-parsley-required");
          $("#conNit").slideUp();
          $("#campoNit").removeAttr("data-parsley-required");
          $("#conNombreEmpresa").slideUp();
          $("#campoNombreEmpresa").removeAttr("data-parsley-required");
          $("#conDireccionEmpresa").slideUp();
          $("#campoDireccionEmpresa").removeAttr("data-parsley-required");
          $("#conNombreUsuario").slideUp();
          $("#campoNombreUsuario").removeAttr("data-parsley-required");
          $("#conClave").slideUp();
          $("#campoClave").removeAttr("data-parsley-required");
          $("#conConfirmar").slideUp();
          $("#campoConfirmar").removeAttr("data-parsley-required");
          $("#conTipoRol").slideUp();
          $("#campoTipoRol").removeAttr("data-parsley-required");
          $("#campoEmail").removeAttr("data-parsley-required");
          $("#asterisco").hide();
          }else if(tipo == 6){
            $("#conFechaContrato").slideUp()
            $("#campoFechaContrato").removeAttr("data-parsley-required");
            $("#conNit").slideUp();
            $("#campoNit").removeAttr("data-parsley-required");
            $("#conNombreEmpresa").slideUp();
            $("#campoNombreEmpresa").removeAttr("data-parsley-required");
            $("#conDireccionEmpresa").slideUp();
            $("#campoDireccionEmpresa").removeAttr("data-parsley-required");
            $("#conNombreUsuario").slideUp();
            $("#campoNombreUsuario").removeAttr("data-parsley-required");
            $("#conClave").slideUp();
            $("#campoClave").removeAttr("data-parsley-required");
            $("#conConfirmar").slideUp();
            $("#campoConfirmar").removeAttr("data-parsley-required");
            $("#conTipoRol").slideUp();
            $("#campoTipoRol").removeAttr("data-parsley-required");
            $("#campoEmail").removeAttr("data-parsley-required");
            $("#asterisco").hide();
          }else{
            $("#conFechaContrato").slideUp()
            $("#campoFechaContrato").removeAttr("data-parsley-required");
            $("#conNit").slideUp();
            $("#campoNit").removeAttr("data-parsley-required");
            $("#conNombreEmpresa").slideUp();
            $("#campoNombreEmpresa").removeAttr("data-parsley-required");
            $("#conDireccionEmpresa").slideUp();
            $("#campoDireccionEmpresa").removeAttr("data-parsley-required");
            $("#conNombreUsuario").slideUp();
            $("#campoNombreUsuario").removeAttr("data-parsley-required");
            $("#conClave").slideUp();
            $("#campoClave").removeAttr("data-parsley-required");
            $("#conConfirmar").slideUp();
            $("#campoConfirmar").removeAttr("data-parsley-required");
            $("#conTipoRol").slideUp();
            $("#campoTipoRol").removeAttr("data-parsley-required");
            $("#campoEmail").removeAttr("data-parsley-required");
            $("#asterisco").hide();
            }
    });
  });
</script>

<?php if (isset($errorId) && $errorId == false): ?>
  <script type="text/javascript">
    $(document).ready(function(){
      swal({
            title: "Identificación ya existe, no se puede registrar!",
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

<?php if (isset($errorUsuario) && $errorUsuario == false): ?>
  <script type="text/javascript">
    $(document).ready(function(){
      swal({
            title: "Nombre de usuario ya existe, no se puede registrar!",
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

<?php if (isset($errorEmail) && $errorEmail == false): ?>
  <script type="text/javascript">
    $(document).ready(function(){
      swal({
            title: "Correo ya existe, no se puede registrar!",
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
  $(function(){

    $("#campoId").keydown(function(){

      if($("#campoId").val() == 0){
        $("#campoId").val("");
      }
    })

    $("#campoId").change(function(){

      var campoId = $("#campoId").val();

      if(campoId <= 0){
        swal({
              title: "Identificacion inválida!",
              type: "error",
              confirmButton: "#3CB371",
              confirmButtonText: "Aceptar",
              // confirmButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
            });
        $("#campoId").val("");
        $("#campoId").focus();
      }else{
        $.ajax({
          url: url + 'Personas/validacion',
          data:{'campoId': campoId},
          type: 'post',
          dataType:"text"
        }).done(function(resut){

          if(resut == "1"){
            swal({
                  title: "Identificación ya existe!",
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

    });

  });
</script>

<script type="text/javascript">
  $(function(){

    $("#campoEmail").change(function(){

      var campoEmail = $("#campoEmail").val();

      $.ajax({
        url: url + 'Personas/validacionEmail',
        data:{'campoEmail': campoEmail},
        type: 'post',
        dataType:"text"
      }).done(function(resut){

        if(resut == "1"){
          swal({
                title: "Correo ya existe!",
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
  $(function(){

    $("#campoNombreUsuario").change(function(){

      var campoNombreUsuario = $("#campoNombreUsuario").val();

      $.ajax({
        url: url + 'Personas/validacionUsuario',
        data:{'campoNombreUsuario': campoNombreUsuario},
        type: 'post',
        dataType:"text"
      }).done(function(resut){

        if(resut == "1"){
          swal({
                title: "Nombre de usuario ya existe!",
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
$(document).ready(function(){


  $("#documento").change(function(){
    var documento = $("#documento").val();
    if(documento == "Cedula"){
      $("#campoId").removeAttr("data-parsley-type", "alphanum");
      $("#campoId").attr("data-parsley-type", "number");

    }else{
        $("#campoId").removeAttr("data-parsley-type");
      $("#campoId").attr("data-parsley-type", "alphanum");

    }
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
  $(document).ready(function(){
    $("#asterisco").hide();
  });
</script>


<script type="text/javascript">
  $("#campoFechaContrato").change(function(){
    var valor = $('#campoFechaContrato').val();
    var valor2 = $('#campoFechaContrato2').val();


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
                  $('#campoFechaContrato').val("");
              }
            })
          }

  });

</script>

<script type="text/javascript">
  $("#campoFechaContrato").change(function(){
    var valor3 = $('#campoFechaContrato').val();
    var valor4 = $('#campoFechaContrato3').val();


    if(valor3 > valor4){
      swal({
              title: "Fecha inválida, la fecha no puede ser mayor a 3 meses!",
              type: "error",
              confirmButtonColor: "#86CCEB",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,

              },
              function(isConfirm){
              if (isConfirm) {
                  $('#campoFechaContrato').val("");
              }
            })
          }

  });

</script>
