<?php

class Error extends Controller{

  public function sinPermiso(){

    $creditos = $this->modelo->creditos();
    $prestamos = $this->modelo->Prestamos();
    $ventasDia = $this->modelo->VentasDia();
    $comprasDia = $this->modelo->ComprasDia();
    $comprasMes = $this->modelo->ComprasMes();
    $ventasMes = $this->modelo->VentasMes();
    require APP . 'view/_templates/header.php';
    require APP. 'view/index/index.php';
    require APP . 'view/_templates/footer.php';
    echo "<h1>No tiene permisos</h1>";
  }
}
