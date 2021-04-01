<?php


class Login extends Controller
{
  private $modelo;
  private $modeloP;

  function __construct()
  {
    try {
        $this->modelo = $this->loadModel('mdlLogin');
        $this->modeloP = $this->loadModel("mdlPersona");
    } catch (Exception $e) {

    }
  }
  public function iniciar(){
    if(isset($_SESSION['SESION INICIADA']) && $_SESSION['SESION INICIADA'] == true){
      header("Location:".URL . "login/index");
      exit();
    }
    $errorVacios = false;
    $error = false;
    $error2 = false;
    $estado = false;
    if (isset($_POST['btnIniciar'])) {

      if ($_POST['txtContras'] != null && $_POST['txtPersona'] != null) {
        $this->modelo-> __SET('nombre_usuario', $_POST['txtPersona']);
        $usuario = $this->modelo->buscarUsuario2();

        if($usuario['total'] == 0){

          $error2 = true;

        }else{

        $persona = $this->modelo->buscarUsuario();
        // echo "<pre>";
        // var_dump($persona);
        // exit();
        $contrasenia = trim(decrypt($persona['clave']));

          if ($persona['nombre_usuario'] == $_POST['txtPersona'] && $contrasenia == $_POST['txtContras'] && $persona['estado'] == 1) {
            $_SESSION['SESION INICIADA'] = true;
            $_SESSION['USUARIO_ID'] = $persona['id_usuarios'];
            $_SESSION['ROL'] = $persona['rol'];
            $_SESSION['USUARIO'] = $persona['nombres'];
            $_SESSION['USUARIO-APE'] = $persona['apellidos'];
            $_SESSION['NOMBRE_ROL'] = $persona['nombre_rol'];
            if($persona['estado'] == 1){

              header("Location:".URL."login/index");

            }else{
              $estado = true;
          }

        }else{

              $error = true;
        }
    }

  }else{

             $errorVacios = true;
       }

  }
        require APP.'view/Login/Login.php';

      }



      public function index()
      {
        $creditos = $this->modelo->creditos();
        $prestamos = $this->modelo->Prestamos();
        $ventasDia = $this->modelo->VentasDia();
        $comprasDia = $this->modelo->ComprasDia();
        $comprasMes = $this->modelo->ComprasMes();
        $ventasMes = $this->modelo->VentasMes();
        require APP . 'view/_templates/header.php';
        require APP . 'view/index/index.php';
        require APP . 'view/_templates/footer.php';
      }



      public function cerrarsesion(){
          if (isset($_SESSION['SESION INICIADA'])) {
            session_destroy();
          }
            header("Location:".URL."login/iniciar");
            exit();
      }



      public function recuperarContras(){

        $html = "";
        $html .='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $html .='<html xmlns="http://www.w3.org/1999/xhtml">';
        $html .='<head>';
        $html .='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $html .='<title>Bioartsoft</title>';
        $html .='</head>';
        $html .='<body>';
        $html .='<div style="width: 100%" >';
        // $html .='<img src="'.URL.'img/BioartesV2.png" alt="No encontrada">';
        $html .='<img src="https://s12.postimg.org/ismdhzhu5/Bioartes_V2.png" alt="No encontrada" height="100">';
        $html .='<h3>BIOARTES</h3>';
        $html .='<h4>Solicitud para recuperación de contraseña</h4>';
        $html .='<strong>Su contraseña es: </strong>';

        $mensaje = false;
        $error2 = false;
        $error3 = false;
        $alerta = false;
        if (isset($_POST['btnEnviar-Correo'])) {

         if ($_POST['txtNombreUsu'] != null && $_POST['txtEmailUsu'] != null) {
            $this->modelo-> __SET('nombre_usuario', $_POST['txtNombreUsu']);
            $this->modelo-> __SET('correo', $_POST['txtEmailUsu']);
            $usuario = $this->modelo->existeUsuario();

            if ($usuario['nombre_usuario'] == $_POST['txtNombreUsu'] && $usuario['email'] == $_POST['txtEmailUsu']) {

              $correo = $usuario['email'];
              require APP . 'libs/swiftmailer/lib/swift_required.php';

              // Create the Transport
              $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
              ->setUsername(EMAIL_ADMIN)
              ->setPassword(EMAIL_ADMIN_PASS);

              // Create the Mailer using your created Transport
              $mailer = Swift_Mailer::newInstance($transport);
              $contrasenia = decrypt($usuario['clave']);
              $html .= $contrasenia;
              $html .='</div>';
              $html .='</body>';

              // Create a message
              $message = Swift_Message::newInstance('Recuperación Contraseña')
                ->setFrom(array(EMAIL_ADMIN => EMAIL_ALIAS))
                ->setTo(array($correo => 'A name'))
                ->setBody($html, 'text/html');

              // Send the message
              $result = $mailer->send($message);

              $mensaje = true;

              $alerta = true;

            }else{
              $error2 = true;
            }

          }else{
            $error3 = true;
          }

      }

      require APP.'view/Login/RecuperarClave.php';

      }
  }
