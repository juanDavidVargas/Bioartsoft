<?php

  class Usuarios extends controller{

    public function registrarUsuarios(){
      $modeloconfiguracion = $this->loadModel("mdlConfiguracionPago");
      $configuracion = $modeloconfiguracion->listarConfiguracion();
      require APP . 'view/_templates/header.php';
      require APP . 'view/Usuarios/registrarUsuarios.php';
      require APP . 'view/_templates/footer.php';
    }

    public function listarUsuarios(){
      $modeloconfiguracion = $this->loadModel("mdlConfiguracionPago");
      $configuracion = $modeloconfiguracion->listarConfiguracion();
      require APP . 'view/_templates/header.php';
      require APP . 'view/Usuarios/listarUsuarios.php';
      require APP . 'view/_templates/footer.php';
    }

  }
