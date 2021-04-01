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
<center><legend><2>INFORME PRODUCTOS EN STOCK MÍNIMO</h2></legend></center>
  <br>
  <p><strong>Fecha reporte: <?= ucwords(date("Y/m/d h:i:s"))?></strong></p>
  <table border="1">
    <thead>
      <tr>
         <th>Código Producto</th>
         <th>Nombre Producto</th>
         <th>Categoría</th>
         <th>Cantidad Disponible</th>
         <th>Stock</th>
         <th>Precio Detal</th>
         <th>Precio Por Mayor</th>
         <th>Precio Unitario</th>
         <th>Estado</th>
      </tr>
    </thead>
    <tbody>
       <?php foreach ($bajas as $value): ?>
                           <tr>
                             <td><?= $value['Tbl_Productos_id_productos'] ?></td>
                             <td>
                               <?= $value['nombre_producto'] ?>
                             </td>
                             <td>
                               <?= $value['nombre'] ?>
                             </td>
                             <td>
                               <?= $value['fecha_salida'] ?>
                             </td>
                             <td>
                               <?= $value['Cantidad'] ?>
                             </td>
                             <td>
                               <?= $value['tipo_baja'] ?>
                             </td>
                           </tr>
                          <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
