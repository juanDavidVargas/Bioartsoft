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
<center><legend><h2>INFORME DE PRÉSTAMOS EN ESTADO PENDIENTE</h2></legend></center>
    <h4><strong>Informe de : <?= $rango ?> </strong></h4>
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Tipo de Docuento</th>
       <th>Identificación Empleado</th>
       <th>Nombre Empleado</th>
       <th>Apellido Empleado</th>
       <th>Tipo Empleado </th>
       <th>Fecha Préstamo</th>
       <th>Valor Préstamo</th>
       <th>Descripción</th>
       <th>Fecha Límite</th>
       <th>Estado Préstamo</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($ver as $val) :  ?>
       <tr>
         <td><?= $val["tipo_documento"]  ?></td>
         <td><?= $val["id_persona"]  ?></td>
         <td style="width: 12%"><?= ucwords($val["nombres"])?></td>
         <td style="width: 12%"><?= ucwords($val["apellidos"])?></td>
         <td style="width: 12%"><?= $val["Tbl_nombre_tipo_persona"] ?></td>
         <td style="width: 12%"><?= $val["fecha_prestamo"] ?></td>
         <td style="width: 12%"><?= "$ ". number_format($val["valor_prestamo"], "0", ".", ".")  ?></td>
         <td style="width: 10%"><?= $val["descripcion"]  ?></td>
         <td><?= $val["fecha_limite"] ?></td>
         <?php if ($val["estado_prestamo"] == 1) { ?>
            <td>Pendiente</td>
        <?php }elseif ($val["estado_prestamo"] == 0) { ?>
            <td>Pagado</td>
        <?php }else { ?>
            <td>Condonado</td>
        <?php } ?>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <?php foreach ($totalPrestamosFecha as $value): ?>
      <p style="text-align: right"><strong>Total Préstamos: <?= "$ ".number_format($value['total'], "0", ".", "."); ?></strong></p>
  <?php endforeach; ?>
  <script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
