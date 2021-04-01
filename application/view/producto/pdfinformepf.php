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
<center><legend><h2>INFORME GENERAL DE PRODUTOS HABILITADOS</h2></legend></center>
  <br>
  <p>
    <strong>Fecha Reporte: <?= date("Y/m/d H:i:s")  ?></strong>
  </p>
  <table class="table table-striped">
    <thead>
      <tr>
       <th>Código Producto</th>
       <th>Nombre Producto</th>
       <th>Categoría</th>
       <th>Cantidad Disponible</th>
       <th>Precio Unitario</th>
       <th>Precio Detal</th>
       <th>Precio al por Mayor</th>
      </tr>
    </thead>
    <tbody>
     <?php foreach ($ver2 as $val) :  ?>
     <tr>
       <td class="price"><?= $val["id_producto"]  ?></td>
       <td><?= ucwords($val["nombre_producto"]) ?></td>
       <td><?= ucwords($val["nombre"]) ?></td>
       <td><?= $val["cantidad"] ?></td>
       <td><?= "$ ". number_format($val["precio_unitario"], "0", ".", ".") ?></td>
       <td><?= "$ ". number_format($val["precio_detal"], "0", ".", ".") ?></td>
       <td><?= "$ ". number_format($val["precio_por_mayor"], "0", ".", ".") ?></td>
</tr>
 <?php endforeach ?>
    </tbody>
  </table>
  <script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
