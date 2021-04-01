<div class="row">
  <br>
  <button type="button" class="btn btn-primary btn-circle btn-md pull-right" data-toggle="modal" data-target="#mod_ayuda_modificacionPersonas">
    <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
  </button>
    <br><br>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary" >
              <div class="panel-heading" stlyle="height: 70px; width: 100px">
                  <center><span style="color: #fff; margin-top: 10px; margin-bottom: 10px; font-size: 18px"><strong>Listar Usuarios-Empleados</strong></span></center>
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
                                  <th>Celular</th>
                                  <th>Dirección</th>
                                  <th>Tipo Empleado</th>
                                  <th>Estado</th>
                                  <th>Opciones</th>
                              </tr>
                          </thead>
                          <tbody>

                            <?php foreach ($listarE as $valor): ?>
                              <tr>
                                  <td><?= $valor['id_persona'] ?></td>
                                  <td><?=  $valor['nombres'] ?></td>
                                  <td><?=  $valor['apellidos'] ?></td>
                                  <td><?=  $valor['celular'] ?></td>
                                  <td><?=  $valor['direccion'] ?></td>
                                  <td><?=  $valor['Tbl_nombre_tipo_persona'] ?></td>
                                  <td><?php if($valor['estado'] == 1): ?>
                                          Habilitado
                                         <?php else:  ?>
                                          Inhabilitado
                                         <?php endif ?></td>
                                         <td>

                                    <?php if ($valor['estado'] == 1): ?>

                                      <a href="<?= URL. 'Personas/listarPersonasEmpleados/' . $valor['id_usuarios'] ?>/3">
                                       <button type="button" class="btn btn-primary btn-circle btn-md" onclick=""data-toggle="modal" data-target="#modal-detalles" title="Ver detalles"><i class="fa fa-eye" aria-hidden="true" title="Ver detalles"></i></button>
                                       </a>


                                    <a href="<?= URL. 'Personas/listarPersonasEmpleados/' . $valor['id_usuarios'] ?>/1">
                                      <button type="button" class="btn btn-success btn-circle btn-md" onclick=""data-toggle="modal" data-target="#modal-actualizar" title="Modificar"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Modificar"></i></button>
                                    </a>
                                    
                                    <a href="<?= URL. 'Personas/modificarContrasenia/' . $valor['id_usuarios'] ?>/2">
                                      <button type="button" class="btn btn-warning btn-circle btn-md" data-toggle="modal" data-target="#modal-cambiar-contras" title="Cambiar contraseña"><i class="fa fa-key" aria-hidden="true" title="Cambiar contraseña"></i></button>
                                    </a>

                                    <?php if($valor['id_rol'] != 3): ?>
                                     <button type="button"  onclick="cambiarestado('<?= $valor['id_usuarios']?>')" class="btn btn-danger btn-circle btn-md" title="Cambiar estado"><span class="glyphicon glyphicon-refresh" aria-hidden="true" title="Cambiar estado"></span></button>
                                   <?php endif; ?>


                                    <?php else:  ?>
                                      <a href="<?= URL. 'Personas/listarPersonasEmpleados/' . $valor['id_usuarios'] ?>/3">
                                       <button type="button" class="btn btn-primary btn-circle btn-md" onclick=""data-toggle="modal" data-target="#modal-detalles" title="Ver detalles"><i class="fa fa-eye" aria-hidden="true" title="Ver detalles"></i></button>
                                       </a>

                                       <button type="button"  onclick="cambiarestado('<?= $valor['id_usuarios']?>')" class="btn btn-danger btn-circle btn-md" title="Cambiar estado"><span class="glyphicon glyphicon-refresh" aria-hidden="true" title="Cambiar estado"></span></button>
                                       <?php if($valor['id_rol'] != 3): ?>
                                         <button type="button"  onclick="cambiarestado('<?= $valor['id_usuarios']?>')" class="btn btn-danger btn-circle btn-md" title="Cambiar estado"><span class="glyphicon glyphicon-refresh" aria-hidden="true" title="Cambiar estado"></span></button>
                                       <?php endif; ?>
                                   <?php endif ?>
                                </td>
                                </tr>
                                  <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
                  <div class="row">
                    <?php if($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3): ?>
                          <?php if($valor['estado'] == 1): ?>
                       <div class="col-sm-12">
                         <center>
                         <a href="<?= URL ?>Personas/generarpdfEmpleados" target="_blank">
                           <button class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true">   Reporte PDF de Empleados</i></button>
                         </a>
                       </center>
                       </div>
                 <?php else: ?>
                 <?php endif; ?>
                 <?php endif; ?>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>

  <?php if ($id!= "" && $tipo == 1): ?>
  <div class="modal fade" id="modal-actualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
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
                       <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Modificar Usuarios-Empleados (Obligatorios *)</strong></center>
                 </div>
               <form method="POST"  id="form-2" role="form" action="<?= URL ?>Personas/listarPersonasEmpleados/<?= $persona['id_usuarios'] ?>" data-parsley-validate="">
                <div class="modal-body">
                  <input type="hidden" name="idPersona" value="<?= $persona['id_persona'] ?>">

                  <div class="row">
                      <div class="col-md-6">
                        <label for="">Número de documento</label>
                        <input type="text" name="txtIdPersona" value="<?= $persona['id_persona'] ?>" style="width: 100%"class="form-control" id="campoId" readonly="true">
                      </div>
                      <div class="col-md-6">
                        <label for="">Tipo de documento</label>
                        <input type="text" name="txtTipocedula" value="<?= $persona['tipo_documento'] ?>" style="width: 100%"class="form-control" id="campoId1" readonly="true">
                      </div>
                  </div>
                  <br>

        <div class="row">
                <div class="col-md-6" class="form-group">
                    <label>Nombres <span class="obligatorio">*</span></label><br>
                    <input type="text" tabindex="1" class="form-control" name="txtnombre" id="nombres"
                    value="<?= $persona['nombres'] ?>" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@\-\.\\ \/$]+" minlength="3" maxlength="30" data-parsley-required="true">
                  </div>

                    <div class="col-md-6">
                      <label>Apellidos <span class="obligatorio">*</span></label><br>
                        <input type="text"  tabindex="2" class="form-control" id="fecha"
                           value="<?= $persona['apellidos'] ?>" name="txtapell" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@\-\.\\ \/$]+" minlength="3" maxlength="30" onchange="(this)" data-parsley-required="true">
                    </div>
          </div>
          <br>
          <div class="row">
                       <div class="col-md-6">
                         <label>Nombre Usuario <span class="obligatorio">*</span></label><br>
                         <input type="text"  tabindex="3" class="form-control" id="txtusuario"
                                value="<?= $persona['nombre_usuario'] ?>" name="txtnombreusuario" maxlength="30" minlength="3" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9@#\-\_\\.\\ \/$]+" data-parsley-required="true">
                      </div>
                        <div class="col-md-6">
                          <?php if ($persona['id_usuarios'] != '1234567890'): ?>
                          <label>Rol Usuario <span class="obligatorio">*</span></label><br>
                          <select class="form-control"  tabindex="4" id="selectRol" name="txtrol" data-parsley-required="true">
                            <?php foreach($roles AS $rol): ?>
                              <option value="<?= $rol['id_rol'] ?>" <?= $persona['rol'] == $rol['id_rol'] ? 'selected="selected"' : '' ?>>
                                <?= $rol['nombre_rol']?>
                              </option>
                            <?php endforeach ?>
                          </select>

                        <?php endif; ?>
                        </div>
          </div>
          <br>
          <div class="row">
                            <div class="col-md-6">
                              <label>Celular <span class="obligatorio">*</span></label><br>
                              <input type="text"  tabindex="5" class="form-control" id="ejemplo_password_2"
                                     value="<?= $persona['celular'] ?>" name="txtcel" maxlength="12" minlength="10" data-parsley-type="number" data-parsley-required="true">
                             </div>

                           <div class="col-md-6">
                             <label>Email <span class="obligatorio">*</span></label><br>
                             <input type="email"  tabindex="6" class="form-control" id="txtemail"
                             value="<?= $persona['email'] ?>" name="txtcorreo" ata-parsley-type="email" data-parsley-required="true">
                           </div>
          </div>
          <br>
          <div class="row">
                       <div class="col-md-6">
                         <label>Teléfono</label><br>
                         <input type="text"  tabindex="7" class="form-control" id="ejemplo_password_2"
                                value="<?= $persona['telefono'] ?>" name="txttel" maxlength="10" minlength="7" data-parsley-type="number" data-parsley-required="false">
                        </div>
                        <div class="col-md-6">
                          <label>Dirección</label><br>
                            <input type="text"  tabindex="8" class="form-control" id="ejemplo_password_2"
                               value="<?= $persona['direccion'] ?>" name="txtdirecc" maxlength="50" minlength="3" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\*\?_~\\ \\.\/$]+" data-parsley-required="false">
                        </div>
          </div>
          <br>
          <div class="row">
                       <div class="col-md-6">
                         <label>Género <span class="obligatorio">*</span></label>
                         <select class="form-control"  tabindex="9" name="txtgenero" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" data-parsley-required="true">
                         <option value="Masculino" <?= $persona['genero'] == 'Masculino'? 'selected="selected"' : '' ?> >Masculino</option>
                         <option value="Femenino" <?= $persona['genero'] == 'Femenino'? 'selected="selected"' : '' ?>>Femenino</option>
                       </select>
                        </div>

                        <div class="col-md-6">
                          <label>Tipo Empleado <span class="obligatorio">*</span></label><br>
                          <select class="form-control"  tabindex="10" name="txtTipoEmpleado" id="Select-Empleado" data-parsley-type="alphanum" data-parsley-required="true">
                              <!-- <option>Seleccione un rol</option> -->
                            <?php foreach($TipoEmpleado AS $tipo): ?>
                              <option value="<?= $tipo['idTbl_tipo_persona'] ?>" <?= $persona['idTbl_tipo_persona'] == $tipo['idTbl_tipo_persona'] ? 'selected="selected"' : '' ?>>
                                <?= $tipo['Tbl_nombre_tipo_persona']?>
                              </option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                        <br>
                          <?php if ($persona['Tbl_TipoPersona_idTbl_TipoPersona'] == 1): ?>
                        <div class="row">
                          <?php
                              $hoy = date("Y-m-d");
                              $hoy1 = $persona['fecha_Contrato'];
                              $nuevaFecha = strtotime('-3 month', strtotime($hoy1));
                              $nuevaFecha = date('Y-m-d', $nuevaFecha);
                              $nuevaFecha2 = strtotime('+3 month', strtotime($hoy1));
                              $nuevaFecha2 = date('Y-m-d', $nuevaFecha2);
                           ?>
                        <div id="conFechaContrato" style="" class="col-md-6">
                            <label for="form-control">Fecha Contrato <span class="obligatorio">*</span></label>
                            <div class="input-group date calendario" data-provide="datepicker" id="dataPicker">
                            <input type="text"  tabindex="12" class="form-control" value="<?= $persona['fecha_Contrato'] ?>" name="txtfechac" readonly="true" id="campoFechaContrato" placeholder="Fecha Contrato" data-parsley-required="false">
                            <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                          </div>
                          </div>
                        </div>
                        <input type="hidden" id="campoFechaContrato2" value="<?= $nuevaFecha ?>">
                        <input type="hidden" id="campoFechaContrato3" value="<?= $nuevaFecha2 ?>">
                        <input type="hidden" id="campoFechaContrato4" value="<?= $hoy1 ?>">

                        <div class="col-md-6" id="div-fechaTer">
                          <label>Fecha Terminación Contrato</label>
                          <input class="form-control"  tabindex="13"  name="fechaTerminacionC" id="fechaTer" readonly="true" value="<?= $persona['fecha_Terminacion_Contrato'] ?>">
                        </div>
                          </div>
                           <?php endif; ?>

                          <?php if ($persona['Tbl_TipoPersona_idTbl_TipoPersona'] == 2): ?>
                            <?php
                                $hoy = date("Y-m-d");
                                $nuevaFecha = strtotime('-3 month', strtotime($hoy));
                                $nuevaFecha = date('Y-m-d', $nuevaFecha);
                                $nuevaFecha2 = strtotime('+3 month', strtotime($hoy));
                                $nuevaFecha2 = date('Y-m-d', $nuevaFecha2);
                             ?>
                            <div class="row">
                            <div id="conFechaContrato" style="" class="col-md-6" style="display: none">
                                <label for="" style="display: none" id="ftitulo">Fecha Contrato <span class="obligatorio">*</span></label>
                                <div class="input-group date calendario" data-provide="datepicker" id="dataPicker" style="display: none">
                                <input type="text"  tabindex="12" class="form-control" value="<?= $hoy ?>" name="txtfechac" id="campoFechaContrato2" readonly="true" data-parsley-required="false">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                              </div>
                              </div>
                            </div>
                            <input type="hidden" id="campoFecha1" value="<?= $nuevaFecha ?>">
                            <input type="hidden" id="campoFecha2" value="<?= $nuevaFecha2 ?>">
                            <input type="hidden" id="campoFecha3" value="<?= $hoy ?>">
                              </div>
                          <?php endif; ?>
                        </div>
                        <br><br>
                    </div>
                    <div class="row">
                    <div class="col-md-6 col-xs-6 col-lg-6">
                      <button type="submit"  tabindex="15" name="btn-modificar" class="btn btn-success active btn-md pull-right" id="btn-modificar"><i class="fa fa-floppy-o" aria-hidden="true">   Modificar</i></button>
                      <input type="hidden" tabindex="16">
                    </div>
                    <div class="col-xs-3 col-md-3 col-lg-3">
                     <button type="button" class="btn btn-danger btn-md active" onclick="cancelarMod()" style="float: right;" id="btnguardarP" title="Cancelar Registro"><i class="fa fa-times" aria-hidden="true">   Cancelar</i> </button>
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
      $("#btn-modificar").blur(function(e){
        $("#nombres").focus();
      })
    })
  </script>


<script type="text/javascript">
 $(document).ready(function(){
   $("#modal-actualizar").modal("show");

   $("#btnguardarP").click(function(){

     $("#form-2").parsley().validate();

   })
    });
</script>


  <?php if ($id!= "" && $tipo == 3): ?>
  <div class="modal fade" id="modal-detalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
       <div class="modal-dialog" style="width: 80%" role="document">
         <div class="modal-content" style="width: 100%">
                  <div class="modal-body">
                    <input type="hidden" name="idPersona" value="<?= $persona['id_persona'] ?>">
                    <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-primary" >
                          <div class="panel-heading" stlyle="height: 70px; width: 100px">
                            <center><span style="color: #fff; font-size: 18px" id="myModalLabel"><strong>Detalle de: <?= $persona['tipo_documento'] == "Cédula"? "C.C" : "C.E"  ?>: <?php echo $persona['id_persona']." - ".$persona['nombres'].' '.$persona['apellidos']?></strong></span></center>
                          </div>
                            <div class="panel-body">
                              <div class="dataTable_wrapper">
                                <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                          <tr>
                          <th>Nombre Usuario</th>
                          <th>Rol Usuario</th>
                          <th>Email</th>
                          <th>Género</th>
                        <?php if($persona['Tbl_TipoPersona_idTbl_TipoPersona'] == 1): ?>
                          <th>Fecha Inicio Contrato</th>
                          <th>Fecha Terminación Contrato</th>
                        <?php endif; ?>
                          <th>Teléfono</th>
                          </tr>
                        </thead>
                        <tbody>

                          <tr>
                            <td><?=  $persona['nombre_usuario'] ?></td>
                            <td><?=  $persona['nombre_rol'] ?></td>
                            <td><?=  $persona['email'] ?></td>
                            <td><?=  $persona['genero'] ?></td>
                            <?php if($persona['Tbl_TipoPersona_idTbl_TipoPersona'] == 1): ?>
                              <td><?= $persona['fecha_Contrato'] ?></td>
                              <td><?= $persona['fecha_Terminacion_Contrato'] ?></td>
                           <?php endif; ?>
                            <td><?=  $persona['telefono'] ?></td>
                          </tr>
                        </tbody>
                      </table>
                   </div>
                 </div>
               </div>
            </div>
         </div>
     <div class="row">
       <div class="col-md-11 col-xs-10 col-lg-11">
        <button type="button" class="btn btn-secondary btn-md active pull-right"  data-dismiss="modal" style="float: center"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
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
      $("#modal-detalles").modal("show");
    });
    </script>


  <?php if ($id != "" && $tipo == 2): ?>
  <form method="POST" id="form-3" role="form" data-parsley-validate="">
  <div class="modal fade" id="modal-cambiar-contras" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
   <div class="modal-dialog" role="document">
     <div class="modal-content" style="width: 100%">

              <div class="modal-body">
                <input type="hidden" name="idusuario" value="<?= $persona['id_usuarios'] ?>">

                <div class="row">
                    <div class="panel panel-primary" style="margin-left: 2%; margin-right: 2%">
                      <div class="panel-heading" stlyle="height: 70px; width: 100px">
                        <center><span style="color: #fff; font-size: 18px" id="myModalLabel"><strong>Cambiar Contraseña de: <?= $persona['tipo_documento'] == "Cédula"? "C.C" : "C.E"  ?> : <?= $persona['id_persona'].' - '.$persona['nombres'].' '.$persona['apellidos']?></strong></span></center>
                      </div>

                      <div class="panel-body">
                          <div class="col-xs-12 col-md-6" id="conClave" >
                              <label for="inputPassword"  class="control-label">Nueva Contraseña <span class="obligatorio">*</span></label>
                              <input type="password" tabindex="1"  maxlength="7" minlength="4" name="txtnueva" class="form-control" id="campoClave" placeholder="Contraseña" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\*\?_~\\.\\()\/$]+" data-parsley-required="true">
                          </div>

                          <div class="col-xs-12 col-md-6" id="conConfirmar">
                                <label for="">Confirmar Contraseña <span class="obligatorio">*</span></label>
                                <input type="password" tabindex="2" maxlength="7" minlength="4" name="txtConfClave" data-parsley-equalto="#campoClave" class="form-control" id="campoConfirmar" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\*\?_~\\.\\()\/$]+" placeholder="Confirmar Contraseña" data-parsley-required="true">
                          </div>

                        <div class="col-md-3">
                        </div>
                    </div>
                  </div>
                </div>
              </div>
                       <div class="row">
                          <div class="col-xs-6 col-md-6 col-lg-6">
                            <button type="submit" tabindex="4" name="btn-modificar-clave" class="btn btn-success btn-md active pull-right" id="btn-contras"><i class="fa fa-floppy-o" aria-hidden="true">  Modificar</i></button>
                            <input type="hidden" tabindex="5">
                         </div>
                         <div class="col-xs-6 col-md-6 col-lg-3">
                           <button type="button" tabindex="3" class="btn btn-secondary btn-md active"  data-dismiss="modal"><i class="fa fa-times" aria-hidden="true">   Cerrar</i></button>
                         </div>
                      </div>
                    <br>
                </div>
              </div>
            </div>
          </form>

              <script type="text/javascript">
                $(document).ready(function(){
                  $("#btn-contras").blur(function(e){
                    $("#campoClave").focus();
                  })
                })
              </script>

  <script type="text/javascript">
    $(document).ready(function(){
    $("#modal-cambiar-contras").modal("show");
  });
  </script>

  <?php endif; ?>
  <script type="text/javascript">
  function cambiarestado(id){
swal({
  title: "¿Realmente desea cambiar el estado del usuario?",
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
          url:url+"Personas/cambiarEstado",
          data:{
          'id':id,
        },
        }).done(function(respuesta){
          if(respuesta == 1){
            window.location = url + "Personas/listarPersonasEmpleados";
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

  <?php if ($persona['Tbl_TipoPersona_idTbl_TipoPersona'] == 1): ?>
  <script type="text/javascript">
  $(document).ready(function(){
  //$("#Select-Empleado").select2();
  $("#Select-Empleado").change(function(){
   var tipo=$(this).val();
   if(tipo == 1){
     $("#conFechaContrato").slideDown();
     $("#dataPicker").slideDown();
     $("#campoFechaContrat").attr("required", 'true');
     $("#div-fechaTer").slideDown();

   }else if(tipo == 2){
     $("#conFechaContrato").slideUp();
     $("#dataPicker").slideUp();
     $("#campoFechaContrat").removeAttr("required");
     $("#div-fechaTer").slideUp();

   }
  });
  });
  </script>
  <?php endif; ?>

 <?php if ($persona['Tbl_TipoPersona_idTbl_TipoPersona'] == 2): ?>
  <script type="text/javascript">
  $(document).ready(function(){
  //$("#Select-Empleado").select2();
  $("#Select-Empleado").change(function(){
   var tipo=$(this).val();
   if(tipo == 1){

     $("#ftitulo").slideDown();
     $("#conFechaContrato").slideDown();
      $("#dataPicker").slideDown();
     $("#campoFechaContrato").attr("required", 'true');
     $("#div-fechaTer").slideDown();

   }else if(tipo == 2){

     $("#ftitulo").slideUp();
     $("#conFechaContrato").slideUp();
     $("#dataPicker").slideUp();
     $("#campoFechaContrato").removeAttr("required");
     $("#div-fechaTer").slideUp();
   }
  });
  });
  </script>
<?php endif; ?>

<?php if (isset($validarUsu) && $validarUsu == false): ?>
  <script type="text/javascript">
    $(document).ready(function(){
      swal({
            title: "Nombre de usuario o correo ya existe, no se puede modificar!",
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
  $("#campoFechaContrato").change(function(){
    var valor3 = $('#campoFechaContrato').val();
    var valor4 = $('#campoFechaContrato2').val();
    var valor5 = $('#campoFechaContrato4').val();

    if(valor3 < valor4){
      swal({
              title: "Fecha inválida, la fecha no puede ser menor a 3 meses!",
              type: "error",
              confirmButtonColor: "#86CCEB",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,

              },
              function(isConfirm){
              if (isConfirm) {
                  $('#campoFechaContrato').val(valor5);
              }
            })
          }

  });

</script>

<script type="text/javascript">
  $("#campoFechaContrato").change(function(){
    var valor3 = $('#campoFechaContrato').val();
    var valor4 = $('#campoFechaContrato2').val();
    var valor5 = $('#campoFechaContrato4').val();

    if(valor3 < valor4){
      swal({
              title: "Fecha inválida, la fecha no puede ser menor a 3 meses!",
              type: "error",
              confirmButtonColor: "#86CCEB",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,

              },
              function(isConfirm){
              if (isConfirm) {
                  $('#campoFechaContrato').val(valor5);
              }
            })
          }

  });

</script>

<script type="text/javascript">
  $("#campoFechaContrato").change(function(){
    var valor = $('#campoFechaContrato').val();
    var valor2 = $('#campoFechaContrato3').val();
    var valor3 = $('#campoFechaContrato4').val();

    if(valor > valor2){
      swal({
              title: "Fecha inválida, la fecha no puede ser mayor a 3 meses!",
              type: "error",
              confirmButtonColor: "#86CCEB",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,

              },
              function(isConfirm){
              if (isConfirm) {
                  $('#campoFechaContrato').val(valor3);
              }
            })
          }
  });

</script>

<script type="text/javascript">
  $("#campoFechaContrato2").change(function(){
    var valor = $('#campoFechaContrato2').val();
    var valor2 = $('#campoFecha2').val();
    var valor3 = $('#campoFecha3').val();

    if(valor > valor2){
      swal({
              title: "Fecha inválida, la fecha no puede ser mayor a 3 meses!",
              type: "error",
              confirmButtonColor: "#86CCEB",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,

              },
              function(isConfirm){
              if (isConfirm) {
                  $('#campoFechaContrato2').val(valor3);
              }
            })
          }
  });

</script>

<script type="text/javascript">
  $("#campoFechaContrato2").change(function(){
    var valor = $('#campoFechaContrato2').val();
    var valor2 = $('#campoFecha1').val();
    var valor3 = $('#campoFecha3').val();

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
                  $('#campoFechaContrato2').val(valor3);
              }
            })
          }
  });

  function  cancelarMod() {
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
          window.location= url + 'Personas/listarPersonasEmpleados';
        });
      }
      });
  }

</script>

<script type="text/javascript">

  $("#txtemail").change(function(){
      var correo = $("#txtemail").val();
      var id = $("#campoId").val();

        $.ajax({
          type:"POST",
          url:url+"Personas/validacionModCorreo",
          data:{
          'correo':correo, 'id': id,
        },
        }).done(function(respuesta){
          if(respuesta == 1){
            swal({
              title: "Correo ya existe!",
              type: "error",
              confirmButton: "#3CB371",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
              closeOnCancel: false
            });
          }else{

          }
        })

  })

</script>


<script type="text/javascript">

  $("#txtusuario").change(function(){
      var usuario = $("#txtusuario").val();
      var id = $("#campoId").val();

        $.ajax({
          type:"POST",
          url:url+"Personas/validacionModUsuario",
          data:{
          'usuario':usuario, 'id': id,
        },
        }).done(function(respuesta){
          if(respuesta == 1){
            swal({
              title: "Nombre de usuario ya existe!",
              type: "error",
              confirmButton: "#3CB371",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
              closeOnCancel: false
            });
          }else{

          }
        })

  })

</script>
