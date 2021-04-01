<div class="row">
  <br>
  <button type="button" class="btn btn-primary btn-circle btn-md pull-right" data-toggle="modal" data-target="#mod_ayuda_proveedores">
    <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
  </button>
  <br><br>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary" >
              <div class="panel-heading" stlyle="height: 70px; width: 100px">
                  <center><span style="color: #fff; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><strong>Listar Proveedores</strong></span></center>
              </div>
              <div class="panel-body">
                <div class="dataTable_wrapper">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo de Proveedor</th>
                                <th>Estado</th>
                                <th>Opciones</th>

                              </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($listarP as $valor): ?>
                            <tr>
                                <td><?= $valor['id_persona'] ?></td>
                                <td><?=  $valor['nombres'] ?></td>
                                <td><?=  $valor['apellidos'] ?></td>
                                <td><?=  $valor['Tbl_nombre_tipo_persona'] ?></td>
                                <td><?php if($valor['estado'] == 1): ?>
                                        Habilitado
                                       <?php else:  ?>
                                        Inhabilitado
                                       <?php endif ?></td>
                                       <td>

                                  <?php if ($valor['estado']==1): ?>

                                     <a href="<?= URL. 'Personas/listarProveedores/' . $valor['id_persona'] ?>/3">
                                     <button type="button" class="btn btn-primary btn-circle btn-md" onclick="" data-toggle="modal" data-target="#modal-detalles-Proveedor" title="Ver detalles"><i class="fa fa-eye" aria-hidden="true" title="Ver detalles"></i></button>
                                     </a>

                                     <a href="<?= URL. 'Personas/listarProveedores/' . $valor['id_persona'] ?>/1">
                                     <button type="button" class="btn btn-success btn-circle btn-md" onclick=""data-toggle="modal" data-target="#modal-actualizar-prov" title="Modificar"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Modificar"></i></button>
                                     </a>

                                   <button type="button"  onclick="cambiarestado('<?= $valor['id_persona']?>')" class="btn btn-danger btn-circle btn-md" title="Cambiar estado"><span class="glyphicon glyphicon-refresh" aria-hidden="true" title="Cambiar estado"></span></button>

                                  <?php else:  ?>

                                    <a href="<?= URL. 'Personas/listarProveedores/' . $valor['id_persona'] ?>/3">
                                    <button type="button" class="btn btn-primary btn-circle btn-md" onclick=""data-toggle="modal" data-target="#modal-detalles-Proveedor" title="Ver detalles"><i class="fa fa-eye" aria-hidden="true" title="Ver detalles"></i></button>
                                    </a>

                                   <button type="button"  onclick="cambiarestado('<?= $valor['id_persona']?>')" class="btn btn-danger btn-circle btn-md" title="Cambiar estado"><span class="glyphicon glyphicon-refresh" aria-hidden="true" title="Cambiar estado"></span></button>

                                 <?php endif ?>
                              </td>
                              </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                 <div class="row">
                <?php foreach ($listarP as $value): ?>
                <?php if($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3): ?>
                <?php if($value['estado'] == 1): ?>
                      <div class="col-sm-12">
                        <center>
                        <a href="<?= URL ?>Personas/generarpdfproveedor" target="_blank">
                          <button class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true">   Reporte PDF de Proveedores</i></button>
                        </a>
                      </center>
                      </div>
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
      </div>

      <div class="modal fade" id="mod_ayuda_proveedores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-body">
                       <div class="row">
                         <div class="col-xs-12 col-md-12 col-lg-12">
                           <div class="panel panel-primary">
                             <div class="panel-heading" stlyle="height: 70px; width: 100px">
                                   <center><span class="modal-title" id="myModalLabel" style="color: #FFF; font-size: 18px"><strong>Ayuda de Listar Proveedores</strong></span></center>
                             </div>
                             <div class="panel-body">
                                 <p ALIGN="justify">Señor usuario en esta vista usted se va a encontrar con diferentes
                                    opciones ubicadas al lado izquierdo de la tabla, cada una con una acción
                                    diferente, pero en esta ocasión solo se le orientará sobre el icono verde, que
                                    pertenece a la opción de modificación:</p>
                                 <ul>
                                   <li><strong>Opcion de Modificación:</strong>
                                       <ol>Tener en cuenta a la hora de modificar un proveedor lo siguiente:
                                         <li ALIGN="justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian,
                                           el sistema no le dejará seguir.</li>
                                           <li ALIGN="justify">Al cambiar un proveedor natural a proveedor jurídico, se le solicitará los datos adicionales de la empresa,
                                             todos obligatorios.</li>
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

<?php if ($id!= "" && $tipo == 1): ?>

<div class="modal fade" id="modal-actualizar-prov" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-body">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       <div class="modal-header">
         <div class="row">
           <div class="col-lg-12">
             <div class="panel panel-primary">
               <div class="panel-heading" stlyle="height: 70px; width: 100px">
                     <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Modificar Proveedor (Obligatorios *)</strong></center>
               </div>
             <form method="POST"  id="form-2" role="form" action="<?= URL ?>Personas/listarProveedores/<?= $proveedor['id_persona'] ?>" data-parsley-validate="">
              <div class="modal-body">
                <input type="hidden" name="txtidPersona" value="<?= $proveedor['id_persona'] ?>">
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Número de documento</label>
                    <input type="text" tabindex="1" name="txtIdPersona" style="width: 100%"class="form-control" id="campoId" readonly="true" value="<?= $proveedor['id_persona'] ?>">
                  </div>
                  <div class="col-md-6">
                        <label for="">Tipo de documento</label>
                        <input type="text" name="txttipoCedula" value="<?= $proveedor['tipo_documento'] ?>" style="width: 100%"class="form-control" id="campoId2" readonly="true">
                  </div>
                </div>
                  <br>
        <div class="row">
              <div class="col-md-6"  class="form-group">
                  <label>Nombres <span class="obligatorio">*</span></label><br>
                  <input type="text" tabindex="2" class="form-control" name="txtnombre" id="ejemplo_password_2" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@\-\.\\ \/$]+" minlength="3" maxlength="30"
                  value="<?= $proveedor['nombres'] ?>" data-parsley-required="true">
               </div>

                  <div class="col-md-6">
                    <label>Apellidos <span class="obligatorio">*</span></label><br>
                      <input type="text" tabindex="3" class="form-control" id="fecha" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@\-\.\\ \/$]+" minlength="3" maxlength="30"
                         value="<?= $proveedor['apellidos'] ?>" name="txtapell" data-parsley-required="true">
                  </div>
        </div>
        <br>

        <div class="row">
                          <div class="col-md-6">
                            <label>Celular <span class="obligatorio">*</span></label><br>
                            <input type="text" tabindex="4" class="form-control" id="ejemplo_password_2" maxlength="12" minlength="10" data-parsley-type="number"
                                   value="<?= $proveedor['celular'] ?>" name="txtcel" data-parsley-required="true">
                           </div>
                         <div class="col-md-6">
                           <label>Email</label><br>
                           <input type="email" tabindex="5" class="form-control" id="ejemplo_password_2" data-parsley-type="email"
                           value="<?= $proveedor['email'] ?>" name="txtcorreo">
                         </div>
        </div>
        <br>
        <div class="row">
                     <div class="col-md-6">
                       <label>Teléfono</label><br>
                       <input type="text" tabindex="6" class="form-control" id="ejemplo_password_2" maxlength="10" minlength="7" data-parsley-type="number"
                              value="<?= $proveedor['telefono'] ?>" name="txttel" data-parsley-required="false">
                      </div>
                      <div class="col-md-6">
                        <label>Dirección</label><br>
                          <input type="text" tabindex="7" class="form-control" id="ejemplo_password_2" maxlength="50" minlength="3"  pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\*\?_~\\ \\.\/$]+"
                             value="<?= $proveedor['direccion'] ?>" name="txtdirecc" data-parsley-required="false">
                      </div>
        </div>
        <br>
        <div class="row">

                   <div class="col-md-6">
                     <label>Tipo Proveedor <span class="obligatorio">*</span></label><br>
                     <select class="form-control" tabindex="8" name="txtTipoEmpleado" id="select-proveedor" data-parsley-type="alphanum" data-parsley-required="true">
                       <?php foreach($TipoProveedor AS $tipo): ?>
                         <option value="<?= $tipo['idTbl_tipo_persona'] ?>" <?= $proveedor['Tbl_TipoPersona_idTbl_TipoPersona'] == $tipo['idTbl_tipo_persona'] ? 'selected="selected"' : '' ?>>
                           <?= $tipo['Tbl_nombre_tipo_persona']?>
                         </option>
                       <?php endforeach ?>

                     </select>

                   </div>
                   <?php if (isset($proveedorJ)): ?>
                     <div class="col-md-6" id="div-empresa">
                       <label>Nit Empresa <span class="obligatorio">*</span></label><br>
                       <input type="text" tabindex="9" class="form-control" id="txtnit"  maxlength="30" minlength="6" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\.\?_~\\ \\()\/$]+"
                              value="<?= $proveedorJ['nit'] ?>" name="txtNit" data-parsley-required="true">
                      </div>
                   <?php endif; ?>
                    <br>

                      </div>
                      <br>
                      <div class="row">
                         <?php if (isset($proveedorJ)): ?>
                                   <div class="col-md-6" id="div-nombreEmp">
                                     <label>Nombre Empresa <span class="obligatorio">*</span></label><br>
                                     <input type="text" tabindex="10" class="form-control" id="txtnombreEmp" maxlength="30" minlength="3" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\.\?_~\\ \\()\/$]+"
                                            value="<?= $proveedorJ['empresa'] ?>" name="txtEmpresa" data-parsley-required="true">
                                    </div>
                                    <div class="col-md-6" id="div-telefonoEmp">
                                      <label>Teléfono Empresa <span class="obligatorio">*</span></label><br>
                                        <input type="text" tabindex="11" class="form-control" id="txttelefonoEmp" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\.\?_~\\ \\()\/$]+" minlength="6" maxlength="20"
                                           value="<?= $proveedorJ['telefono_empresa'] ?>" name="txtTele" data-parsley-required="true">
                                    </div>
                          <?php endif; ?>
                      </div>
                      <?php if ($proveedor['Tbl_TipoPersona_idTbl_TipoPersona'] == 3): ?>
                      <div class="row">
                                  <div class="" style="display: none" id="div-titulo">
                                    <center>
                                      <h4 class="modal-title"  style="color: #337AB7" id="ftitulo"><b>Datos de empresa a ingresar</b></h4>
                                    </center>

                                  </div>
                                  <br>
                                  <div class="col-md-4" id="div-emp" style="display: none">
                                    <label>Nit Empresa <span class="obligatorio">*</span></label><br>
                                    <input type="text" tabindex="12" class="form-control" id="txtNitE" maxlength="30" minlength="6" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\.\?_~\\ \/$]+"
                                           value="" name="txtNitEmp" data-parsley-required="true">
                                   </div>
                                   <div class="col-md-4" id="div-nombreEmpresa"  style="display: none">
                                     <label>Nombre Empresa <span class="obligatorio">*</span></label><br>
                                     <input type="text" tabindex="13" class="form-control" id="txtNombreEmpresa" maxlength="30" minlength="3" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\.\?_~\\ \\()\/$]+"
                                            value="" name="txtNombreE" data-parsley-required="true">
                                    </div>
                                    <div class="col-md-4" id="div-telefEmp"  style="display: none">
                                      <label>Teléfono Empresa <span class="obligatorio">*</span></label><br>
                                        <input type="text" tabindex="14" class="form-control" id="txttelefonoEmpresa" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\.\?_~\\ \\()\/$]+" minlength="6" maxlength="20"
                                           value="" name="txtTeleEmp" data-parsley-required="true">
                                    </div>

                      </div>
                      <?php endif; ?>
                      <br>
                  </div>
                </div>
                <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-6">
                  <button type="submit" tabindex="16" name="btn-modificar-prov" id="btn-guardar-Mod-Prov" class="btn btn-success btn-md active pull-right"><i class="fa fa-floppy-o" aria-hidden="true">   Modificar</i></button>
                  <input type="hidden" tabindex="17">
                </div>
                  <div class="col-xs-6 col-md-3 col-lg-3">
                    <button type="button" class="btn btn-danger btn-md active" onclick="cancelarModProveedor()" id="btnmodificarProveedor" title="Cancelar Registro"><i class="fa fa-times" aria-hidden="true">   Cancelar</i> </button>
                  </div>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


 <?php endif; ?>
 <script type="text/javascript">
   $(document).ready(function(){
     $("#btn-guardar-Mod-Prov").blur(function(e){
       $("#campoId").focus();
     })
   })
 </script>

 <?php if ($id!= "" && $tipo == 3): ?>
 <div class="modal fade" id="modal-detalles-Proveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
     <div class="modal-dialog">
       <div class="modal-content" style="width: 100%">
               <form method="POST" action="<?= URL ?>Personas/listarProveedores/<?=  $valor['id_persona'] ?>">
                <div class="modal-body">
                  <input type="hidden" name="idPersona" value="<?= $proveedor['id_persona'] ?>">
                  <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-primary" >
                        <div class="panel-heading" stlyle="height: 70px; width: 100px">
                            <center><span style="color: #fff; font-size: 18px" id="myModalLabel"><strong>Detalle de: <?= $proveedor['tipo_documento'] == "Cédula"? "C.C" : "C.E"  ?>: <?php echo $proveedor['id_persona']." - ".$proveedor['nombres'].' '.$proveedor['apellidos']?></strong></span></center>
                        </div>
                          <div class="panel-body">
                            <div class="dataTable_wrapper">
                              <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>

                        <th>Celular</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                      <?php if ( $proveedor['Tbl_TipoPersona_idTbl_TipoPersona'] == 4): ?>
                        <th>Nit Empresa</th>
                        <th>Nombre Empresa</th>
                        <th>Teléfono Empresa</th>
                      <?php endif; ?>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td><?=  $proveedor['celular'] ?></td>
                          <td><?=  $proveedor['telefono'] ?></td>
                          <td><?=  $proveedor['email'] ?></td>
                          <td><?=  $proveedor['direccion'] ?></td>
                      <?php if ( $proveedor['Tbl_TipoPersona_idTbl_TipoPersona'] == 4): ?>
                          <td><?=  $proveedorJ['nit'] ?></td>
                          <td><?=  $proveedorJ['empresa'] ?></td>
                          <td><?=  $proveedorJ['telefono_empresa'] ?></td>
                      <?php endif; ?>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        <div>
      <div class="row">
          <div class="col-md-11 col-lg-11 col-xs-11">
            <button type="button" class="btn btn-secondary btn-md active pull-right"  data-dismiss="modal" style="float: center"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
</div>
</div>
</div>
<?php endif; ?>

<script type="text/javascript">
   $(document).ready(function(){
   $("#modal-actualizar-prov").modal("show");

   $("#btn-guardar-Mod-Prov").click(function(){

     $("#form-2").parsley().validate();

   });

 });

  function  cancelarModProveedor(){
    swal({
    title: "¿Cancelar la modificación?",
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
          title: "Modificación cancelada!",
          type: "error",
          confirmButton: "#3CB371",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfir){
          window.location = url + "Personas/listarProveedores";
        });
      }
      });
  }
</script>

<script type="text/javascript">
    $(document).ready(function(){
    $("#modal-detalles-Proveedor").modal("show");

  });
</script>

<script type="text/javascript">
function cambiarestado(id){
swal({
title: "¿Realmente desea cambiar el estado del proveedor?",
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
  if (isConfirm) {
    swal({
      title: "Estado cambiado.!",
      type: "success",
      confirmButton: "#3CB371",
      confirmButtonText: "Aceptar",
      // confirmButtonText: "Cancelar",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      $.ajax({
        type:"POST",
        url:url+"Personas/cambiarEstadoProveedor",
        data:{
        'id':id,
      },
      }).done(function(respuesta){
        if(respuesta == 1){
          window.location = url + "Personas/listarProveedores";
        }else{
        sweetAlert("Error al cambiar el estado");
        }
      }).fail(function(){

      })

    });
  }
  });

}

</script>

<?php if ($proveedor['Tbl_TipoPersona_idTbl_TipoPersona'] == 4): ?>
<script type="text/javascript">
$(document).ready(function(){
$("#select-proveedor").change(function(){
 var tipo=$(this).val();
 if(tipo == 4){
   $("#div-empresa").slideDown();
   $("#txtnit").attr("data-parsley-required", 'true');
   $("#div-nombreEmp").slideDown();
   $("#txtnombreEmp").attr("data-parsley-required", 'true');
   $("#div-telefonoEmp").slideDown();
   $("#txttelefonoEmp").attr("required", 'true');
   $("#txtnit").removeAttr("data-parsley-required");
   $("#txtNitE").removeAttr("data-parsley-required");
   $("#txtNombreEmpresa").removeAttr("data-parsley-required");
   $("#txttelefonoEmpresa").removeAttr("data-parsley-required");
   $("#txtnit").removeAttr("data-parsley-required");
   $("#txtnombreEmp").removeAttr("data-parsley-required");
   $("#txttelefonoEmp").removeAttr("data-parsley-required");

 }else if(tipo == 3){
   $("#div-empresa").slideUp();
   $("#txtnit").removeAttr("data-parsley-required");
   $("#div-nombreEmp").slideUp();
   $("#txtnombreEmp").removeAttr("data-parsley-required");
   $("#div-telefonoEmp").slideUp();
   $("#txttelefonoEmp").removeAttr("data-parsley-required");
   $("#txtNitE").removeAttr("data-parsley-required");
   $("#txtNombreEmpresa").removeAttr("data-parsley-required");
   $("#txttelefonoEmpresa").removeAttr("data-parsley-required");

   }
});
});
</script>
<?php endif; ?>

<?php if ($proveedor['Tbl_TipoPersona_idTbl_TipoPersona'] == 3): ?>
<script type="text/javascript">
$(document).ready(function(){
$("#select-proveedor").change(function(){
 var tipo=$(this).val();
 if(tipo == 4){
   $("#div-emp").slideDown();
   $("#txtNitE").attr("data-parsley-required", 'true');
   $("#div-nombreEmpresa").slideDown();
   $("#txtNombreEmpresa").attr("data-parsley-required", 'true');
   $("#div-telefEmp").slideDown();
   $("#txttelefonoEmpresa").attr("data-parsley-required", 'true');
   $("#div-titulo").slideDown();
   $("#ftitulo").attr("data-parsley-required", 'true');
   $("#ftitulo").removeAttr("data-parsley-required");
   $("#txtnit").removeAttr("data-parsley-required");
   $("#txtnombreEmp").removeAttr("data-parsley-required");
   $("#txttelefonoEmp").removeAttr("data-parsley-required");

 }else if(tipo == 3){
   $("#div-emp").slideUp();
   $("#txtNitE").removeAttr("data-parsley-required");
   $("#div-nombreEmpresa").slideUp();
   $("#txtNombreEmpresa").removeAttr("data-parsley-required");
   $("#div-telefEmp").slideUp();
   $("#txttelefonoEmpresa").removeAttr("data-parsley-required");
   $("#div-titulo").slideUp();
   $("#ftitulo").removeAttr("data-parsley-required");
   $("#txtnit").removeAttr("data-parsley-required");
   $("#txtnombreEmp").removeAttr("data-parsley-required");
   $("#txttelefonoEmp").removeAttr("data-parsley-required");
   }
});
});
</script>
<?php endif; ?>

<?php if ( $proveedor['Tbl_TipoPersona_idTbl_TipoPersona'] == 3): ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#txtNitE").removeAttr("data-parsley-required");
    $("#txtNombreEmpresa").removeAttr("data-parsley-required");
    $("#txttelefonoEmpresa").removeAttr("data-parsley-required");

  })
</script>
<?php endif; ?>


<?php if (isset($correo) && $correo == false): ?>
  <script type="text/javascript">
    $(document).ready(function(){
      swal({
            title: "Correo ya existe, no se puede modificar!",
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
