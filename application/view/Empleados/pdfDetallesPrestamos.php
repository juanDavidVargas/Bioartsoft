<html>
<head>
<style media="screen">
  table{
    width: 100%;
  }
</style>
<link href="<?php echo URL?>css/bootstrap.min.css" rel="stylesheet">
  <title>Reporte Préstamos</title>
</head>
<body>
  <img src="<?php echo URL ?>img/bio-artes.png" height="100" width="400">
  <br>
  <center><legend><h2>INFORME DE PRÉSTAMOS DE: <?= $val['empleado'] ?></h2></legend></center>
  <br>
    <p><strong>Fecha Informe: <?= ucwords(date("Y/m/d h:i:s"))?></strong></p>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Tipo de Documento</th>
        <th>Identificación</th>
        <th>Nombre Empleado</th>
        <th>Tipo Empleado</th>
        <th>Fecha Préstamo</th>
        <th>Valor Préstamo</th>
        <th>Descripción</th>
        <th>Fecha Límite</th>
      </tr>
    </thead>
    <tbody>
      <?= $tabla ?>
    </tbody>
  </table>
  <script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
