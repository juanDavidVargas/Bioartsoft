<html>
<head>
<style media="screen">
  table{
    width: 100%;
  }
</style>
  <title>Recibo de abono</title>
</head>
<body>
  <h2 style="text-align: center">BIOARTES</h2>
  <div style="text-align: center">
    <p>Nit: </p>
    <p>Centro Comercial Cisneros</p>
    <p>Teléfono: 513-10-12</p>
    <p>Cra. 51 N° 44 – 69, Local 144 B - Medellín</p>
  </div>
  Recibo de abono número: <strong><?= $val['idTbl_Abono_Prestamo'] ?></strong><br>
  Fecha: <?= $val['fecha_abono'];?>&nbsp;&nbsp;&nbsp;&nbsp;<?= date("H:i:s"); ?>
  <br><br>
  Empleado: <strong><?= ucwords($val['empleado']) ?></strong><br>
  Identificación: <strong><?= $val['id_persona'] ?></strong><br>
  Tipo de Documento: <strong><?= $val['tipo_documento'] ?></strong><br>
  <br>
  ----------------------------------------------------------<br>
  ----------------------------------------------------------<br><br>
  <center><legend><h3>RECIBO DE ABONO DE PRÉSTAMO</h3></legend></center>
  <br>
  <table>
    <thead>
      <tr>
        <th>Valor Préstamo</th>
        <th>Valor Abono</th>
        <th>Total Abonado</th>
        <th>Pendiente</th>
      </tr>
    </thead>
    <tbody>
      <?= $tabla2 ?>
    </tbody>
  </table>
  <br><br>
  -----------------------------------------------------------<br>
  -----------------------------------------------------------<br><br>
  <p>Recuerde cancelar antes del: <?= $val['fecha_limite'] ?></p>
</body>
</html>
