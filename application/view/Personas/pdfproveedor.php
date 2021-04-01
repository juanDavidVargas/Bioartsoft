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
<center><legend><h2>INFORME GENERAL DE PROVEEDORES HABILITADOS</h2></legend></center>
  <br>
  <p><strong>Fecha Reporte: <?= ucwords(date("Y/m/d H:i:s")) ?></strong></p>
  <table class="table table-striped">
    <thead>
      <tr>
                                <th>Tipo de Documento</th>
                                <th>Identificación</th>
                                <th>Nombres Proveedor</th>
                                <th>Apellidos Proveedor</th>
                                <th>Tipo Proveedor</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Celular</th>
      </tr>
    </thead>
    <tbody>
     <?php foreach ($listarP as $valor): ?>
                            <tr>
                                <td><?= $valor['tipo_documento'] == "Cedula"?"Cédula" : "Cédula Extranjera" ?></td>
                                <td><?= $valor['id_persona'] ?></td>
                                <td><?=  ucwords($valor['nombres']) ?></td>
                                <td><?=  ucwords($valor['apellidos']) ?></td>
                                <td><?=  $valor['Tbl_nombre_tipo_persona'] ?></td>
                                <td style="width: 15%"><?=  $valor['email'] ?></td>
                                <td style="width: 10%"><?=  $valor['telefono'] ?></td>
                                <td style="width: 10%"><?=  $valor['celular'] ?></td>
                              </tr>
     <?php endforeach; ?>
    </tbody>
  </table>
<script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
