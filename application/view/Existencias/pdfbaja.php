<!DOCTYPE html>
<html>
<head>
  <style media="screen">
    table{
      width: 100%;
    }
  </style>
</head>
<body>
  <img src="<?php echo URL ?>img/bio-artes.png" height="100" width="400">
  <br>
<center><legend><h2>INFORME DE BAJAS</h2></legend></center>
  <br>
  <h4><strong>Informe de : </strong><?= $rango ?> </h4>
  <table border="1">
    <thead>
      <tr>
      <th>Código Baja</th>
      <th>Empleado Responsable Baja</th>
      <th>Identificación Empleado</th>
      <th>Producto</th>
      <th>Categoría</th>
      <th>Fecha Registro Baja</th>
      <th>Cantidad</th>
      <th>Tipo de Baja</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bajas as $value): ?>
                           <tr>
                             <td><?= $value['id_bajas'] ?></td>
                             <td><?= $value['empleado'] ?></td>
                             <td><?= $value['id_persona'] ?></td>
                             <td><?= $value['nombre_producto'] ?></td>
                             <td><?= $value['nombre'] ?></td>
                             <td><?= $value['fecha_salida'] ?></td>
                             <td><?= $value['Cantidad'] ?></td>
                             <td><?= $value['tipo_baja'] ?></td>
                           </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
