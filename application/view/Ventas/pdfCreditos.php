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
  <center><legend><h2>INFORME GENERAL DE CRÉDITOS EN ESTADO PENDIENTE</h2></legend></center>
    <h4><strong>Informe de : <?= $rango ?> </strong></h4>
    <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Identificación Cliente</th>
        <th>Tipo de Documento</th>
        <th>Nombres Cliente</th>
        <th>Tipo Cliente</th>
        <th>Valor Crédito</th>
        <th>Estado Crédito</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($listarC as $valor): ?>
      <tr>
        <td><?= $valor['id_persona'] ?></td>
          <td><?= $valor['tipo_documento'] ?></td>
          <td><?= ucwords($valor['cliente']) ?></td>
          <td><?= $valor['Tbl_nombre_tipo_persona'] ?></td>
          <td><?= "$ ". number_format($valor['total_venta'], "0", ".", ".") ?></td>
          <td><?= $valor['estado_credito'] ==1?"Pendiente" : "Pagado" ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <?php foreach ($totalCreditosFecha as $val): ?>
      <p style="text-align: right"><strong>Total Créditos: <?= "$ ".number_format($val['total'], "0", ".", "."); ?></strong></p>
  <?php endforeach; ?>
<script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
