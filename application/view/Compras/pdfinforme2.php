<html>
<head>

  <style media="screen">
    table{
      width: 100%;
    }
  </style>
  <link href="<?php echo URL?>css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <img src="<?php echo URL ?>img/bio-artes.png" height="100" width="400">
  <br>
  <center><legend><h2>INFORME DE ENTRADAS</h2></legend></center>
      <h4><strong>Informe de : <?= $rango ?> </strong></h4>
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Código Entrada</th>
        <th>Fecha Entrada</th>
        <th>Valor Total Entrada</th>
        <th>Proveedor</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ver as $valor): ?>
      <tr>
          <td><?= $valor['id_compras'] ?></td>
          <td><?= $valor['fecha_compra'] ?></td>
          <td><?= "$ ".number_format($valor['valor_total'], "0", ".", ".") ?></td>
          <td><?= ucwords($valor['proveedor']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php foreach ($totalCompraFecha as $val): ?>
    <p style="text-align: right"><strong>Total Entradas: <?= "$ ".number_format($val['total'], "0", ".", "."); ?></strong></p>
<?php endforeach; ?>
<script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
