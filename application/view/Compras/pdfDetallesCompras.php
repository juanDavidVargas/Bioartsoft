<html>
<head>
<style media="screen">
  table{
    width: 100%;
  }
</style>
  <link href="<?php echo URL?>css/bootstrap.min.css" rel="stylesheet">
  <title>Reporte Entradas</title>
</head>
<body>
  <img src="<?php echo URL ?>img/bio-artes.png" height="100" width="400">
  <br>
  <center><legend><h2>DETALLE DE ENTRADA CÓDIGO: <?= $val['id_compras'] ?></h2></legend></center>
  <br>
<?php if($val['estado'] == 0): ?>
  <h3>Esta entrada fue anulada</h3>
<?php else: ?>
<?php endif; ?>
<br>
  <p><strong>Fecha Informe: <?= ucwords(date("Y/m/d h:i:s"))?></strong></p>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Fecha Entrada</th>
        <th>Nombre Proveedor</th>
        <th>Total Entrada</th>
      </tr>
    </thead>
    <tbody>
      <?= $tabla2 ?>
    </tbody>
  </table>
  <br>

  <legend><h4>Productos</h4></legend>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?= $tabla ?>
    </tbody>
  </table>
  <script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
