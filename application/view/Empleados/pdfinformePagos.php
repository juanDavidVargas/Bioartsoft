<!DOCTYPE html>
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
<center><legend><h2>INFORME DE PAGOS DE: <?= $val['empleado']; ?></h2></legend></center>
  <br>
    <p><strong>Fecha Informe: <?= ucwords(date("Y/m/d h:i:s"))?></strong></p>
  <table class="table table-striped">
    <thead>
      <tr>
       <th>Tipo de Documento</th>
       <th>Identificación Empleado</th>
       <th>Nombres Empleado</th>
       <th>Tipo Empleado </th>
    <?php if($val['Tbl_nombre_tipo_persona'] == "Empleado-temporal"): ?>
       <th>Tipo Pago</th>
       <th>Fecha Pago</th>
       <th>Valor Día</th>
       <th>Total Días</th>
       <th>Total Pagado</th>
     <?php else: ?>
       <th>Tipo Pago</th>
       <th>Fecha Pago</th>
       <th>Valor Día</th>
       <th>Valor Comisión</th>
       <th>Valor Prima</th>
       <th>Valor Cesantías</th>
       <th>Valor Vacaciones</th>
       <th>Total Pagado</th>
     <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?= $tabla; ?>
    </tbody>
  </table>
  <script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
