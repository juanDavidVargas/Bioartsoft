<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <link href="<?= URL ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>css/metisMenu.min.css" rel="stylesheet">
    <link href="<?= URL ?>css/sb-admin-2.css" rel="stylesheet">
    <link href="<?= URL ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo URL ?>css/sweetalert.css">

    <script src="<?= URL ?>js/jquery-1.12.3.min.js"></script>
    <script src="<?= URL ?>js/parsley.min.js"></script>
    <script src="<?= URL ?>js/i18n/es.js"></script>

</head>

<body background="<?= URL ?>img/fondo.png" style="background-size: cover">

    <div class="container">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
                  <div class="login-panel panel panel-default">
                      <div class="panel-heading">
                         <center>
                          <img alt="Brand" src="<?= URL ?>img/LOGOv2.png" style="height:100px">
                          <h3 class="panel-title"></h3>
                        </center>
                      </div>
                      <div class="panel-body">
                          <form role="form" method="post" data-parsley-validate="">
                              <fieldset><br>
                                <?php if ($estado == true): ?>
                                  <div class="alert alert-danger ">
                                      <p>
                                        Usuario inhabilitado, no puede ingresar
                                      </p>
                                  </div>
                                <?php endif; ?>
                                <?php if ($error == true): ?>
                                  <div class="alert alert-danger ">
                                      <p>
                                        Usuario o contraseña incorrecta
                                      </p>
                                  </div>
                                <?php endif; ?>

                                <?php if ($error2 == true): ?>
                                  <div class="alert alert-danger ">
                                      <p>
                                        No existe usuario o contraseña
                                      </p>
                                  </div>
                                <?php endif; ?>
                                  <div class="form-group">
                                      <input tabindex="1" class="form-control" id="nombre" placeholder="Nombre de usuario *" name="txtPersona" type="text" data-parsley-required="true" maxlength="20" minlength="3" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9@#\-\_\\.\\ \/$]+" autofocus="true">
                                  </div>
                                  <div class="form-group">
                                      <input tabindex="2" class="form-control" id="clave" placeholder="Contraseña *" name="txtContras" type="password" data-parsley-required="true" maxlength="15" minlength="3" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\*\?_~\\.\\()\/$]+">
                                  </div><br>
                                    <button tabindex="3" type="submit" name="btnIniciar" id="btn-iniciar" class="btn btn-lg btn-primary btn-block">Iniciar sesión</button>
                                    <br>
                                  <div class="checkbox">
                                          <a tabindex="4" href="<?= URL ?>login/recuperarContras" id="recuperarContras" style="margin-left: 80px;color: blue; text-decoration: underline">¿Olvidó la Contraseña?</a>
                                          <p tabindex="5">
                                            &nbsp;
                                          </p>
                                  </div>
                              </fieldset>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <script type="text/javascript">
        $(document).ready(function(){
          $("#recuperarContras").blur(function(e){
                $("#nombre").focus();

          })
        })
      </script>

    <!-- jQuery -->
    <script src="<?= URL ?>js/jquery.min.js"></script>

    <script type="text/javascript" src="<?php echo URL ?>js/sweetAlert.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= URL ?>js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= URL ?>js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
