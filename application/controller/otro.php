<?php

class Otro extends Controller{


      private $modelo;

      function __construct()
      {
        try {
            $this->modelo = $this->loadModel('mdlLogin');
        } catch (Exception $e) {

        }
      }



      public function index(){
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

      public function index2(){
        require APP . 'view/_templates/header.php';
        require APP . 'view/index/mapa.php';
        require APP . 'view/_templates/footer.php';
      }

}

?>
